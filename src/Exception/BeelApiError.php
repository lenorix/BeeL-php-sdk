<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

use Psr\Http\Message\ResponseInterface;
use Throwable;

class BeelApiError extends \RuntimeException
{
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
        $error = is_object($payload) && method_exists($payload, 'getError') ? $payload->getError() : null;
        $code = is_object($error) && method_exists($error, 'getCode') ? $error->getCode() : null;
        $message = is_object($error) && method_exists($error, 'getMessage') ? $error->getMessage() : $exception->getMessage();
        $details = is_object($error) && method_exists($error, 'getDetails') && (! method_exists($error, 'isInitialized') || $error->isInitialized('details')) ? $error->getDetails() : null;
        $requestId = $response->getHeaderLine('X-Request-Id') ?: null;
        if ($requestId === null && is_object($payload) && method_exists($payload, 'getMeta') && (! method_exists($payload, 'isInitialized') || $payload->isInitialized('meta'))) {
            $meta = $payload->getMeta();
            $requestId = is_object($meta) && method_exists($meta, 'getRequestId') && (! method_exists($meta, 'isInitialized') || $meta->isInitialized('requestId')) ? $meta->getRequestId() : null;
        }
        $retryAfter = ctype_digit($response->getHeaderLine('Retry-After')) ? (int) $response->getHeaderLine('Retry-After') : null;
        if ($retryAfter === null && $error instanceof \ArrayAccess && is_numeric($error['retry_after'] ?? null)) {
            $retryAfter = (int) $error['retry_after'];
        }
        if ($retryAfter === null && is_array($details) && is_numeric($details['retry_after'] ?? null)) {
            $retryAfter = (int) $details['retry_after'];
        }
        $class = match (true) {
            $status === 401 || $status === 403 => BeelAuthError::class,
            $status === 404 => BeelNotFoundError::class,
            $status === 409 => BeelConflictError::class,
            $status === 422 => BeelValidationError::class,
            $status === 429 => BeelRateLimitError::class,
            default => self::class,
        };

        return new $class($message, $status, $code, $details, $requestId, $retryAfter, $exception);
    }
}
