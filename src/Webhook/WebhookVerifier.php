<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Webhook;

use Lenorix\BeelSdk\Exception\WebhookVerificationError;
use Lenorix\BeelSdk\Generated\Model\WebhookEvent;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataAccountClaimed;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataCompanyCreated;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceEmailSent;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoicePdfGenerated;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceScheduleFailed;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceVoided;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataRecurringInvoicePaused;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataRepresentationSigned;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataVeriFactuStatusUpdated;
use Lenorix\BeelSdk\Generated\Normalizer\JaneObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/** Verify signed BeeL webhook requests using the original JSON body. */
final readonly class WebhookVerifier
{
    // The generated oneOf normalizer guesses from overlapping data fields; the outer type is the actual discriminator.
    // Keep this map in sync with WebhookEventType and the OpenAPI WebhookEvent.data schema.
    /** @var array<string, class-string> */
    private const EVENT_DATA_MODELS = [
        'invoice.issued' => WebhookEventDataInvoiceIssued::class,
        'invoice.email.sent' => WebhookEventDataInvoiceEmailSent::class,
        'invoice.pdf.generated' => WebhookEventDataInvoicePdfGenerated::class,
        'invoice.voided' => WebhookEventDataInvoiceVoided::class,
        'recurring_invoice.paused' => WebhookEventDataRecurringInvoicePaused::class,
        'invoice.schedule_failed' => WebhookEventDataInvoiceScheduleFailed::class,
        'verifactu.status.updated' => WebhookEventDataVeriFactuStatusUpdated::class,
        'account.claimed' => WebhookEventDataAccountClaimed::class,
        'company.created' => WebhookEventDataCompanyCreated::class,
        'representation.signed' => WebhookEventDataRepresentationSigned::class,
    ];

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
        $event = $this->normalizeDateTimeValues($event);

        try {
            $eventType = $event['type'] ?? null;
            $eventData = $event['data'] ?? null;
            if (is_string($eventType) && is_array($eventData) && isset(self::EVENT_DATA_MODELS[$eventType])) {
                $event['data'] = $this->serializer->denormalize($eventData, self::EVENT_DATA_MODELS[$eventType], 'json');
            }

            $model = $this->serializer->denormalize($event, WebhookEvent::class, 'json');
        } catch (\Throwable $exception) {
            throw new WebhookVerificationError('Webhook payload does not match the BeeL event schema.', previous: $exception);
        }

        return $model;
    }

    /** @param array<string, mixed> $event
     * @return array<string, mixed>
     */
    private function normalizeDateTimeValues(array $event): array
    {
        foreach ($event as $key => $value) {
            if (is_array($value)) {
                $event[$key] = $this->normalizeDateTimeValues($value);

                continue;
            }

            if (! is_string($value)) {
                continue;
            }

            $normalized = preg_replace_callback(
                '/^(\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2})(?:\.\d+)?(Z|[+-]\d{2}:\d{2})$/',
                static fn (array $matches): string => $matches[1].($matches[2] === 'Z' ? '+00:00' : $matches[2]),
                $value,
            );

            if ($normalized !== null) {
                $event[$key] = $normalized;
            }
        }

        return $event;
    }
}
