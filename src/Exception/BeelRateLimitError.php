<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

final class BeelRateLimitError extends BeelApiError
{
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
