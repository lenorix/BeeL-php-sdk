<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Webhook;

use Lenorix\BeelSdk\Exception\WebhookVerificationError;
use Lenorix\BeelSdk\Generated\Model\WebhookEvent;
use Lenorix\BeelSdk\Generated\Normalizer\JaneObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/** Verify signed BeeL webhook requests using the original JSON body. */
final readonly class WebhookVerifier
{
    private SerializerInterface $serializer;

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

        $this->serializer = new Serializer([new JaneObjectNormalizer]);
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

    /**
     * Verify the request and denormalize it to Jane's generated webhook model.
     *
     * The signature is checked against the original, unmodified body before the
     * timestamp is normalized for Jane's generated date-time normalizer.
     *
     * @throws WebhookVerificationError If the signature is invalid or the event cannot be parsed.
     */
    public function verifyEvent(string $payload, ?string $signatureHeader = null, ?int $now = null): WebhookEvent
    {
        $event = $this->verify($payload, $signatureHeader, $now);
        $event = $this->normalizeCreatedAt($event);

        try {
            $model = $this->serializer->denormalize($event, WebhookEvent::class, 'json');
        } catch (\Throwable $exception) {
            throw new WebhookVerificationError('Webhook payload does not match the BeeL event schema.', previous: $exception);
        }

        return $model;
    }

    /** @param array<string, mixed> $event
     * @return array<string, mixed>
     */
    private function normalizeCreatedAt(array $event): array
    {
        $createdAt = $event['created_at'] ?? null;
        if (! is_string($createdAt)) {
            return $event;
        }

        $normalized = preg_replace_callback(
            '/^(\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2})(?:\.\d+)?(Z|[+-]\d{2}:\d{2})$/',
            static fn (array $matches): string => $matches[1].($matches[2] === 'Z' ? '+00:00' : $matches[2]),
            $createdAt,
        );

        if ($normalized !== null) {
            $event['created_at'] = $normalized;
        }

        return $event;
    }
}
