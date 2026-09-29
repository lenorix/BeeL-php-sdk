<?php

declare(strict_types=1);

use Lenorix\BeelSdk\Build\OpenApi\ContractPatcher;
use Symfony\Component\Yaml\Yaml;

require dirname(__DIR__).'/vendor/autoload.php';
require __DIR__.'/OpenApi/ContractPatcher.php';

// With a file argument (such as build/openapi.json itself) the contract is prepared again
// from that copy instead of being downloaded: every edit can be applied twice.
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

// The order matters: requireEnvelopeData() must run before makeOptionalNullable() reads what is required.
$patcher = new ContractPatcher($document);
[$typed, $formatted] = $patcher->typeParameters();
$defaultResponses = $patcher->dropDefaultResponses();
$nullableReferences = $patcher->wrapNullableReferences();
$envelopes = $patcher->requireEnvelopeData();
[$madeNullable, $shared] = $patcher->makeOptionalNullable();

$json = json_encode($document, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
if ($json === false || (! is_dir(dirname($destination)) && ! mkdir(dirname($destination), 0777, true))
    || file_put_contents($destination, $json."\n") === false) {
    fwrite(STDERR, "Unable to write the OpenAPI schema to {$destination}.\n");
    exit(1);
}

fwrite(STDOUT, "Wrote {$destination} ({$typed} parameter schemas given a type for Jane, {$formatted} number parameters given a format, {$defaultResponses} default responses dropped, {$nullableReferences} nullable references wrapped, {$envelopes} envelopes given a required `data`, {$madeNullable} optional properties or models made nullable).\n");
if ($shared !== []) {
    fwrite(STDOUT, 'Optional but left non-nullable, as they are also required in what BeeL sends and have required keys or enums: '.implode(', ', $shared).".\n");
}
if ($typed === 0 && ! isset($argv[1])) {
    fwrite(STDOUT, "BeeL's contract no longer needs the parameter type edit: Jane can read every parameter type.\n");
}
