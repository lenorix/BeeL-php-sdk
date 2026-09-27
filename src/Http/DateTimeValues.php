<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;

/**
 * Rejects date-time values the generated client would silently misread.
 *
 * The client parses date-times with `new \DateTime()` to keep fractional seconds, but that
 * also turns `""` or words such as `"tomorrow"` into a date instead of failing. This check runs
 * before the generated client reads a payload and accepts only `null` or an RFC 3339 date-time,
 * as the old fixed-format parser did. It never changes any value.
 *
 * @internal
 */
final class DateTimeValues
{
    /** Property names the generated normalizers parse as `date-time`. A test keeps this list in sync. */
    public const NAMES = [
        'at',
        'connected_at',
        'created_at',
        'deactivated_at',
        'deleted_at',
        'delivered_at',
        'discarded_at',
        'effective_at',
        'expires_at',
        'generated_at',
        'last_event_at',
        'last_generated_at',
        'last_invoice_at',
        'last_sent_at',
        'last_used_at',
        'nif_registered_at',
        'paid_at',
        'processed_at',
        'received_at',
        'registered_at',
        'sent_at',
        'signed_at',
        'since',
        'timestamp',
        'updated_at',
        'validated_at',
        'voided_at',
    ];

    /** Free-form maps (such as `metadata`) the generated client copies without parsing; their contents are never checked. */
    public const FREE_FORM_NAMES = [
        'by_failure_reason',
        'by_status',
        'customer',
        'details',
        'metadata',
        'request_headers',
        'response_headers',
        'vat_breakdown_by_rate',
    ];

    private const RFC3339 = '/^\d{4}-\d{2}-\d{2}[Tt]\d{2}:\d{2}:\d{2}(?:\.\d+)?(?:[Zz]|[+-]\d{2}:\d{2})$/';

    /**
     * Check a raw JSON document, decoding it only when a date-time field holds something suspicious.
     *
     * @throws InvalidDateException If a date-time field is neither `null` nor an RFC 3339 date-time.
     */
    public static function assertJson(string $json): void
    {
        // Fast path: every date-time field is null or a complete RFC 3339 string.
        $valid = '"\d{4}-\d{2}-\d{2}[Tt]\d{2}:\d{2}:\d{2}(?:\.\d+)?(?:[Zz]|[+-]\d{2}:\d{2})"';
        $suspicious = '/"(?:'.implode('|', self::NAMES).')"\s*:\s*(?!null\b|'.$valid.')/';
        if (preg_match($suspicious, $json) !== 1) {
            return;
        }

        try {
            $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return; // Not JSON the generated client can read either; let it report that.
        }
        if (is_array($data)) {
            self::assert($data);
        }
    }

    /**
     * Check a decoded payload.
     *
     * @param  array<array-key, mixed>  $data
     *
     * @throws InvalidDateException If a date-time field is neither `null` nor an RFC 3339 date-time.
     */
    public static function assert(array $data): void
    {
        $isList = array_is_list($data);
        foreach ($data as $key => $value) {
            if (! $isList && in_array($key, self::FREE_FORM_NAMES, true)) {
                continue;
            }
            if (! $isList && in_array($key, self::NAMES, true) && $value !== null) {
                if (! is_string($value) || preg_match(self::RFC3339, $value) !== 1) {
                    throw new InvalidDateException($value, 'RFC 3339 date-time');
                }

                continue;
            }
            if (is_array($value)) {
                self::assert($value);
            }
        }
    }
}
