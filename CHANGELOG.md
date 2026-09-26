# Changelog

All notable changes to `BeeL-php-sdk` will be documented in this file.

## Unreleased

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
