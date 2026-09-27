# BeeL PHP SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lenorix/beel-sdk.svg?style=flat-square)](https://packagist.org/packages/lenorix/beel-sdk)
[![Tests](https://github.com/lenorix/BeeL-php-sdk/actions/workflows/run-tests.yml/badge.svg)](https://github.com/lenorix/BeeL-php-sdk/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/lenorix/beel-sdk.svg?style=flat-square)](https://packagist.org/packages/lenorix/beel-sdk)
[![Plumb score](https://plumbphp.dev/badges/lenorix/beel-sdk/composite.svg)](https://plumbphp.dev/lenorix/beel-sdk)

An instance-based PHP client for the [BeeL invoicing API](https://docs.beel.es), including company and account scoped resources, VeriFactu invoicing, retries, idempotency, PDF downloads, and webhook signature verification.

> **Unofficial SDK, developed by [lenorix](https://lenorix.com).** BeeL does not make or endorse this package. Lenorix develops it as an independent client for the BeeL API.

Requires **PHP 8.4+**. The HTTP API is backed by the JanePHP client generated from BeeL's OpenAPI contract.

## Installation

```bash
composer require lenorix/beel-sdk
```

## Quick start

```php
<?php

use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Builder\InvoiceBuilder;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequestLinesItem;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequestLinesItemMainTax;

$beel = new Beel(apiKey: getenv('BEEL_API_KEY') ?: throw new RuntimeException('Set BEEL_API_KEY.'));
$company = $beel->company('company-uuid');

$line = (new CreateInvoiceRequestLinesItem())
    ->setLineType('NORMAL')
    ->setDescription('Consulting services')
    ->setQuantity(1)
    ->setUnitPrice(100)
    ->setDiscountPercentage(0)
    ->setMainTax((new CreateInvoiceRequestLinesItemMainTax())
        ->setType('IVA')
        ->setPercentage(21)
        ->setRegimeKey('01'));

$request = InvoiceBuilder::create()
    ->forCustomer('customer-uuid')
    ->addLineObject($line)
    ->build();

$invoice = $company->invoices->create($request);
$issued = $company->invoices->issue($invoice->getId());

echo $issued->getInvoiceNumber();
```

Every method that takes a request model also accepts an array with the API's field names, like the plain objects of the official Node.js SDK:

```php
$invoice = $company->invoices->create([
    'type' => 'STANDARD',
    'recipient' => ['customer_id' => 'customer-uuid'],
    'lines' => [[
        'line_type' => 'NORMAL',
        'description' => 'Consulting services',
        'quantity' => 1,
        'unit_price' => 100,
        'main_tax' => ['type' => 'IVA', 'percentage' => 21, 'regime_key' => '01'],
    ]],
]);
$company->invoices->void($invoice->getId(), ['reason' => 'Billing error']);
```

An array that does not match the model, or lacks a required field, throws `InvalidArgumentException` naming the problem before anything is sent.

Create the invoice first and issue it when it is ready. The generated Jane model returned by the SDK is available directly, so its getters and the complete BeeL response remain accessible. Date-time fields become `DateTime` objects with second precision, as the generated models require; every other value, including anything in `metadata`, keeps exactly what BeeL sent.

## Client options

```php
$beel = new Beel(
    apiKey: 'beel_sk_live_...',
    baseUrl: 'https://app.beel.es/api', // default
    maxRetries: 3,                     // default: retries after the initial request
    retryDelayMs: 500,                 // default
    maxRetryDelayMs: 30_000,            // default
    autoIdempotencyKey: true,          // default
);
```

Use a test key (`beel_sk_test_...`) while developing and a live key (`beel_sk_live_...`) in production. The key selects the environment; the base URL stays the same.

`maxRetries` is the maximum number of retries after the first attempt. The SDK retries `429` and `5xx` responses with exponential backoff, honors `Retry-After` when provided up to `maxRetryDelayMs`, and uses the same idempotency key for every retry of a POST. It does not retry other client errors. A POST or PATCH without an `Idempotency-Key` is not retried after a `5xx`, because BeeL may already have applied it. Only POST requests get an automatic key, so PATCH requests retry on `5xx` only when you pass an `Idempotency-Key`, for example with `withOptions()`. A `429` is always retried: BeeL rejects it without applying the request.

The client is instance-based. Each `Beel` instance has its own API key and transport; there is no global configuration or shared authentication state.

## Companies (NIFs)

Address the company explicitly so one client can work with multiple NIFs:

```php
$company = $beel->company('company-uuid');

$invoices = $company->invoices->list(['status' => ['ISSUED']]);
$invoice = $company->invoices->get('invoice-uuid');
$company->invoices->issue($invoice->getId());
$company->invoices->void(
    $invoice->getId(),
    (new \Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest())->setReason('Billing error'),
);
$pdf = $company->invoices->getPdf($invoice->getId());

$customer = $company->customers->create($customerRequest);
$product = $company->products->create($productRequest);
$company->series->ensureDefaults();

$summary = $company->fiscalSummary(['year' => 2026]);
$readiness = $company->issuingReadiness();
```

The company scope exposes `invoices`, `customers`, `products`, `series`, `recurringInvoices`, `paymentConnections`, `taxConfiguration`, `verifactuConfiguration`, `invoiceCustomization`, `logo`, `activations` and `representation`, along with company operations such as `get()`, `update()`, `delete()`, `fiscalSummary()`, and `issuingReadiness()`.

Recurring invoices, schedules, VeriFactu settings, and other request bodies use the corresponding generated models under `Lenorix\BeelSdk\Generated\Model`. For example:

```php
use Lenorix\BeelSdk\Generated\Model\SetRecurringInvoiceStatusRequest;

$company->recurringInvoices->setStatus(
    'recurring-invoice-uuid',
    (new SetRecurringInvoiceStatusRequest())->setStatus('PAUSED'),
);
```

## Iterating over every page

List operations return one page. Their `all()` counterparts return a lazy generator that fetches the next page only when iteration reaches it:

```php
foreach ($company->invoices->all(['status' => ['ISSUED'], 'limit' => 100]) as $invoice) {
    // Each item is a generated Invoice model.
}
```

Filters and `limit` apply to every page, and `page` sets the first page to read. Iteration stops on the last page, on an empty page, or if BeeL answers a different page than the one requested. Iterators are available for company invoices, customers, products, series, recurring invoices (`all()` and `allHistory()`), payment events, and for account companies, members (`all()` and `allGrants()`), invitations, webhooks (`all()` and `allDeliveries()`), emails, and `$beel->accounts->all()`, which follows BeeL's `next_cursor`.

## Per-call options

`withOptions()` returns a copy of any resource that sends extra headers, an `Idempotency-Key`, or both, on each request it makes. The original resource is unchanged:

```php
use Lenorix\BeelSdk\Http\RequestOptions;

$invoice = $company->invoices
    ->withOptions(new RequestOptions(idempotencyKey: 'order-42'))
    ->create($request);

$traced = $beel->company('company-uuid')->withOptions(new RequestOptions(headers: ['X-Trace-Id' => $traceId]));
$traced->invoices->get('invoice-uuid'); // child resources use the same options
```

The options are added by the SDK's transport, so they work for every operation, including those whose generated endpoint declares no header parameters. A stable idempotency key lets you retry a write safely after a timeout or a crash: BeeL returns the stored response instead of repeating the operation. The same key is sent on every request made through the copy, so scope a copy with an idempotency key to one write. Options take precedence over headers passed as method arguments. `maxRetries` overrides the client's retry limit for these requests (`0` disables retries, useful inside queue workers that retry on their own), and `retryServerErrors` decides whether a `5xx` may be retried. `Authorization`, `Host`, `Content-Type` and `Content-Length` cannot be set per call: the API key belongs to the `Beel` instance, so use one instance per credential.

## Identity

`$beel->me->identity()` returns the account the API key belongs to and describes the key itself, including its environment and scopes. It needs no scope, so it also works as a credentials check:

```php
$identity = $beel->me->identity();
$identity->getAccountId();
$identity->getCredential()->getEnvironment();
$identity->getCredential()->getScopes();
```

## Switching a company on

A company invoices only in the environments it is switched on in. `activations` switches it on or off in Test or Live:

```php
use Lenorix\BeelSdk\Enum\Environment;
use Lenorix\BeelSdk\Exception\BeelPaymentRequiredError;

$company->activations->activate(Environment::TEST);

try {
    $company->activations->activate(
        Environment::PROD,
        successUrl: 'https://your-app.example.com/billing/return?session={CHECKOUT_SESSION_ID}',
        cancelUrl: 'https://your-app.example.com/billing',
    );
} catch (BeelPaymentRequiredError $exception) {
    // CHECKOUT_REQUIRED: no card on file yet. Send the user to the checkout.
    $checkoutUrl = $exception->checkoutUrl;
}

$deactivation = $company->activations->deactivate(Environment::PROD); // Live: effective at the end of the billing cycle
```

Test is immediate and free. Live is immediate when the account already has a card on file or an enterprise contract; otherwise BeeL answers `402` and `BeelPaymentRequiredError` carries the `checkoutUrl` when both return URLs are given. A `PAYMENT_REQUIRED` code means billing is past due.

## Invoice customization and logo

```php
$customization = $company->invoiceCustomization->get();
$company->invoiceCustomization->update(['template' => 'modern']);

$company->logo->upload(fopen('/path/to/logo.png', 'rb')); // a file, a stream or the image contents
$company->logo->delete();
```

## Representation

The representation is the AEAT authorization a company signs so BeeL can submit its invoices in production:

```php
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRepresentationSubmitPostBody;

$company->representation->generate();
$link = $company->representation->documentLink(); // getDownloadUrl(), getExpiresInSeconds()

$signed = (new V1CompaniesCompanyIdRepresentationSubmitPostBody())
    ->setFile(fopen('/path/to/signed.pdf', 'rb'));
$company->representation->submit($signed); // accepted for validation

$status = $company->representation->get()->getStatus();
$company->representation->cancel();
```

`submit()` uploads the signed document as `multipart/form-data`. BeeL validates the signature asynchronously, so poll `get()` for the outcome. Errors carry their real HTTP status, for example `BeelNotFoundError` or `BeelConflictError`.

## Accounts and payment connections

Account resources are scoped independently from NIF resources:

```php
$account = $beel->account('account-uuid');

$accountData = $account->get();
$companies = $account->companies->list();
$members = $account->members->list();
$invitations = $account->invitations->list();
$webhooks = $account->webhooks->list();

foreach ($account->requestLogs->all(['only_errors' => true]) as $log) {
    // Every failed API request made to this account, newest first.
}
$detail = $account->requestLogs->get('request-id');
```

Integrators that provision accounts can import them in bulk from CSV, after validating the file:

```php
$preview = $beel->accounts->previewImport(['accounts_file' => fopen('/path/to/accounts.csv', 'rb')]);
$result = $beel->accounts->import(['accounts_file' => fopen('/path/to/accounts.csv', 'rb')]);

$template = $beel->templates->accountImport(); // BinaryDownload with the CSV template; also customerImport()
```

Payment connections belong to a company. A connection is identified by its ID; its events resource is scoped to that connection:

```php
$company = $beel->company('company-uuid');
$connections = $company->paymentConnections->list();
$events = $company->paymentConnections->events('connection-uuid');
$pending = $events->list(['needs_action' => true]);
$events->retry('event-uuid');
$draft = $events->draft('event-uuid');
```

## Builders

Builders are optional helpers. They return Jane-generated request models, not SDK-specific DTOs.

```php
use Lenorix\BeelSdk\Builder\CustomerBuilder;

$customerRequest = CustomerBuilder::create()
    ->name('Acme SL')
    ->nif('B12345678')
    ->email('billing@acme.es')
    ->address('Calle Mayor', '1', '28001', 'Madrid', 'Madrid', 'Spain')
    ->build();

$customer = $company->customers->create($customerRequest);
```

`InvoiceBuilder` supports `type()`, `forCustomer()`, `operationDate()`, `dueDate()`, `series()`, `externalRef()`, `metadata()`, `notes()`, `addLine()`, and `addLineObject()`. BeeL requires an explicit `main_tax` on every normal invoice line; `addLine()` is a convenience shortcut without tax fields, so use `addLineObject()` when building a valid taxable line. `CustomerBuilder` supports name, NIF, email, phone, notes, and address. Each builder checks its documented required fields when `build()` is called.

## Any endpoint

`$beel->request()` calls any API path, like the official Node.js SDK's `beel.raw.GET(...)`. It uses the client's authentication, retries and idempotency keys, and maps errors to `BeelApiError` like every resource method. It is for JSON endpoints and returns the decoded response, including BeeL's envelope; for files use `createPdfArchive()`, `export()` or `getPdf()`:

```php
use Lenorix\BeelSdk\Http\RequestOptions;

$response = $beel->request('GET', '/v1/companies/{company_id}/series/defaults', ['company_id' => 'company-uuid']);
$defaults = $response['data'];

$beel->request('PUT', '/v1/companies/{company_id}/series/defaults', ['company_id' => 'company-uuid'], options: new RequestOptions(idempotencyKey: 'seed-defaults'));
$beel->request('DELETE', '/v1/companies/{company_id}/logo', ['company_id' => 'company-uuid']);
```

In the query, booleans are sent as `true`/`false`, lists as a comma-separated value and maps as `name[key]=value`; `null` values are left out.

### Raw Jane client

`$beel->raw` exposes the generated Jane client, with typed models for every operation in the contract. It uses the same authentication and transport, but it returns Jane's `ErrorResponse` models or exceptions instead of `BeelApiError`:

```php
$identity = $beel->raw->getMyIdentity();
```

New operations become available there after the OpenAPI client is regenerated. Generated classes live under `Lenorix\BeelSdk\Generated`; `src/Generated/` is generated output and should not be edited by hand.

## PDF downloads

`$company->invoices->getPdf($invoiceId)` returns the generated PDF response model, including its signed download URL. BeeL waits for PDF generation (ten seconds by default). `waitSeconds` bounds that wait with `Prefer: wait=N`; `0` answers at once.

If the PDF is still being generated, BeeL answers `202` and `getPdf()` throws `BeelNotReadyError`, with BeeL's `Retry-After` in seconds (or `null` when absent). It does not extend `BeelApiError`, so a generic API error handler does not log it as a failure:

```php
use Lenorix\BeelSdk\Exception\BeelNotReadyError;

try {
    $pdf = $company->invoices->getPdf($invoiceId, waitSeconds: 0);
} catch (BeelNotReadyError $exception) {
    $retryInSeconds = $exception->retryAfter ?? 5;
}
```

### Draft previews, ZIP archives and spreadsheet exports

`$company->invoices->previewPdf($invoiceId)` renders a draft as a PDF without issuing or numbering it, and returns a `BinaryDownload`.

`createPdfArchive()` and `export()` return a `BinaryDownload`. Its `body` is the response stream, which the SDK never reads into memory:

```php
use Lenorix\BeelSdk\Generated\Model\CreateInvoicePdfArchiveRequest;

$download = $company->invoices->createPdfArchive(
    (new CreateInvoicePdfArchiveRequest())->setInvoiceIds($invoiceIds),
);

$file = fopen('/path/to/'.($download->fileName ?? 'invoices.zip'), 'wb');
while (! $download->body->eof()) {
    fwrite($file, $download->body->read(1_048_576));
}
fclose($file);

$download->counts; // ['total' => 10, 'successful' => 9, 'failed' => 1]
```

`fileName` comes from `Content-Disposition` and is reduced to a base name, so it never contains a path. The archive's `counts` has `total`, `successful` and `failed`; the export's has `total`. Errors such as `EXPORT_SELECTION_REQUIRED` or `EXPORT_LIMIT_EXCEEDED` throw `BeelApiError`. Neither operation retries a `5xx` by default, because each attempt builds the file again.

With the default Guzzle client, the body is downloaded to a temporary stream (in memory up to 2 MB, then on disk) before the call returns. For true network streaming, pass a client created with `new \GuzzleHttp\Client(['stream' => true])`; the body can then be read only once.

The legacy convenience method `$beel->downloadPdf($invoiceId)` returns `['buffer' => ..., 'fileName' => ...]`; it uses the deprecated session-focus invoice route. Prefer the company-scoped route for new integrations.

## Webhooks

Verify the raw request body before processing an event. The verifier checks the HMAC-SHA256 signature and timestamp replay window (300 seconds by default):

```php
use Lenorix\BeelSdk\Webhook\WebhookVerifier;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued;

$verifier = new WebhookVerifier($_ENV['BEEL_WEBHOOK_SECRET']);
$event = $verifier->verifyEvent(
    payload: $rawRequestBody,
    signatureHeader: $signatureHeader, // BeeL-Signature request header
);

if ($event->getType() === 'invoice.issued'
    && $event->getData() instanceof WebhookEventDataInvoiceIssued) {
    $invoiceId = $event->getData()->getInvoiceId();
    $invoiceNumber = $event->getData()->getInvoiceNumber();
}
```

Each failure has its own exception, and all of them extend `WebhookVerificationError`:

| Exception | Cause |
|---|---|
| `WebhookHeaderError` | The `BeeL-Signature` header is missing or malformed. |
| `WebhookTimestampError` | The signed timestamp is outside the replay window. It exposes `timestamp`, `now` and `toleranceSeconds`. |
| `WebhookSignatureError` | No signature matches the body: the secret is wrong or was rotated, or the body changed. |
| `WebhookPayloadError` | The signature is valid, but the body is not a JSON object or does not match the event schema. |

To reject malformed or stale requests before computing the HMAC, parse the header and check its timestamp first:

```php
use Lenorix\BeelSdk\Webhook\WebhookSignatureHeader;

$header = WebhookSignatureHeader::parse($signatureHeader); // WebhookHeaderError
$verifier->checkTimestamp($header);                        // WebhookTimestampError
$verifier->checkSignature($rawRequestBody, $header);       // WebhookSignatureError
```

`WebhookSigner` signs bodies the same way BeeL does, which is useful for tests and local development:

```php
use Lenorix\BeelSdk\Webhook\WebhookSigner;

$signatureHeader = (new WebhookSigner($secret))->sign($body); // "t=...,v1=..."
```

`$verifier->toEvent($payload)` builds the typed model from a payload that `verify()` already returned, without checking the signature again. Only pass it verified payloads.

Event field values are also available as enums in `Lenorix\BeelSdk\Enum`: `VeriFactuSubmissionStatus`, `RecurringInvoicePauseReason` and `WebhookAccountRelationship`.

`verifyEvent()` returns Jane's generated `WebhookEvent` model, with `data` denormalized to the generated model for its event type. This is useful when dispatching typed framework events, such as Laravel events. `verify()` remains available when you prefer the decoded payload as an array. Event names are also available as `WebhookEventType` enum cases, for example `WebhookEventType::INVOICE_ISSUED->value`. `WebhookEventType::ACCOUNT_CLAIMED->isProvisionerOnly()` is `true` for the `account.*` events, which BeeL documents as delivered only to the provisioner that created the account.

To build the typed event later from a payload already verified, for example in a queued job, use the static `WebhookVerifier::eventFromPayload($payload)`; it needs no secret and checks no signature, so pass only verified payloads.

## Errors

API errors are mapped to semantic exception classes. All extend `BeelApiError`:

| Exception | HTTP status | Useful properties |
|---|---:|---|
| `BeelAuthError` | 401, 403 | `statusCode`, `apiCode`, `requestId` |
| `BeelNotFoundError` | 404 | `statusCode`, `apiCode`, `requestId` |
| `BeelConflictError` | 409 | `statusCode`, `apiCode`, `details`, `requestId` |
| `BeelValidationError` | 422 | `statusCode`, `apiCode`, `details`, `requestId` |
| `BeelRateLimitError` | 429 | `statusCode`, `retryAfter`, `retryAfterSeconds` |
| `BeelApiError` | Other API errors | `statusCode`, `apiCode`, `details`, `requestId` |

An error without a JSON body, such as an HTML `502` or an empty `503` from a proxy, is mapped the same way, with its real `statusCode`. When BeeL sends no error code, `apiCode` falls back to the same values as the official Node.js SDK: `UNAUTHORIZED`, `FORBIDDEN`, `NOT_FOUND`, `CONFLICT`, `UNPROCESSABLE_ENTITY`, `RATE_LIMIT_EXCEEDED` or `UNKNOWN`. `BeelRateLimitError::$retryAfterSeconds` is `60` when BeeL gives no delay, also like the Node.js SDK; `retryAfter` stays `null` in that case. `BeelNotReadyError` (HTTP `202`, see [PDF downloads](#pdf-downloads)) does not extend `BeelApiError`, because it is not an error.

`$exception->context()` returns `status_code`, `api_code`, `request_id` and `retry_after` as an array, ready for a PSR-3 logging context. It leaves out `details`, because validation errors echo submitted values such as NIFs or amounts; read `$exception->details` explicitly when you need them.

```php
use Lenorix\BeelSdk\Exception\BeelNotFoundError;

try {
    $invoice = $company->invoices->get('invoice-uuid');
} catch (BeelNotFoundError $exception) {
    logger()->warning($exception->getMessage(), ['request_id' => $exception->requestId]);
}
```

## Legacy session-focused resources

The SDK retains the deprecated compatibility surface from the API, including `$beel->invoices`, `$beel->customers`, `$beel->products`, `$beel->series`, and `$beel->configuration`. New integrations should use `$beel->company($companyId)` and its resources so the NIF is explicit in every operation. See the [Multi-NIF migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for route changes and sunset details.

## Differences from the official Node.js SDK

The SDK follows the official [`@beel_es/sdk`](https://www.npmjs.com/package/@beel_es/sdk): the same client options and defaults, resources and method names, error classes, builder methods and messages, and fallback error codes. Its enums are covered too, with every value in the OpenAPI contract, and some the Node.js SDK only declares as types are available here at runtime. When porting code, note these differences:

- **Names:** classes use `Beel` casing (`Beel`, `BeelApiError`, `BeelRateLimitError`…), not `BeeL`. The BeeL error code is `apiCode`, because PHP's `Exception::$code` holds the HTTP status.
- **Error data:** every error keeps the code and `details` BeeL sent. The Node.js SDK replaces the code of 401, 403, 404, 409, 422 and 429 errors with a fixed one, and drops `details` on all of them except 422, so a check such as `apiCode === 'UNPROCESSABLE_ENTITY'` only matches when BeeL sent no code.
- **Arguments and return values:** requests can be arrays in API format, like the Node.js SDK's plain objects, or Jane models. Methods return Jane models (objects with getters), not plain JSON, and list methods return the whole page with its pagination.
- **Retries:** `429` responses are always retried. A `5xx` is retried for GET, PUT and DELETE, and for POST or PATCH only when the request carries an `Idempotency-Key` (POST requests get one automatically unless `autoIdempotencyKey` is `false`). The key stays the same on every attempt. File downloads (`createPdfArchive()`, `export()`) do not retry a `5xx` by default.
- **Webhooks:** every `v1` signature in the header is checked, so a secret rotation does not break verification. The body must be a string with the exact bytes received. `verify()` returns an array and `verifyEvent()` a typed model; failures use the subclasses of `WebhookVerificationError`.
- **Query parameters:** list filters such as `status` accept a single value or a list and are sent as a comma-separated value (`status=DRAFT,ISSUED`), as the OpenAPI contract describes; the Node.js SDK repeats the parameter instead. Booleans are sent as `true`/`false`, like in the Node.js SDK.
- **Request IDs:** `requestId` comes from the `X-Request-Id` header when present, then from `meta.request_id` in the body; the Node.js SDK reads only the body.
- **Any endpoint:** `$beel->request()` is the equivalent of `beel.raw.GET(...)`. `$beel->raw` is the generated Jane client, which does not map errors to `BeelApiError`.
- **Writes without a body:** they are sent as `{}` like in the Node.js SDK, but an existing `Content-Type`, such as a multipart upload, is never replaced.
- **Extras:** every current endpoint has a method, including those without one in the Node.js SDK (`activations`, `invoiceCustomization`, `logo`, `requestLogs`, account imports, `templates`, `previewPdf()`), named in its style. Also `$beel->request()` for any path, `all()` iterators, per-call `withOptions()`, `BinaryDownload` for archives and exports, `$company->representation`, `BeelNotReadyError` with `Retry-After` for PDFs, `WebhookSigner`, and `$beel->me`.

## Documentation and support

- [BeeL API documentation](https://docs.beel.es)
- [OpenAPI specification](https://docs.beel.es/api/openapi)
