<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

/**
 * The fields of an error body, read once. Bodies from gateways and proxies do not follow BeeL's
 * error schema, so only text is taken where BeeL sends text.
 *
 * @internal
 */
final readonly class ErrorBody
{
    /** @param  array<array-key, mixed>  $data */
    private function __construct(private array $data) {}

    public static function fromJson(?string $body): self
    {
        $data = $body === null ? null : json_decode($body, true);

        return new self(is_array($data) ? $data : []);
    }

    public function code(): ?string
    {
        return self::text($this->fields()['code'] ?? null);
    }

    /** BeeL's message, an `error` given as plain text, or an RFC 9457 `detail` or `title`. */
    public function message(): ?string
    {
        $error = $this->data['error'] ?? null;

        return self::text($this->fields()['message'] ?? null) ?? self::text(is_array($error) ? null : $error)
            ?? self::text($this->data['detail'] ?? null) ?? self::text($this->data['title'] ?? null);
    }

    public function details(): mixed
    {
        return $this->fields()['details'] ?? null;
    }

    public function requestId(): ?string
    {
        $meta = $this->data['meta'] ?? null;

        return self::text(is_array($meta) ? ($meta['request_id'] ?? null) : null);
    }

    /** Seconds from `error.retry_after`, a top-level `retry_after` or `error.details.retry_after`. */
    public function retryAfter(): ?int
    {
        $error = is_array($this->data['error'] ?? null) ? $this->data['error'] : [];
        $details = is_array($error['details'] ?? null) ? $error['details'] : [];

        return RetryAfter::fromValue($error['retry_after'] ?? $this->data['retry_after'] ?? $details['retry_after'] ?? null);
    }

    /** @return array<array-key, mixed> The `error` object, or the body itself when it has none. */
    private function fields(): array
    {
        return is_array($this->data['error'] ?? null) ? $this->data['error'] : $this->data;
    }

    /** A non-empty string, or a number written as one; anything else is not usable as text. */
    private static function text(mixed $value): ?string
    {
        return match (true) {
            is_string($value) && $value !== '' => $value,
            is_int($value), is_float($value) => (string) $value,
            default => null,
        };
    }
}
