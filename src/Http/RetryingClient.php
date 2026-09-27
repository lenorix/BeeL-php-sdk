<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use GuzzleHttp\Psr7\Utils;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/** Adds BeeL's retry and POST idempotency behavior around Jane's PSR-18 transport. */
final readonly class RetryingClient implements ClientInterface
{
    public const DEFAULT_MAX_RETRIES = 3;

    public const DEFAULT_RETRY_DELAY_MS = 500;

    public const DEFAULT_MAX_RETRY_DELAY_MS = 30_000;

    private const IDEMPOTENT_METHODS = ['GET', 'HEAD', 'OPTIONS', 'PUT', 'DELETE'];

    private ResponseContext $responseContext;

    public function __construct(
        private ClientInterface $client,
        private int $maxRetries = self::DEFAULT_MAX_RETRIES,
        private int $retryDelayMs = self::DEFAULT_RETRY_DELAY_MS,
        private int $maxRetryDelayMs = self::DEFAULT_MAX_RETRY_DELAY_MS,
        private bool $autoIdempotencyKey = true,
        ?ResponseContext $responseContext = null,
    ) {
        $this->responseContext = $responseContext ?? new ResponseContext;

        if ($maxRetries < 0 || $retryDelayMs < 0 || $maxRetryDelayMs < 0) {
            throw new \InvalidArgumentException('Retry limits and delays must not be negative.');
        }
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        foreach ($this->responseContext->requestOptions()?->allHeaders() ?? [] as $name => $value) {
            $request = $request->withHeader($name, $value);
        }
        // Like the official Node.js SDK, send an empty JSON object when a write has no body at all.
        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'], true)
            && ! $request->hasHeader('Content-Type') && $request->getBody()->getSize() === 0) {
            $request = $request->withBody(Utils::streamFor('{}'))
                ->withHeader('Content-Type', 'application/json')
                ->withoutHeader('Content-Length');
        }
        if ($request->getMethod() === 'POST' && $this->autoIdempotencyKey && ! $request->hasHeader('Idempotency-Key')) {
            $request = $request->withHeader('Idempotency-Key', $this->uuid());
        }

        $body = $request->getBody();
        $position = $body->isSeekable() ? $body->tell() : null;
        $canReplayBody = $position !== null || $body->getSize() === 0;
        $options = $this->responseContext->requestOptions();
        $maxRetries = $options->maxRetries ?? $this->maxRetries;
        // A POST or PATCH that failed with a 5xx may already have been applied; repeat it only when BeeL can deduplicate it.
        $canRetry = ($options->retryServerErrors ?? true)
            && (in_array($request->getMethod(), self::IDEMPOTENT_METHODS, true) || $request->hasHeader('Idempotency-Key'));

        for ($attempt = 0; ; $attempt++) {
            if ($attempt > 0 && $position !== null) {
                $body->seek($position);
            }

            $response = $this->client->sendRequest($request);
            // Jane's generated error handling assumes a Content-Type; proxies often omit it on errors.
            if ($response->getStatusCode() >= 400 && ! $response->hasHeader('Content-Type')) {
                $response = $response->withHeader('Content-Type', 'application/octet-stream');
            }
            $this->responseContext->capture($response);
            // BeeL rejects a 429 without applying it; a 5xx may have been applied, so it needs $canRetry.
            $status = $response->getStatusCode();
            $retryable = $status === 429 || ($status >= 500 && $canRetry);
            if ($attempt >= $maxRetries || ! $canReplayBody || ! $retryable) {
                return $response;
            }

            $delay = $this->retryDelay($response, $attempt);
            if ($delay > 0) {
                usleep($delay * 1_000);
            }
        }
    }

    public function responseContext(): ResponseContext
    {
        return $this->responseContext;
    }

    private function retryDelay(ResponseInterface $response, int $attempt): int
    {
        $retryAfter = $response->getHeaderLine('Retry-After');
        if ($retryAfter !== '' && ctype_digit($retryAfter)) {
            return $this->boundedDelay((float) $retryAfter);
        }
        if ($retryAfter !== '' && ($retryAt = strtotime($retryAfter)) !== false) {
            return $this->boundedDelay(max(0, $retryAt - time()));
        }
        $body = $response->getBody();
        if ($body->isSeekable()) {
            $position = $body->tell();
            try {
                $error = json_decode((string) $body, true);
                $seconds = $error['error']['retry_after'] ?? $error['retry_after'] ?? null;
                if (is_numeric($seconds)) {
                    return $this->boundedDelay((float) $seconds);
                }
            } finally {
                $body->seek($position);
            }
        }

        $base = min($this->retryDelayMs, $this->maxRetryDelayMs);
        for ($step = 0; $step < $attempt && $base < $this->maxRetryDelayMs; $step++) {
            $base = $base > intdiv($this->maxRetryDelayMs, 2)
                ? $this->maxRetryDelayMs
                : $base * 2;
        }
        if ($base === 0) {
            return 0;
        }

        return random_int((int) ($base * 0.5), $base);
    }

    private function boundedDelay(float $seconds): int
    {
        return (int) min(max(0, $seconds * 1_000), $this->maxRetryDelayMs);
    }

    private function uuid(): string
    {
        $bytes = random_bytes(16);
        $bytes[6] = chr((ord($bytes[6]) & 0x0F) | 0x40);
        $bytes[8] = chr((ord($bytes[8]) & 0x3F) | 0x80);
        $hex = bin2hex($bytes);

        return sprintf('%s-%s-%s-%s-%s', substr($hex, 0, 8), substr($hex, 8, 4), substr($hex, 12, 4), substr($hex, 16, 4), substr($hex, 20));
    }
}
