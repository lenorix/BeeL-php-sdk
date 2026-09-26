<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Webhook;

/**
 * Sign webhook bodies the way BeeL does, for tests and local development.
 *
 * The result verifies with a {@see WebhookVerifier} that uses the same secret.
 */
final readonly class WebhookSigner
{
    /** @param  string  $secret  Signing secret of the webhook subscription. */
    public function __construct(private string $secret)
    {
        if (trim($secret) === '') {
            throw new \InvalidArgumentException('Webhook secret must not be empty.');
        }
    }

    /** Compute the `v1` signature of a body for the given Unix timestamp. */
    public function signature(string $payload, int $timestamp): string
    {
        return hash_hmac('sha256', $timestamp.'.'.$payload, $this->secret);
    }

    /**
     * Sign a body and return the `BeeL-Signature` header value.
     *
     * @param  string  $payload  Exact request body that will be sent.
     * @param  int|null  $timestamp  Unix timestamp to sign; defaults to now.
     */
    public function sign(string $payload, ?int $timestamp = null): string
    {
        $timestamp ??= time();

        return (string) new WebhookSignatureHeader($timestamp, [$this->signature($payload, $timestamp)]);
    }
}
