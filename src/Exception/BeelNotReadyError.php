<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/**
 * BeeL accepted the request, but the resource is still being generated (HTTP 202).
 *
 * This is not an API error, so it does not extend {@see BeelApiError}: ask again
 * after {@see self::$retryAfter} seconds.
 */
final class BeelNotReadyError extends \RuntimeException
{
    /**
     * @param  string  $message  Human-readable description of what is not ready yet.
     * @param  int|null  $retryAfter  `Retry-After` in seconds, or null when absent or unparseable.
     * @param  string|null  $requestId  BeeL request ID to include when contacting support.
     */
    public function __construct(
        string $message,
        public readonly ?int $retryAfter = null,
        public readonly ?string $requestId = null,
    ) {
        parent::__construct($message);
    }

    /**
     * Structured data for logging, such as a PSR-3 context array.
     *
     * @return array{status_code: int, retry_after: int|null, request_id: string|null}
     */
    public function context(): array
    {
        return ['status_code' => 202, 'retry_after' => $this->retryAfter, 'request_id' => $this->requestId];
    }
}
