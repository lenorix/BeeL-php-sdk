<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Builder\InvoiceBuilder;
use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Exception\BeelAuthError;
use Lenorix\BeelSdk\Exception\BeelNotReadyError;
use Lenorix\BeelSdk\Exception\BeelValidationError;
use Lenorix\BeelSdk\Exception\WebhookHeaderError;
use Lenorix\BeelSdk\Exception\WebhookPayloadError;
use Lenorix\BeelSdk\Exception\WebhookSignatureError;
use Lenorix\BeelSdk\Exception\WebhookTimestampError;
use Lenorix\BeelSdk\Exception\WebhookVerificationError;
use Lenorix\BeelSdk\Generated\Model\AccountMember;
use Lenorix\BeelSdk\Generated\Model\CompanyData;
use Lenorix\BeelSdk\Generated\Model\Customer;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryResponse;
use Lenorix\BeelSdk\Generated\Model\GenerationHistoryResponse;
use Lenorix\BeelSdk\Generated\Model\GrantAssignment;
use Lenorix\BeelSdk\Generated\Model\InvitationSummary;
use Lenorix\BeelSdk\Generated\Model\Invoice;
use Lenorix\BeelSdk\Generated\Model\InvoicePdfResponseData;
use Lenorix\BeelSdk\Generated\Model\InvoiceSeries;
use Lenorix\BeelSdk\Generated\Model\ManagedAccountSummary;
use Lenorix\BeelSdk\Generated\Model\ManagedPaymentEvent;
use Lenorix\BeelSdk\Generated\Model\MyIdentity;
use Lenorix\BeelSdk\Generated\Model\Product;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponse;
use Lenorix\BeelSdk\Generated\Model\WebhookDeliveryLog;
use Lenorix\BeelSdk\Generated\Model\WebhookEvent;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued;
use Lenorix\BeelSdk\Generated\Model\WebhookSubscription;
use Lenorix\BeelSdk\Http\RequestOptions;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;
use Lenorix\BeelSdk\Webhook\WebhookEventType;
use Lenorix\BeelSdk\Webhook\WebhookSignatureHeader;
use Lenorix\BeelSdk\Webhook\WebhookSigner;
use Lenorix\BeelSdk\Webhook\WebhookVerifier;

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

// Per-call request options

it('sends per-call headers on operations whose generated endpoint declares none', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']])]);
    $invoices = testClient($transport)->company('company-1')->invoices;

    $invoice = $invoices->withOptions(new RequestOptions(headers: ['X-Trace-Id' => 'trace-1', 'X-Multi' => ['a', 'b']]))->get('inv-1');

    expect($invoice)->toBeInstanceOf(Invoice::class)
        ->and($transport->requests[0]->getHeaderLine('X-Trace-Id'))->toBe('trace-1')
        ->and($transport->requests[0]->getHeader('X-Multi'))->toBe(['a', 'b'])
        ->and($transport->requests[0]->getHeaderLine('Authorization'))->toBe('Bearer beel_sk_test_key');
});

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

// Webhooks

it('reports each webhook verification failure with its own exception type', function () {
    $secret = 'whsec_test';
    $now = 1_800_000_000;
    $body = '{"type":"invoice.issued","data":{}}';
    $header = (new WebhookSigner($secret))->sign($body, $now);
    $verifier = new WebhookVerifier($secret);

    $cases = [
        [fn () => $verifier->verify($body, null, $now), WebhookHeaderError::class],
        [fn () => $verifier->verify($body, 'v1=abc', $now), WebhookHeaderError::class],
        [fn () => $verifier->verify($body, $header, $now + 301), WebhookTimestampError::class],
        [fn () => (new WebhookVerifier('whsec_rotated'))->verify($body, $header, $now), WebhookSignatureError::class],
        [fn () => $verifier->verify($body.' ', $header, $now), WebhookSignatureError::class],
        [fn () => $verifier->verify('not json', (new WebhookSigner($secret))->sign('not json', $now), $now), WebhookPayloadError::class],
        [fn () => $verifier->verifyEvent('{"type":"invoice.issued","data":{"invoice_id":[]}}', (new WebhookSigner($secret))->sign('{"type":"invoice.issued","data":{"invoice_id":[]}}', $now), $now), WebhookPayloadError::class],
    ];

    foreach ($cases as [$verify, $expected]) {
        try {
            $verify();
            test()->fail("Expected {$expected}.");
        } catch (WebhookVerificationError $exception) {
            expect($exception)->toBeInstanceOf($expected);
        }
    }
});

it('exposes the checked and signed timestamps on a replay window failure', function () {
    $header = WebhookSignatureHeader::parse((new WebhookSigner('whsec_test'))->sign('{}', 1_000));

    try {
        (new WebhookVerifier('whsec_test', toleranceSeconds: 60))->checkTimestamp($header, 2_000);
        test()->fail('Expected a timestamp error.');
    } catch (WebhookTimestampError $exception) {
        expect($exception->timestamp)->toBe(1_000)
            ->and($exception->now)->toBe(2_000)
            ->and($exception->toleranceSeconds)->toBe(60);
    }
});

it('parses and checks the header freshness without the body or HMAC', function () {
    $header = WebhookSignatureHeader::parse('t=1800000000,v1=aa,v1=bb');
    (new WebhookVerifier('whsec_test'))->checkTimestamp($header, 1_800_000_100);

    expect($header->timestamp)->toBe(1_800_000_000)
        ->and($header->signatures)->toBe(['aa', 'bb'])
        ->and((string) $header)->toBe('t=1800000000,v1=aa,v1=bb')
        ->and(WebhookSignatureHeader::NAME)->toBe('BeeL-Signature');
});

it('signs webhook bodies that the verifier accepts', function () {
    $body = json_encode(['id' => 'evt-1', 'type' => WebhookEventType::INVOICE_ISSUED->value, 'data' => []], JSON_THROW_ON_ERROR);
    $header = (new WebhookSigner('whsec_test'))->sign($body, 1_800_000_000);

    expect($header)->toBe('t=1800000000,v1='.hash_hmac('sha256', '1800000000.'.$body, 'whsec_test'))
        ->and((new WebhookVerifier('whsec_test'))->verify($body, $header, 1_800_000_000)['id'])->toBe('evt-1')
        ->and((new WebhookVerifier('whsec_test'))->verify($body, (new WebhookSigner('whsec_test'))->sign($body))['id'])->toBe('evt-1');
});

// Pagination

it('iterates every page lazily, keeping filters and limit', function () {
    $transport = new RecordingPsrClient([
        invoicePage(['a', 'b'], 1, 2, hasNext: true),
        invoicePage(['c'], 2, 2, hasNext: false),
    ]);
    $invoices = testClient($transport)->company('company-1')->invoices->all(['status' => ['ISSUED'], 'limit' => 2]);

    expect($transport->requests)->toHaveCount(0);
    expect($invoices->current()->getId())->toBe('a')
        ->and($transport->requests)->toHaveCount(1);

    $ids = [];
    foreach ($invoices as $invoice) {
        $ids[] = $invoice->getId();
    }

    parse_str($transport->requests[1]->getUri()->getQuery(), $secondQuery);
    expect($ids)->toBe(['a', 'b', 'c'])
        ->and($transport->requests)->toHaveCount(2)
        ->and($secondQuery)->toMatchArray(['status' => 'ISSUED', 'limit' => '2', 'page' => '2']);
});

it('iterates every paginated list into its generated item model', function (Closure $iterate, string $itemsKey, string $itemClass, string $path) {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => [
        $itemsKey => [['id' => 'item-1']],
        'pagination' => ['current_page' => 1, 'total_pages' => 1, 'total_items' => 1, 'items_per_page' => 20, 'has_next' => false],
    ]])]);

    $items = iterator_to_array($iterate(testClient($transport)));

    expect($items)->toHaveCount(1)
        ->and($items[0])->toBeInstanceOf($itemClass)
        ->and($transport->requests[0]->getUri()->getPath())->toBe('/api'.$path);
})->with([
    'company customers' => [fn (Beel $beel) => $beel->company('c')->customers->all(), 'customers', Customer::class, '/v1/companies/c/customers'],
    'company products' => [fn (Beel $beel) => $beel->company('c')->products->all(), 'products', Product::class, '/v1/companies/c/products'],
    'company series' => [fn (Beel $beel) => $beel->company('c')->series->all(), 'series', InvoiceSeries::class, '/v1/companies/c/series'],
    'recurring invoices' => [fn (Beel $beel) => $beel->company('c')->recurringInvoices->all(), 'recurring_invoices', RecurringInvoiceResponse::class, '/v1/companies/c/recurring-invoices'],
    'recurring invoice history' => [fn (Beel $beel) => $beel->company('c')->recurringInvoices->allHistory('r'), 'history', GenerationHistoryResponse::class, '/v1/companies/c/recurring-invoices/r/history'],
    'payment events' => [fn (Beel $beel) => $beel->company('c')->paymentConnections->events('p')->all(), 'events', ManagedPaymentEvent::class, '/v1/companies/c/payment-connections/p/events'],
    'account companies' => [fn (Beel $beel) => $beel->account('a')->companies->all(), 'companies', CompanyData::class, '/v1/accounts/a/companies'],
    'account members' => [fn (Beel $beel) => $beel->account('a')->members->all(), 'members', AccountMember::class, '/v1/accounts/a/members'],
    'member grants' => [fn (Beel $beel) => $beel->account('a')->members->allGrants('m'), 'grants', GrantAssignment::class, '/v1/accounts/a/members/m/grants'],
    'account invitations' => [fn (Beel $beel) => $beel->account('a')->invitations->all(), 'invitations', InvitationSummary::class, '/v1/accounts/a/invitations'],
    'account webhooks' => [fn (Beel $beel) => $beel->account('a')->webhooks->all(), 'webhooks', WebhookSubscription::class, '/v1/accounts/a/webhooks'],
    'webhook deliveries' => [fn (Beel $beel) => $beel->account('a')->webhooks->allDeliveries('w'), 'deliveries', WebhookDeliveryLog::class, '/v1/accounts/a/webhooks/w/deliveries'],
    'account emails' => [fn (Beel $beel) => $beel->account('a')->emails->all(), 'emails', EmailDeliveryResponse::class, '/v1/accounts/a/emails'],
]);

it('falls back to page counts when has_next is absent and stops on an empty page', function () {
    $transport = new RecordingPsrClient([
        invoicePage(['a'], 3, 5),
        invoicePage([], 4, 5),
    ]);

    $ids = array_map(
        static fn (Invoice $invoice): ?string => $invoice->getId(),
        iterator_to_array(testClient($transport)->company('company-1')->invoices->all(['page' => 3])),
    );

    parse_str($transport->requests[0]->getUri()->getQuery(), $firstQuery);
    expect($ids)->toBe(['a'])
        ->and($firstQuery['page'])->toBe('3')
        ->and($transport->requests)->toHaveCount(2);
});

it('follows next_cursor for cursor-paginated lists', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['accounts' => [['id' => 'acc-1']], 'next_cursor' => 'cur-2']]),
        jsonResponse(['success' => true, 'data' => ['accounts' => [['id' => 'acc-2']], 'next_cursor' => null]]),
    ]);

    $accounts = iterator_to_array(testClient($transport)->accounts->all(['limit' => 1]));

    parse_str($transport->requests[1]->getUri()->getQuery(), $secondQuery);
    expect($accounts)->toHaveCount(2)
        ->and($accounts[1])->toBeInstanceOf(ManagedAccountSummary::class)
        ->and($secondQuery)->toMatchArray(['limit' => '1', 'cursor' => 'cur-2']);
});

// Identity

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

// Asynchronous PDFs

function pdfNotReady(Response $response): BeelNotReadyError
{
    try {
        testClient(new RecordingPsrClient([$response]))->company('c')->invoices->getPdf('inv-1');
    } catch (BeelNotReadyError $exception) {
        return $exception;
    }

    throw new LogicException('Expected BeelNotReadyError.');
}

it('reports a 202 PDF as not ready with its Retry-After', function () {
    $exception = pdfNotReady(new Response(202, ['Retry-After' => '3', 'X-Request-Id' => 'req-1']));

    expect($exception->retryAfter)->toBe(3)
        ->and($exception->requestId)->toBe('req-1')
        ->and($exception)->not->toBeInstanceOf(BeelApiError::class)
        ->and($exception->context())->toBe(['status_code' => 202, 'retry_after' => 3, 'request_id' => 'req-1']);
});

it('reports a 202 PDF without Retry-After with a null delay', function () {
    expect(pdfNotReady(new Response(202))->retryAfter)->toBeNull()
        ->and(pdfNotReady(new Response(202, ['Retry-After' => 'soon']))->retryAfter)->toBeNull();
});

it('sends the PDF wait preference and still returns the ready PDF', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['download_url' => 'https://signed.example.test/a.pdf', 'file_name' => 'a.pdf', 'expires_in_seconds' => 300]]),
        jsonResponse(['success' => true, 'data' => ['download_url' => 'https://signed.example.test/a.pdf', 'file_name' => 'a.pdf', 'expires_in_seconds' => 300]]),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    $pdf = $invoices->getPdf('inv-1', waitSeconds: 0);
    $invoices->getPdf('inv-1');

    expect($pdf)->toBeInstanceOf(InvoicePdfResponseData::class)
        ->and($pdf->getFileName())->toBe('a.pdf')
        ->and($transport->requests[0]->getHeaderLine('Prefer'))->toBe('wait=0')
        ->and($transport->requests[1]->hasHeader('Prefer'))->toBeFalse()
        ->and(fn () => $invoices->getPdf('inv-1', waitSeconds: -1))->toThrow(InvalidArgumentException::class);
});

it('keeps mapping PDF API errors to BeelApiError', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => false, 'error' => ['code' => 'INVOICE_NOT_ISSUED_NO_PDF', 'message' => 'Draft']], 400)]);

    try {
        testClient($transport)->company('c')->invoices->getPdf('inv-1');
        test()->fail('Expected an API error.');
    } catch (BeelApiError $exception) {
        expect($exception->apiCode)->toBe('INVOICE_NOT_ISSUED_NO_PDF')
            ->and($exception->statusCode)->toBe(400);
    }
});

it('applies the not-ready behavior to the legacy PDF endpoint', function () {
    $transport = new RecordingPsrClient([new Response(202, ['Retry-After' => '7'])]);

    try {
        testClient($transport)->invoices->getPdf('inv-1', waitSeconds: 2);
        test()->fail('Expected BeelNotReadyError.');
    } catch (BeelNotReadyError $exception) {
        expect($exception->retryAfter)->toBe(7)
            ->and($transport->requests[0]->getHeaderLine('Prefer'))->toBe('wait=2');
    }
});

// Error context and verified webhook models

it('exposes API error data as a logging context without submitted values', function () {
    $transport = new RecordingPsrClient([new Response(422, ['Content-Type' => 'application/json', 'X-Request-Id' => 'req-9'], '{"success":false,"error":{"code":"INVALID","message":"Bad","details":{"field":"x"}}}')]);

    try {
        testClient($transport)->company('c')->invoices->get('inv-1');
        test()->fail('Expected a validation error.');
    } catch (BeelValidationError $exception) {
        expect($exception->context())->toBe(['status_code' => 422, 'api_code' => 'INVALID', 'request_id' => 'req-9', 'retry_after' => null])
            ->and($exception->details['field'])->toBe('x');
    }
});

it('builds the typed event from an already verified payload', function () {
    $verifier = new WebhookVerifier('whsec_test');
    $body = json_encode(['id' => 'evt-1', 'type' => 'invoice.issued', 'created_at' => '2026-09-25T12:00:00.123Z', 'api_version' => '2026-09-01', 'company_id' => 'c', 'data' => ['invoice_id' => 'inv-1', 'invoice_number' => 'A-1']], JSON_THROW_ON_ERROR);
    $payload = $verifier->verify($body, (new WebhookSigner('whsec_test'))->sign($body, 1_800_000_000), 1_800_000_000);

    $event = $verifier->toEvent($payload);

    expect($event)->toBeInstanceOf(WebhookEvent::class)
        ->and($event->getData())->toBeInstanceOf(WebhookEventDataInvoiceIssued::class)
        ->and($event->getData()->getInvoiceId())->toBe('inv-1')
        ->and(fn () => $verifier->toEvent(['type' => 'invoice.issued', 'data' => ['invoice_id' => []]]))->toThrow(WebhookPayloadError::class);
});
