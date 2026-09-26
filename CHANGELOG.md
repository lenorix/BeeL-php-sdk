# Changelog

All notable changes to `BeeL-php-sdk` will be documented in this file.

## Unreleased

### Added

- `createPdfArchive()` and `export()` on company invoices return a `BinaryDownload` with the response stream, file name, content type, length and invoice counts. They used to return `null`, as the generated client discards file bodies. The body is never read into memory, and neither operation retries a `5xx` by default.
- `$company->representation` with `get()`, `generate()`, `documentLink()`, `submit()` and `cancel()`. Errors carry their real HTTP status.
- `RequestOptions(maxRetries: …, retryServerErrors: …)` control retries per call.

### Fixed

- Transports that return non-seekable bodies, such as Guzzle with `'stream' => true`, no longer break JSON responses.
- The SDK no longer copies successful non-JSON response bodies into memory. `Beel::downloadPdf()` now holds the PDF once instead of twice.
- An error status without a JSON body, such as an empty `503` from a proxy, now throws `BeelApiError` instead of a `TypeError`.
- Error responses without a `Content-Type` no longer trigger a PHP deprecation in the generated client before reaching `BeelApiError`.
- `all()` stops if BeeL answers a different page than the one requested, instead of looping forever on the same page.

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
