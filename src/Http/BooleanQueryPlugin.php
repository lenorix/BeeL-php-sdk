<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

/**
 * Sends BeeL's boolean query parameters as `true`/`false` instead of the generated client's `1`/`0`.
 *
 * It is registered only for BeeL API requests, so third-party URLs such as signed
 * download links are never modified.
 *
 * @internal
 */
final class BooleanQueryPlugin implements Plugin
{
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $uri = $request->getUri();
        $query = QueryParameters::booleans($uri->getQuery());
        if ($query !== $uri->getQuery()) {
            $request = $request->withUri($uri->withQuery($query), true);
        }

        return $next($request);
    }
}
