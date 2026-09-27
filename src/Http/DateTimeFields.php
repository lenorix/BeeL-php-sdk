<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

/**
 * Normalizes BeeL `date-time` values for Jane's generated date-time normalizers.
 *
 * Jane parses `date-time` fields with second precision (`Y-m-d\TH:i:sP`), while BeeL
 * can send fractional seconds and `Z`. Only the fields Jane parses as `date-time` are
 * rewritten: free-text values that merely look like dates, and anything inside free-form
 * maps such as `metadata`, keep the value BeeL sent.
 *
 * @internal
 */
final class DateTimeFields
{
    /** JSON property names that Jane's generated normalizers parse as `date-time`. */
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

    /**
     * Free-form maps (such as `metadata`) that Jane copies without parsing.
     *
     * Their contents belong to the integration, so they are never rewritten, even when a
     * key inside them matches one of {@see self::NAMES}.
     */
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

    private const VALUE = '(\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2})(?:\.\d+)?(Z|[+-]\d{2}:\d{2})';

    /**
     * Rewrite `date-time` values in a raw JSON document.
     *
     * The document is returned byte for byte unless it contains a value to rewrite. Then it is
     * decoded and encoded again, which keeps its structure and values but may change whitespace
     * and escaping.
     */
    public static function normalizeJson(string $json): string
    {
        $candidate = '/"(?:'.implode('|', self::NAMES).')"\s*:\s*"\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}(?:\.\d+|Z)/';
        if (preg_match($candidate, $json) !== 1) {
            return $json;
        }

        try {
            $data = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
            $normalized = self::normalizeValue($data);
            if ($normalized === $data) {
                return $json;
            }

            return json_encode($normalized, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRESERVE_ZERO_FRACTION);
        } catch (\JsonException) {
            return $json;
        }
    }

    /**
     * Rewrite `date-time` values in a decoded JSON document.
     *
     * @param  array<array-key, mixed>  $data
     * @return array<array-key, mixed>
     */
    public static function normalizeArray(array $data): array
    {
        $normalized = self::normalizeValue($data);

        return is_array($normalized) ? $normalized : $data;
    }

    /** Normalize a decoded value, returning the same instance when nothing changes. */
    private static function normalizeValue(mixed $value): mixed
    {
        if ($value instanceof \stdClass) {
            $copy = null;
            foreach (get_object_vars($value) as $key => $item) {
                $normalized = self::normalizeEntry((string) $key, $item);
                if ($normalized !== $item) {
                    $copy ??= clone $value;
                    $copy->{$key} = $normalized;
                }
            }

            return $copy ?? $value;
        }
        if (is_array($value)) {
            $isList = array_is_list($value);
            foreach ($value as $key => $item) {
                $value[$key] = $isList ? self::normalizeValue($item) : self::normalizeEntry((string) $key, $item);
            }
        }

        return $value;
    }

    private static function normalizeEntry(string $key, mixed $value): mixed
    {
        if (in_array($key, self::FREE_FORM_NAMES, true)) {
            return $value;
        }
        if (is_string($value) && in_array($key, self::NAMES, true)
            && preg_match('/^'.self::VALUE.'$/', $value, $matches) === 1) {
            return self::format($matches[1], $matches[2]);
        }

        return self::normalizeValue($value);
    }

    private static function format(string $dateTime, string $offset): string
    {
        return $dateTime.($offset === 'Z' ? '+00:00' : $offset);
    }
}
