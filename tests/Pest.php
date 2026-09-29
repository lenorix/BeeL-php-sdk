<?php

declare(strict_types=1);

/**
 * BeeL's prepared OpenAPI contract (build/openapi.json), which the client is generated from.
 *
 * @return array<string, mixed>
 */
function openApiContract(): array
{
    static $contract;
    $file = __DIR__.'/../build/openapi.json';
    if (! is_file($file)) {
        throw new RuntimeException('build/openapi.json is missing: run `composer prepare-openapi` to download BeeL\'s contract.');
    }

    return $contract ??= json_decode((string) file_get_contents($file), true, 512, JSON_THROW_ON_ERROR);
}
