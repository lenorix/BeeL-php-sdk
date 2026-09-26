<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/** The signed timestamp is outside the replay window; the request may be a replay or the clocks disagree. */
final class WebhookTimestampError extends WebhookVerificationError
{
    /**
     * @param  int  $timestamp  Unix timestamp from the signature header.
     * @param  int  $now  Unix timestamp the header was checked against.
     * @param  int  $toleranceSeconds  Allowed difference, in seconds.
     */
    public function __construct(
        public readonly int $timestamp,
        public readonly int $now,
        public readonly int $toleranceSeconds,
    ) {
        parent::__construct('Webhook timestamp is outside the allowed replay window.');
    }
}
