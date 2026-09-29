<?php

declare(strict_types=1);

use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Exception\BeelAuthError;
use Lenorix\BeelSdk\Generated\Model\Invoice;
use Lenorix\BeelSdk\Http\RequestOptions;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;

it('sends per-call headers on operations whose generated endpoint declares none', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']])]);
    $invoices = testClient($transport)->company('company-1')->invoices;

    $invoice = $invoices->withOptions(new RequestOptions(headers: ['X-Trace-Id' => 'trace-1', 'X-Multi' => ['a', 'b']]))->get('inv-1');

    expect($invoice)->toBeInstanceOf(Invoice::class)
        ->and($transport->requests[0]->getHeaderLine('X-Trace-Id'))->toBe('trace-1')
        ->and($transport->requests[0]->getHeader('X-Multi'))->toBe(['a', 'b'])
        ->and($transport->requests[0]->getHeaderLine('Authorization'))->toBe('Bearer beel_sk_test_key');
});

it('keeps options on the copy only and clears them after a failed call', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => false, 'error' => ['code' => 'UNAUTHORIZED', 'message' => 'Nope']], 401),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
    ]);
    $invoices = testClient($transport)->company('company-1')->invoices;
    $withOptions = $invoices->withOptions(new RequestOptions(headers: ['X-Trace-Id' => 'trace-1']));

    expect(fn () => $withOptions->get('inv-1'))->toThrow(BeelAuthError::class);
    $invoices->get('inv-1');
    $withOptions->withOptions(new RequestOptions(headers: ['X-Other' => 'yes']))->get('inv-1');

    expect($transport->requests[0]->getHeaderLine('X-Trace-Id'))->toBe('trace-1')
        ->and($transport->requests[1]->hasHeader('X-Trace-Id'))->toBeFalse()
        ->and($transport->requests[2]->hasHeader('X-Trace-Id'))->toBeFalse()
        ->and($transport->requests[2]->getHeaderLine('X-Other'))->toBe('yes');
});

it('passes scope options down to child resources and resources created on demand', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
        jsonResponse(['success' => true, 'data' => ['events' => [], 'pagination' => ['current_page' => 1, 'total_pages' => 1, 'total_items' => 0, 'items_per_page' => 20]]]),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
    ]);
    $company = testClient($transport)->company('company-1');
    $scoped = $company->withOptions(new RequestOptions(headers: ['X-Tenant' => 'tenant-1']));

    $scoped->invoices->get('inv-1');
    $scoped->paymentConnections->events('connection-1')->list();
    $company->invoices->get('inv-1');

    expect($transport->requests[0]->getHeaderLine('X-Tenant'))->toBe('tenant-1')
        ->and($transport->requests[1]->getHeaderLine('X-Tenant'))->toBe('tenant-1')
        ->and($transport->requests[2]->hasHeader('X-Tenant'))->toBeFalse();
});

it('keeps per-call options when an alias delegates to another resource', function (Closure $call, array $response) {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => $response])]);

    $call(testClient($transport), new RequestOptions(headers: ['X-Trace-Id' => 'trace-9']));

    expect($transport->requests[0]->getHeaderLine('X-Trace-Id'))->toBe('trace-9');
})->with([
    'invoice schedule' => [fn (Beel $beel, RequestOptions $options) => $beel->company('c')->invoices->withOptions($options)->getSchedule('inv-1'), ['invoice_id' => 'inv-1']],
    'catalog preferences' => [fn (Beel $beel, RequestOptions $options) => $beel->catalogs->withOptions($options)->updateMe(['language' => 'es']), ['language' => 'es']],
    'account' => [fn (Beel $beel, RequestOptions $options) => $beel->accounts->withOptions($options)->get('acc-1'), ['account_id' => 'acc-1']],
]);
