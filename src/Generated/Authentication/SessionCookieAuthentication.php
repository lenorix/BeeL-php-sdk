<?php

namespace Lenorix\BeelSdk\Generated\Authentication;

use Jane\Component\OpenApiRuntime\Client\AuthenticationPlugin;
use Psr\Http\Message\RequestInterface;

class SessionCookieAuthentication implements AuthenticationPlugin
{
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->{'apiKey'} = $apiKey;
    }

    public function authentication(RequestInterface $request): RequestInterface
    {
        return $request;
    }

    public function getScope(): string
    {
        return 'SessionCookie';
    }
}
