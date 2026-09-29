<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Tests\Support;

use GuzzleHttp\Psr7\Response;
use LogicException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Answers every BeeL request as the contract says the operation would: it finds the operation by
 * method and path, records it, and returns a success response built from the operation's schema.
 */
final class ContractTransport implements ClientInterface
{
    /** @var list<string> operationIds of the requests received since the last reset(). */
    public array $operations = [];

    /** @var array<string, string> Status to answer, by operationId, instead of the first success status. */
    private array $statuses = [];

    /** @var list<array{string, string, string}> Method, path pattern and operationId, most specific first. */
    private array $routes = [];

    private SchemaSample $sample;

    /** @param  array<string, mixed>  $contract  The decoded `build/openapi.json`. */
    public function __construct(private readonly array $contract)
    {
        $this->sample = new SchemaSample($contract['components']['schemas']);
        foreach ($contract['paths'] as $path => $operations) {
            foreach ($operations as $method => $operation) {
                if (is_array($operation) && isset($operation['operationId'])) {
                    $pattern = '#^/api'.preg_replace('/\\\\\{[A-Za-z0-9_]+\\\\\}/', '[^/]+', preg_quote($path, '#')).'$#';
                    $this->routes[] = [strtoupper($method), $pattern, $operation['operationId'], substr_count($path, '{')];
                }
            }
        }
        // A literal segment such as /invoices/export wins over a parameter such as /invoices/{id}.
        usort($this->routes, static fn (array $a, array $b): int => $a[3] <=> $b[3]);
    }

    public function reset(): void
    {
        $this->operations = [];
        $this->statuses = [];
    }

    public function answer(string $operationId, string $status): void
    {
        $this->statuses[$operationId] = $status;
    }

    /** @return list<string> The success statuses the contract declares for an operation. */
    public function successStatuses(string $operationId): array
    {
        $statuses = array_keys($this->operation($operationId)['responses']);

        return array_values(array_map('strval', array_filter($statuses, static fn (int|string $status): bool => (int) $status >= 200 && (int) $status < 300)));
    }

    /** Whether the contract declares a JSON body for an operation's status. */
    public function hasJsonBody(string $operationId, string $status): bool
    {
        return isset($this->operation($operationId)['responses'][$status]['content']['application/json']);
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        foreach ($this->routes as [$method, $pattern, $operationId]) {
            if ($method === $request->getMethod() && preg_match($pattern, $request->getUri()->getPath()) === 1) {
                $this->operations[] = $operationId;

                return $this->respond($operationId, $this->statuses[$operationId] ?? $this->successStatuses($operationId)[0]);
            }
        }

        throw new LogicException(sprintf('No operation of the contract matches %s %s.', $request->getMethod(), $request->getUri()->getPath()));
    }

    private function respond(string $operationId, string $status): ResponseInterface
    {
        $content = $this->operation($operationId)['responses'][$status]['content'] ?? [];
        if (isset($content['application/json'])) {
            return new Response((int) $status, ['Content-Type' => 'application/json'], (string) json_encode($this->sample->build($content['application/json']['schema'])));
        }
        foreach (array_keys($content) as $mediaType) {
            return new Response((int) $status, ['Content-Type' => $mediaType], 'file contents');
        }

        return new Response((int) $status, ['Content-Type' => 'text/plain']);
    }

    /** @return array<string, mixed> */
    private function operation(string $operationId): array
    {
        foreach ($this->contract['paths'] as $operations) {
            foreach ($operations as $operation) {
                if (is_array($operation) && ($operation['operationId'] ?? null) === $operationId) {
                    return $operation;
                }
            }
        }

        throw new LogicException("Unknown operation {$operationId}.");
    }
}
