<?php

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

require dirname(__DIR__).'/vendor/autoload.php';

$source = 'https://docs.beel.es/api/openapi';
$destination = dirname(__DIR__).'/build/openapi.json';
$context = stream_context_create([
    'http' => [
        'timeout' => 30,
        'header' => "Accept: application/yaml\r\n",
    ],
]);

$contents = @file_get_contents($source, false, $context);

if ($contents === false) {
    fwrite(STDERR, "Unable to download the BeeL OpenAPI schema from {$source}.\n");
    exit(1);
}

try {
    $document = Yaml::parse($contents);
} catch (Throwable $exception) {
    fwrite(STDERR, "Unable to parse the BeeL OpenAPI schema: {$exception->getMessage()}\n");
    exit(1);
}

if (! is_array($document) || ! isset($document['paths']) || ! is_array($document['paths'])) {
    fwrite(STDERR, "The BeeL OpenAPI schema does not contain a valid paths object.\n");
    exit(1);
}

$normalizeParameter = static function (mixed &$parameter) use ($document): void {
    if (! is_array($parameter) || isset($parameter['$ref']) || isset($parameter['content'])) {
        return;
    }

    $schema = $parameter['schema'] ?? null;

    if (! is_array($schema)
        || isset($schema['type'])
        || isset($schema['enum'])
        || isset($schema['$ref'])
        || isset($schema['oneOf'])
        || isset($schema['anyOf'])) {
        return;
    }

    // BeeL wraps some shared enum schemas in a single-item allOf. Jane does
    // not infer a non-body parameter's type through that wrapper, so copy the
    // referenced type and enum onto the parameter schema.
    if (isset($schema['allOf']) && is_array($schema['allOf']) && count($schema['allOf']) === 1) {
        $reference = $schema['allOf'][0]['$ref'] ?? null;

        if (is_string($reference) && str_starts_with($reference, '#/')) {
            $referencedSchema = $document;

            foreach (explode('/', substr($reference, 2)) as $segment) {
                $segment = str_replace(['~1', '~0'], ['/', '~'], $segment);
                $referencedSchema = is_array($referencedSchema) ? ($referencedSchema[$segment] ?? null) : null;
            }

            if (is_array($referencedSchema)) {
                if (isset($referencedSchema['type'])) {
                    $parameter['schema']['type'] = $referencedSchema['type'];
                }

                if (isset($referencedSchema['enum'])) {
                    $parameter['schema']['enum'] = $referencedSchema['enum'];
                }

                $schema = $parameter['schema'];
            }
        }
    }

    if (isset($schema['type']) || isset($schema['enum'])) {
        return;
    }

    // BeeL's untyped query parameters are scalar filters; Jane needs an
    // explicit OpenAPI type to generate their PHP argument declarations.
    $parameter['schema']['type'] = 'string';
};

$methods = ['get', 'put', 'post', 'delete', 'options', 'head', 'patch', 'trace'];

foreach ($document['paths'] as &$pathItem) {
    if (! is_array($pathItem)) {
        continue;
    }

    if (isset($pathItem['parameters']) && is_array($pathItem['parameters'])) {
        foreach ($pathItem['parameters'] as &$parameter) {
            $normalizeParameter($parameter);
        }
        unset($parameter);
    }

    foreach ($methods as $method) {
        if (! isset($pathItem[$method]['parameters']) || ! is_array($pathItem[$method]['parameters'])) {
            continue;
        }

        foreach ($pathItem[$method]['parameters'] as &$parameter) {
            $normalizeParameter($parameter);
        }
        unset($parameter);
    }
}
unset($pathItem);

if (isset($document['components']['parameters']) && is_array($document['components']['parameters'])) {
    foreach ($document['components']['parameters'] as &$parameter) {
        $normalizeParameter($parameter);
    }
    unset($parameter);
}

$json = json_encode($document, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

if ($json === false) {
    fwrite(STDERR, "Unable to encode the BeeL OpenAPI schema as JSON.\n");
    exit(1);
}

$directory = dirname($destination);

if (! is_dir($directory) && ! mkdir($directory, 0777, true) && ! is_dir($directory)) {
    fwrite(STDERR, "Unable to create the build directory.\n");
    exit(1);
}

if (file_put_contents($destination, $json."\n") === false) {
    fwrite(STDERR, "Unable to write the normalized OpenAPI schema to {$destination}.\n");
    exit(1);
}
