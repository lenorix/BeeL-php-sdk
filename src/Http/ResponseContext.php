<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use Psr\Http\Message\ResponseInterface;

/** Keeps the final HTTP response available while Jane transforms its body. */
final class ResponseContext
{
    private ?ResponseInterface $response = null;

    private ?string $body = null;

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
