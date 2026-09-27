<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/**
 * Payment is required (HTTP 402), for example to switch a company on in Live.
 *
 * `CHECKOUT_REQUIRED` means there is no card on file: {@see self::$checkoutUrl} carries the
 * checkout when `success_url` and `cancel_url` were supplied. `PAYMENT_REQUIRED` means billing
 * exists but is past due, and the outstanding invoice has to be settled first.
 */
final class BeelPaymentRequiredError extends BeelApiError
{
    /** Checkout URL from `error.details.checkout_url`, when BeeL returned one. */
    public readonly ?string $checkoutUrl;

    public function __construct(
        string $message,
        int $statusCode = 402,
        ?string $apiCode = null,
        mixed $details = null,
        ?string $requestId = null,
        ?int $retryAfter = null,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $statusCode, $apiCode, $details, $requestId, $retryAfter, $previous);

        $checkoutUrl = is_array($details) || $details instanceof \ArrayAccess ? ($details['checkout_url'] ?? null) : null;
        $this->checkoutUrl = is_string($checkoutUrl) && $checkoutUrl !== '' ? $checkoutUrl : null;
    }
}
