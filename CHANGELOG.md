# Changelog

All notable changes to `BeeL-php-sdk` will be documented in this file.

## Unreleased

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
