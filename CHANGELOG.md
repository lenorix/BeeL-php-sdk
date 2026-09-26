# Changelog

All notable changes to `BeeL-php-sdk` will be documented in this file.

## Unreleased

### Added

- `withOptions(RequestOptions)` on every resource sends an `Idempotency-Key` and extra headers with each request, including operations whose generated endpoint declares no headers. Child resources inherit the options.
- Lazy `all()` iterators that fetch every page of paginated lists, plus `allHistory()`, `allGrants()` and `allDeliveries()`. `$beel->accounts->all()` follows `next_cursor`.
- Webhook exceptions for each failure: `WebhookHeaderError`, `WebhookTimestampError`, `WebhookSignatureError` and `WebhookPayloadError`. All of them extend `WebhookVerificationError`, which is no longer `final`.
- `WebhookSignatureHeader::parse()`, `WebhookVerifier::checkTimestamp()` and `WebhookVerifier::checkSignature()` check a webhook one step at a time.
- `WebhookSigner`, which produces `BeeL-Signature` headers for tests and local development.
- `$beel->me->identity()` and `$beel->me->update()` for `/v1/me`.
- `AccountMembersResource::list()`, `listGrants()` and `AccountInvitationsResource::list()` now accept query options.
