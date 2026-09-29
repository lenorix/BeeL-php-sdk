<?php

declare(strict_types=1);

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Builder\InvoiceBuilder;
use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Exception\BeelRateLimitError;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRepresentationSubmitPostBody;
use Lenorix\BeelSdk\Http\RequestOptions;
use Lenorix\BeelSdk\Http\RetryAfter;
use Lenorix\BeelSdk\Http\RetryingClient;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;

it('uses the per-call idempotency key on every retry, ahead of the automatic key and method headers', function () {
    $transport = new RecordingPsrClient([
        new Response(503),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']], 201),
    ]);
    $invoices = testClient($transport, maxRetries: 1)->company('company-1')->invoices;

    $invoices->withOptions(new RequestOptions(idempotencyKey: 'order-42'))
        ->create(InvoiceBuilder::create()->forCustomer('customer-1')->addLine('Consulting', 1, 100)->build(), headers: ['Idempotency-Key' => 'from-argument']);

    expect($transport->requests)->toHaveCount(2)
        ->and($transport->requests[0]->getHeader('Idempotency-Key'))->toBe(['order-42'])
        ->and($transport->requests[1]->getHeader('Idempotency-Key'))->toBe(['order-42']);
});

it('rejects idempotency keys and headers BeeL or HTTP would not accept', function () {
    expect(fn () => new RequestOptions(idempotencyKey: 'has spaces'))->toThrow(InvalidArgumentException::class)
        ->and(fn () => new RequestOptions(idempotencyKey: str_repeat('a', 256)))->toThrow(InvalidArgumentException::class)
        ->and(fn () => new RequestOptions(headers: ['Bad Header' => 'x']))->toThrow(InvalidArgumentException::class)
        ->and(fn () => new RequestOptions(headers: ['X-Number' => 1]))->toThrow(InvalidArgumentException::class)
        ->and(fn () => new RequestOptions(headers: ['X-Empty' => []]))->toThrow(InvalidArgumentException::class)
        ->and(fn () => new RequestOptions(headers: ['authorization' => 'Bearer other']))->toThrow(InvalidArgumentException::class)
        ->and((new RequestOptions(idempotencyKey: 'k_1-2', headers: ['idempotency-key' => 'other']))->allHeaders())
        ->toBe(['Idempotency-Key' => 'k_1-2']);
});

it('retries a failed request only when repeating it cannot duplicate a write', function (string $method, array $headers, bool $autoKey, int $expectedAttempts, int $status = 500) {
    $transport = new RecordingPsrClient([new Response($status), new Response(200)]);
    $client = new RetryingClient($transport, maxRetries: 1, retryDelayMs: 0, maxRetryDelayMs: 0, autoIdempotencyKey: $autoKey);

    $client->sendRequest(new Request($method, 'https://example.test/v1/invoices', $headers, '{}'));

    expect($transport->requests)->toHaveCount($expectedAttempts);
})->with([
    'POST with automatic key' => ['POST', [], true, 2],
    'POST with own key' => ['POST', ['Idempotency-Key' => 'order-42'], false, 2],
    'POST without key' => ['POST', [], false, 1],
    'PATCH without key' => ['PATCH', [], true, 1],
    'PATCH with key' => ['PATCH', ['Idempotency-Key' => 'edit-1'], true, 2],
    'GET' => ['GET', [], false, 2],
    'PUT' => ['PUT', [], false, 2],
    'DELETE' => ['DELETE', [], false, 2],
    'POST without key rate limited' => ['POST', [], false, 2, 429],
    'PATCH without key rate limited' => ['PATCH', [], true, 2, 429],
]);

it('does not retry a failed file download on 5xx unless asked, but retries a 429', function () {
    $noRetry = new RecordingPsrClient([new Response(503), new Response(200, ['Content-Type' => 'application/zip'], 'PK')]);
    $optIn = new RecordingPsrClient([new Response(503), new Response(200, ['Content-Type' => 'application/zip'], 'PK')]);
    $rateLimited = new RecordingPsrClient([new Response(429), new Response(200, ['Content-Type' => 'application/zip'], 'PK')]);

    expect(fn () => testClient($noRetry, maxRetries: 1)->company('c')->invoices->createPdfArchive(archiveRequest()))->toThrow(BeelApiError::class);
    testClient($optIn, maxRetries: 1)->company('c')->invoices->withOptions(new RequestOptions(retryServerErrors: true))->createPdfArchive(archiveRequest());
    testClient($rateLimited, maxRetries: 1)->company('c')->invoices->createPdfArchive(archiveRequest());

    expect($noRetry->requests)->toHaveCount(1)
        ->and($optIn->requests)->toHaveCount(2)
        ->and($rateLimited->requests)->toHaveCount(2);
});

it('limits retries per call with maxRetries', function () {
    $unavailable = static fn (): Response => new Response(503, ['Content-Type' => 'text/plain'], 'Service Unavailable');
    $transport = new RecordingPsrClient([$unavailable(), $unavailable(), jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']])]);
    $invoices = testClient($transport, maxRetries: 2)->company('c')->invoices;

    expect(fn () => $invoices->withOptions(new RequestOptions(maxRetries: 0))->get('inv-1'))->toThrow(BeelApiError::class, 'API error 503')
        ->and($transport->requests)->toHaveCount(1)
        ->and(fn () => new RequestOptions(maxRetries: -1))->toThrow(InvalidArgumentException::class);
});

it('uploads the signed representation as a replayable multipart body', function () {
    $transport = new RecordingPsrClient([new Response(503), jsonResponse(['success' => true, 'data' => ['status' => 'VALIDATING', 'message' => 'Queued']])]);
    $representation = testClient($transport, maxRetries: 1)->company('c')->representation;

    $representation->submit((new V1CompaniesCompanyIdRepresentationSubmitPostBody)->setFile('%PDF-signed'), ['Idempotency-Key' => 'sign-1']);

    expect($transport->requests)->toHaveCount(2)
        ->and($transport->requests[0]->getHeaderLine('Content-Type'))->toStartWith('multipart/form-data')
        ->and((string) $transport->requests[1]->getBody())->toContain('%PDF-signed')
        ->and($transport->requests[1]->getHeaderLine('Idempotency-Key'))->toBe('sign-1');
});

it('reads retry_after from the error body like the Node.js SDK', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => false, 'error' => ['code' => 'RATE_LIMITED', 'message' => 'Slow', 'retry_after' => 30]], 429)]);

    try {
        testClient($transport)->company('c')->invoices->get('inv-1');
        test()->fail('Expected a rate limit error.');
    } catch (BeelRateLimitError $exception) {
        expect($exception->retryAfter)->toBe(30)
            ->and($exception->retryAfterSeconds)->toBe(30);
    }
});

it('waits exactly the Retry-After BeeL asks for when it fits under maxRetryDelayMs', function () {
    $sleeps = [];
    $transport = new RecordingPsrClient([new Response(429, ['Retry-After' => '60']), new Response(200)]);

    retryingClient($transport, $sleeps, maxRetryDelayMs: 60_000)->sendRequest(new Request('GET', 'https://example.test/x'));

    expect($sleeps)->toBe([60_000])->and($transport->requests)->toHaveCount(2);
});

it('does not wait less than BeeL asks: it returns the 429 with the requested delay', function () {
    $sleeps = [];
    $transport = new RecordingPsrClient([new Response(429, ['Retry-After' => '60'])]);

    $response = retryingClient($transport, $sleeps, maxRetryDelayMs: 30_000)->sendRequest(new Request('GET', 'https://example.test/x'));

    expect($response->getStatusCode())->toBe(429)
        ->and($sleeps)->toBe([])
        ->and($transport->requests)->toHaveCount(1);
});

it('reports the requested delay on the exception when it does not wait', function (array|Closure $headers, string $body, int $expected) {
    $headers = $headers instanceof Closure ? $headers() : $headers;
    // Only one response is queued: a wait followed by a retry would hit the transport's
    // unexpected-request error, so one request proves the SDK did not wait, without timing it.
    $transport = new RecordingPsrClient([new Response(429, ['Content-Type' => 'application/json', ...$headers], $body)]);

    try {
        testClient($transport, maxRetries: 3)->company('c')->invoices->get('inv-1');
        test()->fail('Expected a rate limit error.');
    } catch (BeelRateLimitError $exception) {
        expect($exception->retryAfterSeconds)->toBeGreaterThanOrEqual($expected - 1)->toBeLessThanOrEqual($expected)
            ->and($exception->retryAfter)->toBe($exception->retryAfterSeconds)
            ->and($transport->requests)->toHaveCount(1);
    }
})->with([
    'seconds' => [['Retry-After' => '120'], '{"success":false}', 120],
    // A closure, so the date is built when the test runs rather than when the file loads.
    'HTTP date' => [fn (): array => ['Retry-After' => gmdate('D, d M Y H:i:s \G\M\T', time() + 120)], '{"success":false}', 120],
    'error body' => [[], '{"success":false,"error":{"code":"RATE_LIMITED","message":"Slow","retry_after":90}}', 90],
]);

it('backs off within maxRetryDelayMs for a 429 without Retry-After and for 5xx', function (int $status) {
    $sleeps = [];
    $transport = new RecordingPsrClient([new Response($status), new Response($status), new Response(200)]);

    retryingClient($transport, $sleeps, maxRetries: 2, maxRetryDelayMs: 1_000, retryDelayMs: 5_000)->sendRequest(new Request('GET', 'https://example.test/x'));

    expect($sleeps)->toHaveCount(2)
        ->and(max($sleeps))->toBeLessThanOrEqual(1_000)
        ->and(min($sleeps))->toBeGreaterThanOrEqual(500);
})->with(['429 without Retry-After' => [429], '503' => [503]]);

it('lets a single call skip waiting with maxRetries 0', function () {
    $transport = new RecordingPsrClient([new Response(429, ['Content-Type' => 'application/json', 'Retry-After' => '5'], '{"success":false}')]);

    try {
        testClient($transport, maxRetries: 3)->company('c')->invoices->withOptions(new RequestOptions(maxRetries: 0))->get('inv-1');
        test()->fail('Expected a rate limit error.');
    } catch (BeelRateLimitError $exception) {
        expect($exception->retryAfterSeconds)->toBe(5)->and($transport->requests)->toHaveCount(1);
    }
});

it('retries a connection error on a safe request and rethrows the original after the last attempt', function () {
    $sleeps = [];
    $first = new ConnectException('Connection refused', new Request('GET', 'https://example.test/x'));
    $last = new ConnectException('Timed out', new Request('GET', 'https://example.test/x'));
    $transport = new RecordingPsrClient([$first, $first, $last]);

    try {
        retryingClient($transport, $sleeps, maxRetries: 2, retryDelayMs: 0)->sendRequest(new Request('GET', 'https://example.test/x'));
        test()->fail('Expected the connection error.');
    } catch (ConnectException $exception) {
        expect($exception)->toBe($last)
            ->and($transport->requests)->toHaveCount(3)
            ->and($sleeps)->toHaveCount(2);
    }
});

it('retries a connection error only when repeating it cannot duplicate a write', function (string $method, array $headers, bool $retried) {
    $sleeps = [];
    $transport = new RecordingPsrClient([new ConnectException('Timed out', new Request($method, 'https://example.test/x')), new Response(200)]);
    $client = new RetryingClient($transport, 1, 0, 0, autoIdempotencyKey: false);

    try {
        $client->sendRequest(new Request($method, 'https://example.test/x', $headers, '{}'));
    } catch (ConnectException) {
    }

    expect($transport->requests)->toHaveCount($retried ? 2 : 1);
})->with([
    'GET' => ['GET', [], true],
    'POST with Idempotency-Key' => ['POST', ['Idempotency-Key' => 'op-1'], true],
    'POST without key' => ['POST', [], false],
    'PATCH without key' => ['PATCH', [], false],
]);

it('does not retry a connection error on file downloads', function (string $method) {
    $transport = new RecordingPsrClient([new ConnectException('Timed out', new Request('POST', 'https://example.test/x')), new Response(200, ['Content-Type' => 'application/zip'], 'PK')]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 1, retryDelayMs: 0, maxRetryDelayMs: 0, httpClient: $transport);
    $invoices = $beel->company('c')->invoices;

    expect(fn () => $method === 'archive' ? $invoices->createPdfArchive(archiveRequest()) : $invoices->export(new CreateInvoiceExportRequest))
        ->toThrow(ConnectException::class)
        ->and($transport->requests)->toHaveCount(1);
})->with(['archive' => ['archive'], 'export' => ['export']]);

it('sends the Idempotency-Key BeeL requires on imports without one from the caller', function (Closure $import) {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['id' => 'x']], 201),
        jsonResponse(['success' => true, 'data' => ['id' => 'x']], 201),
    ]);
    $beel = testClient($transport);

    $import($beel, null);
    $import($beel, 'import-42');

    expect($transport->requests[0]->getHeaderLine('Idempotency-Key'))->toMatch('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/')
        ->and($transport->requests[1]->getHeaderLine('Idempotency-Key'))->toBe('import-42');
})->with([
    'customers' => [fn (Beel $beel, ?string $key) => ($key === null ? $beel->company('c')->customers : $beel->company('c')->customers->withOptions(new RequestOptions(idempotencyKey: $key)))
        ->import(['file' => fopen('php://memory', 'rb'), 'source' => 'BEEL']), ],
    'accounts' => [fn (Beel $beel, ?string $key) => ($key === null ? $beel->accounts : $beel->accounts->withOptions(new RequestOptions(idempotencyKey: $key)))
        ->import(['accounts_file' => fopen('php://memory', 'rb')]), ],
]);

it('waits and retries with the same key while BeeL is still processing it', function () {
    $sleeps = [];
    $transport = new RecordingPsrClient([
        new Response(409, ['Content-Type' => 'application/json', 'Retry-After' => '2'], '{"success":false,"error":{"code":"IDEMPOTENCY_KEY_PROCESSING","message":"In flight"}}'),
        new Response(201, ['Content-Type' => 'application/json'], '{"success":true,"data":{"id":"inv-1"}}'),
    ]);

    $response = retryingClient($transport, $sleeps)->sendRequest(new Request('POST', 'https://app.beel.es/api/v1/x', [], '{"a":1}'));

    expect($response->getStatusCode())->toBe(201)
        ->and($sleeps)->toBe([2_000])
        ->and($transport->requests[1]->getHeaderLine('Idempotency-Key'))->toBe($transport->requests[0]->getHeaderLine('Idempotency-Key'));
});

it('does not retry a conflict other than a key still being processed', function () {
    $sleeps = [];
    $transport = new RecordingPsrClient([
        new Response(409, ['Content-Type' => 'application/json'], '{"success":false,"error":{"code":"IDEMPOTENCY_KEY_MISMATCH","message":"Other body"}}'),
    ]);

    expect(retryingClient($transport, $sleeps)->sendRequest(new Request('POST', 'https://app.beel.es/api/v1/x', [], '{"a":1}'))->getStatusCode())->toBe(409)
        ->and($transport->requests)->toHaveCount(1);
});

it('does not retry a server error BeeL replays for the same key', function () {
    $sleeps = [];
    $transport = new RecordingPsrClient([
        new Response(500, ['Content-Type' => 'application/json', 'Idempotency-Replay' => 'true'], '{"success":false}'),
    ]);

    expect(retryingClient($transport, $sleeps)->sendRequest(new Request('POST', 'https://app.beel.es/api/v1/x', [], '{"a":1}'))->getStatusCode())->toBe(500)
        ->and($transport->requests)->toHaveCount(1);
});

it('reads only a valid Retry-After and otherwise backs off', function (string $header, ?int $seconds) {
    expect(RetryAfter::seconds(new Response(429, ['Retry-After' => $header]), '', 1_000_000_000))->toBe($seconds);
})->with([
    'seconds' => ['7', 7],
    'decimal seconds round up' => ['1.5', 2],
    'HTTP date' => ['Sun, 09 Sep 2001 01:46:50 GMT', 10],
    'negative' => ['-1', null],
    'words' => ['now', null],
    'a clock time' => ['2.0', 2],
    'garbage' => ['soon please', null],
]);

it('ignores a retry_after in the body that is not a finite, non-negative number', function (string $value) {
    expect(RetryAfter::seconds(new Response(429), '{"error":{"retry_after":'.$value.'}}'))->toBeNull();
})->with(['overflowing' => ['1e400'], 'negative' => ['-5'], 'text' => ['"soon"']]);

it('ignores an invalid retry_after in the error details, as the transport does', function (string $value) {
    $transport = new RecordingPsrClient([new Response(429, ['Content-Type' => 'application/json'], '{"success":false,"error":{"code":"RATE_LIMIT_EXCEEDED","details":{"retry_after":'.$value.'}}}')]);

    try {
        testClient($transport)->company('c')->invoices->get('inv-1');
        test()->fail('Expected BeelRateLimitError.');
    } catch (BeelRateLimitError $exception) {
        expect($exception->retryAfter)->toBeNull()
            ->and($exception->retryAfterSeconds)->toBe(60);
    }
})->with(['negative' => ['-5'], 'overflowing' => ['1e400']]);
