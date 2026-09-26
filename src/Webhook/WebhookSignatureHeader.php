<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Webhook;

use Lenorix\BeelSdk\Exception\WebhookHeaderError;

/** A parsed `BeeL-Signature` header (`t=timestamp,v1=signature`). */
final readonly class WebhookSignatureHeader
{
    public const NAME = 'BeeL-Signature';

    /**
     * @param  int  $timestamp  Unix timestamp BeeL signed together with the body.
     * @param  non-empty-list<string>  $signatures  `v1` HMAC-SHA256 signatures, in hexadecimal.
     */
    public function __construct(
        public int $timestamp,
        public array $signatures,
    ) {}

    /**
     * Parse the header without checking its timestamp or signature.
     *
     * @throws WebhookHeaderError If the header is missing or malformed.
     */
    public static function parse(?string $header): self
    {
        if ($header === null || trim($header) === '') {
            throw new WebhookHeaderError('Missing BeeL-Signature header.');
        }

        $timestamp = null;
        $signatures = [];
        foreach (explode(',', $header) as $part) {
            [$key, $value] = array_pad(explode('=', trim($part), 2), 2, null);
            if ($key === 't' && $value !== null && ctype_digit($value)) {
                $timestamp = (int) $value;
            }
            if ($key === 'v1' && $value !== null && $value !== '') {
                $signatures[] = $value;
            }
        }

        if ($timestamp === null || $signatures === []) {
            throw new WebhookHeaderError('Invalid signature header format (expected: t=timestamp,v1=signature).');
        }

        return new self($timestamp, $signatures);
    }

    /** Format the header value as BeeL sends it. */
    public function __toString(): string
    {
        return implode(',', ['t='.$this->timestamp, ...array_map(static fn (string $signature): string => 'v1='.$signature, $this->signatures)]);
    }
}
