<?php

declare(strict_types=1);

use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Exception\BeelNotReadyError;
use Lenorix\BeelSdk\Resource\GeneratedResource;
use Lenorix\BeelSdk\Tests\Support\ContractTransport;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;

/**
 * Every resource reachable from a client, with a label such as `company->invoices`.
 *
 * @return array<string, GeneratedResource>
 */
function reachableResources(Beel $beel): array
{
    $resources = [];
    $visit = static function (string $label, GeneratedResource $resource) use (&$visit, &$resources): void {
        $resources[$label] = $resource;
        foreach ((new ReflectionObject($resource))->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $child = $property->getValue($resource);
            if ($child instanceof GeneratedResource) {
                $visit($label.'->'.$property->getName(), $child);
            }
        }
        foreach (resourceMethods($resource, navigators: true) as $method) {
            $visit($label.'->'.$method->getName().'()', $method->invokeArgs($resource, contractArguments($method)));
        }
    };
    foreach ((new ReflectionObject($beel))->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
        if ($property->getValue($beel) instanceof GeneratedResource) {
            $visit($property->getName(), $property->getValue($beel));
        }
    }
    $visit('company', $beel->company('company-1'));
    $visit('account', $beel->account('account-1'));

    return $resources;
}

/**
 * The public methods a resource adds: calls to BeeL, or with $navigators, the ones returning a child resource.
 *
 * @return list<ReflectionMethod>
 */
function resourceMethods(GeneratedResource $resource, bool $navigators = false): array
{
    return array_values(array_filter(
        (new ReflectionObject($resource))->getMethods(ReflectionMethod::IS_PUBLIC),
        static function (ReflectionMethod $method) use ($navigators): bool {
            $type = $method->getReturnType();
            $returnsResource = $type instanceof ReflectionNamedType && is_a($type->getName(), GeneratedResource::class, true);

            return ! $method->isStatic() && ! $method->isConstructor() && ! str_starts_with($method->getName(), '__')
                && $method->getDeclaringClass()->getName() !== GeneratedResource::class
                && $returnsResource === $navigators;
        },
    ));
}

/**
 * A generated model with every property set to a placeholder, so its normalizer finds each required field.
 */
function sampleModel(string $class, int $depth = 0): object
{
    $model = new $class;
    if ($depth > 4) {
        return $model;
    }
    foreach ((new ReflectionClass($class))->getMethods(ReflectionMethod::IS_PUBLIC) as $setter) {
        $parameter = $setter->getParameters()[0] ?? null;
        if (! str_starts_with($setter->getName(), 'set') || $setter->getNumberOfParameters() !== 1 || $parameter === null) {
            continue;
        }
        $type = $parameter->getType();
        $name = match (true) {
            $type instanceof ReflectionNamedType => $type->getName(),
            // Traversable|array, as PHP reports `iterable`.
            $type instanceof ReflectionUnionType => in_array('array', array_map('strval', $type->getTypes()), true) ? 'array' : 'mixed',
            default => 'mixed',
        };
        $setter->invoke($model, match (true) {
            $name === 'string', $name === 'mixed' => 'x',
            $name === 'iterable' => [],
            $name === 'int' => 1,
            $name === 'float' => 1.5,
            $name === 'bool' => true,
            $name === 'array' => [],
            is_a($name, DateTimeInterface::class, true) => new DateTime('2026-01-02T03:04:05Z'),
            str_starts_with($name, 'Lenorix\\BeelSdk\\Generated\\Model\\') => sampleModel($name, $depth + 1),
            default => null,
        });
    }

    return $model;
}

/**
 * Placeholder arguments for a method's required parameters, plus `$query` values the generated client requires.
 *
 * @param  array<string, mixed>  $query
 * @return list<mixed>
 */
function contractArguments(ReflectionMethod $method, array $query = []): array
{
    $arguments = [];
    foreach ($method->getParameters() as $parameter) {
        if ($parameter->isOptional()) {
            if ($query === [] || ! in_array($parameter->getName(), ['query', 'queryParameters'], true)) {
                if ($query === []) {
                    break;
                }
                $arguments[] = $parameter->getDefaultValue();

                continue;
            }
            $arguments[] = $query;

            break;
        }
        $type = $parameter->getType();
        $names = $type instanceof ReflectionUnionType
            ? array_map(static fn (ReflectionNamedType $part): string => $part->getName(), $type->getTypes())
            : [$type instanceof ReflectionNamedType ? $type->getName() : 'mixed'];
        $model = array_values(array_filter($names, static fn (string $name): bool => str_starts_with($name, 'Lenorix\\BeelSdk\\Generated\\Model\\')))[0] ?? null;
        $enum = array_values(array_filter($names, static fn (string $name): bool => enum_exists($name)))[0] ?? null;
        $arguments[] = match (true) {
            $model !== null => sampleModel($model),
            $enum !== null => $enum::cases()[0],
            in_array('string', $names, true) => $parameter->getName().'-1',
            in_array('array', $names, true) => $parameter->getName() === 'query' ? $query : [],
            in_array('int', $names, true) => 1,
            in_array('float', $names, true) => 1.0,
            in_array('bool', $names, true) => true,
            default => 'contents',
        };
    }

    return $arguments;
}

/**
 * Call a resource method with placeholders, adding each query value the generated client reports missing.
 */
function callWithPlaceholders(ReflectionMethod $method, GeneratedResource $resource): mixed
{
    $query = [];
    for ($attempt = 0; ; $attempt++) {
        try {
            $result = $method->invokeArgs($resource, contractArguments($method, $query));

            return $result instanceof Generator ? $result->current() : $result;
        } catch (MissingOptionsException $exception) {
            if ($attempt > 3 || preg_match('/"([^"]+)"/', $exception->getMessage(), $option) !== 1) {
                throw $exception;
            }
            $query[$option[1]] = 'x';
        } catch (InvalidOptionsException $exception) {
            if ($attempt > 3 || preg_match('/option "([^"]+)".*expected to be of type "array"/', $exception->getMessage(), $option) !== 1) {
                throw $exception;
            }
            $query[$option[1]] = ['x'];
        }
    }
}

/** Whether a value fits a declared return type, reading `void` as null. */
function fitsReturnType(mixed $value, ?ReflectionType $type): bool
{
    if ($type === null || ($type instanceof ReflectionNamedType && $type->getName() === 'mixed')) {
        return true;
    }
    if ($value === null) {
        return $type->allowsNull() || ($type instanceof ReflectionNamedType && $type->getName() === 'void');
    }
    $names = $type instanceof ReflectionUnionType
        ? array_map(static fn (ReflectionNamedType $part): string => $part->getName(), $type->getTypes())
        : [$type instanceof ReflectionNamedType ? $type->getName() : ''];
    foreach ($names as $name) {
        if (match ($name) {
            'array' => is_array($value),
            'string' => is_string($value),
            'int' => is_int($value),
            'bool' => is_bool($value),
            'float' => is_float($value),
            'Generator', 'iterable' => $value instanceof Generator,
            default => $value instanceof $name,
        }) {
            return true;
        }
    }

    return false;
}

it('reads every success status of each operation into the type its resource method declares', function () {
    $transport = new ContractTransport(openApiContract());
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: $transport);
    $failures = [];
    $calls = 0;

    foreach (reachableResources($beel) as $label => $resource) {
        foreach (resourceMethods($resource) as $method) {
            $call = static fn (): mixed => callWithPlaceholders($method, $resource);
            $name = "{$label}->{$method->getName()}()";
            $transport->reset();
            try {
                $call();
            } catch (Throwable $exception) {
                $failures[] = "{$name}: ".$exception::class.': '.$exception->getMessage();

                continue;
            }
            if ($transport->operations === []) {
                continue;
            }
            // The operation whose response the method returns is the last one it called.
            $operationId = end($transport->operations);
            foreach ($transport->successStatuses($operationId) as $status) {
                $transport->reset();
                $transport->answer($operationId, $status);
                $calls++;
                try {
                    $result = $call();
                } catch (BeelNotReadyError) {
                    // A bodiless 202 means the result is still being generated.
                    if ($status === '202' && ! $transport->hasJsonBody($operationId, $status)) {
                        continue;
                    }
                    $failures[] = "{$name} with {$status}: not ready, though BeeL sends a body";

                    continue;
                } catch (Throwable $exception) {
                    $failures[] = "{$name} with {$status} ({$operationId}): ".$exception::class.': '.$exception->getMessage();

                    continue;
                }
                $declared = $method->getReturnType();
                // A Generator yields models whose type the method's docblock names; its first item was read above.
                if (! ($declared instanceof ReflectionNamedType && $declared->getName() === 'Generator') && ! fitsReturnType($result, $declared)) {
                    $failures[] = "{$name} with {$status} ({$operationId}): returned ".get_debug_type($result).", declared {$declared}";
                }
            }
        }
    }

    expect($failures)->toBe([])
        ->and($calls)->toBeGreaterThan(200);
});

it('reaches every current operation of the contract from a resource method', function () {
    $transport = new ContractTransport(openApiContract());
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: $transport);
    $reached = [];
    foreach (reachableResources($beel) as $resource) {
        foreach (resourceMethods($resource) as $method) {
            $transport->reset();
            try {
                callWithPlaceholders($method, $resource);
            } catch (Throwable) {
                // The first test reports failing calls; this one only collects the operations reached.
            }
            foreach ($transport->operations as $operationId) {
                $reached[$operationId] = true;
            }
        }
    }

    $missing = [];
    foreach (openApiContract()['paths'] as $path => $operations) {
        foreach ($operations as $method => $operation) {
            if (is_array($operation) && isset($operation['operationId']) && ! ($operation['deprecated'] ?? false) && ! isset($reached[$operation['operationId']])) {
                $missing[] = strtoupper($method).' '.$path.' '.$operation['operationId'];
            }
        }
    }

    expect($missing)->toBe([]);
});
