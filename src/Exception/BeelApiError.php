<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorDetail;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/** Base exception for BeeL API failures, with HTTP and BeeL error metadata. */
class BeelApiError extends \RuntimeException
{
    /**
     * @param  string  $message  Human-readable API error message.
     * @param  int  $statusCode  HTTP status code returned by BeeL, or `0` when unavailable.
     * @param  string|null  $apiCode  Stable BeeL error code, when present.
     * @param  mixed  $details  Structured field or domain error details returned by BeeL.
     * @param  string|null  $requestId  BeeL request ID to include when contacting support.
     * @param  int|null  $retryAfter  Suggested delay in seconds for rate-limited requests.
     * @param  Throwable|null  $previous  Underlying HTTP-client or Jane exception, when available.
     */
    public function __construct(
        string $message,
        public readonly int $statusCode = 0,
        public readonly ?string $apiCode = null,
        public readonly mixed $details = null,
        public readonly ?string $requestId = null,
        public readonly ?int $retryAfter = null,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $statusCode, $previous);
    }

    public static function fromGenerated(Throwable $exception): self
    {
        if (! method_exists($exception, 'getResponse')) {
            if ($exception instanceof self) {
                return $exception;
            }

            throw $exception;
        }

        /** @var ResponseInterface $response */
        $response = $exception->getResponse();
        $status = $response->getStatusCode();
        $payload = method_exists($exception, 'getErrorResponse') ? $exception->getErrorResponse() : null;
        $error = $payload instanceof ErrorResponse && $payload->isInitialized('error') ? $payload->getError() : null;
        $code = $error instanceof ErrorDetail && $error->isInitialized('code') ? $error->getCode() : null;
        $message = $error instanceof ErrorDetail && $error->isInitialized('message') ? $error->getMessage() : $exception->getMessage();
        $details = $error instanceof ErrorDetail && $error->isInitialized('details') ? $error->getDetails() : null;
        $requestId = $response->getHeaderLine('X-Request-Id') ?: null;
        if ($requestId === null && $payload instanceof ErrorResponse && $payload->isInitialized('meta')) {
            $meta = $payload->getMeta();
            $requestId = $meta->isInitialized('requestId') ? $meta->getRequestId() : null;
        }
        $retryAfter = ctype_digit($response->getHeaderLine('Retry-After')) ? (int) $response->getHeaderLine('Retry-After') : null;
        if ($retryAfter === null && $error instanceof \ArrayAccess && is_numeric($error['retry_after'] ?? null)) {
            $retryAfter = (int) $error['retry_after'];
        }
        $retryAfter ??= self::retryAfterFromDetails($details);

        return self::forStatus($status, $message, $code, $details, $requestId, $retryAfter, $exception);
    }

    public static function fromErrorResponse(
        ErrorResponse $payload,
        ?ResponseInterface $response = null,
        ?string $body = null,
    ): self {
        $status = $response?->getStatusCode() ?? 0;
        $error = $payload->isInitialized('error') ? $payload->getError() : null;
        $code = $error instanceof ErrorDetail && $error->isInitialized('code') ? $error->getCode() : null;
        $message = $error instanceof ErrorDetail && $error->isInitialized('message') ? $error->getMessage() : null;
        $details = $error instanceof ErrorDetail && $error->isInitialized('details') ? $error->getDetails() : null;
        $requestId = $response?->getHeaderLine('X-Request-Id') ?: null;
        if ($requestId === null && $payload->isInitialized('meta')) {
            $meta = $payload->getMeta();
            $requestId = $meta->isInitialized('requestId') ? $meta->getRequestId() : null;
        }

        if (($message === null || $code === null || $details === null || $requestId === null) && $body !== null) {
            $data = json_decode($body, true);
            if (is_array($data)) {
                $errorData = is_array($data['error'] ?? null) ? $data['error'] : $data;
                $message ??= $errorData['message'] ?? $data['detail'] ?? $data['title'] ?? null;
                $code ??= $errorData['code'] ?? null;
                $details ??= $errorData['details'] ?? null;
                $requestId ??= $data['meta']['request_id'] ?? null;
            }
        }

        $retryAfterHeader = $response?->getHeaderLine('Retry-After') ?? '';
        $retryAfter = ctype_digit($retryAfterHeader) ? (int) $retryAfterHeader : null;
        $retryAfter ??= self::retryAfterFromDetails($details);

        return self::forStatus(
            $status,
            $message ?? ($response === null ? 'BeeL API returned an error response.' : 'BeeL API request failed with HTTP '.$status.'.'),
            $code,
            $details,
            $requestId,
            $retryAfter,
        );
    }

    private static function forStatus(
        int $status,
        string $message,
        ?string $code,
        mixed $details,
        ?string $requestId,
        ?int $retryAfter,
        ?Throwable $previous = null,
    ): self {
        $class = match (true) {
            $status === 401 || $status === 403 => BeelAuthError::class,
            $status === 404 => BeelNotFoundError::class,
            $status === 409 => BeelConflictError::class,
            $status === 422 => BeelValidationError::class,
            $status === 429 => BeelRateLimitError::class,
            default => self::class,
        };

        return new $class($message, $status, $code, $details, $requestId, $retryAfter, $previous);
    }

    private static function retryAfterFromDetails(mixed $details): ?int
    {
        if (! is_iterable($details)) {
            return null;
        }

        foreach ($details as $key => $value) {
            if ($key === 'retry_after' && is_numeric($value)) {
                return (int) $value;
            }
        }

        return null;
    }
}
