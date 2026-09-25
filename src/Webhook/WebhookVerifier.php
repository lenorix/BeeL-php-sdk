<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Webhook;

use Lenorix\BeelSdk\Exception\WebhookVerificationError;

/** Verify signed BeeL webhook requests using the original JSON body. */
final readonly class WebhookVerifier
{
    /**
     * @param  string  $secret  Signing secret shown when the webhook subscription is created.
     * @param  int  $toleranceSeconds  Maximum age difference allowed for the signed timestamp; defaults to 300 seconds.
     */
    public function __construct(private string $secret, private int $toleranceSeconds = 300)
    {
        if (trim($secret) === '') {
            throw new \InvalidArgumentException('Webhook secret must not be empty.');
        }
        if ($toleranceSeconds < 0) {
            throw new \InvalidArgumentException('Webhook timestamp tolerance must not be negative.');
        }
    }

    /**
     * Verify the raw request body and return its decoded event payload.
     *
     * Pass the exact request body bytes as received; decoding and re-encoding JSON
     * before verification changes the signed content. The signature header is
     * `BeeL-Signature` (`t=timestamp,v1=signature`).
     *
     * @param  string  $payload  Unmodified UTF-8 request body.
     * @param  string|null  $signatureHeader  Value of the `BeeL-Signature` header.
     * @param  int|null  $now  Optional Unix timestamp for deterministic tests.
     * @return array<string, mixed>
     *
     * @throws WebhookVerificationError If the signature is missing, invalid, too old, or the body is not a JSON object.
     */
    public function verify(string $payload, ?string $signatureHeader = null, ?int $now = null): array
    {
        if ($signatureHeader === null || trim($signatureHeader) === '') {
            throw new WebhookVerificationError('Missing BeeL-Signature header.');
        }

        $timestamp = null;
        $signatures = [];
        foreach (explode(',', $signatureHeader) as $part) {
            [$key, $value] = array_pad(explode('=', trim($part), 2), 2, null);
            if ($key === 't' && $value !== null && ctype_digit($value)) {
                $timestamp = (int) $value;
            }
            if ($key === 'v1' && $value !== null && $value !== '') {
                $signatures[] = $value;
            }
        }

        if ($timestamp === null || $signatures === []) {
            throw new WebhookVerificationError('Invalid signature header format (expected: t=timestamp,v1=signature).');
        }
        if (abs(($now ?? time()) - $timestamp) > $this->toleranceSeconds) {
            throw new WebhookVerificationError('Webhook timestamp is outside the allowed replay window.');
        }

        $expected = hash_hmac('sha256', $timestamp.'.'.$payload, $this->secret);
        $valid = false;
        foreach ($signatures as $signature) {
            $valid = hash_equals($expected, $signature) || $valid;
        }
        if (! $valid) {
            throw new WebhookVerificationError('Invalid BeeL webhook signature.');
        }

        try {
            $event = json_decode($payload, true, flags: JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            throw new WebhookVerificationError('Invalid JSON in webhook body.', previous: $exception);
        }
        if (! is_array($event)) {
            throw new WebhookVerificationError('BeeL webhook payload must be a JSON object.');
        }

        return $event;
    }
}
