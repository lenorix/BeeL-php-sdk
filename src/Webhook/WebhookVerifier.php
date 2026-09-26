<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Webhook;

use Lenorix\BeelSdk\Exception\WebhookHeaderError;
use Lenorix\BeelSdk\Exception\WebhookPayloadError;
use Lenorix\BeelSdk\Exception\WebhookSignatureError;
use Lenorix\BeelSdk\Exception\WebhookTimestampError;
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
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Serializer;

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

    private DenormalizerInterface $serializer;

    private WebhookSigner $signer;

    /**
     * @param  string  $secret  Signing secret shown when the webhook subscription is created.
     * @param  int  $toleranceSeconds  Maximum age difference allowed for the signed timestamp; defaults to 300 seconds.
     */
    public function __construct(string $secret, private int $toleranceSeconds = 300)
    {
        if (trim($secret) === '') {
            throw new \InvalidArgumentException('Webhook secret must not be empty.');
        }
        if ($toleranceSeconds < 0) {
            throw new \InvalidArgumentException('Webhook timestamp tolerance must not be negative.');
        }

        $this->signer = new WebhookSigner($secret);
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
     * @throws WebhookHeaderError If the signature header is missing or malformed.
     * @throws WebhookTimestampError If the signed timestamp is outside the replay window.
     * @throws WebhookSignatureError If no signature matches the body.
     * @throws WebhookPayloadError If the body is not a JSON object.
     */
    public function verify(string $payload, ?string $signatureHeader = null, ?int $now = null): array
    {
        $header = WebhookSignatureHeader::parse($signatureHeader);
        $this->checkTimestamp($header, $now);
        $this->checkSignature($payload, $header);

        try {
            $event = json_decode($payload, true, flags: JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            throw new WebhookPayloadError('Invalid JSON in webhook body.', previous: $exception);
        }
        if (! is_array($event)) {
            throw new WebhookPayloadError('BeeL webhook payload must be a JSON object.');
        }

        return $event;
    }

    /**
     * Check that a parsed header's timestamp is inside the replay window.
     *
     * This needs no HMAC, so a receiver can reject stale or malformed requests
     * before reading the full body: parse with {@see WebhookSignatureHeader::parse()} first.
     *
     * @param  int|null  $now  Optional Unix timestamp for deterministic tests.
     *
     * @throws WebhookTimestampError If the timestamp is outside the replay window.
     */
    public function checkTimestamp(WebhookSignatureHeader $header, ?int $now = null): void
    {
        $now ??= time();
        if (abs($now - $header->timestamp) > $this->toleranceSeconds) {
            throw new WebhookTimestampError($header->timestamp, $now, $this->toleranceSeconds);
        }
    }

    /**
     * Check that one of the header's signatures matches the raw body, without checking the timestamp.
     *
     * @throws WebhookSignatureError If no signature matches.
     */
    public function checkSignature(string $payload, WebhookSignatureHeader $header): void
    {
        $expected = $this->signer->signature($payload, $header->timestamp);
        $valid = false;
        foreach ($header->signatures as $signature) {
            $valid = hash_equals($expected, $signature) || $valid;
        }
        if (! $valid) {
            throw new WebhookSignatureError('Invalid BeeL webhook signature.');
        }
    }

    /**
     * Verify the request and denormalize it to Jane's generated webhook model.
     *
     * The signature is checked against the original, unmodified body before the
     * timestamp is normalized for Jane's generated date-time normalizer.
     *
     * @throws WebhookVerificationError If verification fails; see {@see self::verify()} for the subclasses.
     * @throws WebhookPayloadError If the event does not match the BeeL event schema.
     */
    public function verifyEvent(string $payload, ?string $signatureHeader = null, ?int $now = null): WebhookEvent
    {
        return $this->toEvent($this->verify($payload, $signatureHeader, $now));
    }

    /**
     * Build Jane's generated webhook model from a payload that {@see self::verify()} already returned.
     *
     * Use it to get the typed event later without verifying the signature again. It does
     * not check any signature itself, so only pass payloads that were verified.
     *
     * @param  array<string, mixed>  $event  Decoded payload returned by `verify()`.
     *
     * @throws WebhookPayloadError If the event does not match the BeeL event schema.
     */
    public function toEvent(array $event): WebhookEvent
    {
        $event = $this->normalizeDateTimeValues($event);

        try {
            $eventType = $event['type'] ?? null;
            $eventData = $event['data'] ?? null;
            if (is_string($eventType) && is_array($eventData) && isset(self::EVENT_DATA_MODELS[$eventType])) {
                $event['data'] = $this->serializer->denormalize($eventData, self::EVENT_DATA_MODELS[$eventType], 'json');
            }

            $model = $this->serializer->denormalize($event, WebhookEvent::class, 'json');
        } catch (\Throwable $exception) {
            throw new WebhookPayloadError('Webhook payload does not match the BeeL event schema.', previous: $exception);
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
