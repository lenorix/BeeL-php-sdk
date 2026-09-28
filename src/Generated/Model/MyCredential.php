<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class MyCredential implements AdditionalPropertiesInterface
{
    use AdditionalAndPatternProperties;

    /**
     * @var array
     */
    protected $initialized = [];

    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }

    /**
     * How the caller authenticated.
     *
     * * `api_key` - a secret key sent as a bearer token.
     * * `oauth_token` - an access token issued by the authorisation server.
     * * `session` - a browser session cookie.
     *
     *
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $environment;

    /**
     * Permissions granted to this credential, each named after the resource it covers and the action it allows. For a key or token these are the scopes it was issued with; for a session they are the permissions its holder's role grants on the account and on the company in focus. Empty means the credential can only read its own identity.
     *
     * @var list<string>
     */
    protected $scopes;

    /**
     * How the caller authenticated.
     *
     * * `api_key` - a secret key sent as a bearer token.
     * * `oauth_token` - an access token issued by the authorisation server.
     * * `session` - a browser session cookie.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * How the caller authenticated.

     * `api_key` - a secret key sent as a bearer token.
     * `oauth_token` - an access token issued by the authorisation server.
     * `session` - a browser session cookie.
     */
    public function setType(string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;

        return $this;
    }

    public function getEnvironment(): string
    {
        return $this->environment;
    }

    public function setEnvironment(string $environment): self
    {
        $this->initialized['environment'] = true;
        $this->environment = $environment;

        return $this;
    }

    /**
     * Permissions granted to this credential, each named after the resource it covers and the action it allows. For a key or token these are the scopes it was issued with; for a session they are the permissions its holder's role grants on the account and on the company in focus. Empty means the credential can only read its own identity.
     *
     * @return list<string>
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * Permissions granted to this credential, each named after the resource it covers and the action it allows. For a key or token these are the scopes it was issued with; for a session they are the permissions its holder's role grants on the account and on the company in focus. Empty means the credential can only read its own identity.
     *
     * @param  list<string>  $scopes
     */
    public function setScopes(array $scopes): self
    {
        $this->initialized['scopes'] = true;
        $this->scopes = $scopes;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['type' => ['type', 'getType', 'setType'], 'environment' => ['environment', 'getEnvironment', 'setEnvironment'], 'scopes' => ['scopes', 'getScopes', 'setScopes']];
    }
}
