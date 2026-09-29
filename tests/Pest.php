<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Exception\BeelNotReadyError;
use Lenorix\BeelSdk\Generated\Model\CreateInvoicePdfArchiveRequest;
use Lenorix\BeelSdk\Http\RetryingClient;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;
use PHPUnit\Framework\AssertionFailedError;
use Psr\Http\Client\ClientInterface;

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

/** Read a source file with Unix line endings; Git checks files out with CRLF on Windows. */
function sourceCode(string $file): string
{
    return str_replace("\r\n", "\n", (string) file_get_contents($file));
}

function jsonResponse(array $body, int $status = 200): Response
{
    return new Response($status, ['Content-Type' => 'application/json'], json_encode($body, JSON_THROW_ON_ERROR));
}

function invoicePage(array $ids, int $page, int $totalPages, ?bool $hasNext = null): Response
{
    $pagination = ['current_page' => $page, 'total_pages' => $totalPages, 'total_items' => 99, 'items_per_page' => 2];
    if ($hasNext !== null) {
        $pagination['has_next'] = $hasNext;
    }

    return jsonResponse(['success' => true, 'data' => [
        'invoices' => array_map(static fn (string $id): array => ['id' => $id], $ids),
        'pagination' => $pagination,
    ]]);
}

function testClient(RecordingPsrClient $transport, int $maxRetries = 0): Beel
{
    return new Beel(apiKey: 'beel_sk_test_key', maxRetries: $maxRetries, retryDelayMs: 0, maxRetryDelayMs: 0, httpClient: $transport);
}

function pdfNotReady(Response $response): BeelNotReadyError
{
    try {
        testClient(new RecordingPsrClient([$response]))->company('c')->invoices->getPdf('inv-1');
    } catch (BeelNotReadyError $exception) {
        return $exception;
    }

    throw new LogicException('Expected BeelNotReadyError.');
}

function archiveRequest(): CreateInvoicePdfArchiveRequest
{
    return (new CreateInvoicePdfArchiveRequest)->setInvoiceIds(['inv-1', 'inv-2']);
}

function retryingClient(ClientInterface $transport, array &$sleeps, int $maxRetries = 1, int $maxRetryDelayMs = 30_000, int $retryDelayMs = 500): RetryingClient
{
    return new RetryingClient($transport, $maxRetries, $retryDelayMs, $maxRetryDelayMs, sleep: static function (int $milliseconds) use (&$sleeps): void {
        $sleeps[] = $milliseconds;
    });
}

/**
 * Run a call and collect the deprecations it triggers in the SDK's own code, generated code included.
 *
 * @return list<string>
 */
function deprecationsFromSource(Closure $call): array
{
    $deprecations = [];
    $source = str_replace('\\', '/', (string) realpath(__DIR__.'/../src')).'/';
    set_error_handler(static function (int $level, string $message, string $file) use (&$deprecations, $source): bool {
        if (str_starts_with(str_replace('\\', '/', $file), $source)) {
            $deprecations[] = $message;
        }

        return true;
    }, E_DEPRECATED | E_USER_DEPRECATED);

    try {
        $call();
    } finally {
        restore_error_handler();
    }

    return $deprecations;
}

/** A webhook event with every field BeeL's contract requires, for tests that change one of them. */
function webhookEvent(array $overrides = []): array
{
    return [
        'id' => 'evt-1',
        'type' => 'invoice.issued',
        'created_at' => '2026-09-25T12:00:00Z',
        'api_version' => '2026-09-01',
        'livemode' => false,
        'data' => ['invoice_id' => 'inv-1', 'invoice_number' => 'F-2026-0001'],
        ...$overrides,
    ];
}

/**
 * Run a call that must throw, and return the exception so the test can check it.
 *
 * @template T of Throwable
 *
 * @param  class-string<T>  $class
 * @return T
 */
function thrown(callable $call, string $class): Throwable
{
    try {
        $call();
    } catch (Throwable $exception) {
        expect($exception)->toBeInstanceOf($class);

        return $exception;
    }

    throw new AssertionFailedError("Expected {$class}, but nothing was thrown.");
}
