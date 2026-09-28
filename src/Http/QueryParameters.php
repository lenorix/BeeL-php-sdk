<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

/**
 * Query-string conventions shared with the official Node.js SDK.
 *
 * @internal
 */
final class QueryParameters
{
    /**
     * Boolean query parameters, which BeeL documents as `true`/`false` (the generated client sends `1`/`0`).
     *
     * None of these names has another type in any endpoint, which a test keeps true.
     */
    public const BOOLEANS = [
        'active',
        'attach_source_invoices',
        'charges_only',
        'dry_run',
        'fiscal_only',
        'include_discarded',
        'needs_action',
        'only_errors',
        'verifactu_enabled',
        'wait_for_pdf',
    ];

    /** List filters sent as a comma-separated value; a single value is accepted as a one-item list. */
    public const LISTS = [
        'event_kind',
        'failure_category',
        'failure_reason',
        'payment_method',
        'related_entity_ids',
        'status',
    ];

    /**
     * Wrap a single value of a list filter, such as `['status' => 'ISSUED']`, into a list.
     *
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    public static function lists(array $query): array
    {
        foreach (self::LISTS as $name) {
            if (isset($query[$name]) && ! is_array($query[$name])) {
                $query[$name] = [$query[$name]];
            }
        }

        return $query;
    }

    /**
     * Join a list given for a parameter BeeL types as one comma-separated string, such as the
     * `ids` of a bulk delete, which the generated client would otherwise reject as an array.
     *
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    public static function commaSeparated(array $query, string $name): array
    {
        if (isset($query[$name]) && is_array($query[$name])) {
            $query[$name] = implode(',', $query[$name]);
        }

        return $query;
    }

    /** Rewrite boolean parameters encoded as `1`/`0` to `true`/`false`, leaving every other byte as it was. */
    public static function booleans(string $query): string
    {
        if ($query === '') {
            return $query;
        }

        $pairs = explode('&', $query);
        foreach ($pairs as $index => $pair) {
            [$name, $value] = array_pad(explode('=', $pair, 2), 2, null);
            if (($value === '1' || $value === '0') && in_array(rawurldecode($name), self::BOOLEANS, true)) {
                $pairs[$index] = $name.'='.($value === '1' ? 'true' : 'false');
            }
        }

        return implode('&', $pairs);
    }
}
