# Changelog

All notable changes to `BeeL-php-sdk` will be documented in this file.

## v0.9.0 - 2026-09-29

### Added

- `BeelException`, an interface `BeelApiError`, `BeelNotReadyError` and `BeelUnexpectedResponseError` implement, to catch every exception about a BeeL response at once; each has `context()` with BeeL's request ID.
- `WebhookEventType::dataModel()` and `requiredDataFields()` give the generated model of an event's `data` and the fields BeeL requires in it.
- `InvoiceBuilder::mainTax()` sets the tax of the lines added with `addLine()`, which also takes a line's own tax as its fifth argument, like the Node.js SDK: BeeL rejects a normal line without one.

### Changed

- Resource constructors require the client's `ResponseContext` and are marked `@internal`: resources are meant to be reached from `Beel` (`$beel->company($id)->invoices`), which always passed it. Code that built them by hand without one, which could not send per-call options, must use the client instead.
- The generated client no longer reads a status an operation does not declare as an `ErrorResponse` (BeeL's `default` response, which `bin/prepare-openapi.php` now drops): called directly through `$beel->raw`, it returns `null` for one. Resource methods are unaffected: they still read such an error from its body, with its code, message and request ID.

### Fixed

- An error status the operation declares took its message only from the generated model: like an undeclared one, it now falls back to the body's plain `error`, `detail` or `title` when BeeL sends no `message`. `BeelApiError::fromErrorResponse()` takes the original exception as an optional fourth argument.
- A `retry_after` in an error's `details` that is negative or not a finite number reached `retryAfter`/`retryAfterSeconds` (such as `-5`), because the exceptions read it without the transport's checks: both now use the same rules.
- The legacy `$beel->invoices->list()` rejected whole numbers for `total_min` and the other amount filters, like the company-scoped list did.
- `getLastResponse()` returned the previous call's response after a call rejected before anything was sent, such as one with an invalid request array: it is now `null` then.
- `$beel->accounts->all()` stopped at a `next_cursor` only when it repeated the current one, so cursors cycling through several pages (A, B, A) were followed forever: it now stops at any cursor already read.
- Numeric list filters rejected valid values: `total_min`/`total_max` and `taxable_base_min`/`taxable_base_max` a whole number, and the product `min_price`/`max_price` and payment event `min_amount`/`max_amount`, which the generated client read as integers, a decimal one. All of them now take both; `bin/prepare-openapi.php` gives BeeL's untyped `number` filters the `double` format.
- `$beel->request()` queries: a `BackedEnum` is sent as its value, `null` items and empty lists are left out, and a large float keeps plain decimal notation (`1e20` was sent as `1.0E+20`); a date object or a list of maps throws `InvalidArgumentException` instead of an `Error` or a `list=Array` query.
- `$beel->request()` sends an empty array body as `{}`, not `[]`.
- A date-time that does not exist, such as `2026-02-30T00:00:00Z` or `T24:00:00`, throws `InvalidDateException` instead of rolling over into the next day.
- `BinaryDownload::$fileName` is safe to save on Windows too: characters Windows forbids become `_` (`:` would have named an alternate data stream), trailing dots and spaces are removed, and a reserved device name such as `CON` gets a `_` prefix.
- A `409 IDEMPOTENCY_KEY_PROCESSING`, which BeeL sends while the first request with the key is still running, was returned as the result of a retried write, so calling again with a new key could duplicate it: it is now retried with the same key after BeeL's `Retry-After`.
- A `5xx` BeeL replays for the key (`Idempotency-Replay: true`) is no longer retried, since the same key would only replay it.
- A `Retry-After` that is neither seconds nor an HTTP date (such as `-1`, `now` or `1.5` read as a clock time) and a non-finite or negative `retry_after` made retries fire at once: they are now ignored, and decimal seconds are rounded up. `BeelNotReadyError::$retryAfter` reads it the same way.
- `$beel->request()` sent the API key to any host given in the path, such as `https://attacker.example/x` or `//attacker.example/x`: it now takes only a path starting with a single `/`, without a query (use `$query`).
- An ID that is empty, `.` or `..`, such as `invoices->delete('..')`, pointed the request at a parent resource (`DELETE /companies/{id}/`): every BeeL request with an empty, `.` or `..` path segment is now rejected with `InvalidArgumentException` before it is sent.
- A redirect (`3xx`) was read as a success, so a write that never happened looked done: it now throws `BeelApiError`, since the SDK never follows redirects.
- A response without a `Content-Type` no longer triggers PHP's "Passing null to parameter #1 ($string) of type string is deprecated" in the generated client, which read BeeL's `default` response without checking the header exists.
- A success status without a body the SDK can read (an undeclared status such as an empty `202` or `204`, or a declared one whose body is empty or not JSON) throws `BeelUnexpectedResponseError`; it ended in a `TypeError`, or a Symfony `NotEncodableValueException` for an empty JSON body. Only the operations that return nothing accept an empty `204`.
- `InvoiceBuilder::operationDate()` and `dueDate()` sent the previous day for a date object in a time zone ahead of UTC, such as `Europe/Madrid` at midnight: they now keep its calendar day.
- `$company->customers->import()` and `$beel->accounts->import()` failed with `MissingOptionsException` unless the caller passed an `Idempotency-Key` header, which BeeL requires there: they now send the key set with `withOptions()`, or a new one.
- `all()` iterators stopped after the first page when BeeL sent `"has_next": null`, which its contract allows; they now fall back to comparing page numbers.
- An error body whose `code`, `message` or `request_id` is not text (such as a proxy's numeric code) throws `BeelApiError` instead of a `TypeError`, and an `error` given as a plain string becomes its message.
- A success response without `data`, or with `"data": null`, throws `BeelUnexpectedResponseError` instead of a `TypeError` or an empty model.
- `verifyEvent()`, `toEvent()` and `WebhookVerifier::eventFromPayload()` throw `WebhookPayloadError` for an event without a field BeeL always sends, in the envelope or in the data of a known type, instead of a model whose getters throw a `TypeError`. `verify()` rejects a body that is an empty JSON list (`[]`), as it did a non-empty one.
- The `data` of an event type this SDK does not know yet is kept as an array, instead of whichever typed model its fields happened to fit: an `invoice.paid` event with an invoice ID and number was read as `WebhookEventDataInvoiceIssued`.
- The published package no longer includes `AGENTS.md`.
- README: the fiscal summary example used a `year` filter BeeL does not accept (it takes `start_date` and `end_date`), and the Node.js comparison said checking every `v1` signature survives a secret rotation, while BeeL invalidates the old secret at once.
- An error status whose JSON `Content-Type` carries a body that is not JSON, such as a proxy's error page, throws the `BeelApiError` for its status instead of a Symfony `NotEncodableValueException`.

## v0.8.0 - 2026-09-29

### Changed

- Optional `Address` and `ResponseMeta` fields that BeeL leaves out read as `null` too, instead of throwing a `TypeError`: 197 more getters, such as `Recipient::getAddress()` and the `getMeta()` of response envelopes, are now nullable, which static analysis reports where their result is used as non-null. Where BeeL requires them, they keep their types, except `Address` in the requests that require it (creating a company or customer, provisioning an account), whose setters now accept `null`. An optional `Pagination` or `TaxInfo`, such as `InvoiceLine::getMainTax()`, still needs `isInitialized()`: BeeL requires them elsewhere and they have required keys or an enum.

### Fixed

- `$company->customers->deleteBulk()` and `$company->products->deleteBulk()` accept `ids` as a list, as well as the comma-separated string BeeL expects; a list threw `InvalidOptionsException` before.

## v0.7.0 - 2026-09-28

Regenerated from BeeL's current OpenAPI contract (still labelled 1.9.0).

### Upgrading from 0.6

- `$company->invoices->send()` and the legacy `sendEmail()` may return the new `...Response202Data` model: with `attach_pdf` and a PDF not generated yet, BeeL queues the email and answers `202`. Both models carry `email_id`.
- `$company->invoices->preview()` throws `BeelNotReadyError` when the invoice PDF is not generated yet (HTTP `202`) instead of failing with a `TypeError`.
- `$account->members->allGrants()` yields `MemberGrant` models, as BeeL now returns them.
- `CreateSeriesRequest` now requires `document_type`, as BeeL does. An array without it throws `InvalidArgumentException` naming the field; a hand-built model without it fails when sent.
- Generated models follow the updated contract (compared method by method against 0.6):
  - removed: `VeriFactu::getChainingHash()` and `setChainingHash()`;
  - `irpf_rate` and `default_irpf_rate` are now `float` instead of `int` (`getIrpfRate()`, `getDefaultIrpfRate()` and their setters in invoice lines, line requests and tax configuration): strict comparisons with an `int` need adjusting;
  - now nullable: `GenerationHistoryResponse::getInvoiceId()` and `WebhookEventDataVeriFactuStatusUpdated::getPreviousStatus()`;
  - 50 new getters and setters on existing models (such as `VoidInvoiceRequest::setIssuedInError()`, `Invoice::getReplacedInvoiceIds()`, `TaxConfiguration::getWithholdingOptions()`), and 15 new classes (`VeriFactuRecord`, `MemberGrant`, `WithholdingOptions`, the `202` send models…).
  - No generated class or client method was removed, and the only client additions are the two new operations.
- Code that catches `BeelApiError` does not catch the new `BeelUnexpectedResponseError`, and code that type-hints `send()`'s return as the `200` model must accept the `202` one too.

- A success status the contract does not declare (BeeL sometimes adds one, as it did with `202` here) now throws `BeelUnexpectedResponseError` instead of a `BeelApiError`: the request may have succeeded, so check `getLastResponse()` before retrying. It has `context()` with the status and request ID for logs.
- Getters of optional fields in what BeeL sends (responses and webhook events) return `null` when BeeL leaves the field out, instead of throwing a `TypeError`: 527 getters, such as `Customer::getTradeName()`, `Product::getUnit()` or `Invoice::getPaymentInfo()`, are now nullable, and so are their setters. Code that passes their result where a non-null value is expected needs a null check (PHPStan reports it from level 8). Required fields keep their types, and the `data` of every response stays non-null.
- Optional references to `Address`, `Pagination`, `ResponseMeta` and `TaxInfo` stay non-nullable, because BeeL requires those models elsewhere: where one may be missing, such as `InvoiceLine::getMainTax()`, check `isInitialized('mainTax')` first.
- `null` in a date-time field throws `InvalidDateException` only where the field is required, instead of silently becoming the current time as it did before 0.5. An optional date-time, such as `sent_at` in a send response, reads a `null` as `null`.

### Changed

- Date-times are read and written by `DateTimeNormalizer`, to which the regenerated client delegates every `date-time` field. It replaces the name-based checks of 0.5 and 0.6: nothing changes for valid values (still `\DateTime` with microseconds), and invalid ones are rejected per field.
- `$beel->request()` returns the JSON as BeeL sent it without checking date-times, since it never turns them into objects; in 0.6 it rejected invalid ones.

### Added

- `$company->invoices->createSimplifiedExchange()` issues a full invoice in exchange for simplified invoices.
- `$company->invoices->listVerifactuRecords()` lists an invoice's VeriFactu records.
- The `payment_method` invoice filter accepts a single value as well as a list, like `status`.
- Arrays passed to resource methods accept date objects (`DateTime`, `DateTimeImmutable`, Carbon…) for date-time fields, sent with their microseconds. Date-only fields and `$beel->request()` bodies still take strings.

### Fixed

- `exemption_reason` and `default_exemption_reason` accept and return `null`, as BeeL documents; OpenAPI 3.0 dropped the `nullable` BeeL wrote next to their reference.
- `$account->webhooks->all()`, `allDeliveries()` and `$account->requestLogs->all()` end the iteration when a page leaves out its list or pagination, instead of throwing a `TypeError`.
- `$company->invoices->preview()` documented a draft PDF render; it returns a temporary URL to a preview image.

## v0.6.2 - 2026-09-28

### Fixed

- `BinaryDownload` dropped the `Content-Type` parameters, so the `charset` of a CSV download was lost. It now keeps it in `BinaryDownload::$charset` (for example `utf-8`, or `null` when absent); `contentType` is still the media type without parameters, such as `text/csv`.

## v0.6.1 - 2026-09-27

### Fixed

- `WebhookEventType::isProvisionerOnly()` returned `true` only for `account.claimed`. BeeL documents `company.created` and `representation.signed` as provisioner-only too, so they now return `true` as well.

## v0.6.0 - 2026-09-27

### Changed

- When BeeL asks for a delay longer than `maxRetryDelayMs`, the SDK no longer waits a shorter time and likely gets another `429`: it stops and throws, with the requested delay in `retryAfterSeconds`. A delay BeeL asks for within `maxRetryDelayMs` is waited exactly, instead of being shortened; `maxRetryDelayMs` otherwise caps the exponential backoff.

### Added

- Connection errors (timeouts, refused or dropped connections, DNS failures) are retried with the same rules as a `5xx`: only for idempotent methods or requests with an `Idempotency-Key`, never when `retryServerErrors` is `false`, with backoff. After the last attempt the original exception is rethrown.

### Fixed

- A `Retry-After` sent as an HTTP date is now read by the exceptions too; `retryAfterSeconds` used to fall back to `60` for it.

## v0.5.0 - 2026-09-27

### Upgrading from 0.4

- `DateTime` values from BeeL now carry microseconds, and date-times sent to BeeL include them (`2026-09-25T12:00:00.123456+00:00`); comparisons that assumed whole seconds may need adjusting.
- `BeelApiError::$apiCode` is never `null`: without a BeeL code it falls back to `UNAUTHORIZED`, `FORBIDDEN`, `NOT_FOUND`, `CONFLICT`, `UNPROCESSABLE_ENTITY`, `RATE_LIMIT_EXCEEDED` or `UNKNOWN`.
- `BeelRateLimitError::$retryAfterSeconds` is an `int` and defaults to `60`.
- `$company->invoices->createPdfArchive()` and `export()` return a `BinaryDownload` instead of `null`.
- `$beel->catalogs->taxTypes()` returns `TaxTypesCatalog`; it threw a `TypeError` on every call before.
- Resource methods declare concrete return types; ten operations answered with `204 No Content` now return `void`.
- Boolean query parameters are sent as `true`/`false` instead of `1`/`0`.
- `InvoiceBuilder::build()` and `CustomerBuilder::build()` return a new model on every call.
- A POST or PATCH without an `Idempotency-Key` is no longer retried after a `5xx`.

### Added

- `createPdfArchive()` and `export()` on company invoices return a `BinaryDownload` with the response stream, file name, content type, length and invoice counts. They used to return `null`, as the generated client discards file bodies. The body is never read into memory, and neither operation retries a `5xx` by default.
- `$company->representation` with `get()`, `generate()`, `documentLink()`, `submit()` and `cancel()`. Errors carry their real HTTP status.
- Methods for every current endpoint without one, named in the Node.js SDK's style: `$company->activations` (`activate()`, `deactivate()`), `$company->invoiceCustomization` (`get()`, `update()`), `$company->logo` (`upload()`, `delete()`), `$company->invoices->previewPdf()`, `$account->requestLogs` (`list()`, `all()`, `get()`), `$beel->accounts->import()` and `previewImport()`, and `$beel->templates` (`accountImport()`, `customerImport()`).
- `BeelPaymentRequiredError` for HTTP 402, with the `checkoutUrl` BeeL returns when a company is switched on in Live without a card on file.
- The `Environment` enum (`TEST`, `PROD`).
- `WebhookVerifier::eventFromPayload()` builds the typed event from a verified payload without a verifier or secret.
- `WebhookEventType::isProvisionerOnly()`, `true` for the `account.*` events BeeL documents as delivered only to the provisioner.
- `$beel->getLastResponse()` returns the PSR-7 response of the last call, like Stripe's `getLastResponse()`, so exact values such as nanosecond date-times can be read without repeating the request.
- `$beel->request()` calls any API path with the client's authentication, retries, per-call options and error mapping, like the Node.js SDK's `beel.raw.GET(...)`.
- List filters such as `status`, `event_kind` or `related_entity_ids` accept a single value as well as a list.
- Every method that takes a request model also accepts an array in API format, like the Node.js SDK's plain objects. Invalid arrays and missing required fields throw `InvalidArgumentException` before sending.
- `RequestOptions(maxRetries: …, retryServerErrors: …)` control retries per call.
- Enums covering those of the official Node.js SDK, with every value in the OpenAPI contract: `VeriFactuSubmissionStatus`, `RecurringInvoicePauseReason` and `WebhookAccountRelationship`.
- The legacy `markSent()` accepts an optional body with `sent_at`, as in the Node.js SDK.

### Changed

- Every resource method now declares its concrete return type instead of `mixed`, so applications get autocompletion and static analysis. Operations answered with `204 No Content` return `void`. A test checks each type against the generated client, so a declared type can never drift from what is returned.
- When BeeL sends no error code, `apiCode` falls back to the Node.js SDK codes (`UNAUTHORIZED`, `FORBIDDEN`, `NOT_FOUND`, `CONFLICT`, `UNPROCESSABLE_ENTITY`, `RATE_LIMIT_EXCEEDED`, `UNKNOWN`) instead of `null`.
- `BeelRateLimitError::$retryAfterSeconds` is `60` when BeeL gives no delay, as in the Node.js SDK, and is now typed `int`.
- A POST, PUT or PATCH without a body is sent as `{}` with `Content-Type: application/json`, as the Node.js SDK does.
- When BeeL sends no error message, `BeelApiError` uses `API error N`, like the Node.js SDK, instead of `BeeL API request failed with HTTP N.` or the generated client's exception message.
- Builder error messages match the Node.js SDK, and `build()` returns a fresh model on every call, so later builder calls never change a model already returned.
- Boolean query parameters are sent to BeeL as `true`/`false`, like in the Node.js SDK, instead of the generated client's `1`/`0`. Third-party URLs, such as signed download links, are never rewritten.
- A rate limit reads `retry_after` from the error body as well, like the Node.js SDK.
- Webhook verification rejects a JSON list body; the payload must be an object.
- The README documents the differences from the official Node.js SDK.

### Fixed

- `$beel->catalogs->taxTypes()` threw a `TypeError` on every call: it declared the response envelope instead of the catalog it returns. It now returns `TaxTypesCatalog` and uses the canonical `/v1/tax-types` route instead of the deprecated `/v1/configuration/tax-types`, like the Node.js SDK.
- `InvoiceBuilder` reported a missing customer as `\Lenorix\BeelSdk\Generated\Model\Customer ID is required.`.
- Transports that return non-seekable bodies, such as Guzzle with `'stream' => true`, no longer break JSON responses.
- The SDK no longer copies successful non-JSON response bodies into memory. `Beel::downloadPdf()` now holds the PDF once instead of twice.
- An error status without a JSON body, such as an empty `503` from a proxy, now throws `BeelApiError` instead of a `TypeError`.
- Error responses without a `Content-Type` no longer trigger a PHP deprecation in the generated client before reaching `BeelApiError`.
- `all()` stops if BeeL answers a different page than the one requested, instead of looping forever on the same page.
- Date-times keep their fractional seconds. Responses and webhooks used to lose them, because the generated client parsed date-times with second precision and the SDK rewrote every response to fit; values in free-form maps such as `metadata` could be rewritten too. The client is now generated to parse date-times with `new \DateTime()` (microseconds, the most PHP holds) and to send them with microseconds, and the SDK no longer rewrites any response or webhook payload. Date-time values are still checked strictly: anything other than `null` or an RFC 3339 date-time, such as `""` or `"tomorrow"`, throws `InvalidDateException` in responses, `WebhookPayloadError` in webhooks and `InvalidArgumentException` in request arrays, instead of silently becoming the current time.

## v0.4.2 - 2026-09-27

### Fixed

- A POST or PATCH without an `Idempotency-Key` is no longer retried after a `5xx`, since BeeL may already have applied it. PATCH requests get no automatic key, so they no longer retry on `5xx` unless you pass an `Idempotency-Key`, for example with `withOptions()`. POST requests without a key only happen with `autoIdempotencyKey: false`. A `429` is still retried for every method.
- Date-time normalization for Jane now rewrites only the fields Jane parses as `date-time`. Before, values in other fields that looked like a date, such as notes, lost their fractional seconds and had `Z` replaced with `+00:00`.

### Changed

- The package is now released under The Unlicense instead of the MIT License. Earlier versions remain available under MIT.

## v0.4.1 - 2026-09-26

### Changed

- `BeelApiError::context()` no longer includes `details`. Validation errors echo submitted values, such as NIFs or amounts, and frameworks that log exception context would write them to logs. `$exception->details` is still available.

## v0.4.0 - 2026-09-26

### Changed

- **Breaking:** `getPdf()` on company and legacy invoices no longer returns `null` while BeeL is still generating the PDF (HTTP 202). It throws `BeelNotReadyError`, which carries the `Retry-After` delay in seconds. Code that checked for `null` must catch the exception instead. `Beel::downloadPdf()` throws it too.

### Added

- `BeelNotReadyError` for `202` responses. It does not extend `BeelApiError`.
- `getPdf($invoiceId, waitSeconds: N)` sends `Prefer: wait=N` to bound how long BeeL waits for the PDF.
- `BeelApiError::context()` and `BeelNotReadyError::context()` return error data for logging.
- `WebhookVerifier::toEvent()` builds the typed event from a payload already returned by `verify()`, without verifying it again.

## v0.3.0 - 2026-09-26

### Added

- `withOptions(RequestOptions)` on every resource sends an `Idempotency-Key` and extra headers with each request, including operations whose generated endpoint declares no headers. Child resources inherit the options.
- Lazy `all()` iterators that fetch every page of paginated lists, plus `allHistory()`, `allGrants()` and `allDeliveries()`. `$beel->accounts->all()` follows `next_cursor`.
- Webhook exceptions for each failure: `WebhookHeaderError`, `WebhookTimestampError`, `WebhookSignatureError` and `WebhookPayloadError`. All of them extend `WebhookVerificationError`, which is no longer `final`.
- `WebhookSignatureHeader::parse()`, `WebhookVerifier::checkTimestamp()` and `WebhookVerifier::checkSignature()` check a webhook one step at a time.
- `WebhookSigner`, which produces `BeeL-Signature` headers for tests and local development.
- `$beel->me->identity()` and `$beel->me->update()` for `/v1/me`.
- `AccountMembersResource::list()`, `listGrants()` and `AccountInvitationsResource::list()` now accept query options.
