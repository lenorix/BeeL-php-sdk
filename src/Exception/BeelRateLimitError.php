<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/** Rate limit was reached (HTTP 429); retry after the indicated delay. */
final class BeelRateLimitError extends BeelApiError
{
    /** Retry delay in seconds, when BeeL supplied one. */
    public readonly ?int $retryAfterSeconds;

    public function __construct(
        string $message,
        int $statusCode = 429,
        ?string $apiCode = null,
        mixed $details = null,
        ?string $requestId = null,
        ?int $retryAfter = null,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $statusCode, $apiCode, $details, $requestId, $retryAfter, $previous);
        $this->retryAfterSeconds = $retryAfter;
    }
}
