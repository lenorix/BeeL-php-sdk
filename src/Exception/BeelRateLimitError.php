<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/** Rate limit was reached (HTTP 429); retry after the indicated delay. */
final class BeelRateLimitError extends BeelApiError
{
    public const DEFAULT_RETRY_AFTER_SECONDS = 60;

    /** Seconds BeeL asks to wait before retrying; 60 when it gives no delay, as in the official Node.js SDK. */
    public readonly int $retryAfterSeconds;

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
        $this->retryAfterSeconds = $retryAfter ?? self::DEFAULT_RETRY_AFTER_SECONDS;
    }
}
