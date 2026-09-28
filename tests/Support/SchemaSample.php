<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Tests\Support;

use stdClass;

/**
 * Builds a value for an OpenAPI schema, taking each leaf from the contract's own `example`
 * and inventing one only where it has none: with every property, or with only the required ones.
 */
final class SchemaSample
{
    private const REF_PREFIX = '#/components/schemas/';

    /**
     * @param  array<string, mixed>  $schemas  The contract's `components/schemas`.
     * @param  bool  $requiredOnly  Leave out every property that is not required.
     */
    public function __construct(private readonly array $schemas, private readonly bool $requiredOnly = false) {}

    /**
     * @param  array<string, mixed>  $schema
     * @param  list<string>  $required  Required properties that an enclosing `allOf` adds to this schema.
     */
    public function build(array $schema, int $depth = 0, array $required = []): mixed
    {
        if (isset($schema['$ref'])) {
            return $this->build($this->resolve($schema), $depth, $required);
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
            // One model is generated from all the parts, so a property is required when any part requires it.
            $required = [...$required, ...$this->requiredIn($schema)];
            $object = [];
            $other = null;
            foreach ($schema['allOf'] as $part) {
                $value = $this->build($part, $depth, $required);
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
            'object' => $this->object($schema, $depth, $required),
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

    /**
     * The properties a schema requires, including those required by the parts of its `allOf`.
     *
     * @param  array<string, mixed>  $schema
     * @return list<string>
     */
    public function requiredIn(array $schema): array
    {
        $schema = $this->resolve($schema);
        $required = $schema['required'] ?? [];
        foreach ($schema['allOf'] ?? [] as $part) {
            $required = [...$required, ...$this->requiredIn($part)];
        }

        return array_values(array_unique($required));
    }

    /**
     * @param  array<string, mixed>  $schema
     * @return array<string, mixed>
     */
    private function resolve(array $schema): array
    {
        while (isset($schema['$ref'])) {
            $schema = $this->schemas[substr($schema['$ref'], strlen(self::REF_PREFIX))];
        }

        return $schema;
    }

    /**
     * @param  array<string, mixed>  $schema
     * @param  list<string>  $required
     */
    private function object(array $schema, int $depth, array $required): array|stdClass
    {
        $required = [...$required, ...($schema['required'] ?? [])];
        $object = [];
        foreach ($schema['properties'] ?? [] as $name => $property) {
            if (! $this->requiredOnly || in_array($name, $required, true)) {
                $object[$name] = $this->build($property, $depth + 1);
            }
        }

        return $object !== [] ? $object : new stdClass;
    }
}
