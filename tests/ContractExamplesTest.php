<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Tests\Support\SchemaSample;

/**
 * Every response example in BeeL's contract, resolved from `components/examples`.
 *
 * @return array<string, array{string, int, mixed}>
 */
function contractResponseExamples(): array
{
    $spec = json_decode((string) file_get_contents(__DIR__.'/../build/openapi.json'), true, flags: JSON_THROW_ON_ERROR);
    $examples = [];
    foreach ($spec['paths'] as $operations) {
        foreach ($operations as $operation) {
            if (! is_array($operation) || ! isset($operation['operationId'], $operation['responses'])) {
                continue;
            }
            foreach ($operation['responses'] as $status => $response) {
                $content = $response['content']['application/json'] ?? null;
                if ($content === null) {
                    continue;
                }
                $named = array_key_exists('example', $content) ? ['example' => ['value' => $content['example']]] : ($content['examples'] ?? []);
                foreach ($named as $name => $example) {
                    if (isset($example['$ref'])) {
                        $example = $spec['components']['examples'][substr($example['$ref'], strlen('#/components/examples/'))];
                    }
                    $examples["{$status} {$operation['operationId']} {$name}"] = [$operation['operationId'], (int) $status, $example['value']];
                }
            }
        }
    }

    return $examples;
}

it('reads the contract examples', function () {
    $statuses = array_column(contractResponseExamples(), 1);

    // Guards the dataset below against a contract or parser change that silently drops examples.
    expect(count(array_filter($statuses, fn (int $status) => $status < 300)))->toBeGreaterThanOrEqual(33)
        ->and(count(array_filter($statuses, fn (int $status) => $status >= 400)))->toBeGreaterThanOrEqual(38);
});

it('reads every response example of the contract', function (string $operationId, int $status, mixed $example) {
    $serializer = (fn () => $this->serializer)->call((new Beel(apiKey: 'beel_sk_test_key'))->raw);
    $endpoint = (new ReflectionClass('Lenorix\\BeelSdk\\Generated\\Endpoint\\'.ucfirst($operationId)))->newInstanceWithoutConstructor();
    $response = new Response($status, ['Content-Type' => 'application/json'], json_encode($example, JSON_THROW_ON_ERROR));
    $read = fn () => (fn () => $this->transformResponseBody($response, $serializer, 'application/json'))->call($endpoint);

    if ($status < 300) {
        expect($read())->toBeObject()->not->toBeInstanceOf(ErrorResponse::class);

        return;
    }

    try {
        $read();
        $this->fail('An error example was read as a success.');
    } catch (Throwable $exception) {
        $error = BeelApiError::fromGenerated($exception);
        expect($error->statusCode)->toBe($status)
            ->and($error->apiCode)->toBe($example['error']['code']);
    }
})->with(contractResponseExamples());

/**
 * Call every getter the generated model declares, then the getters of the models it holds.
 *
 * @return list<string> The getters that failed, with their errors.
 */
function failingGetters(object $model, string $path): array
{
    if (! str_starts_with($model::class, 'Lenorix\\BeelSdk\\Generated\\Model\\')) {
        return [];
    }
    $failures = [];
    foreach ((new ReflectionClass($model))->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
        if ($method->getDeclaringClass()->getName() !== $model::class || ! str_starts_with($method->getName(), 'get')
            || $method->getNumberOfRequiredParameters() > 0 || in_array($method->getName(), ['getIterator', 'getArrayCopy'], true)) {
            continue;
        }
        try {
            $value = $method->invoke($model);
        } catch (Throwable $exception) {
            $failures[] = "{$path}->{$method->getName()}(): ".$exception->getMessage();

            continue;
        }
        foreach (is_array($value) ? $value : [$value] as $item) {
            if (is_object($item)) {
                array_push($failures, ...failingGetters($item, "{$path}->{$method->getName()}()"));
            }
        }
    }

    return $failures;
}

it('reads every model of the contract filled from its property examples', function () {
    $spec = json_decode((string) file_get_contents(__DIR__.'/../build/openapi.json'), true, flags: JSON_THROW_ON_ERROR);
    $serializer = (fn () => $this->serializer)->call((new Beel(apiKey: 'beel_sk_test_key'))->raw);
    $sample = new SchemaSample($spec['components']['schemas']);

    $models = 0;
    $failures = [];
    foreach (array_keys($spec['components']['schemas']) as $name) {
        $class = 'Lenorix\\BeelSdk\\Generated\\Model\\'.$name;
        if (! class_exists($class)) {
            continue;
        }
        $models++;
        try {
            $model = $serializer->deserialize(json_encode($sample->build(['$ref' => '#/components/schemas/'.$name]), JSON_THROW_ON_ERROR), $class, 'json');
            array_push($failures, ...failingGetters($model, $name));
        } catch (Throwable $exception) {
            $failures[] = "{$name}: ".$exception->getMessage();
        }
    }

    expect($models)->toBeGreaterThan(200)
        ->and($failures)->toBe([]);
});
