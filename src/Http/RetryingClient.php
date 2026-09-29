<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use GuzzleHttp\Psr7\Utils;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Adds BeeL's retry and POST idempotency behavior around Jane's PSR-18 transport.
 *
 * @internal
 */
final readonly class RetryingClient implements ClientInterface
{
    public const DEFAULT_MAX_RETRIES = 3;

    public const DEFAULT_RETRY_DELAY_MS = 500;

    public const DEFAULT_MAX_RETRY_DELAY_MS = 30_000;

    private const IDEMPOTENT_METHODS = ['GET', 'HEAD', 'OPTIONS', 'PUT', 'DELETE'];

    private ResponseContext $responseContext;

    /** @var \Closure(int): void Waits the given milliseconds. */
    private \Closure $sleep;

    public function __construct(
        private ClientInterface $client,
        private int $maxRetries = self::DEFAULT_MAX_RETRIES,
        private int $retryDelayMs = self::DEFAULT_RETRY_DELAY_MS,
        private int $maxRetryDelayMs = self::DEFAULT_MAX_RETRY_DELAY_MS,
        private bool $autoIdempotencyKey = true,
        ?ResponseContext $responseContext = null,
        ?\Closure $sleep = null,
    ) {
        $this->responseContext = $responseContext ?? new ResponseContext;
        $this->sleep = $sleep ?? static function (int $milliseconds): void {
            usleep($milliseconds * 1_000);
        };

        if ($maxRetries < 0 || $retryDelayMs < 0 || $maxRetryDelayMs < 0) {
            throw new \InvalidArgumentException('Retry limits and delays must not be negative.');
        }
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $request = $this->prepare($request);
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

            try {
                $response = $this->normalize($this->client->sendRequest($request));
            } catch (NetworkExceptionInterface $exception) {
                // A timeout or a dropped connection may hide an applied request: retry only what is safe to repeat.
                if ($attempt >= $maxRetries || ! $canReplayBody || ! $canRetry) {
                    throw $exception;
                }
                ($this->sleep)($this->backoff($attempt));

                continue;
            }
            $this->responseContext->capture($response);
            if ($attempt >= $maxRetries || ! $canReplayBody || ! $this->isRetryable($request, $response, $canRetry)) {
                return $response;
            }
            $delay = $this->delayMs($response, $attempt);
            if ($delay === null) {
                return $response;
            }
            if ($delay > 0) {
                ($this->sleep)($delay);
            }
        }
    }

    /** Add the call's options, an empty JSON body to a write without one, and an automatic POST key. */
    private function prepare(RequestInterface $request): RequestInterface
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
            $request = $request->withHeader('Idempotency-Key', IdempotencyKey::generate());
        }

        return $request;
    }

    /** Give an error a Content-Type, and make JSON and error bodies rereadable. */
    private function normalize(ResponseInterface $response): ResponseInterface
    {
        // Jane's generated error handling assumes a Content-Type; proxies often omit it on errors.
        if ($response->getStatusCode() >= 400 && ! $response->hasHeader('Content-Type')) {
            $response = $response->withHeader('Content-Type', 'application/octet-stream');
        }
        // JSON and error bodies are small: make them rereadable, so the SDK and getLastResponse()
        // can read them even from a streaming transport. Successful file downloads stay streamed.
        if ((Responses::isJson($response) || $response->getStatusCode() >= 400) && ! $response->getBody()->isSeekable()) {
            $response = $response->withBody(Utils::streamFor((string) $response->getBody()));
        }

        return $response;
    }

    /**
     * BeeL rejects a 429 without applying it; a 5xx may have been applied, so it needs $canRetry,
     * unless BeeL replays a stored 5xx for the key, which the same key would only replay again.
     * A 409 IDEMPOTENCY_KEY_PROCESSING asks to wait and retry with the same key.
     */
    private function isRetryable(RequestInterface $request, ResponseInterface $response, bool $canRetry): bool
    {
        $status = $response->getStatusCode();

        return $status === 429
            || ($status >= 500 && $canRetry && strtolower($response->getHeaderLine('Idempotency-Replay')) !== 'true')
            || ($status === 409 && $request->hasHeader('Idempotency-Key') && ErrorBody::fromJson(Responses::peekBody($response))->code() === 'IDEMPOTENCY_KEY_PROCESSING');
    }

    /**
     * Wait exactly what BeeL asks for, or back off when it gives no delay. Null when BeeL asks for
     * longer than maxRetryDelayMs: the response is returned instead of waiting less, so the error
     * carries the requested delay.
     */
    private function delayMs(ResponseInterface $response, int $attempt): ?int
    {
        $requested = RetryAfter::seconds($response);
        if ($requested === null) {
            return $this->backoff($attempt);
        }

        return $requested * 1_000 > $this->maxRetryDelayMs ? null : $requested * 1_000;
    }

    /** Exponential backoff with jitter for attempts BeeL gave no delay for, capped at maxRetryDelayMs. */
    private function backoff(int $attempt): int
    {
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
}
