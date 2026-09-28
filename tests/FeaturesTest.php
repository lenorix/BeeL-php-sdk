<?php

declare(strict_types=1);

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\NoSeekStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Builder\CustomerBuilder;
use Lenorix\BeelSdk\Builder\InvoiceBuilder;
use Lenorix\BeelSdk\Enum\Environment;
use Lenorix\BeelSdk\Enum\RecurringInvoicePauseReason;
use Lenorix\BeelSdk\Enum\VeriFactuSubmissionStatus;
use Lenorix\BeelSdk\Enum\WebhookAccountRelationship;
use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Exception\BeelAuthError;
use Lenorix\BeelSdk\Exception\BeelConflictError;
use Lenorix\BeelSdk\Exception\BeelNotFoundError;
use Lenorix\BeelSdk\Exception\BeelNotReadyError;
use Lenorix\BeelSdk\Exception\BeelPaymentRequiredError;
use Lenorix\BeelSdk\Exception\BeelRateLimitError;
use Lenorix\BeelSdk\Exception\BeelUnexpectedResponseError;
use Lenorix\BeelSdk\Exception\BeelValidationError;
use Lenorix\BeelSdk\Exception\WebhookHeaderError;
use Lenorix\BeelSdk\Exception\WebhookPayloadError;
use Lenorix\BeelSdk\Exception\WebhookSignatureError;
use Lenorix\BeelSdk\Exception\WebhookTimestampError;
use Lenorix\BeelSdk\Exception\WebhookVerificationError;
use Lenorix\BeelSdk\Generated\Model\AccountMember;
use Lenorix\BeelSdk\Generated\Model\CompanyData;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoicePdfArchiveRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\Customer;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryResponse;
use Lenorix\BeelSdk\Generated\Model\GenerationHistoryResponse;
use Lenorix\BeelSdk\Generated\Model\InvitationSummary;
use Lenorix\BeelSdk\Generated\Model\Invoice;
use Lenorix\BeelSdk\Generated\Model\InvoicePdfResponseData;
use Lenorix\BeelSdk\Generated\Model\InvoicePreviewResponseData;
use Lenorix\BeelSdk\Generated\Model\InvoiceSeries;
use Lenorix\BeelSdk\Generated\Model\ManagedAccountSummary;
use Lenorix\BeelSdk\Generated\Model\ManagedPaymentEvent;
use Lenorix\BeelSdk\Generated\Model\MemberGrant;
use Lenorix\BeelSdk\Generated\Model\MyIdentity;
use Lenorix\BeelSdk\Generated\Model\Product;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponse;
use Lenorix\BeelSdk\Generated\Model\RepresentationStatusResponseData;
use Lenorix\BeelSdk\Generated\Model\RequestLogDetail;
use Lenorix\BeelSdk\Generated\Model\RequestLogSummary;
use Lenorix\BeelSdk\Generated\Model\TaxTypesCatalog;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse202Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRepresentationSubmitPostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkSentPostBody;
use Lenorix\BeelSdk\Generated\Model\VeriFactuRecord;
use Lenorix\BeelSdk\Generated\Model\WebhookDeliveryLog;
use Lenorix\BeelSdk\Generated\Model\WebhookEvent;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued;
use Lenorix\BeelSdk\Generated\Model\WebhookSubscription;
use Lenorix\BeelSdk\Generated\Runtime\Normalizer\InvalidDateException;
use Lenorix\BeelSdk\Http\BinaryDownload;
use Lenorix\BeelSdk\Http\DateTimeValues;
use Lenorix\BeelSdk\Http\QueryParameters;
use Lenorix\BeelSdk\Http\RequestModels;
use Lenorix\BeelSdk\Http\RequestOptions;
use Lenorix\BeelSdk\Http\RetryingClient;
use Lenorix\BeelSdk\Resource\Company\CompanyRepresentationResource;
use Lenorix\BeelSdk\Tests\Support\RecordingPsrClient;
use Lenorix\BeelSdk\Tests\Support\TripwireStream;
use Lenorix\BeelSdk\Webhook\WebhookEventType;
use Lenorix\BeelSdk\Webhook\WebhookSignatureHeader;
use Lenorix\BeelSdk\Webhook\WebhookSigner;
use Lenorix\BeelSdk\Webhook\WebhookVerifier;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

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
    'member grants' => [fn (Beel $beel) => $beel->account('a')->members->allGrants('m'), 'grants', MemberGrant::class, '/v1/accounts/a/members/m/grants'],
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

it('stops instead of looping when BeeL ignores the requested page', function () {
    $transport = new RecordingPsrClient([
        invoicePage(['a'], 1, 3, hasNext: true),
        invoicePage(['a'], 1, 3, hasNext: true),
    ]);

    $ids = array_map(static fn (Invoice $invoice): string => $invoice->getId(), iterator_to_array(testClient($transport)->company('c')->invoices->all()));

    expect($ids)->toBe(['a', 'a'])
        ->and($transport->requests)->toHaveCount(2);
});

it('keeps paginating when BeeL does not report the current page', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['invoices' => [['id' => 'a']], 'pagination' => ['has_next' => true]]]),
        jsonResponse(['success' => true, 'data' => ['invoices' => [['id' => 'b']], 'pagination' => ['has_next' => false]]]),
    ]);

    $ids = array_map(static fn (Invoice $invoice): string => $invoice->getId(), iterator_to_array(testClient($transport)->company('c')->invoices->all()));

    expect($ids)->toBe(['a', 'b']);
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

// Retries and date-time normalization

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

it('keeps free-text response values that look like dates as BeeL sent them', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => [
        'id' => 'inv-1',
        'notes' => '2026-09-25T12:00:00.123Z',
        'created_at' => '2026-09-25T12:00:00.123Z',
    ]])]);

    $invoice = testClient($transport)->company('c')->invoices->get('inv-1');

    expect($invoice->getNotes())->toBe('2026-09-25T12:00:00.123Z')
        ->and($invoice->getCreatedAt()?->format(DATE_ATOM))->toBe('2026-09-25T12:00:00+00:00');
});

it('never rewrites values inside free-form maps such as metadata', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => [
        'id' => 'inv-1',
        'created_at' => '2026-09-25T12:00:00.123Z',
        'metadata' => ['created_at' => '2026-09-25T12:00:00.123Z', 'nested' => ['paid_at' => '2026-01-01T00:00:00.5Z']],
    ]])]);

    $invoice = testClient($transport)->company('c')->invoices->get('inv-1');

    expect($invoice->getCreatedAt()->format(DATE_ATOM))->toBe('2026-09-25T12:00:00+00:00')
        ->and($invoice->getMetadata()['created_at'])->toBe('2026-09-25T12:00:00.123Z')
        ->and($invoice->getMetadata()['nested'])->toBe(['paid_at' => '2026-01-01T00:00:00.5Z']);
});

// File downloads

function archiveRequest(): CreateInvoicePdfArchiveRequest
{
    return (new CreateInvoicePdfArchiveRequest)->setInvoiceIds(['inv-1', 'inv-2']);
}

it('returns the PDF archive as the untouched response stream', function (bool $seekable) {
    $body = new TripwireStream("PK\x03\x04zip-bytes", $seekable);
    $transport = new RecordingPsrClient([new Response(200, [
        'Content-Type' => 'application/zip',
        'Content-Disposition' => 'attachment; filename="facturas.zip"',
        'X-Bulk-Total' => '2',
        'X-Bulk-Successful' => '1',
        'X-Bulk-Failed' => '1',
    ], $body)]);

    $download = testClient($transport)->company('c')->invoices->createPdfArchive(archiveRequest());

    expect($download)->toBeInstanceOf(BinaryDownload::class)
        ->and($download->body)->toBe($body)
        ->and($body->reads)->toBe(0)
        ->and($download->fileName)->toBe('facturas.zip')
        ->and($download->contentType)->toBe('application/zip')
        ->and($download->contentLength)->toBe(13)
        ->and($download->counts)->toBe(['total' => 2, 'successful' => 1, 'failed' => 1])
        ->and($download->body->read(2))->toBe('PK')
        ->and($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/companies/c/invoices/pdf-archive')
        ->and($transport->requests[0]->getHeaderLine('Accept'))->toContain('application/zip');
})->with(['seekable' => [true], 'non-seekable' => [false]]);

it('returns the export spreadsheet with its file name and invoice count', function () {
    $transport = new RecordingPsrClient([new Response(200, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'Content-Disposition' => "attachment; filename=\"fallback.xlsx\"; filename*=UTF-8''facturas%20a%C3%B1o_2025.xlsx",
        'Content-Length' => '42',
        'X-Total-Invoices' => '17',
    ], new TripwireStream('PK-xlsx'))]);

    $download = testClient($transport)->company('c')->invoices
        ->withOptions(new RequestOptions(headers: ['X-Trace-Id' => 'trace-1']))
        ->export(new CreateInvoiceExportRequest);

    expect($download->fileName)->toBe('facturas año_2025.xlsx')
        ->and($download->contentLength)->toBe(42)
        ->and($download->counts)->toBe(['total' => 17])
        ->and($transport->requests[0]->getHeaderLine('X-Trace-Id'))->toBe('trace-1');
});

it('reduces download file names to a safe base name', function (string $disposition, ?string $expected) {
    $transport = new RecordingPsrClient([new Response(200, ['Content-Type' => 'application/zip', 'Content-Disposition' => $disposition], 'PK')]);

    expect(testClient($transport)->company('c')->invoices->createPdfArchive(archiveRequest())->fileName)->toBe($expected);
})->with([
    'path traversal' => ['attachment; filename="../../etc/passwd"', 'passwd'],
    'encoded traversal' => ["attachment; filename*=UTF-8''..%2F..%2Fsecret.zip", 'secret.zip'],
    'windows path' => ['attachment; filename="C:\\\\temp\\\\a.zip"', 'a.zip'],
    'only dots' => ['attachment; filename=".."', null],
    'token form' => ['attachment; filename=archive.zip', 'archive.zip'],
    'no file name' => ['attachment', null],
]);

it('maps export errors to BeelApiError with their BeeL code', function () {
    $selection = new RecordingPsrClient([jsonResponse(['success' => false, 'error' => ['code' => 'EXPORT_SELECTION_REQUIRED', 'message' => 'Select invoices']], 400)]);
    $limit = new RecordingPsrClient([jsonResponse(['success' => false, 'error' => ['code' => 'EXPORT_LIMIT_EXCEEDED', 'message' => 'Too many']], 422)]);
    $gateway = new RecordingPsrClient([new Response(502, ['Content-Type' => 'text/html'], '<html>Bad gateway</html>')]);

    foreach ([[$selection, BeelApiError::class, 400, 'EXPORT_SELECTION_REQUIRED'], [$limit, BeelValidationError::class, 422, 'EXPORT_LIMIT_EXCEEDED'], [$gateway, BeelApiError::class, 502, 'UNKNOWN']] as [$transport, $class, $status, $code]) {
        try {
            testClient($transport)->company('c')->invoices->export(new CreateInvoiceExportRequest);
            test()->fail('Expected an API error.');
        } catch (BeelApiError $exception) {
            expect($exception)->toBeInstanceOf($class)
                ->and($exception->statusCode)->toBe($status)
                ->and($exception->apiCode)->toBe($code);
        }
    }
});

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

it('maps an empty error response without Content-Type to BeelApiError', function () {
    $deprecations = [];
    $source = str_replace('\\', '/', (string) realpath(__DIR__.'/../src')).'/';
    set_error_handler(static function (int $level, string $message, string $file) use (&$deprecations, $source): bool {
        // Only the SDK's own code counts: with the lowest dependencies, third-party classes emit
        // deprecations when first loaded, which can happen during this test.
        if (str_starts_with(str_replace('\\', '/', $file), $source)) {
            $deprecations[] = $message;
        }

        return true;
    }, E_DEPRECATED | E_USER_DEPRECATED);

    try {
        expect(fn () => testClient(new RecordingPsrClient([new Response(503)]))->company('c')->invoices->get('inv-1'))
            ->toThrow(BeelApiError::class, 'API error 503');
    } finally {
        restore_error_handler();
    }

    expect($deprecations)->toBe([]);
});

it('parses JSON from a transport that streams non-seekable bodies', function () {
    $transport = new RecordingPsrClient([new Response(200, ['Content-Type' => 'application/json'], new NoSeekStream(Utils::streamFor('{"success":true,"data":{"id":"inv-1","created_at":"2026-09-25T12:00:00.123Z"}}')))]);

    $invoice = testClient($transport)->company('c')->invoices->get('inv-1');

    expect($invoice->getId())->toBe('inv-1')
        ->and($invoice->getCreatedAt()->format(DATE_ATOM))->toBe('2026-09-25T12:00:00+00:00');
});

it('keeps a non-seekable JSON body readable when nothing needs normalizing', function () {
    $transport = new RecordingPsrClient([new Response(200, ['Content-Type' => 'application/json'], new NoSeekStream(Utils::streamFor('{"success":true,"data":{"id":"inv-1"}}')))]);

    expect(testClient($transport)->company('c')->invoices->get('inv-1')->getId())->toBe('inv-1');
});

// Representation

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

    try {
        $representation->documentLink();
        test()->fail('Expected a not found error.');
    } catch (BeelNotFoundError $exception) {
        expect($exception->statusCode)->toBe(404)->and($exception->apiCode)->toBe('REPRESENTATION_NOT_FOUND');
    }
    try {
        $representation->generate();
        test()->fail('Expected a conflict error.');
    } catch (BeelConflictError $exception) {
        expect($exception->statusCode)->toBe(409)->and($exception->apiCode)->toBe('REPRESENTATION_IN_PROGRESS');
    }
    $representation->cancel();

    expect($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/companies/c/representation')
        ->and($transport->requests[1]->getUri()->getPath())->toBe('/api/v1/companies/c/representation/document')
        ->and($transport->requests[4]->getMethod())->toBe('DELETE')
        ->and(array_map(static fn ($request): string => $request->getHeaderLine('X-Tenant'), $transport->requests))->toBe(array_fill(0, 5, 't-1'));
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

// Parity with the official Node.js SDK

it('falls back to the Node.js SDK error codes when BeeL sends none', function (int $status, string $class, string $code) {
    $transport = new RecordingPsrClient([new Response($status, ['Content-Type' => 'application/json'], '{"success":false}')]);

    try {
        testClient($transport)->company('c')->invoices->get('inv-1');
        test()->fail('Expected an API error.');
    } catch (BeelApiError $exception) {
        expect($exception)->toBeInstanceOf($class)
            ->and($exception->apiCode)->toBe($code);
    }
})->with([
    [401, BeelAuthError::class, 'UNAUTHORIZED'],
    [403, BeelAuthError::class, 'FORBIDDEN'],
    [404, BeelNotFoundError::class, 'NOT_FOUND'],
    [409, BeelConflictError::class, 'CONFLICT'],
    [422, BeelValidationError::class, 'UNPROCESSABLE_ENTITY'],
    [429, BeelRateLimitError::class, 'RATE_LIMIT_EXCEEDED'],
    [400, BeelApiError::class, 'UNKNOWN'],
]);

it('keeps the code BeeL sends and defaults a rate limit without delay to 60 seconds', function () {
    $coded = new RecordingPsrClient([jsonResponse(['success' => false, 'error' => ['code' => 'INVOICE_NOT_FOUND', 'message' => 'Missing']], 404)]);
    $limited = new RecordingPsrClient([jsonResponse(['success' => false, 'error' => ['code' => 'RATE_LIMITED', 'message' => 'Slow down']], 429)]);
    $withDelay = new RecordingPsrClient([new Response(429, ['Content-Type' => 'application/json', 'Retry-After' => '7'], '{"success":false}')]);

    $caught = [];
    foreach ([$coded, $limited, $withDelay] as $transport) {
        try {
            testClient($transport)->company('c')->invoices->get('inv-1');
        } catch (BeelApiError $exception) {
            $caught[] = $exception;
        }
    }

    expect($caught[0]->apiCode)->toBe('INVOICE_NOT_FOUND')
        ->and($caught[1]->apiCode)->toBe('RATE_LIMITED')
        ->and($caught[1]->retryAfterSeconds)->toBe(60)
        ->and($caught[1]->retryAfter)->toBeNull()
        ->and($caught[2]->retryAfterSeconds)->toBe(7);
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

it('exposes the Node.js SDK enums with every value in the OpenAPI contract', function () {
    expect(array_map(static fn (VeriFactuSubmissionStatus $case): string => $case->value, VeriFactuSubmissionStatus::cases()))
        ->toBe(['PENDING', 'ACCEPTED', 'VOIDED', 'REJECTED', 'NOT_SUBMITTED'])
        ->and(RecurringInvoicePauseReason::from('GENERATION_FAILURE'))->toBe(RecurringInvoicePauseReason::GENERATION_FAILURE)
        ->and(WebhookAccountRelationship::from('managed'))->toBe(WebhookAccountRelationship::MANAGED);
});

it('uses the Node.js SDK builder messages', function () {
    expect(fn () => InvoiceBuilder::create()->build())->toThrow(LogicException::class, 'Customer ID is required')
        ->and(fn () => InvoiceBuilder::create()->forCustomer('c')->build())->toThrow(LogicException::class, 'At least one invoice line is required')
        ->and(fn () => CustomerBuilder::create()->name('Acme')->nif('B1')->build())->toThrow(LogicException::class, 'Address is required');
});

// Plain arrays, like the Node.js SDK's plain objects

it('accepts an array in API format wherever a request model is expected', function () {
    $missing = [];
    foreach (glob(__DIR__.'/../src/Resource/{,*/}*.php', GLOB_BRACE) ?: [] as $file) {
        $class = 'Lenorix\\BeelSdk\\Resource\\'.str_replace(['/', '.php'], ['\\', ''], substr($file, strlen(__DIR__.'/../src/Resource/')));
        if (! class_exists($class)) {
            continue;
        }
        foreach ((new ReflectionClass($class))->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            foreach ($method->getParameters() as $parameter) {
                $type = $parameter->getType();
                $names = $type instanceof ReflectionUnionType
                    ? array_map(static fn ($part): string => (string) $part, $type->getTypes())
                    : [$type instanceof ReflectionNamedType ? $type->getName() : ''];
                $models = array_filter($names, static fn (string $name): bool => str_starts_with($name, 'Lenorix\\BeelSdk\\Generated\\Model\\')
                    && (str_ends_with($name, 'Request') || str_ends_with($name, 'Body')));
                if ($models !== [] && ! in_array('array', $names, true)) {
                    $missing[] = $class.'::'.$method->getName().'($'.$parameter->getName().')';
                }
            }
        }
    }

    expect($missing)->toBe([]);
});

it('sends an array request with the same fields a model would send', function () {
    $invoice = [
        'type' => 'STANDARD',
        'recipient' => ['customer_id' => 'customer-1'],
        'lines' => [[
            'line_type' => 'NORMAL',
            'description' => 'Consulting',
            'quantity' => 2,
            'unit_price' => 100.5,
            'discount_percentage' => 0,
            'main_tax' => ['type' => 'IVA', 'percentage' => 21, 'regime_key' => '01'],
        ]],
        'metadata' => ['order_id' => 'A-1', 'created_at' => '2026-09-25T12:00:00.123Z'],
    ];
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']], 201),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    $invoices->create($invoice);
    $invoices->void('inv-1', ['reason' => 'Billing error']);
    $invoices->schedule->set('inv-1', ['scheduled_for' => '2026-12-01', 'generation_mode' => 'DRAFT']);

    $sent = json_decode((string) $transport->requests[0]->getBody(), true);

    // Jane orders keys by schema and sends numbers as floats, exactly as it does for a hand-built model.
    expect($sent)->toEqual($invoice)
        ->and($sent['metadata'])->toBe($invoice['metadata'])
        ->and(json_decode((string) $transport->requests[1]->getBody(), true))->toBe(['reason' => 'Billing error'])
        ->and(json_decode((string) $transport->requests[2]->getBody(), true))->toBe(['scheduled_for' => '2026-12-01', 'generation_mode' => 'DRAFT']);
});

it('rejects arrays or objects that do not match the request model', function () {
    $invoices = testClient(new RecordingPsrClient([]))->company('c')->invoices;

    expect(fn () => $invoices->schedule->set('inv-1', ['scheduled_for' => 'tomorrow']))->toThrow(InvalidArgumentException::class, 'SetInvoiceScheduleRequest')
        ->and(fn () => RequestModels::from(new stdClass, CreateInvoiceRequest::class))->toThrow(InvalidArgumentException::class)
        ->and(fn () => $invoices->create(['type' => 'STANDARD', 'lines' => []]))->toThrow(InvalidArgumentException::class, 'missing the required field "recipient"');
});

it('uploads the signed representation from an array', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['status' => 'VALIDATING', 'message' => 'ok']])]);

    testClient($transport)->company('c')->representation->submit(['file' => '%PDF-array']);

    expect((string) $transport->requests[0]->getBody())->toContain('%PDF-array');
});

// Second parity round

it('never rewrites the query of a signed download URL', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['download_url' => 'https://signed.example.test/f.pdf?active=1&X-Sig=abc', 'file_name' => 'f.pdf', 'expires_in_seconds' => 300]]),
        new Response(200, ['Content-Type' => 'application/pdf'], '%PDF'),
    ]);

    testClient($transport)->downloadPdf('inv-1');

    expect($transport->requests[1]->getUri()->getQuery())->toBe('active=1&X-Sig=abc');
});

it('sends boolean query parameters as true and false', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']], 201),
        jsonResponse(['success' => true, 'data' => ['events' => [], 'pagination' => ['current_page' => 1, 'total_pages' => 1, 'total_items' => 0, 'items_per_page' => 20]]]),
    ]);
    $company = testClient($transport)->company('c');

    $company->invoices->create(InvoiceBuilder::create()->forCustomer('customer-1')->addLine('Consulting', 1, 100)->build(), ['wait_for_pdf' => true]);
    $company->paymentConnections->events('p')->list(['needs_action' => false, 'page' => 1]);

    expect($transport->requests[0]->getUri()->getQuery())->toBe('wait_for_pdf=true')
        ->and($transport->requests[1]->getUri()->getQuery())->toContain('needs_action=false')
        ->and($transport->requests[1]->getUri()->getQuery())->toContain('page=1');
});

it('accepts a single value for list filters such as status', function () {
    $transport = new RecordingPsrClient([
        invoicePage([], 1, 1, hasNext: false),
        invoicePage([], 1, 1, hasNext: false),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    $invoices->list(['status' => 'ISSUED']);
    $invoices->list(['status' => ['DRAFT', 'ISSUED']]);

    parse_str($transport->requests[0]->getUri()->getQuery(), $single);
    parse_str($transport->requests[1]->getUri()->getQuery(), $several);

    expect($single['status'])->toBe('ISSUED')
        ->and($single['fiscal_only'])->toBe('false')
        ->and($several['status'])->toBe('DRAFT,ISSUED');
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

it('rejects a webhook body that is a JSON list but accepts an empty object', function () {
    $signer = new WebhookSigner('whsec_test');
    $verifier = new WebhookVerifier('whsec_test');

    expect(fn () => $verifier->verify('[1,2]', $signer->sign('[1,2]', 1_000), 1_000))->toThrow(WebhookPayloadError::class)
        ->and($verifier->verify('{}', $signer->sign('{}', 1_000), 1_000))->toBe([]);
});

it('builds a fresh model on every build() call', function () {
    $builder = InvoiceBuilder::create()->forCustomer('customer-1')->addLine('First', 1, 10);
    $first = $builder->build();
    $builder->addLine('Second', 1, 20);
    $customers = CustomerBuilder::create()->name('Acme')->nif('B1')->address('Calle', '1', '28001', 'Madrid', 'Madrid', 'Spain');
    $customer = $customers->build();
    $customers->name('Other');

    expect($first)->not->toBe($builder->build())
        ->and($first->getLines())->toHaveCount(1)
        ->and($builder->build()->getLines())->toHaveCount(2)
        ->and($customer->getLegalName())->toBe('Acme');
});

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

it('lists every boolean and list query parameter of the generated endpoints', function () {
    $booleans = [];
    $lists = [];
    foreach (glob(__DIR__.'/../src/Generated/Endpoint/*.php') ?: [] as $file) {
        if (preg_match('/function getQueryOptionsResolver\(\).*?\n    \}\n/s', sourceCode($file), $resolver) !== 1) {
            continue;
        }
        preg_match_all("/addAllowedTypes\\('([a-z_]+)', \\['bool'\\]\\)/", $resolver[0], $matches);
        array_push($booleans, ...$matches[1]);
        preg_match_all("/addAllowedTypes\\('([a-z_]+)', \\['array'\\]\\)/", $resolver[0], $matches);
        array_push($lists, ...$matches[1]);
    }
    $booleans = array_values(array_unique($booleans));
    $lists = array_values(array_diff(array_unique($lists), ['metadata']));
    sort($booleans);
    sort($lists);

    $otherTypes = [];
    foreach (glob(__DIR__.'/../src/Generated/Endpoint/*.php') ?: [] as $file) {
        if (preg_match('/function getQueryOptionsResolver\\(\\).*?\\n    \\}\\n/s', sourceCode($file), $resolver) !== 1) {
            continue;
        }
        foreach (QueryParameters::BOOLEANS as $name) {
            // The rewrite is keyed by name, so a same-named int or string parameter would be corrupted.
            if (preg_match("/addAllowedTypes\\('".$name."', \\['(?!bool')/", $resolver[0]) === 1) {
                $otherTypes[] = basename($file).': '.$name;
            }
        }
    }

    expect(QueryParameters::BOOLEANS)->toBe($booleans)
        ->and(QueryParameters::LISTS)->toBe($lists)
        ->and($otherTypes)->toBe([]);
});

// Return types

it('declares every resource return type as the generated client actually returns it', function () {
    $root = __DIR__.'/../';
    $mismatches = [];
    $checked = [];
    $callers = [];
    foreach (array_merge(glob($root.'src/Resource/*.php') ?: [], glob($root.'src/Resource/*/*.php') ?: []) as $file) {
        preg_match_all('/public function (\w+)\(([^)]*)\): ([^\n{]+)\n    \{\n(.*?)\n    \}\n/s', sourceCode($file), $methods, PREG_SET_ORDER);
        foreach ($methods as [, $name, , $declared, $body]) {
            if (str_contains($body, '$this->client->')) {
                $callers[] = basename($file, '.php').'::'.$name;
            }
            if (preg_match('/\$this->(execute(?:Ready)?)\(\s*fn \(\) => \$this->client->(\w+)\(/', $body, $call) !== 1) {
                continue;
            }
            $checked[] = basename($file, '.php').'::'.$name;
            preg_match('/protected function transformResponseBody.*?\n    \}\n/s', sourceCode($root.'src/Generated/Endpoint/'.ucfirst($call[2]).'.php'), $transform);
            // Raw Jane output writes `200 === $status`; Pint rewrites it to `$status === 200`.
            preg_match_all('/(?|\$status === (2\d\d)|(2\d\d) === \$status)[^\n]*\n\s*return \$serializer->deserialize\(\$body, \'([^\']+)\'/', $transform[0], $bodies, PREG_SET_ORDER);
            preg_match_all('/(?|\$status === (2\d\d)|(2\d\d) === \$status)/', $transform[0], $statuses);

            $types = [];
            $nullable = false;
            foreach ($bodies as [, , $class]) {
                if (str_ends_with($class, '[]')) {
                    $types[] = 'array';

                    continue;
                }
                $type = method_exists($class, 'getData') ? (string) (new ReflectionMethod($class, 'getData'))->getReturnType() : $class;
                $nullable = $nullable || str_starts_with($type, '?');
                $types[] = ltrim($type, '?\\');
            }
            $types = array_values(array_unique($types));
            // executeReady() turns a bodiless 202 into BeelNotReadyError, so only execute() can return null for it.
            $bodiless = array_diff(array_unique($statuses[1]), array_column($bodies, 1));
            $nullable = $nullable || ($call[1] === 'execute' && $bodiless !== []);

            $expected = $types === [] ? 'void' : (count($types) === 1 ? $types[0] : implode('|', $types));
            $actual = (string) (new ReflectionMethod(
                'Lenorix\\BeelSdk\\Resource\\'.str_replace(['/', '.php'], ['\\', ''], substr($file, strlen($root.'src/Resource/'))),
                $name,
            ))->getReturnType();
            $actualType = ltrim($actual, '?\\');
            // Compare unions as sets: declaration order is irrelevant to PHP.
            $sortUnion = static function (string $type): string {
                $parts = array_map(static fn (string $part): string => ltrim($part, '\\'), explode('|', $type));
                sort($parts);

                return implode('|', $parts);
            };
            $actualType = $sortUnion($actualType);
            $expected = $sortUnion($expected);
            $isNullable = str_starts_with($actual, '?');
            // Declaring void deliberately discards the response (as the Node.js SDK does for customers->deactivate()); it can never fail.
            if ($actual !== 'void' && ($actualType !== $expected || ($nullable && ! $isNullable && $expected !== 'void'))) {
                $mismatches[] = basename($file, '.php')."::{$name}(): {$actual}, expected ".($nullable ? '?' : '').$expected;
            }
        }
    }

    // Every method that calls the generated client must have been checked, or the patterns above have drifted.
    expect($checked)->not->toBeEmpty()
        ->and(array_values(array_diff($callers, $checked)))->toBe([])
        ->and($mismatches)->toBe([]);
});

// Endpoints without a Node.js SDK method, named in its style

it('switches a company on and off, exposing the Live checkout URL', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['environment' => 'TEST']], 201),
        jsonResponse(['success' => false, 'error' => ['code' => 'CHECKOUT_REQUIRED', 'message' => 'Add a card', 'details' => ['checkout_url' => 'https://checkout.example.test/s/1']]], 402),
        jsonResponse(['success' => true, 'data' => ['environment' => 'PROD', 'effective_at' => '2026-10-31T00:00:00Z']]),
    ]);
    $activations = testClient($transport)->company('c')->activations;

    $activations->activate(Environment::TEST);
    try {
        $activations->activate('PROD', 'https://app.example.test/ok?s={CHECKOUT_SESSION_ID}', 'https://app.example.test/cancel');
        test()->fail('Expected a payment required error.');
    } catch (BeelPaymentRequiredError $exception) {
        expect($exception->apiCode)->toBe('CHECKOUT_REQUIRED')
            ->and($exception->checkoutUrl)->toBe('https://checkout.example.test/s/1');
    }
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

it('downloads draft previews and import templates as streams', function () {
    $pdf = new TripwireStream('%PDF-preview');
    $transport = new RecordingPsrClient([
        new Response(200, ['Content-Type' => 'application/pdf'], $pdf),
        new Response(200, ['Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="accounts.csv"'], "name,nif\n"),
        new Response(200, ['Content-Type' => 'text/csv'], "legal_name,nif\n"),
    ]);
    $beel = testClient($transport);

    $preview = $beel->company('c')->invoices->previewPdf('inv-1');
    $accounts = $beel->templates->accountImport();
    $customers = $beel->templates->customerImport();

    expect($preview->body)->toBe($pdf)
        ->and($preview->contentType)->toBe('application/pdf')
        ->and($accounts->fileName)->toBe('accounts.csv')
        ->and($customers->contentType)->toBe('text/csv')
        ->and(array_map(static fn ($request): string => $request->getUri()->getPath(), $transport->requests))->toBe([
            '/api/v1/companies/c/invoices/inv-1/pdf/preview',
            '/api/v1/templates/account-import',
            '/api/v1/templates/customer-import',
        ]);
});

it('lists, iterates and reads account request logs', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['request_logs' => [['request_id' => 'r1']], 'pagination' => ['next_cursor' => 'c2', 'has_next' => true, 'has_previous' => false]]]),
        jsonResponse(['success' => true, 'data' => ['request_logs' => [['request_id' => 'r2']], 'pagination' => ['next_cursor' => null, 'has_next' => false, 'has_previous' => true]]]),
        jsonResponse(['success' => true, 'data' => ['request_id' => 'r1']]),
    ]);
    $logs = testClient($transport)->account('a')->requestLogs;

    $all = iterator_to_array($logs->all(['only_errors' => true]));
    $detail = $logs->get('r1');

    parse_str($transport->requests[1]->getUri()->getQuery(), $second);
    expect($all)->toHaveCount(2)
        ->and($all[0])->toBeInstanceOf(RequestLogSummary::class)
        ->and($second)->toMatchArray(['only_errors' => 'true', 'cursor' => 'c2'])
        ->and($detail)->toBeInstanceOf(RequestLogDetail::class)
        ->and($transport->requests[2]->getUri()->getPath())->toBe('/api/v1/accounts/a/request-logs/r1');
});

it('imports managed accounts from an array', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['metadata' => []]]),
        jsonResponse(['success' => true, 'data' => ['metadata' => []]], 201),
    ]);
    $accounts = testClient($transport)->accounts;

    $accounts->previewImport(['accounts_file' => "external_ref,nif\nclient-1,B1\n"]);
    $accounts->import(['accounts_file' => "external_ref,nif\nclient-1,B1\n"], ['Idempotency-Key' => 'import-1']);

    expect($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/accounts/imports/preview')
        ->and((string) $transport->requests[0]->getBody())->toContain('client-1,B1')
        ->and($transport->requests[1]->getHeaderLine('Idempotency-Key'))->toBe('import-1');
});

it('reads tax types from the canonical route', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => []])]);

    expect(testClient($transport)->catalogs->taxTypes())->toBeInstanceOf(TaxTypesCatalog::class)
        ->and($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/tax-types');
});

it('builds typed events without a verifier and flags provisioner-only events', function () {
    $event = WebhookVerifier::eventFromPayload(['id' => 'evt-1', 'type' => 'invoice.issued', 'created_at' => '2026-09-25T12:00:00.5Z', 'api_version' => '2026-09-01', 'livemode' => false, 'data' => ['invoice_id' => 'inv-1']]);

    expect($event->getData())->toBeInstanceOf(WebhookEventDataInvoiceIssued::class)
        ->and(array_values(array_map(static fn (WebhookEventType $type): string => $type->value, array_filter(WebhookEventType::cases(), static fn (WebhookEventType $type): bool => $type->isProvisionerOnly()))))
        ->toBe(['account.claimed', 'company.created', 'representation.signed']);
});

it('uses the Node.js SDK fallback message when BeeL sends none', function (Response $response, string $message) {
    try {
        testClient(new RecordingPsrClient([$response]))->company('c')->invoices->get('inv-1');
        test()->fail('Expected an API error.');
    } catch (BeelApiError $exception) {
        expect($exception->getMessage())->toBe($message);
    }
})->with([
    'declared JSON error without message' => [new Response(404, ['Content-Type' => 'application/json'], '{"success":false}'), 'API error 404'],
    'undeclared HTML error' => [new Response(502, ['Content-Type' => 'text/html'], '<html>Bad gateway</html>'), 'API error 502'],
    'JSON error with message' => [new Response(409, ['Content-Type' => 'application/json'], '{"success":false,"error":{"code":"X","message":"Already issued"}}'), 'Already issued'],
]);

// Date-time precision

it('keeps the microseconds of API date-times, the most PHP DateTime can hold', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => [
        'id' => 'inv-1',
        'created_at' => '2026-09-25T01:29:40.548233096Z',
        'updated_at' => '2026-09-25T12:00:00.123+02:00',
    ]])]);

    $invoice = testClient($transport)->company('c')->invoices->get('inv-1');

    expect($invoice->getCreatedAt()->format('Y-m-d\TH:i:s.uP'))->toBe('2026-09-25T01:29:40.548233+00:00')
        ->and($invoice->getUpdatedAt()->format('Y-m-d\TH:i:s.uP'))->toBe('2026-09-25T12:00:00.123000+02:00');
});

it('keeps the microseconds of webhook date-times', function () {
    $body = '{"id":"evt-1","type":"invoice.issued","created_at":"2026-09-25T01:29:40.548233096Z","api_version":"2026-09-01","livemode":false,"data":{"invoice_id":"inv-1"}}';

    $event = (new WebhookVerifier('whsec_test'))->verifyEvent($body, (new WebhookSigner('whsec_test'))->sign($body, 1_000), 1_000);

    expect($event->getCreatedAt()->format('Y-m-d\TH:i:s.uP'))->toBe('2026-09-25T01:29:40.548233+00:00');
});

it('sends date-times with microseconds', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1']]),
    ]);
    $invoices = testClient($transport)->invoices;

    $invoices->markSent('inv-1', ['sent_at' => '2026-09-25T12:00:00.123456Z']);
    $invoices->markSent('inv-1', (new V1InvoicesInvoiceIdMarkSentPostBody)->setSentAt(new DateTime('2026-09-25T12:00:00.5+02:00')));

    expect(json_decode((string) $transport->requests[0]->getBody(), true))->toBe(['sent_at' => '2026-09-25T12:00:00.123456+00:00'])
        ->and(json_decode((string) $transport->requests[1]->getBody(), true))->toBe(['sent_at' => '2026-09-25T12:00:00.500000+02:00']);
});

// Strict date-time values

it('rejects an empty or non-RFC 3339 date-time instead of reading it as now', function (mixed $value) {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => ['id' => 'inv-1', 'created_at' => $value]])]);

    expect(fn () => testClient($transport)->company('c')->invoices->get('inv-1'))->toThrow(InvalidDateException::class);
})->with(['empty' => [''], 'relative word' => ['tomorrow'], 'date only' => ['2026-09-25'], 'number' => [1_758_800_000]]);

it('accepts null and every RFC 3339 form, and ignores free-form maps', function () {
    $transport = new RecordingPsrClient([jsonResponse(['success' => true, 'data' => [
        'id' => 'inv-1',
        'created_at' => '2026-09-25t12:00:00z',
        'updated_at' => '2026-09-25T12:00:00+02:00',
        'voided_at' => null,
        'metadata' => ['created_at' => '', 'sent_at' => 'whenever'],
    ]])]);

    $invoice = testClient($transport)->company('c')->invoices->get('inv-1');

    expect($invoice->getCreatedAt()->format(DATE_ATOM))->toBe('2026-09-25T12:00:00+00:00')
        ->and($invoice->getVoidedAt())->toBeNull()
        ->and($invoice->getMetadata()['created_at'])->toBe('');
});

it('rejects invalid date-times in webhooks and in request arrays', function () {
    $body = '{"id":"evt-1","type":"invoice.issued","created_at":"","api_version":"2026-09-01","livemode":false,"data":{"invoice_id":"inv-1"}}';
    $transport = new RecordingPsrClient([]);

    expect(fn () => (new WebhookVerifier('whsec_test'))->verifyEvent($body, (new WebhookSigner('whsec_test'))->sign($body, 1_000), 1_000))
        ->toThrow(WebhookPayloadError::class)
        ->and(fn () => testClient($transport)->invoices->markSent('inv-1', ['sent_at' => '']))->toThrow(InvalidArgumentException::class)
        ->and($transport->requests)->toBe([]);
});

it('lists every date-time field and free-form map of the generated normalizers', function () {
    $dates = [];
    $free = [];
    foreach (glob(__DIR__.'/../src/Generated/Normalizer/*.php') ?: [] as $file) {
        $code = sourceCode($file);
        preg_match_all('/new \\\\DateTime\(\$data\[\'([a-z_]+)\'\]\)/', $code, $matches);
        array_push($dates, ...$matches[1]);
        // Raw Jane output writes `new \Lenorix\...\JsonObject()`; Pint rewrites it to `new JsonObject;`.
        preg_match_all('/new (?:\\\\[A-Za-z\\\\]+\\\\)?JsonObject(?:\(\))?;\s*foreach \(\$data\[\'([A-Za-z0-9_]+)\'\]/', $code, $matches);
        array_push($free, ...$matches[1]);
    }
    $dates = array_values(array_unique($dates));
    $free = array_values(array_unique($free));
    sort($dates);
    sort($free);

    expect($dates)->not->toBeEmpty()
        ->and(DateTimeValues::NAMES)->toBe($dates)
        ->and(DateTimeValues::FREE_FORM_NAMES)->toBe($free);
});

it('never skips date-time fields of a model that shares a free-form map name', function () {
    $normalizers = __DIR__.'/../src/Generated/Normalizer/';
    $withDates = static function (string $model, array &$seen) use (&$withDates, $normalizers): array {
        $file = $normalizers.$model.'Normalizer.php';
        if (isset($seen[$model]) || ! is_file($file)) {
            return [];
        }
        $seen[$model] = true;
        $code = sourceCode($file);
        $found = str_contains($code, 'new \\DateTime($data') ? [$model] : [];
        preg_match_all('/([A-Za-z0-9]+)::class/', $code, $children);
        foreach (array_unique($children[1]) as $child) {
            array_push($found, ...$withDates($child, $seen));
        }

        return $found;
    };

    $collisions = [];
    $models = [];
    foreach (glob($normalizers.'*.php') ?: [] as $file) {
        foreach (DateTimeValues::FREE_FORM_NAMES as $name) {
            preg_match_all('/denormalize\(\$data\[\''.$name.'\'\], \\\\?(?:[A-Za-z\\\\]+\\\\)?([A-Za-z0-9]+)::class/', sourceCode($file), $matches);
            foreach ($matches[1] as $model) {
                $models[] = $model;
                $seen = [];
                array_push($collisions, ...$withDates($model, $seen));
            }
        }
    }

    // DateTimeValues skips these names, so a model under one of them must have no date-time fields.
    expect($models)->not->toBeEmpty()
        ->and($collisions)->toBe([]);
});

// Last response

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

// Retry delays and network errors

/** A transport that fails with a connection error for each queued exception, then answers with the queued responses. */
function flakyTransport(array $outcomes): ClientInterface
{
    return new class($outcomes) implements ClientInterface
    {
        /** @var list<RequestInterface> */
        public array $requests = [];

        public function __construct(private array $outcomes) {}

        public function sendRequest(RequestInterface $request): ResponseInterface
        {
            $this->requests[] = $request;
            $outcome = array_shift($this->outcomes) ?? throw new LogicException('Unexpected request.');
            if ($outcome instanceof Throwable) {
                throw $outcome;
            }

            return $outcome;
        }
    };
}

function retryingClient(ClientInterface $transport, array &$sleeps, int $maxRetries = 1, int $maxRetryDelayMs = 30_000, int $retryDelayMs = 500): RetryingClient
{
    return new RetryingClient($transport, $maxRetries, $retryDelayMs, $maxRetryDelayMs, sleep: static function (int $milliseconds) use (&$sleeps): void {
        $sleeps[] = $milliseconds;
    });
}

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
    $transport = flakyTransport([$first, $first, $last]);

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
    $transport = flakyTransport([new ConnectException('Timed out', new Request($method, 'https://example.test/x')), new Response(200)]);
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
    $transport = flakyTransport([new ConnectException('Timed out', new Request('POST', 'https://example.test/x')), new Response(200, ['Content-Type' => 'application/zip'], 'PK')]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 1, retryDelayMs: 0, maxRetryDelayMs: 0, httpClient: $transport);
    $invoices = $beel->company('c')->invoices;

    expect(fn () => $method === 'archive' ? $invoices->createPdfArchive(archiveRequest()) : $invoices->export(new CreateInvoiceExportRequest))
        ->toThrow(ConnectException::class)
        ->and($transport->requests)->toHaveCount(1);
})->with(['archive' => ['archive'], 'export' => ['export']]);

it('keeps the Content-Type charset of a download while contentType stays the media type', function (string $header, ?string $charset) {
    $transport = new RecordingPsrClient([new Response(200, ['Content-Type' => $header], "legal_name,nif\n")]);

    $download = testClient($transport)->templates->customerImport();

    expect($download->contentType)->toBe('text/csv')
        ->and($download->charset)->toBe($charset);
})->with([
    'as BeeL sends it' => ['text/csv; charset=utf-8', 'utf-8'],
    'quoted' => ['text/csv; charset="UTF-8"', 'UTF-8'],
    'upper-case name' => ['text/csv;CHARSET=iso-8859-1', 'iso-8859-1'],
    'among other parameters' => ['text/csv; header=present; charset=utf-8', 'utf-8'],
    'without charset' => ['text/csv', null],
]);

// OpenAPI 1.9.0 update: preview and send may answer 202, payment_method, new endpoints

it('reports a draft preview whose PDF is not ready as not ready', function () {
    $transport = new RecordingPsrClient([
        new Response(202, ['Retry-After' => '4']),
        jsonResponse(['success' => true, 'data' => ['invoice_id' => 'inv-1']]),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    try {
        $invoices->preview('inv-1');
        test()->fail('Expected BeelNotReadyError.');
    } catch (BeelNotReadyError $exception) {
        expect($exception->retryAfter)->toBe(4);
    }

    expect($invoices->preview('inv-1'))->toBeInstanceOf(InvoicePreviewResponseData::class);
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

it('filters invoices by a single payment method', function () {
    $transport = new RecordingPsrClient([invoicePage([], 1, 1, hasNext: false)]);

    testClient($transport)->company('c')->invoices->list(['payment_method' => 'CARD']);

    parse_str($transport->requests[0]->getUri()->getQuery(), $query);
    expect($query['payment_method'])->toBe('CARD');
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

it('reports an undeclared success status as unexpected, not as a failed request', function () {
    $transport = new RecordingPsrClient([
        new Response(202, ['Content-Type' => 'application/json', 'X-Request-Id' => 'req-202'], '{"success":true,"data":{"id":"inv-1"}}'),
        jsonResponse(['success' => false, 'error' => ['code' => 'NOT_FOUND', 'message' => 'Missing']], 404),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    try {
        $invoices->get('inv-1');
        test()->fail('Expected BeelUnexpectedResponseError.');
    } catch (BeelUnexpectedResponseError $exception) {
        expect($exception)->not->toBeInstanceOf(BeelApiError::class)
            ->and($exception->statusCode)->toBe(202)
            ->and($exception->requestId)->toBe('req-202')
            ->and($exception->getMessage())->toContain('getLastResponse()')
            ->and($exception->context())->toBe(['status_code' => 202, 'request_id' => 'req-202']);
    }

    expect(fn () => $invoices->get('inv-1'))->toThrow(BeelNotFoundError::class);
});

it('rejects null in a date-time field that is never nullable, instead of reading it as now', function () {
    $transport = new RecordingPsrClient([
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1', 'created_at' => null]]),
        jsonResponse(['success' => true, 'data' => ['id' => 'inv-1', 'created_at' => '2026-09-28T10:00:00Z', 'voided_at' => null]]),
    ]);
    $invoices = testClient($transport)->company('c')->invoices;

    expect(fn () => $invoices->get('inv-1'))->toThrow(InvalidDateException::class)
        ->and($invoices->get('inv-1')->getVoidedAt())->toBeNull();
});

it('lists the date-time fields that no generated model allows to be null', function () {
    $kinds = [];
    foreach (glob(__DIR__.'/../src/Generated/Normalizer/*Normalizer.php') ?: [] as $file) {
        if (preg_match('/public function denormalize\(.*?\n    \}\n/s', sourceCode($file), $denormalize) !== 1) {
            continue;
        }
        preg_match_all('/new \\\\DateTime\(\$data\[\'([a-z_]+)\'\]\)/', $denormalize[0], $matches);
        foreach (array_unique($matches[1]) as $name) {
            $nullable = preg_match('/\$data\[\''.$name.'\'\] (?:!==|===) null|null (?:!==|===) \$data\[\''.$name.'\'\]/', $denormalize[0]) === 1;
            $kinds[$name][$nullable ? 'nullable' : 'required'] = true;
        }
    }
    $neverNullable = array_keys(array_filter($kinds, static fn (array $kind): bool => ! isset($kind['nullable'])));
    sort($neverNullable);

    expect($neverNullable)->not->toBeEmpty()
        ->and(DateTimeValues::NON_NULLABLE_NAMES)->toBe($neverNullable);
});

it('reports a 202 as not ready whatever body and Content-Type BeeL sends', function (string $method, array $headers, string $body) {
    $transport = new RecordingPsrClient([new Response(202, ['Retry-After' => '6', ...$headers], $body)]);
    $invoices = testClient($transport)->company('c')->invoices;
    $deprecations = [];
    $source = str_replace('\\', '/', (string) realpath(__DIR__.'/../src')).'/';
    set_error_handler(static function (int $level, string $message, string $file) use (&$deprecations, $source): bool {
        if (str_starts_with(str_replace('\\', '/', $file), $source)) {
            $deprecations[] = $message;
        }

        return true;
    }, E_DEPRECATED | E_USER_DEPRECATED);

    try {
        $method === 'preview' ? $invoices->preview('inv-1') : $invoices->getPdf('inv-1');
        test()->fail('Expected BeelNotReadyError.');
    } catch (BeelNotReadyError $exception) {
        expect($exception->retryAfter)->toBe(6);
    } finally {
        restore_error_handler();
    }

    expect($deprecations)->toBe([]);
})->with(['preview', 'getPdf'])->with([
    'no Content-Type' => [[], ''],
    'JSON, empty body' => [['Content-Type' => 'application/json'], ''],
    'JSON, empty object' => [['Content-Type' => 'application/json'], '{}'],
]);
