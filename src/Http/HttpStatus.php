<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
final class HttpStatus
{
    /** Whether a response has a `2xx` status. The SDK never follows a redirect, so a `3xx` is not one. */
    public static function isSuccess(ResponseInterface $response): bool
    {
        return $response->getStatusCode() >= 200 && $response->getStatusCode() < 300;
    }
}
