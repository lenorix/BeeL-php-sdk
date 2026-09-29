<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Build\OpenApi;

use stdClass;

/**
 * The edits BeeL's OpenAPI contract needs before Jane generates the client from it.
 *
 * Every edit can be applied twice: preparing an already prepared contract changes nothing.
 */
final class ContractPatcher
{
    private const SCHEMAS = '#/components/schemas/';

    private stdClass $schemas;

    public function __construct(private readonly stdClass $document)
    {
        $this->schemas = $document->components->schemas ?? new stdClass;
    }

    /**
     * Jane cannot read the type of a non-body parameter whose schema is a single-item `allOf`
     * wrapper around a `$ref` (BeeL's `sort_by` and `sort_order`), and refuses to generate: copy
     * the referenced `type` onto those schemas. In the same pass, Jane reads a `number` query
     * parameter without a `format` as an integer, so a price filter such as `min_price=9.99` was
     * rejected: give it the `double` format BeeL uses for the other amounts (the SDK passes whole
     * numbers for them as floats, see QueryParameters::numbers()).
     *
     * @return array{int, int} Parameters given a type, and number parameters given a format.
     */
    public function typeParameters(): array
    {
        $typed = 0;
        $formatted = 0;
        $parameters = [];
        foreach (get_object_vars($this->document->paths) as $pathItem) {
            foreach (get_object_vars($pathItem) as $key => $operation) {
                $list = $key === 'parameters' ? $operation : ($operation->parameters ?? []);
                $parameters = [...$parameters, ...(is_array($list) ? $list : [])];
            }
        }
        $parameters = [...$parameters, ...array_values(get_object_vars($this->document->components->parameters ?? new stdClass))];

        foreach ($parameters as $parameter) {
            $schema = $parameter instanceof stdClass ? ($parameter->schema ?? null) : null;
            if (! $schema instanceof stdClass) {
                continue;
            }
            $reference = is_array($schema->allOf ?? null) && count($schema->allOf) === 1 ? ($schema->allOf[0]->{'$ref'} ?? null) : null;
            $name = is_string($reference) && str_starts_with($reference, self::SCHEMAS) ? substr($reference, strlen(self::SCHEMAS)) : null;
            $type = $name !== null ? ($this->document->components->schemas->{$name}->type ?? null) : null;
            if (! isset($schema->type) && ! isset($schema->enum) && is_string($type)) {
                $schema->type = $type;
                $typed++;
            }
            if (($parameter->in ?? null) === 'query' && ($schema->type ?? null) === 'number' && ! isset($schema->format)) {
                $schema->format = 'double';
                $formatted++;
            }
        }

        return [$typed, $formatted];
    }

    /**
     * Every operation declares a `default` response (BeeL's UnexpectedError), and Jane reads it with
     * code that lowercases the Content-Type without checking it exists, a PHP deprecation for a
     * response without one. Drop them: the SDK reads an error status the operation does not declare
     * from its body itself, and reports a success status it cannot read.
     *
     * @return int Default responses dropped.
     */
    public function dropDefaultResponses(): int
    {
        $dropped = 0;
        foreach ($this->operations() as $operation) {
            if (($operation->responses ?? null) instanceof stdClass && isset($operation->responses->default)) {
                unset($operation->responses->default);
                $dropped++;
            }
        }

        return $dropped;
    }

    /**
     * OpenAPI 3.0 ignores keywords next to `$ref`, so BeeL's nullable references written as
     * `{$ref, nullable: true}` lose their null. Move `nullable` onto an `allOf` wrapper, where Jane
     * reads it; only around a single value, since around an object Jane would copy the model.
     *
     * @return int References wrapped.
     */
    public function wrapNullableReferences(): int
    {
        $wrapped = 0;
        $this->everySchema(function (stdClass $schema, string $property) use (&$wrapped): void {
            $propertySchema = $schema->properties->{$property};
            $name = $this->component($propertySchema);
            if ($name !== null && ($propertySchema->nullable ?? false) === true && $this->isScalar($name)) {
                $schema->properties->{$property} = $this->wrap('allOf', $propertySchema, $name);
                $wrapped++;
            }
        }, static fn () => null);

        return $wrapped;
    }

    /**
     * BeeL's `SuccessResponse` states that every successful JSON response carries its payload in
     * `data`, but a few envelopes are written without `SuccessResponse` and without `required`.
     * Require `data` there too, so makeOptionalNullable() keeps it non-nullable like everywhere else.
     *
     * @return int Envelopes given a required `data`.
     */
    public function requireEnvelopeData(): int
    {
        $completed = 0;
        foreach ($this->successMedia() as $media) {
            $name = $this->component($media->schema ?? null);
            $envelope = $name !== null ? $this->schemas->{$name} : ($media->schema ?? null);
            if ($envelope instanceof stdClass && isset($envelope->properties->data) && ! in_array('data', $this->requiredIn($envelope), true)) {
                $envelope->required = [...(is_array($envelope->required ?? null) ? $envelope->required : []), 'data'];
                $completed++;
            }
        }

        return $completed;
    }

    /**
     * An optional property BeeL leaves out of what it sends (successful responses and webhook
     * events) is read as null. The contract keeps absent and null apart, but a PHP getter cannot
     * return "absent": without this, the getter of an omitted optional property throws a TypeError.
     * Required properties keep their types, so a null BeeL sends where one is not allowed is still
     * rejected.
     *
     * @return array{int, list<string>} Properties or models made nullable, and the models left
     *                                  non-nullable because they are also required in what BeeL sends.
     */
    public function makeOptionalNullable(): array
    {
        // Census first: every place each property and component is used in the whole contract.
        $everRequired = [];
        $optionalUses = [];
        $otherUses = [];
        $this->everySchema(
            function (stdClass $schema, string $property, bool $required) use (&$everRequired, &$optionalUses): void {
                $key = spl_object_id($schema).'.'.$property;
                $everRequired[$key] = ($everRequired[$key] ?? false) || $required;
                if (! $required && ($name = $this->component($schema->properties->{$property})) !== null) {
                    $optionalUses[$name] = true;
                }
            },
            static function (string $name) use (&$otherUses): void {
                $otherUses[$name] = true;
            },
        );
        $requiredInSent = [];
        $this->everySent(function (stdClass $schema, string $property, bool $required) use (&$requiredInSent): void {
            if ($required && ($name = $this->component($schema->properties->{$property})) !== null) {
                $requiredInSent[$name] = true;
            }
        });

        $madeNullable = 0;
        $shared = [];
        $this->everySent(function (stdClass $schema, string $property) use (&$madeNullable, &$shared, $everRequired, $optionalUses, $otherUses, $requiredInSent): void {
            $propertySchema = $schema->properties->{$property};
            if (($everRequired[spl_object_id($schema).'.'.$property] ?? false) || ($propertySchema->nullable ?? false) === true) {
                return;
            }
            $name = $this->component($propertySchema);
            if ($name === null) {
                $propertySchema->nullable = true;
                $madeNullable++;
            } elseif ($this->isScalar($name)) {
                $schema->properties->{$property} = $this->wrap('allOf', $propertySchema, $name);
                $madeNullable++;
            } elseif (($this->schemas->{$name}->nullable ?? false) === true) {
                return;
            } elseif (! isset($otherUses[$name]) && ! isset($requiredInSent[$name]) && isset($optionalUses[$name])) {
                // BeeL never sends this model where it is required, so the model itself can be nullable.
                // Request properties that require it accept null too; BeeL still rejects one sent as null.
                $this->schemas->{$name}->nullable = true;
                $madeNullable++;
            } elseif ($this->readsAnyObject($name)) {
                // Required elsewhere in what BeeL sends: only this use becomes nullable (see readsAnyObject()).
                $schema->properties->{$property} = $this->wrap('oneOf', $propertySchema, $name);
                $madeNullable++;
            } else {
                $shared[$name] = true;
            }
        });
        ksort($shared);

        return [$madeNullable, array_keys($shared)];
    }

    /** @return iterable<stdClass> Every operation of every path. */
    private function operations(): iterable
    {
        foreach (get_object_vars($this->document->paths) as $pathItem) {
            foreach (get_object_vars($pathItem) as $operation) {
                if ($operation instanceof stdClass) {
                    yield $operation;
                }
            }
        }
    }

    /** @return iterable<stdClass> The media types of every successful (`2xx`) response. */
    private function successMedia(): iterable
    {
        foreach ($this->operations() as $operation) {
            foreach (get_object_vars($operation->responses ?? new stdClass) as $status => $response) {
                if ((int) $status >= 200 && (int) $status < 300) {
                    foreach (get_object_vars($response->content ?? new stdClass) as $media) {
                        yield $media;
                    }
                }
            }
        }
    }

    /** The component a schema refers to with `$ref`, if it exists. */
    private function component(mixed $schema): ?string
    {
        $reference = $schema instanceof stdClass ? ($schema->{'$ref'} ?? null) : null;
        if (! is_string($reference) || ! str_starts_with($reference, self::SCHEMAS)) {
            return null;
        }
        $name = substr($reference, strlen(self::SCHEMAS));

        return isset($this->schemas->{$name}) ? $name : null;
    }

    /** A component holding a single value (such as an enum) rather than an object with properties. */
    private function isScalar(string $name): bool
    {
        return in_array($this->schemas->{$name}->type ?? null, ['string', 'integer', 'number', 'boolean'], true)
            && ! isset($this->schemas->{$name}->allOf);
    }

    /** A nullable `allOf` or `oneOf` wrapper around a reference, keeping the property's other keywords. */
    private function wrap(string $keyword, stdClass $property, string $name): stdClass
    {
        $wrapped = (object) [$keyword => [(object) ['$ref' => self::SCHEMAS.$name]]];
        foreach (get_object_vars($property) as $key => $value) {
            if ($key !== '$ref') {
                $wrapped->{$key} = $value;
            }
        }
        $wrapped->nullable = true;

        return $wrapped;
    }

    /**
     * Jane reads a one-item `oneOf` as its model only when the object has every required key and
     * known enum values; otherwise the raw array reaches the setter and the whole response fails.
     * So the wrapper is only safe around a model with neither, which Jane reads from any object.
     */
    private function readsAnyObject(string $name): bool
    {
        $schema = $this->schemas->{$name};
        if (! isset($schema->properties) || isset($schema->allOf) || ($schema->required ?? []) !== []) {
            return false;
        }
        foreach (get_object_vars($schema->properties) as $property) {
            $target = $this->component($property);
            if (isset($property->enum) || ($target !== null && isset($this->schemas->{$target}->enum))) {
                return false;
            }
        }

        return true;
    }

    /**
     * The properties a schema requires, including those required by the parts of its `allOf`: Jane
     * generates one model from all the parts, so a property is required when any part requires it.
     *
     * @return list<string>
     */
    private function requiredIn(stdClass $schema): array
    {
        $name = $this->component($schema);
        $schema = $name !== null ? $this->schemas->{$name} : $schema;
        $required = is_array($schema->required ?? null) ? $schema->required : [];
        foreach (is_array($schema->allOf ?? null) ? $schema->allOf : [] as $part) {
            if ($part instanceof stdClass) {
                $required = [...$required, ...$this->requiredIn($part)];
            }
        }

        return $required;
    }

    /**
     * Walk a schema and everything it contains, calling $onProperty for each property with whether
     * it is required there, and $onReference for each component it refers to other than as a property.
     *
     * @param  list<string>  $inherited  Required properties an enclosing `allOf` adds.
     * @param  array<string, true>  $visited
     */
    private function walk(mixed $schema, array $inherited, callable $onProperty, callable $onReference, array &$visited): void
    {
        if (! $schema instanceof stdClass) {
            return;
        }
        $name = $this->component($schema);
        if ($name !== null) {
            $key = $name.'|'.implode(',', $inherited);
            if (! isset($visited[$key])) {
                $visited[$key] = true;
                $this->walk($this->schemas->{$name}, $inherited, $onProperty, $onReference, $visited);
            }

            return;
        }
        $required = [...$inherited, ...$this->requiredIn($schema)];
        foreach (get_object_vars($schema->properties ?? new stdClass) as $property => $propertySchema) {
            if ($propertySchema instanceof stdClass) {
                $onProperty($schema, $property, in_array($property, $required, true));
                $this->walk($propertySchema, [], $onProperty, $onReference, $visited);
            }
        }
        foreach (is_array($schema->allOf ?? null) ? $schema->allOf : [] as $part) {
            $this->walk($part, $required, $onProperty, $onReference, $visited);
        }
        foreach (['oneOf', 'anyOf'] as $keyword) {
            foreach (is_array($schema->{$keyword} ?? null) ? $schema->{$keyword} : [] as $option) {
                if (($optionName = $this->component($option)) !== null) {
                    $onReference($optionName);
                }
                $this->walk($option, [], $onProperty, $onReference, $visited);
            }
        }
        foreach (['items', 'additionalProperties'] as $keyword) {
            $this->walk($schema->{$keyword} ?? null, [], $onProperty, $onReference, $visited);
        }
    }

    /** Walk every component, request body and response of the contract. */
    private function everySchema(callable $onProperty, callable $onReference): void
    {
        $visited = [];
        foreach (array_keys(get_object_vars($this->schemas)) as $name) {
            $this->walk((object) ['$ref' => self::SCHEMAS.$name], [], $onProperty, $onReference, $visited);
        }
        foreach ($this->operations() as $operation) {
            $contents = [$operation->requestBody->content ?? null];
            foreach (get_object_vars($operation->responses ?? new stdClass) as $response) {
                $contents[] = $response->content ?? null;
            }
            foreach ($contents as $content) {
                foreach (get_object_vars($content ?? new stdClass) as $media) {
                    if (($name = $this->component($media->schema ?? null)) !== null) {
                        $onReference($name);
                    }
                    $this->walk($media->schema ?? null, [], $onProperty, $onReference, $visited);
                }
            }
        }
    }

    /** Walk what BeeL sends: successful responses and the webhook events it posts. */
    private function everySent(callable $onProperty): void
    {
        $visited = [];
        foreach ($this->successMedia() as $media) {
            $this->walk($media->schema ?? null, [], $onProperty, static fn () => null, $visited);
        }
        foreach (array_keys(get_object_vars($this->schemas)) as $name) {
            if (str_starts_with($name, 'WebhookEvent')) {
                $this->walk((object) ['$ref' => self::SCHEMAS.$name], [], $onProperty, static fn () => null, $visited);
            }
        }
    }
}
