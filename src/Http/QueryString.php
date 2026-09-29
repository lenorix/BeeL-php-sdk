<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

/**
 * Encodes the query of `Beel::request()`: booleans as `true`/`false`, lists as a comma-separated
 * value and maps as `name[key]=value`, leaving out nulls.
 *
 * @internal
 */
final class QueryString
{
    /**
     * @param  array<array-key, mixed>  $query
     *
     * @throws \InvalidArgumentException If a value has no query form, such as a date object or a list of maps.
     */
    public static function encode(array $query, ?string $prefix = null): string
    {
        $pairs = [];
        foreach ($query as $key => $value) {
            $name = $prefix === null ? (string) $key : $prefix.'['.$key.']';
            if (is_array($value) && ! array_is_list($value)) {
                $nested = self::encode($value, $name);
                if ($nested !== '') {
                    $pairs[] = $nested;
                }

                continue;
            }
            // Nulls, and lists left empty without them, are left out.
            $items = array_values(array_filter(is_array($value) ? $value : [$value], static fn (mixed $item): bool => $item !== null));
            if ($items !== []) {
                $pairs[] = rawurlencode($name).'='.rawurlencode(implode(',', array_map(static fn (mixed $item): string => self::value($name, $item), $items)));
            }
        }

        return implode('&', $pairs);
    }

    /** @throws \InvalidArgumentException If the value has no query form. */
    private static function value(string $name, mixed $value): string
    {
        return match (true) {
            is_bool($value) => $value ? 'true' : 'false',
            is_int($value), is_string($value) => (string) $value,
            // Plain decimal notation: PHP would write 1e20 as 1.0E+20.
            is_float($value) && is_finite($value) => rtrim(rtrim(number_format($value, 14, '.', ''), '0'), '.'),
            $value instanceof \BackedEnum => (string) $value->value,
            $value instanceof \Stringable && ! $value instanceof \DateTimeInterface => (string) $value,
            default => throw new \InvalidArgumentException(sprintf(
                'Query parameter "%s" has a %s, which has no query form: pass text, a number, a boolean, an enum, or a list or map of them%s.',
                $name,
                get_debug_type($value),
                $value instanceof \DateTimeInterface ? ' (a date as "Y-m-d" or an RFC 3339 date-time)' : '',
            )),
        };
    }
}
