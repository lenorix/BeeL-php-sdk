<?php

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

require dirname(__DIR__).'/vendor/autoload.php';

// With a file argument (such as build/openapi.json itself) the contract is prepared again
// from that copy instead of being downloaded: every edit below can be applied twice.
$source = $argv[1] ?? 'https://docs.beel.es/api/openapi';
$destination = dirname(__DIR__).'/build/openapi.json';

$contents = @file_get_contents($source, false, stream_context_create([
    'http' => ['timeout' => 30, 'header' => "Accept: application/yaml\r\n"],
]));
if ($contents === false) {
    fwrite(STDERR, "Unable to read the BeeL OpenAPI schema from {$source}.\n");
    exit(1);
}

try {
    // Objects stay objects, so empty maps such as `{}` survive the conversion to JSON unchanged.
    $document = Yaml::parse($contents, Yaml::PARSE_OBJECT_FOR_MAP);
} catch (Throwable $exception) {
    fwrite(STDERR, "Unable to parse the BeeL OpenAPI schema: {$exception->getMessage()}\n");
    exit(1);
}
if (! $document instanceof stdClass || ! isset($document->paths) || ! $document->paths instanceof stdClass) {
    fwrite(STDERR, "The BeeL OpenAPI schema does not contain a valid paths object.\n");
    exit(1);
}

// First edit: Jane cannot read the type of a non-body parameter whose schema
// is a single-item `allOf` wrapper around a `$ref` (BeeL's `sort_by` and `sort_order`),
// and refuses to generate. Copy the referenced `type` onto those schemas; nothing else changes.
$patched = 0;
$addType = static function (mixed $parameter) use ($document, &$patched): void {
    $schema = $parameter instanceof stdClass ? ($parameter->schema ?? null) : null;
    if (! $schema instanceof stdClass || isset($schema->type) || isset($schema->enum)
        || ! isset($schema->allOf) || ! is_array($schema->allOf) || count($schema->allOf) !== 1) {
        return;
    }
    $reference = $schema->allOf[0]->{'$ref'} ?? null;
    if (! is_string($reference) || ! str_starts_with($reference, '#/components/schemas/')) {
        return;
    }
    $type = $document->components->schemas->{substr($reference, strlen('#/components/schemas/'))}->type ?? null;
    if (is_string($type)) {
        $schema->type = $type;
        $patched++;
    }
};

foreach (get_object_vars($document->paths) as $pathItem) {
    foreach (get_object_vars($pathItem) as $key => $operation) {
        $parameters = $key === 'parameters' ? $operation : ($operation->parameters ?? []);
        foreach (is_array($parameters) ? $parameters : [] as $parameter) {
            $addType($parameter);
        }
    }
}
foreach (get_object_vars($document->components->parameters ?? new stdClass) as $parameter) {
    $addType($parameter);
}

$schemas = $document->components->schemas ?? new stdClass;
$component = static function (mixed $schema) use ($schemas): ?string {
    $reference = $schema instanceof stdClass ? ($schema->{'$ref'} ?? null) : null;
    if (! is_string($reference) || ! str_starts_with($reference, '#/components/schemas/')) {
        return null;
    }
    $name = substr($reference, strlen('#/components/schemas/'));

    return isset($schemas->{$name}) ? $name : null;
};
// A component holding a single value (such as an enum) rather than an object with properties.
$isScalar = static fn (string $name): bool => in_array($schemas->{$name}->type ?? null, ['string', 'integer', 'number', 'boolean'], true)
    && ! isset($schemas->{$name}->allOf);
// OpenAPI 3.0 ignores keywords next to `$ref`, so `nullable` must sit on an `allOf` wrapper instead.
// Only for a single value: around an object, Jane would copy the model under a new class name.
$wrapScalarReference = static function (stdClass $property, string $name): stdClass {
    $wrapped = (object) ['allOf' => [(object) ['$ref' => '#/components/schemas/'.$name]]];
    foreach (get_object_vars($property) as $keyword => $value) {
        if ($keyword !== '$ref') {
            $wrapped->{$keyword} = $value;
        }
    }
    $wrapped->nullable = true;

    return $wrapped;
};
// The properties a schema requires, including those required by the parts of its `allOf`: Jane
// generates one model from all the parts, so a property is required when any part requires it.
$requiredIn = static function (stdClass $schema) use (&$requiredIn, $schemas, $component): array {
    $name = $component($schema);
    $schema = $name !== null ? $schemas->{$name} : $schema;
    $required = is_array($schema->required ?? null) ? $schema->required : [];
    foreach (is_array($schema->allOf ?? null) ? $schema->allOf : [] as $part) {
        if ($part instanceof stdClass) {
            $required = [...$required, ...$requiredIn($part)];
        }
    }

    return $required;
};

// Walk a schema and everything it contains, calling $onProperty for each property with whether it
// is required there, and $onReference for each component it refers to other than as a property.
$walk = static function (mixed $schema, array $inherited, callable $onProperty, callable $onReference, array &$visited) use (&$walk, $schemas, $component, $requiredIn): void {
    if (! $schema instanceof stdClass) {
        return;
    }
    $name = $component($schema);
    if ($name !== null) {
        $key = $name.'|'.implode(',', $inherited);
        if (! isset($visited[$key])) {
            $visited[$key] = true;
            $walk($schemas->{$name}, $inherited, $onProperty, $onReference, $visited);
        }

        return;
    }
    $required = [...$inherited, ...$requiredIn($schema)];
    foreach (get_object_vars($schema->properties ?? new stdClass) as $property => $propertySchema) {
        if ($propertySchema instanceof stdClass) {
            $onProperty($schema, $property, in_array($property, $required, true));
            $walk($propertySchema, [], $onProperty, $onReference, $visited);
        }
    }
    foreach (is_array($schema->allOf ?? null) ? $schema->allOf : [] as $part) {
        $walk($part, $required, $onProperty, $onReference, $visited);
    }
    foreach (['oneOf', 'anyOf'] as $keyword) {
        foreach (is_array($schema->{$keyword} ?? null) ? $schema->{$keyword} : [] as $option) {
            if (($optionName = $component($option)) !== null) {
                $onReference($optionName);
            }
            $walk($option, [], $onProperty, $onReference, $visited);
        }
    }
    foreach (['items', 'additionalProperties'] as $keyword) {
        $walk($schema->{$keyword} ?? null, [], $onProperty, $onReference, $visited);
    }
};

// Second edit: BeeL writes some nullable references as `{$ref, nullable: true}`, which loses the
// null (see above). Move `nullable` onto a wrapper, where Jane reads it.
$nullableRefs = 0;
$visited = [];
$everySchema = static function (callable $onProperty, callable $onReference) use ($document, $walk, $schemas, $component): void {
    $visited = [];
    foreach (array_keys(get_object_vars($schemas)) as $name) {
        $walk((object) ['$ref' => '#/components/schemas/'.$name], [], $onProperty, $onReference, $visited);
    }
    foreach (get_object_vars($document->paths) as $pathItem) {
        foreach (get_object_vars($pathItem) as $operation) {
            $contents = [$operation->requestBody->content ?? null];
            foreach (get_object_vars($operation->responses ?? new stdClass) as $response) {
                $contents[] = $response->content ?? null;
            }
            foreach ($contents as $content) {
                foreach (get_object_vars($content ?? new stdClass) as $media) {
                    if (($name = $component($media->schema ?? null)) !== null) {
                        $onReference($name);
                    }
                    $walk($media->schema ?? null, [], $onProperty, $onReference, $visited);
                }
            }
        }
    }
};
$everySchema(static function (stdClass $schema, string $property) use ($component, $isScalar, $wrapScalarReference, &$nullableRefs): void {
    $propertySchema = $schema->properties->{$property};
    $name = $component($propertySchema);
    if ($name !== null && ($propertySchema->nullable ?? false) === true && $isScalar($name)) {
        $schema->properties->{$property} = $wrapScalarReference($propertySchema, $name);
        $nullableRefs++;
    }
}, static fn () => null);

// Third edit: BeeL's `SuccessResponse` states that every successful JSON response carries its
// payload in `data`, but a few envelopes are written without `SuccessResponse` and without
// `required`. Require `data` there too, so the next edit keeps it non-nullable like everywhere else.
$envelopesCompleted = 0;
foreach (get_object_vars($document->paths) as $pathItem) {
    foreach (get_object_vars($pathItem) as $operation) {
        foreach (get_object_vars($operation->responses ?? new stdClass) as $status => $response) {
            if ((int) $status < 200 || (int) $status >= 300) {
                continue;
            }
            foreach (get_object_vars($response->content ?? new stdClass) as $media) {
                $name = $component($media->schema ?? null);
                $envelope = $name !== null ? $schemas->{$name} : ($media->schema ?? null);
                if ($envelope instanceof stdClass && isset($envelope->properties->data)
                    && ! in_array('data', $requiredIn($envelope), true)) {
                    $envelope->required = [...(is_array($envelope->required ?? null) ? $envelope->required : []), 'data'];
                    $envelopesCompleted++;
                }
            }
        }
    }
}

// Fourth edit: an optional property BeeL leaves out of what it sends is read as null. The contract
// keeps absent and null apart, but a PHP getter cannot return "absent": without this, the getter
// of an omitted optional property throws a TypeError. Required properties keep their types, so a
// null BeeL sends where one is not allowed is still rejected.
//
// What BeeL sends: successful responses and the webhook events it posts.
$everySent = static function (callable $onProperty) use ($document, $schemas, $walk): void {
    $visited = [];
    foreach (get_object_vars($document->paths) as $pathItem) {
        foreach (get_object_vars($pathItem) as $operation) {
            foreach (get_object_vars($operation->responses ?? new stdClass) as $status => $response) {
                if ((int) $status >= 200 && (int) $status < 300) {
                    foreach (get_object_vars($response->content ?? new stdClass) as $media) {
                        $walk($media->schema ?? null, [], $onProperty, static fn () => null, $visited);
                    }
                }
            }
        }
    }
    foreach (array_keys(get_object_vars($schemas)) as $name) {
        if (str_starts_with($name, 'WebhookEvent')) {
            $walk((object) ['$ref' => '#/components/schemas/'.$name], [], $onProperty, static fn () => null, $visited);
        }
    }
};
// Census first: every place each property and component is used in the whole contract.
$everRequired = [];
$optionalUses = [];
$otherUses = [];
$everySchema(
    static function (stdClass $schema, string $property, bool $required) use (&$everRequired, &$optionalUses, $component): void {
        $key = spl_object_id($schema).'.'.$property;
        $everRequired[$key] = ($everRequired[$key] ?? false) || $required;
        if (! $required && ($name = $component($schema->properties->{$property})) !== null) {
            $optionalUses[$name] = true;
        }
    },
    static function (string $name) use (&$otherUses): void {
        $otherUses[$name] = true;
    },
);
$requiredInSent = [];
$everySent(static function (stdClass $schema, string $property, bool $required) use (&$requiredInSent, $component): void {
    if ($required && ($name = $component($schema->properties->{$property})) !== null) {
        $requiredInSent[$name] = true;
    }
});
// Jane reads a one-item `oneOf` as its model only when the object has every required key and
// known enum values; otherwise the raw array reaches the setter and the whole response fails.
// So the wrapper is only safe around a model with neither, which Jane reads from any object.
$readsAnyObject = static function (string $name) use ($schemas, $component): bool {
    $schema = $schemas->{$name};
    if (! isset($schema->properties) || isset($schema->allOf) || ($schema->required ?? []) !== []) {
        return false;
    }
    foreach (get_object_vars($schema->properties) as $property) {
        $target = $component($property);
        if (isset($property->enum) || ($target !== null && isset($schemas->{$target}->enum))) {
            return false;
        }
    }

    return true;
};
$optionalMadeNullable = 0;
$sharedComponents = [];
$makeNullable = static function (stdClass $schema, string $property) use (&$optionalMadeNullable, &$sharedComponents, $everRequired, $optionalUses, $otherUses, $requiredInSent, $schemas, $component, $isScalar, $wrapScalarReference, $readsAnyObject): void {
    $propertySchema = $schema->properties->{$property};
    if (($everRequired[spl_object_id($schema).'.'.$property] ?? false) || ($propertySchema->nullable ?? false) === true) {
        return;
    }
    $name = $component($propertySchema);
    if ($name === null) {
        $propertySchema->nullable = true;
        $optionalMadeNullable++;
    } elseif ($isScalar($name)) {
        $schema->properties->{$property} = $wrapScalarReference($propertySchema, $name);
        $optionalMadeNullable++;
    } elseif (($schemas->{$name}->nullable ?? false) === true) {
        return;
    } elseif (! isset($otherUses[$name]) && ! isset($requiredInSent[$name]) && isset($optionalUses[$name])) {
        // BeeL never sends this model where it is required, so the model itself can be nullable.
        // Request properties that require it accept null too; BeeL still rejects one sent as null.
        $schemas->{$name}->nullable = true;
        $optionalMadeNullable++;
    } elseif ($readsAnyObject($name)) {
        // Required elsewhere in what BeeL sends: only this use becomes nullable (see $readsAnyObject).
        $wrapped = (object) ['oneOf' => [(object) ['$ref' => '#/components/schemas/'.$name]]];
        foreach (get_object_vars($propertySchema) as $keyword => $value) {
            if ($keyword !== '$ref') {
                $wrapped->{$keyword} = $value;
            }
        }
        $wrapped->nullable = true;
        $schema->properties->{$property} = $wrapped;
        $optionalMadeNullable++;
    } else {
        $sharedComponents[$name] = true;
    }
};
$everySent($makeNullable);
ksort($sharedComponents);

$json = json_encode($document, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
if ($json === false || (! is_dir(dirname($destination)) && ! mkdir(dirname($destination), 0777, true))
    || file_put_contents($destination, $json."\n") === false) {
    fwrite(STDERR, "Unable to write the OpenAPI schema to {$destination}.\n");
    exit(1);
}

fwrite(STDOUT, "Wrote {$destination} ({$patched} parameter schemas given a type for Jane, {$nullableRefs} nullable references wrapped, {$envelopesCompleted} envelopes given a required `data`, {$optionalMadeNullable} optional properties or models made nullable).\n");
if ($sharedComponents !== []) {
    fwrite(STDOUT, 'Optional but left non-nullable, as they are also required in what BeeL sends and have required keys or enums: '.implode(', ', array_keys($sharedComponents)).".\n");
}
if ($patched === 0 && ! isset($argv[1])) {
    fwrite(STDOUT, "BeeL's contract no longer needs the first edit: Jane can read every parameter type.\n");
}
