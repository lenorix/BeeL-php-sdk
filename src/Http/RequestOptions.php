<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

/**
 * Options for the requests made through one resource instance.
 *
 * Pass them with a resource's `withOptions()`. They are applied by the SDK's
 * transport, so they work for every operation, including those whose generated
 * endpoint declares no header parameters.
 */
final readonly class RequestOptions
{
    /** Headers the client controls: credentials belong to the `Beel` instance, and the transport sets the rest. */
    private const RESERVED_HEADERS = ['authorization', 'host', 'content-type', 'content-length'];

    /** @var array<string, string|list<string>> */
    public array $headers;

    /**
     * @param  string|null  $idempotencyKey  `Idempotency-Key` sent on every request made with these options.
     *                                       BeeL accepts letters, digits, `_` and `-`, up to 255 characters.
     * @param  array<array-key, mixed>  $headers  Extra request headers, as `name => value` or `name => list of values`.
     *                                            `Authorization`, `Host`, `Content-Type` and `Content-Length` are rejected.
     */
    public function __construct(
        public ?string $idempotencyKey = null,
        array $headers = [],
    ) {
        if ($idempotencyKey !== null && preg_match('/^[A-Za-z0-9_-]{1,255}$/', $idempotencyKey) !== 1) {
            throw new \InvalidArgumentException('Idempotency key must contain only letters, digits, "_" or "-" and be at most 255 characters.');
        }

        $normalized = [];
        foreach ($headers as $name => $value) {
            if (! is_string($name) || preg_match('/^[!#$%&\'*+.^_`|~0-9A-Za-z-]+$/', $name) !== 1) {
                throw new \InvalidArgumentException('Request header names must be valid HTTP tokens.');
            }
            if (in_array(strtolower($name), self::RESERVED_HEADERS, true)) {
                throw new \InvalidArgumentException("Request header \"{$name}\" is set by the client and cannot be overridden per call.");
            }
            if (is_string($value)) {
                $normalized[$name] = $value;

                continue;
            }
            if (! is_array($value) || ! array_is_list($value) || $value === []) {
                throw new \InvalidArgumentException("Request header \"{$name}\" must be a string or a non-empty list of strings.");
            }
            $values = [];
            foreach ($value as $item) {
                if (! is_string($item)) {
                    throw new \InvalidArgumentException("Request header \"{$name}\" must be a string or a non-empty list of strings.");
                }
                $values[] = $item;
            }
            $normalized[$name] = $values;
        }
        $this->headers = $normalized;
    }

    /**
     * Headers to add to a request, with `Idempotency-Key` last so it takes precedence.
     *
     * @return array<string, string|list<string>>
     */
    public function allHeaders(): array
    {
        $headers = $this->headers;
        if ($this->idempotencyKey !== null) {
            foreach (array_keys($headers) as $name) {
                if (strcasecmp($name, 'Idempotency-Key') === 0) {
                    unset($headers[$name]);
                }
            }
            $headers['Idempotency-Key'] = $this->idempotencyKey;
        }

        return $headers;
    }
}
