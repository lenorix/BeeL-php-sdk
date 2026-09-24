<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Generated\Client;
use Throwable;

/** Maps ergonomic method names to existing operations on the generated Jane client. */
abstract readonly class GeneratedResource
{
    /** @param array<string, string> $operations @param list<mixed> $prefixArguments */
    public function __construct(protected Client $client, private array $operations, private array $prefixArguments = []) {}

    public function __call(string $name, array $arguments): mixed
    {
        $operation = $this->operations[$name] ?? null;
        if ($operation === null || ! method_exists($this->client, $operation)) {
            throw new \BadMethodCallException(sprintf('Unknown %s operation: %s', static::class, $name));
        }

        return $this->execute(fn () => $this->client->{$operation}(...[...$this->prefixArguments, ...$arguments]));
    }

    /** Run one generated endpoint call and unwrap its generated response envelope. */
    protected function execute(callable $operation): mixed
    {
        try {
            $response = $operation();
        } catch (Throwable $exception) {
            throw BeelApiError::fromGenerated($exception);
        }

        return $this->unwrap($response);
    }

    private function unwrap(mixed $response): mixed
    {
        if (is_object($response) && method_exists($response, 'getData')) {
            return $response->getData();
        }

        return $response;
    }
}
