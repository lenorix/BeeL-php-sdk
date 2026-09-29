<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Lenorix\BeelSdk\Enum\Environment;
use Lenorix\BeelSdk\Exception\BeelConflictError;
use Lenorix\BeelSdk\Exception\BeelNotFoundError;
use Lenorix\BeelSdk\Exception\BeelPaymentRequiredError;
use Lenorix\BeelSdk\Generated\Model\Invoice;
use Lenorix\BeelSdk\Generated\Model\MyIdentity;
use Lenorix\BeelSdk\Generated\Model\RepresentationStatusResponseData;
use Lenorix\BeelSdk\Generated\Model\TaxTypesCatalog;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse202Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRepresentationSubmitPostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkSentPostBody;
use Lenorix\BeelSdk\Generated\Model\VeriFactuRecord;
use Lenorix\BeelSdk\Http\RequestOptions;
use Lenorix\BeelSdk\Resource\Company\CompanyRepresentationResource;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;

it('reads tax types from the canonical route', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => []])]);

    expect(testClient($transport)->catalogs->taxTypes())->toBeInstanceOf(TaxTypesCatalog::class)
        ->and($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/tax-types');
});

it('accepts the empty 204 of operations that return nothing', function () {
    $transport = new RecordingPsrClient([new Response(204), new Response(204)]);
    $company = testClient($transport)->company('c');

    $company->customers->delete('cus-1');
    $company->invoices->delete('inv-1');

    expect($transport->requests)->toHaveCount(2);
});

it('sends an empty JSON object when a write has no body', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
    ]);
    $beel = testClient($transport);

    $beel->company('c')->invoices->issue('inv-1');
    $beel->company('c')->representation->submit((new V1CompaniesCompanyIdRepresentationSubmitPostBody)->setFile('%PDF'));

    expect((string) $transport->requests[0]->getBody())->toBe('{}')
        ->and($transport->requests[0]->getHeaderLine('Content-Type'))->toBe('application/json')
        ->and($transport->requests[0]->getHeaderLine('Content-Length'))->toBeIn(['', '2'])
        ->and($transport->requests[1]->getHeaderLine('Content-Type'))->toStartWith('multipart/form-data');
});

it('marks a legacy invoice as sent with an optional sent_at', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']])]);

    testClient($transport)->invoices->markSent('inv-1', (new V1InvoicesInvoiceIdMarkSentPostBody)->setSentAt(new DateTime('2026-09-25T12:00:00+00:00')));

    expect(json_decode((string) $transport->requests[0]->getBody(), true))->toBe(['sent_at' => '2026-09-25T12:00:00.000000+00:00']);
});

it('switches a company on and off, exposing the Live checkout URL', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['environment' => 'TEST']], 201),
        jsonResponse(['success' => false, 'error' => ['code' => 'CHECKOUT_REQUIRED', 'message' => 'Add a card', 'details' => ['checkout_url' => 'https://checkout.example.test/s/1']]], 402),
        jsonResponse(['success' => true, 'data' => ['environment' => 'PROD', 'effective_at' => '2026-10-31T00:00:00Z']]),
    ]);
    $activations = testClient($transport)->company('c')->activations;

    $activations->activate(Environment::TEST);
    $exception = thrown(fn () => $activations->activate('PROD', 'https://app.example.test/ok?s={CHECKOUT_SESSION_ID}', 'https://app.example.test/cancel'), BeelPaymentRequiredError::class);
    expect($exception->apiCode)->toBe('CHECKOUT_REQUIRED')
        ->and($exception->checkoutUrl)->toBe('https://checkout.example.test/s/1');
    $activations->deactivate(Environment::PROD);

    expect($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/companies/c/activations')
        ->and(json_decode((string) $transport->requests[0]->getBody(), true))->toBe(['environment' => 'TEST'])
        ->and(json_decode((string) $transport->requests[1]->getBody(), true))->toBe(['environment' => 'PROD', 'success_url' => 'https://app.example.test/ok?s={CHECKOUT_SESSION_ID}', 'cancel_url' => 'https://app.example.test/cancel'])
        ->and($transport->requests[2]->getMethod())->toBe('DELETE')
        ->and($transport->requests[2]->getUri()->getQuery())->toBe('environment=PROD');
});

it('reads and updates the invoice customization and manages the logo', function () {
    $logo = fopen('php://memory', 'r+');
    fwrite($logo, 'PNG-bytes');
    rewind($logo);
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['invoice_template_type' => 'MODERN_TABLE']]),
        jsonResponse(['success' => true, 'data' => ['invoice_template_type' => 'PROFESSIONAL_SERVICE']]),
        jsonResponse(['success' => true, 'data' => ['url' => 'https://cdn.example.test/logo.png']]),
        jsonResponse(['success' => true, 'data' => ['url' => 'https://cdn.example.test/logo.png']]),
        jsonResponse(['success' => true, 'data' => ['url' => 'https://cdn.example.test/logo.png']]),
        new Response(204),
    ]);
    $company = testClient($transport)->company('c');

    $company->invoiceCustomization->get();
    $company->invoiceCustomization->update(['invoice_template_type' => 'PROFESSIONAL_SERVICE', 'invoice_accent_color' => '#fc481d']);
    $company->logo->upload($logo);
    $company->logo->upload('PNG-string');
    $company->logo->upload(Utils::streamFor('PNG-stream'));
    $company->logo->delete();

    expect($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/companies/c/invoice-customization')
        ->and($transport->requests[1]->getMethod())->toBe('PUT')
        ->and(json_decode((string) $transport->requests[1]->getBody(), true))->toBe(['invoice_template_type' => 'PROFESSIONAL_SERVICE', 'invoice_accent_color' => '#fc481d'])
        ->and($transport->requests[2]->getHeaderLine('Content-Type'))->toStartWith('multipart/form-data')
        ->and((string) $transport->requests[2]->getBody())->toContain('PNG-bytes')
        ->and((string) $transport->requests[3]->getBody())->toContain('PNG-string')
        ->and((string) $transport->requests[4]->getBody())->toContain('PNG-stream')
        ->and($transport->requests[5]->getMethod())->toBe('DELETE')
        ->and($transport->requests[5]->getUri()->getPath())->toBe('/api/v1/companies/c/logo')
        ->and(fn () => $company->logo->upload(42))->toThrow(InvalidArgumentException::class);
});

it('returns the queued email when BeeL accepts a send that waits for the PDF', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['email_id' => 'e-1', 'sent_to' => ['a@example.test'], 'sent_at' => '2026-09-28T10:00:00Z']]),
        jsonResponse(['success' => true, 'data' => ['email_id' => 'e-2', 'sent_to' => ['a@example.test'], 'sent_at' => '2026-09-28T10:00:00Z']], 202),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    $sent = $invoices->send('inv-1');
    $queued = $invoices->send('inv-1');

    expect($sent)->toBeInstanceOf(V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Data::class)
        ->and($queued)->toBeInstanceOf(V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse202Data::class)
        ->and($queued->getEmailId())->toBe('e-2');
});

it('lists the VeriFactu records of an invoice', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['records' => [
        ['id' => 'r-1', 'operation' => 'REGISTRATION', 'submission_status' => 'ACCEPTED', 'registered_at' => '2026-09-28T10:00:00.123456789Z'],
    ]]])]);

    $records = testClient($transport)->company('c')->invoices->listVerifactuRecords('inv-1')->getRecords();

    expect($records)->toHaveCount(1)
        ->and($records[0])->toBeInstanceOf(VeriFactuRecord::class)
        ->and($records[0]->getSubmissionStatus())->toBe('ACCEPTED')
        ->and($records[0]->getRegisteredAt()->format('u'))->toBe('123456')
        ->and($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/companies/c/invoices/inv-1/verifactu-records');
});

it('exchanges simplified invoices for a full invoice', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['id' => 'inv-full']], 201)]);

    $invoice = testClient($transport)->company('c')->invoices->createSimplifiedExchange(
        ['simplified_invoice_ids' => ['s-1', 's-2'], 'recipient' => ['customer_id' => 'cust-1']],
        ['Idempotency-Key' => 'exchange-1'],
    );

    expect($invoice)->toBeInstanceOf(Invoice::class)
        ->and($invoice->getId())->toBe('inv-full')
        ->and($transport->requests[0]->getMethod())->toBe('POST')
        ->and($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/companies/c/invoices/simplified-exchanges')
        ->and($transport->requests[0]->getHeaderLine('Idempotency-Key'))->toBe('exchange-1')
        ->and(json_decode((string) $transport->requests[0]->getBody(), true))->toBe(['simplified_invoice_ids' => ['s-1', 's-2'], 'recipient' => ['customer_id' => 'cust-1']]);
});

it('exposes the company representation flow with real HTTP statuses', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['status' => 'PENDING_SIGNATURE', 'message' => 'Sign it']]),
        jsonResponse(['success' => true, 'data' => ['download_url' => 'https://signed.example.test/r.pdf', 'expires_in_seconds' => 300]]),
        jsonResponse(['success' => false, 'error' => ['code' => 'REPRESENTATION_NOT_FOUND', 'message' => 'None']], 404),
        jsonResponse(['success' => false, 'error' => ['code' => 'REPRESENTATION_IN_PROGRESS', 'message' => 'Busy']], 409),
        new Response(204),
    ]);
    $representation = testClient($transport)->company('c')->withOptions(new RequestOptions(headers: ['X-Tenant' => 't-1']))->representation;

    expect($representation)->toBeInstanceOf(CompanyRepresentationResource::class)
        ->and($representation->get())->toBeInstanceOf(RepresentationStatusResponseData::class)
        ->and($representation->documentLink()->getDownloadUrl())->toBe('https://signed.example.test/r.pdf');

    $exception = thrown(fn () => $representation->documentLink(), BeelNotFoundError::class);
    expect($exception->statusCode)->toBe(404)->and($exception->apiCode)->toBe('REPRESENTATION_NOT_FOUND');
    $exception = thrown(fn () => $representation->generate(), BeelConflictError::class);
    expect($exception->statusCode)->toBe(409)->and($exception->apiCode)->toBe('REPRESENTATION_IN_PROGRESS');
    $representation->cancel();

    expect($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/companies/c/representation')
        ->and($transport->requests[1]->getUri()->getPath())->toBe('/api/v1/companies/c/representation/document')
        ->and($transport->requests[4]->getMethod())->toBe('DELETE')
        ->and(array_map(static fn ($request): string => $request->getHeaderLine('X-Tenant'), $transport->requests))->toBe(array_fill(0, 5, 't-1'));
});

it('returns the identity of the API key', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => [
        'account_id' => 'acc-1',
        'email' => 'owner@example.test',
        'language' => 'es',
        'credential' => ['type' => 'API_KEY', 'environment' => 'sandbox', 'scopes' => ['invoices:read']],
    ]])]);

    $identity = testClient($transport)->me->identity();

    expect($identity)->toBeInstanceOf(MyIdentity::class)
        ->and($identity->getAccountId())->toBe('acc-1')
        ->and($identity->getCredential()->getScopes())->toBe(['invoices:read'])
        ->and($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/me/identity');
});
