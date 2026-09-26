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

Create the invoice first and issue it when it is ready. The generated Jane model returned by the SDK is available directly, so its getters and the complete BeeL response remain accessible.

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

`maxRetries` is the maximum number of retries after the first attempt. The SDK retries `429` and `5xx` responses with exponential backoff, honors `Retry-After` when provided up to `maxRetryDelayMs`, and uses the same idempotency key for every retry of a POST. It does not retry other client errors.

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

The company scope exposes `invoices`, `customers`, `products`, `series`, `recurringInvoices`, `paymentConnections`, `taxConfiguration`, and `verifactuConfiguration`, along with company operations such as `get()`, `update()`, `delete()`, `fiscalSummary()`, and `issuingReadiness()`.

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

Filters and `limit` apply to every page, and `page` sets the first page to read. Iterators are available for company invoices, customers, products, series, recurring invoices (`all()` and `allHistory()`), payment events, and for account companies, members (`all()` and `allGrants()`), invitations, webhooks (`all()` and `allDeliveries()`), emails, and `$beel->accounts->all()`, which follows BeeL's `next_cursor`.

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

The options are added by the SDK's transport, so they work for every operation, including those whose generated endpoint declares no header parameters. A stable idempotency key lets you retry a write safely after a timeout or a crash: BeeL returns the stored response instead of repeating the operation. The same key is sent on every request made through the copy, so scope a copy with an idempotency key to one write. Options take precedence over headers passed as method arguments. `Authorization`, `Host`, `Content-Type` and `Content-Length` cannot be set per call: the API key belongs to the `Beel` instance, so use one instance per credential.

## Identity

`$beel->me->identity()` returns the account the API key belongs to and describes the key itself, including its environment and scopes. It needs no scope, so it also works as a credentials check:

```php
$identity = $beel->me->identity();
$identity->getAccountId();
$identity->getCredential()->getEnvironment();
$identity->getCredential()->getScopes();
```

## Accounts and payment connections

Account resources are scoped independently from NIF resources:

```php
$account = $beel->account('account-uuid');

$accountData = $account->get();
$companies = $account->companies->list();
$members = $account->members->list();
$invitations = $account->invitations->list();
$webhooks = $account->webhooks->list();
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

## Raw Jane client

`$beel->raw` exposes the generated Jane client for operations without a handwritten convenience wrapper. It uses the same configured authentication and transport:

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

`verifyEvent()` returns Jane's generated `WebhookEvent` model, with `data` denormalized to the generated model for its event type. This is useful when dispatching typed framework events, such as Laravel events. `verify()` remains available when you prefer the decoded payload as an array. Event names are also available as `WebhookEventType` enum cases, for example `WebhookEventType::INVOICE_ISSUED->value`.

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

`$exception->context()` returns these fields as an array, ready for a PSR-3 logging context.

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

## Documentation and support

- [BeeL API documentation](https://docs.beel.es)
- [OpenAPI specification](https://docs.beel.es/api/openapi)
