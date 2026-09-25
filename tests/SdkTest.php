<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Builder\CustomerBuilder;
use Lenorix\BeelSdk\Builder\InvoiceBuilder;
use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Exception\BeelAuthError;
use Lenorix\BeelSdk\Exception\BeelValidationError;
use Lenorix\BeelSdk\Exception\WebhookVerificationError;
use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteBody;
use Lenorix\BeelSdk\Generated\Model\ValidateNifResponse;
use Lenorix\BeelSdk\Generated\Model\VeriFactuConfiguration;
use Lenorix\BeelSdk\Http\RetryingClient;
use Lenorix\BeelSdk\Resource\Account\AccountCompaniesResource;
use Lenorix\BeelSdk\Resource\Account\AccountInvitationsResource;
use Lenorix\BeelSdk\Resource\Account\AccountMembersResource;
use Lenorix\BeelSdk\Resource\Account\AccountWebhooksResource;
use Lenorix\BeelSdk\Resource\AccountsResource;
use Lenorix\BeelSdk\Resource\CatalogsResource;
use Lenorix\BeelSdk\Resource\Company\CompanyInvoiceScheduleResource;
use Lenorix\BeelSdk\Resource\Company\CompanyInvoicesResource;
use Lenorix\BeelSdk\Resource\CustomersResource;
use Lenorix\BeelSdk\Resource\GeneratedResource;
use Lenorix\BeelSdk\Resource\InvoicesResource;
use Lenorix\BeelSdk\Resource\NifResource;
use Lenorix\BeelSdk\Resource\ProductsResource;
use Lenorix\BeelSdk\Resource\SeriesResource;
use Lenorix\BeelSdk\Webhook\WebhookEventType;
use Lenorix\BeelSdk\Webhook\WebhookVerifier;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class RecordingPsrClient implements ClientInterface
{
    /** @var list<RequestInterface> */
    public array $requests = [];

    /** @param list<ResponseInterface> $responses */
    public function __construct(private array $responses) {}

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->requests[] = $request;

        $response = array_shift($this->responses);
        if ($response === null) {
            throw new LogicException(sprintf(
                'Unexpected HTTP request in test: %s %s',
                $request->getMethod(),
                (string) $request->getUri(),
            ));
        }

        return $response;
    }
}

it('constructs the public client, exposes scoped resources and Jane raw client', function () {
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: new RecordingPsrClient([]));

    expect($beel->raw)->toBeInstanceOf(Client::class)
        ->and($beel->company('co-1')->companyId)->toBe('co-1')
        ->and($beel->company('co-1')->invoices)->toBeInstanceOf(CompanyInvoicesResource::class)
        ->and($beel->company('co-1')->invoices->schedule)->toBeInstanceOf(CompanyInvoiceScheduleResource::class)
        ->and($beel->account('ac-1')->members)->toBeInstanceOf(GeneratedResource::class)
        ->and($beel->account('ac-1')->members)->toBeInstanceOf(AccountMembersResource::class)
        ->and($beel->account('ac-1')->invitations)->toBeInstanceOf(AccountInvitationsResource::class)
        ->and($beel->account('ac-1')->webhooks)->toBeInstanceOf(AccountWebhooksResource::class)
        ->and($beel->account('ac-1')->companies)->toBeInstanceOf(AccountCompaniesResource::class)
        ->and($beel->catalogs)->toBeInstanceOf(CatalogsResource::class)
        ->and($beel->nif)->toBeInstanceOf(NifResource::class)
        ->and($beel->accounts)->toBeInstanceOf(AccountsResource::class)
        ->and($beel->series)->toBeInstanceOf(SeriesResource::class)
        ->and($beel->invoices)->toBeInstanceOf(InvoicesResource::class)
        ->and($beel->customers)->toBeInstanceOf(CustomersResource::class)
        ->and($beel->products)->toBeInstanceOf(ProductsResource::class);
});

it('fails closed instead of sending an unmocked request', function () {
    $transport = new RecordingPsrClient([]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: $transport);

    expect(fn () => $beel->raw->getMyIdentity())
        ->toThrow(LogicException::class, 'Unexpected HTTP request in test: GET')
        ->and(count($transport->requests))->toBe(1);
});

it('keeps the NPM NIF validation convenience call while using Jane request models', function () {
    $transport = new RecordingPsrClient([
        new Response(200, ['Content-Type' => 'application/json'], '{"success":true,"data":{"valid":true,"status":"VALID","census_status":"ACTIVE","message":"Valid"}}'),
    ]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: $transport);

    $result = $beel->nif->validate('B12345678');

    expect($result)->toBeInstanceOf(ValidateNifResponse::class)
        ->and($result->getValid())->toBeTrue()
        ->and((string) $transport->requests[0]->getUri())->toEndWith('/v1/nif/validate')
        ->and((string) $transport->requests[0]->getBody())->toContain('B12345678');
});

it('delegates legacy bulk product deletion with its generated request model', function () {
    $transport = new RecordingPsrClient([
        new Response(200, ['Content-Type' => 'application/json'], '{"success":true,"data":{"deleted_products":["product-1"],"errors":[],"summary":{"total_processed":1,"successful":1,"failed":0}}}'),
    ]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: $transport);

    $result = $beel->products->deleteBulk(
        (new V1ProductsBulkDeleteBody)->setProductIds(['product-1']),
    );

    expect($result->getDeletedProducts())->toBe(['product-1'])
        ->and($transport->requests[0]->getMethod())->toBe('DELETE')
        ->and($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/products/bulk')
        ->and(json_decode((string) $transport->requests[0]->getBody(), true))->toBe(['product_ids' => ['product-1']]);
});

it('keeps authentication isolated between client instances', function () {
    $firstTransport = new RecordingPsrClient([new Response(200, ['Content-Type' => 'application/json'], '{}')]);
    $secondTransport = new RecordingPsrClient([new Response(200, ['Content-Type' => 'application/json'], '{}')]);
    $first = new Beel(apiKey: 'beel_sk_test_first', maxRetries: 0, httpClient: $firstTransport);
    $second = new Beel(apiKey: 'beel_sk_test_second', maxRetries: 0, httpClient: $secondTransport);

    $first->raw->getMyIdentity();
    $second->raw->getMyIdentity();

    expect($firstTransport->requests[0]->getHeaderLine('Authorization'))->toBe('Bearer beel_sk_test_first')
        ->and($secondTransport->requests[0]->getHeaderLine('Authorization'))->toBe('Bearer beel_sk_test_second');
});

it('normalizes fractional metadata timestamps before Jane deserializes JSON responses', function () {
    $transport = new RecordingPsrClient([
        new Response(200, ['Content-Type' => 'application/json'], '{"success":true,"data":{"account_id":"account-1","email":"contact@example.com","language":"es"},"meta":{"timestamp":"2026-09-25T01:29:40.548233096Z","request_id":"req-test"}}'),
    ]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: $transport);

    $identity = $beel->raw->getMyIdentity()->getData();

    expect($identity->getEmail())->toBe('contact@example.com')
        ->and($transport->requests[0]->getHeaderLine('Authorization'))->toBe('Bearer beel_sk_test_key');
});

it('normalizes fractional validated-at timestamps from BeeL responses', function () {
    $transport = new RecordingPsrClient([
        new Response(200, ['Content-Type' => 'application/json'], '{"success":true,"data":{"valid":true,"status":"VALID","legal_name_verified":false,"census_status":"IDENTIFIED","message":"Valid","validated_at":"2026-09-25T01:34:34.856943341Z"},"meta":{"timestamp":"2026-09-25T01:34:34.856943341Z","request_id":"req-test"}}'),
    ]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: $transport);

    $result = $beel->nif->validate('B00000000');

    expect($result)->toBeInstanceOf(ValidateNifResponse::class)
        ->and($result->getValidatedAt())->toBeInstanceOf(DateTime::class);
});

it('delegates company invoice creation to Jane with auth, path and generated models', function () {
    $transport = new RecordingPsrClient([
        new Response(422, ['Content-Type' => 'application/json'], json_encode([
            'success' => false,
            'error' => ['code' => 'INVALID', 'message' => 'Invalid invoice'],
            'meta' => ['request_id' => 'req-test'],
        ], JSON_THROW_ON_ERROR)),
    ]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', baseUrl: 'https://sandbox.example/api', maxRetries: 0, httpClient: $transport);
    $request = InvoiceBuilder::create()->forCustomer('customer-1')->addLine('Consulting', 1, 100)->build();

    expect($request)->toBeInstanceOf(CreateInvoiceRequest::class);
    try {
        $beel->company('company-1')->invoices->create($request);
        test()->fail('Expected the API error to be mapped.');
    } catch (BeelValidationError $exception) {
        expect($exception->statusCode)->toBe(422)
            ->and($exception->apiCode)->toBe('INVALID')
            ->and($exception->requestId)->toBe('req-test');
    }

    expect((string) $transport->requests[0]->getUri())->toStartWith('https://sandbox.example/api/v1/companies/company-1/invoices?')
        ->and($transport->requests[0]->getHeaderLine('Authorization'))->toBe('Bearer beel_sk_test_key')
        ->and($transport->requests[0]->getHeaderLine('Idempotency-Key'))->not->toBe('')
        ->and($transport->requests[0]->getHeaderLine('Content-Type'))->toContain('application/json');
});

it('maps an undocumented gateway error response to a typed BeeL error', function () {
    $transport = new RecordingPsrClient([
        new Response(502, ['Content-Type' => 'application/json', 'Retry-After' => '0'], '{"success":false,"error":{"code":"TRANSIENT","message":"Try again"}}'),
        new Response(502, ['Content-Type' => 'application/json', 'X-Request-Id' => 'req-gateway'], '{"success":false,"error":{"code":"UPSTREAM_UNAVAILABLE","message":"Bad gateway","details":{"retry_after":4}}}'),
    ]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 1, httpClient: $transport);

    try {
        $beel->company('company-1')->invoices->get('invoice-1');
        test()->fail('Expected an API error for the gateway response.');
    } catch (BeelApiError $exception) {
        expect($exception->statusCode)->toBe(502)
            ->and($exception->apiCode)->toBe('UPSTREAM_UNAVAILABLE')
            ->and($exception->requestId)->toBe('req-gateway')
            ->and($exception->retryAfter)->toBe(4);
    }

    expect(count($transport->requests))->toBe(2);
});

it('uses generated request models in the customer builder and matches required-field checks', function () {
    $customer = CustomerBuilder::create()->name('Acme SL')->nif('B12345678')
        ->email('billing@example.es')->phone('+34 600 000 000')
        ->address('Calle Mayor', '1', '28001', 'Madrid', 'Madrid', 'Spain')->build();

    expect($customer)->toBeInstanceOf(CreateCustomerRequest::class)
        ->and($customer->getLegalName())->toBe('Acme SL')
        ->and($customer->getAddress()->getCountryCode())->toBe('ES')
        ->and(fn () => CustomerBuilder::create()->build())->toThrow(LogicException::class);
});

it('returns Jane generated response models from scoped resources', function () {
    $transport = new RecordingPsrClient([
        new Response(200, ['Content-Type' => 'application/json'], '{"success":true,"data":{"enabled":true,"status":"ACTIVE"}}'),
    ]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: $transport);
    $configuration = $beel->company('company-1')->verifactuConfiguration->get();

    expect($configuration)->toBeInstanceOf(VeriFactuConfiguration::class)
        ->and($configuration->getEnabled())->toBeTrue()
        ->and((string) $transport->requests[0]->getUri())->toEndWith('/v1/companies/company-1/verifactu-configuration');
});

it('scopes account resource calls to the account path', function () {
    $transport = new RecordingPsrClient([
        new Response(401, ['Content-Type' => 'application/json'], '{"success":false,"error":{"code":"UNAUTHORIZED","message":"Invalid key"}}'),
    ]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: $transport);

    try {
        $beel->account('account-1')->members->list();
        test()->fail('Expected an authentication error.');
    } catch (BeelAuthError $exception) {
        expect($exception->statusCode)->toBe(401)
            ->and($transport->requests[0]->getUri()->getPath())->toBe('/api/v1/accounts/account-1/members');
    }
});

it('creates the company payment events resource with its company scope', function () {
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: new RecordingPsrClient([]));
    $events = $beel->company('company-1')->paymentConnections->events('connection-1');

    expect($events)->toBeInstanceOf(GeneratedResource::class);
});

it('preserves local exceptions when mapping generated API errors', function () {
    $exception = new LogicException('Local programming error');

    expect(fn () => BeelApiError::fromGenerated($exception))->toThrow(LogicException::class, 'Local programming error');
});

it('retries transient responses with the same idempotency key', function () {
    $transport = new RecordingPsrClient([
        new Response(500),
        new Response(200),
    ]);
    $client = new RetryingClient($transport, maxRetries: 1, retryDelayMs: 0, maxRetryDelayMs: 0);
    $response = $client->sendRequest((new Request('POST', 'https://example.test/invoices'))->withBody(Utils::streamFor('{"ok":true}')));

    expect($response->getStatusCode())->toBe(200)
        ->and(count($transport->requests))->toBe(2)
        ->and($transport->requests[0]->getHeaderLine('Idempotency-Key'))->not->toBe('')
        ->and($transport->requests[1]->getHeaderLine('Idempotency-Key'))->toBe($transport->requests[0]->getHeaderLine('Idempotency-Key'));
});

it('verifies webhook HMAC signatures and rejects stale timestamps', function () {
    $secret = 'whsec_test';
    $timestamp = 1_800_000_000;
    $body = '{"type":"invoice.issued","data":{}}';
    $signature = hash_hmac('sha256', $timestamp.'.'.$body, $secret);
    $verifier = new WebhookVerifier($secret);

    expect($verifier->verify($body, "t={$timestamp},v1={$signature}", $timestamp))
        ->toBe(['type' => 'invoice.issued', 'data' => []]);
    expect(fn () => $verifier->verify($body, "t={$timestamp},v1={$signature}", $timestamp + 301))
        ->toThrow(WebhookVerificationError::class);
    expect(WebhookEventType::INVOICE_ISSUED->value)->toBe('invoice.issued');
});

it('downloads the PDF from its signed URL without forwarding the API key', function () {
    $transport = new RecordingPsrClient([
        new Response(200, ['Content-Type' => 'application/json'], '{"success":true,"data":{"download_url":"https://signed.example.test/file.pdf","file_name":"invoice.pdf","expires_in_seconds":300}}'),
        new Response(200, ['Content-Type' => 'application/pdf'], '%PDF-1.7 test'),
    ]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: $transport);

    $pdf = $beel->downloadPdf('invoice-1');

    expect($pdf)->toBe(['buffer' => '%PDF-1.7 test', 'fileName' => 'invoice.pdf'])
        ->and(count($transport->requests))->toBe(2)
        ->and($transport->requests[1]->getUri()->getHost())->toBe('signed.example.test')
        ->and($transport->requests[1]->hasHeader('Authorization'))->toBeFalse();
});

it('reports a pending PDF instead of dereferencing an empty 202 response', function () {
    $transport = new RecordingPsrClient([new Response(202, ['Retry-After' => '2'])]);
    $beel = new Beel(apiKey: 'beel_sk_test_key', maxRetries: 0, httpClient: $transport);

    expect(fn () => $beel->downloadPdf('invoice-1'))
        ->toThrow(RuntimeException::class, 'Invoice PDF is still being generated');
});
