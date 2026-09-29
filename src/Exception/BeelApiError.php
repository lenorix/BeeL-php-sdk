<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorDetail;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Http\ErrorBody;
use Lenorix\BeelSdk\Http\Responses;
use Lenorix\BeelSdk\Http\RetryAfter;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/** Base exception for BeeL API failures, with HTTP and BeeL error metadata. */
class BeelApiError extends \RuntimeException implements BeelException
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

    /**
     * Structured error data for logging, such as a PSR-3 context array.
     *
     * Leaves out `details`: validation errors echo submitted values, such as NIFs or
     * amounts, which should not reach logs by default. Read `$details` explicitly when needed.
     *
     * @return array{status_code: int, api_code: string|null, request_id: string|null, retry_after: int|null}
     */
    public function context(): array
    {
        return [
            'status_code' => $this->statusCode,
            'api_code' => $this->apiCode,
            'request_id' => $this->requestId,
            'retry_after' => $this->retryAfter,
        ];
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
        $payload = method_exists($exception, 'getErrorResponse') ? $exception->getErrorResponse() : null;

        return self::fromErrorResponse($payload instanceof ErrorResponse ? $payload : new ErrorResponse, $response, Responses::peekBody($response), $exception);
    }

    public static function fromErrorResponse(
        ErrorResponse $payload,
        ?ResponseInterface $response = null,
        ?string $body = null,
        ?Throwable $previous = null,
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

        // What the generated model left out, read from the body itself.
        $fallback = ErrorBody::fromJson($body);
        $message ??= $fallback->message();
        $code ??= $fallback->code();
        $details ??= $fallback->details();
        $requestId ??= $fallback->requestId();

        $retryAfter = $response === null ? null : RetryAfter::seconds($response, $body);
        $retryAfter ??= self::retryAfterFromDetails($details);

        return self::forStatus(
            $status,
            $message ?? ($response === null ? 'API error' : 'API error '.$status),
            $code,
            $details,
            $requestId,
            $retryAfter,
            $previous,
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
        // Same fallback codes as the official Node.js SDK when BeeL sends none.
        $code ??= match (true) {
            $status === 401 => 'UNAUTHORIZED',
            $status === 403 => 'FORBIDDEN',
            $status === 404 => 'NOT_FOUND',
            $status === 409 => 'CONFLICT',
            $status === 422 => 'UNPROCESSABLE_ENTITY',
            $status === 429 => 'RATE_LIMIT_EXCEEDED',
            default => 'UNKNOWN',
        };

        $class = match (true) {
            $status === 401 || $status === 403 => BeelAuthError::class,
            $status === 402 => BeelPaymentRequiredError::class,
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
            // The same rules as the transport, which retries on this delay.
            if ($key === 'retry_after') {
                return RetryAfter::fromValue($value);
            }
        }

        return null;
    }
}
