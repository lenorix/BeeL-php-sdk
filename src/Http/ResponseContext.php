<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * Per-client HTTP state shared by resources and the transport.
 *
 * Keeps the final HTTP response available while Jane transforms its body, and
 * carries the request options of the resource call in progress.
 */
final class ResponseContext
{
    private ?ResponseInterface $response = null;

    private ?string $body = null;

    private ?RequestOptions $requestOptions = null;

    /**
     * Run one resource call with its request options, clearing them afterwards even if it throws.
     *
     * @template T
     *
     * @param  callable(): T  $operation
     * @return T
     */
    public function withRequestOptions(?RequestOptions $options, callable $operation): mixed
    {
        $this->requestOptions = $options;

        try {
            return $operation();
        } finally {
            $this->requestOptions = null;
        }
    }

    public function requestOptions(): ?RequestOptions
    {
        return $this->requestOptions;
    }

    public function reset(): void
    {
        $this->response = null;
        $this->body = null;
    }

    public function capture(ResponseInterface $response): void
    {
        $this->response = $response;
        $this->body = null;

        $body = $response->getBody();
        if (! $body->isSeekable()) {
            return;
        }

        $position = $body->tell();
        $this->body = (string) $body;
        $body->seek($position);
    }

    public function response(): ?ResponseInterface
    {
        return $this->response;
    }

    public function body(): ?string
    {
        return $this->body;
    }
}
