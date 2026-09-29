<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\NoSeekStream;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Enum\Environment;
use Lenorix\BeelSdk\Exception\BeelNotFoundError;
use Lenorix\BeelSdk\Http\RequestOptions;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;
use Lenorix\BeelSdk\Tests\Support\TripwireStream;

it('exposes the last response so exact values can be read without repeating the call', function (bool $seekable) {
    $json = '{"success":true,"data":{"id":"inv-1","created_at":"2026-09-25T01:29:40.548233096Z"}}';
    $body = $seekable ? Utils::streamFor($json) : new NoSeekStream(Utils::streamFor($json));
    $transport = new RecordingPsrClient([new Response(200, ['Content-Type' => 'application/json', 'X-Request-Id' => 'req-7'], $body)]);
    $beel = testClient($transport);

    expect($beel->getLastResponse())->toBeNull();

    $invoice = $beel->company('c')->invoices->get('inv-1');
    $last = $beel->getLastResponse();
    $raw = json_decode((string) $last?->getBody(), true);

    expect($invoice->getCreatedAt()->format('u'))->toBe('548233')
        ->and($raw['data']['created_at'])->toBe('2026-09-25T01:29:40.548233096Z')
        ->and($last?->getHeaderLine('X-Request-Id'))->toBe('req-7')
        ->and((string) $beel->getLastResponse()?->getBody())->toBe($json);
})->with(['seekable' => [true], 'streamed' => [false]]);

it('keeps the error response as the last response after a failed call', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => false, 'error' => ['code' => 'NOT_FOUND', 'message' => 'Missing']], 404)]);
    $beel = testClient($transport);

    expect(fn () => $beel->company('c')->invoices->get('inv-1'))->toThrow(BeelNotFoundError::class)
        ->and($beel->getLastResponse()?->getStatusCode())->toBe(404)
        ->and(json_decode((string) $beel->getLastResponse()?->getBody(), true)['error']['code'])->toBe('NOT_FOUND');
});

it('never sends the API key to a host other than BeeL', function (Closure $call) {
    $transport = new RecordingPsrClient([]);

    expect(fn () => $call(testClient($transport)))->toThrow(InvalidArgumentException::class)
        ->and($transport->requests)->toBe([]);
})->with([
    'absolute URL' => [fn (Beel $beel) => $beel->request('GET', 'https://attacker.example/steal')],
    'scheme-relative URL' => [fn (Beel $beel) => $beel->request('GET', '//attacker.example/steal')],
    'path without a leading slash' => [fn (Beel $beel) => $beel->request('GET', 'v1/me')],
    'query in the path' => [fn (Beel $beel) => $beel->request('GET', '/v1/invoices?status=DRAFT')],
]);

it('rejects a path parameter that would change the resource a request reaches', function (Closure $call) {
    $transport = new RecordingPsrClient([]);

    expect(fn () => $call(testClient($transport)))->toThrow(InvalidArgumentException::class)
        ->and($transport->requests)->toBe([]);
})->with([
    'parent segment' => [fn (Beel $beel) => $beel->company('company-1')->invoices->delete('..')],
    'current segment' => [fn (Beel $beel) => $beel->company('company-1')->invoices->get('.')],
    'empty ID' => [fn (Beel $beel) => $beel->company('company-1')->invoices->get('')],
    'empty company' => [fn (Beel $beel) => $beel->company('')->invoices->list()],
    'request() parameter' => [fn (Beel $beel) => $beel->request('DELETE', '/v1/companies/{company_id}/logo', ['company_id' => '..'])],
    'empty request() parameter' => [fn (Beel $beel) => $beel->request('DELETE', '/v1/companies/{company_id}/logo', ['company_id' => ''])],
]);

it('encodes enums, lists and numbers in request() queries, and rejects what has no query form', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => []])]);

    testClient($transport)->request('GET', '/v1/x', query: [
        'environment' => Environment::TEST,
        'status' => ['DRAFT', null, 'ISSUED'],
        'empty' => [],
        'total_min' => 1e20,
        'rate' => 0.1,
    ]);

    expect(rawurldecode($transport->requests[0]->getUri()->getQuery()))
        ->toBe('environment=TEST&status=DRAFT,ISSUED&total_min=100000000000000000000&rate=0.1');
});

it('rejects request() query values that have no query form', function (mixed $value) {
    $transport = new RecordingPsrClient([]);

    expect(fn () => testClient($transport)->request('GET', '/v1/x', query: ['value' => $value]))->toThrow(InvalidArgumentException::class)
        ->and($transport->requests)->toBe([]);
})->with([
    'a date object' => [new DateTimeImmutable('2026-01-01')],
    'a list of maps' => [[['a' => 1]]],
    'an infinite number' => [INF],
]);

it('sends an empty request() body as a JSON object', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => []])]);

    testClient($transport)->request('POST', '/v1/x', body: []);

    expect((string) $transport->requests[0]->getBody())->toBe('{}');
});

it('has no last response after a call rejected before anything is sent', function (Closure $rejected) {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']])]);
    $beel = testClient($transport);
    $beel->company('c')->invoices->get('inv-1');

    expect(fn () => $rejected($beel))->toThrow(InvalidArgumentException::class)
        ->and($beel->getLastResponse())->toBeNull()
        ->and($transport->requests)->toHaveCount(1);
})->with([
    'invalid request array' => [fn (Beel $beel) => $beel->company('c')->invoices->create(['unknown_field' => 1])],
    'missing request() path parameter' => [fn (Beel $beel) => $beel->request('GET', '/v1/companies/{company_id}')],
    'unsafe path' => [fn (Beel $beel) => $beel->company('c')->invoices->get('..')],
]);

it('calls any API path with the client authentication and error mapping', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['url' => 'https://cdn.example.test/logo.png']]),
        jsonResponse(['success' => true, 'data' => ['ok' => true]], 201),
        jsonResponse(['success' => false, 'error' => ['code' => 'LOGO_NOT_FOUND', 'message' => 'No logo']], 404),
    ]);
    $beel = testClient($transport);

    $logo = $beel->request('GET', '/v1/companies/{company_id}/logo', ['company_id' => 'c 1'], ['fiscal_only' => true, 'status' => ['DRAFT', 'ISSUED'], 'metadata' => ['tenant' => 'acme'], 'skip' => null]);
    $created = $beel->request('POST', '/v1/things', body: ['name' => 'x', 'amount' => 1.0], options: new RequestOptions(idempotencyKey: 'thing-1'));

    expect($logo['data']['url'])->toBe('https://cdn.example.test/logo.png')
        ->and($created['data']['ok'])->toBeTrue()
        ->and($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/companies/c%201/logo')
        ->and(urldecode($transport->requests[0]->getUri()->getQuery()))->toBe('fiscal_only=true&status=DRAFT,ISSUED&metadata[tenant]=acme')
        ->and($transport->requests[0]->getHeaderLine('Authorization'))->toBe('Bearer beel_sk_test_key')
        ->and((string) $transport->requests[1]->getBody())->toBe('{"name":"x","amount":1.0}')
        ->and($transport->requests[1]->getHeaderLine('Idempotency-Key'))->toBe('thing-1');

    try {
        $beel->request('GET', '/v1/companies/{company_id}/logo', ['company_id' => 'c']);
        test()->fail('Expected a not found error.');
    } catch (BeelNotFoundError $exception) {
        expect($exception->apiCode)->toBe('LOGO_NOT_FOUND');
    }
    expect(fn () => $beel->request('GET', '/v1/companies/{company_id}'))->toThrow(InvalidArgumentException::class, 'company_id');

    $files = new RecordingPsrClient([new Response(200, ['Content-Type' => 'application/zip'], new TripwireStream('PK'))]);
    expect(fn () => testClient($files)->request('POST', '/v1/companies/{company_id}/invoices/pdf-archive', ['company_id' => 42]))
        ->toThrow(UnexpectedValueException::class, 'createPdfArchive()')
        ->and($files->requests[0]->getUri()->getPath())->toBe('/api/v1/companies/42/invoices/pdf-archive');
});
