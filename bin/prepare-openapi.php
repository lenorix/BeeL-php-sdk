<?php

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

require dirname(__DIR__).'/vendor/autoload.php';

$source = 'https://docs.beel.es/api/openapi';
$destination = dirname(__DIR__).'/build/openapi.json';

$contents = @file_get_contents($source, false, stream_context_create([
    'http' => ['timeout' => 30, 'header' => "Accept: application/yaml\r\n"],
]));
if ($contents === false) {
    fwrite(STDERR, "Unable to download the BeeL OpenAPI schema from {$source}.\n");
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

// The only edit Jane needs: it cannot read the type of a non-body parameter whose schema
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

$json = json_encode($document, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
if ($json === false || (! is_dir(dirname($destination)) && ! mkdir(dirname($destination), 0777, true))
    || file_put_contents($destination, $json."\n") === false) {
    fwrite(STDERR, "Unable to write the OpenAPI schema to {$destination}.\n");
    exit(1);
}

fwrite(STDOUT, "Wrote {$destination} ({$patched} parameter schemas given a type for Jane).\n");
