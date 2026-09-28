<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Tests\Support;

use stdClass;

/**
 * Builds a complete value for an OpenAPI schema: every property present, taking each
 * leaf from the contract's own `example` and inventing one only where it has none.
 */
final class SchemaSample
{
    private const REF_PREFIX = '#/components/schemas/';

    /** @param  array<string, mixed>  $schemas  The contract's `components/schemas`. */
    public function __construct(private readonly array $schemas) {}

    /** @param  array<string, mixed>  $schema */
    public function build(array $schema, int $depth = 0): mixed
    {
        if (isset($schema['$ref'])) {
            return $this->build($this->schemas[substr($schema['$ref'], strlen(self::REF_PREFIX))], $depth);
        }

        $type = $schema['type'] ?? (isset($schema['properties']) ? 'object' : null);
        if (is_array($type)) {
            $type = array_values(array_diff($type, ['null']))[0] ?? 'null';
        }
        // Examples of whole objects and lists may leave optional properties out, so those are built from their parts.
        $composite = isset($schema['properties']) || isset($schema['allOf']) || ($type === 'array' && isset($schema['items']));
        if (! $composite && array_key_exists('example', $schema)) {
            return $schema['example'];
        }
        if (! $composite && isset($schema['examples'][0])) {
            return $schema['examples'][0];
        }
        if (array_key_exists('const', $schema)) {
            return $schema['const'];
        }
        if (isset($schema['enum'])) {
            return $schema['enum'][0];
        }
        if (isset($schema['allOf'])) {
            $object = [];
            $other = null;
            foreach ($schema['allOf'] as $part) {
                $value = $this->build($part, $depth);
                // A later part refines an earlier one, as `data: Product` does the envelope's untyped `data`.
                is_array($value) && ! array_is_list($value) ? $object = array_replace($object, $value) : $other = $value;
            }

            return $object !== [] ? $object : $other;
        }
        foreach (['oneOf', 'anyOf'] as $keyword) {
            if (isset($schema[$keyword])) {
                foreach ($schema[$keyword] as $option) {
                    if (($option['type'] ?? null) !== 'null') {
                        return $this->build($option, $depth);
                    }
                }

                return null;
            }
        }
        if ($depth > 8) {
            return null;
        }

        return match ($type) {
            'object' => $this->object($schema, $depth),
            'array' => [$this->build($schema['items'] ?? [], $depth + 1)],
            'integer' => 1,
            'number' => 1.5,
            'boolean' => true,
            default => match ($schema['format'] ?? null) {
                'date-time' => '2026-01-02T03:04:05.123456789Z',
                'date' => '2026-01-02',
                'uuid' => '00000000-0000-4000-8000-000000000000',
                'email' => 'billing@example.com',
                'uri' => 'https://example.com',
                default => 'x',
            },
        };
    }

    /** @param  array<string, mixed>  $schema */
    private function object(array $schema, int $depth): array|stdClass
    {
        $object = [];
        foreach ($schema['properties'] ?? [] as $name => $property) {
            $object[$name] = $this->build($property, $depth + 1);
        }

        return $object !== [] ? $object : new stdClass;
    }
}
