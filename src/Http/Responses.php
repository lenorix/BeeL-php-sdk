<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
final class Responses
{
    /** Whether a response has a `2xx` status. The SDK never follows a redirect, so a `3xx` is not one. */
    public static function isSuccess(ResponseInterface $response): bool
    {
        return $response->getStatusCode() >= 200 && $response->getStatusCode() < 300;
    }

    public static function isJson(ResponseInterface $response): bool
    {
        return str_contains(strtolower($response->getHeaderLine('Content-Type')), 'json');
    }

    /** Read a response body and leave the stream where it was; null when it cannot be read twice. */
    public static function peekBody(ResponseInterface $response): ?string
    {
        $stream = $response->getBody();
        if (! $stream->isSeekable()) {
            return null;
        }
        $position = $stream->tell();
        $body = (string) $stream;
        $stream->seek($position);

        return $body;
    }
}
