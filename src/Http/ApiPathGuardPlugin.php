<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

/**
 * Stops a BeeL API request that could reach anything but the resource it names, before the
 * API key is added: an absolute URL would take the key to another host, and an empty, `.`
 * or `..` path segment (from an ID such as `..` or `''`) would point at a parent resource.
 *
 * @internal
 */
final class ApiPathGuardPlugin implements Plugin
{
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $uri = $request->getUri();
        if ($uri->getScheme() !== '' || $uri->getHost() !== '') {
            throw new \InvalidArgumentException(sprintf('BeeL API requests take a path, not the URL "%s": the API key is only sent to the client\'s base URL.', $uri));
        }
        $path = $uri->getPath();
        if (! str_starts_with($path, '/')) {
            throw new \InvalidArgumentException(sprintf('The BeeL API path "%s" must start with "/".', $path));
        }
        foreach (explode('/', substr($path, 1)) as $segment) {
            if (in_array(rawurldecode($segment), ['', '.', '..'], true)) {
                throw new \InvalidArgumentException(sprintf('The BeeL API path "%s" has an empty, "." or ".." segment, as an empty or ".." ID would give; it could reach another resource.', $path));
            }
        }

        return $next($request);
    }
}
