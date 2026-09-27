<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use GuzzleHttp\Psr7\Utils;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Validates date-time values in BeeL JSON responses before the generated client reads them.
 *
 * @internal
 */
final class DateTimeGuardPlugin implements Plugin
{
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(static function (ResponseInterface $response): ResponseInterface {
            if (! str_contains(strtolower($response->getHeaderLine('Content-Type')), 'json')) {
                return $response;
            }

            $body = $response->getBody();
            $position = $body->isSeekable() ? $body->tell() : null;
            $contents = (string) $body;
            DateTimeValues::assertJson($contents);

            if ($position === null) {
                // A non-seekable body was consumed by the read above.
                return $response->withBody(Utils::streamFor($contents));
            }
            $body->seek($position);

            return $response;
        });
    }
}
