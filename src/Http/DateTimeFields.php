<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

/**
 * Normalizes BeeL `date-time` values for Jane's generated date-time normalizers.
 *
 * Jane parses `date-time` fields with second precision (`Y-m-d\TH:i:sP`), while BeeL
 * can send fractional seconds and `Z`. Only the fields Jane parses as `date-time` are
 * rewritten, so free-text values that merely look like dates are left untouched.
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

    private const VALUE = '(\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2})(?:\.\d+)?(Z|[+-]\d{2}:\d{2})';

    /** Rewrite `date-time` values in a raw JSON document, leaving every other byte as it was. */
    public static function normalizeJson(string $json): string
    {
        $pattern = '/(?<!\\\\)("(?:'.implode('|', self::NAMES).')"\s*:\s*")'.self::VALUE.'"/';
        $normalized = preg_replace_callback(
            $pattern,
            static fn (array $matches): string => $matches[1].self::format($matches[2], $matches[3]).'"',
            $json,
        );

        return $normalized ?? $json;
    }

    /**
     * Rewrite `date-time` values in a decoded JSON document.
     *
     * @param  array<array-key, mixed>  $data
     * @return array<array-key, mixed>
     */
    public static function normalizeArray(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = self::normalizeArray($value);
            } elseif (is_string($value) && in_array($key, self::NAMES, true)
                && preg_match('/^'.self::VALUE.'$/', $value, $matches) === 1) {
                $data[$key] = self::format($matches[1], $matches[2]);
            }
        }

        return $data;
    }

    private static function format(string $dateTime, string $offset): string
    {
        return $dateTime.($offset === 'Z' ? '+00:00' : $offset);
    }
}
