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
        if ($request->getMethod() === 'POST' && $this->autoIdempotencyKey && ! $request->hasHeader('Idempotency-Key')) {
            $request = $request->withHeader('Idempotency-Key', $this->uuid());
        }

        $body = $request->getBody();
        $position = $body->isSeekable() ? $body->tell() : null;
        $canReplayBody = $position !== null || $body->getSize() === 0;

        for ($attempt = 0; ; $attempt++) {
            if ($attempt > 0 && $position !== null) {
                $body->seek($position);
            }

            $response = $this->normalizeDateTimePrecision($this->client->sendRequest($request));
            $this->responseContext->capture($response);
            if ($attempt >= $this->maxRetries || ! $canReplayBody || ($response->getStatusCode() < 500 && $response->getStatusCode() !== 429)) {
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

    /**
     * Jane's generated date normalizer accepts second precision, while BeeL's
     * JSON responses can include fractional seconds in ISO date-time values.
     */
    private function normalizeDateTimePrecision(ResponseInterface $response): ResponseInterface
    {
        if (! str_contains(strtolower($response->getHeaderLine('Content-Type')), 'application/json')) {
            return $response;
        }

        $body = (string) $response->getBody();
        $normalized = preg_replace_callback(
            '/(")(\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2})(?:\.\d+)?(Z|[+-]\d{2}:\d{2})(")/',
            static fn (array $matches): string => $matches[1].$matches[2].($matches[3] === 'Z' ? '+00:00' : $matches[3]).$matches[4],
            $body,
        );

        if ($normalized === null || $normalized === $body) {
            return $response;
        }

        return $response->withBody(Utils::streamFor($normalized));
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
