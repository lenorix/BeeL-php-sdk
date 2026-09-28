<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class InitiatePaymentConnectionResponseData implements AdditionalPropertiesInterface
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
     * URL where the NIF's holder authorizes the Stripe Connect connection.
     *
     * @var string
     */
    protected $authorizationUrl;
    /**
     * URL where the NIF's holder authorizes the Stripe Connect connection.
     *
     * @return string
     */
    public function getAuthorizationUrl(): string
    {
        return $this->authorizationUrl;
    }
    /**
     * URL where the NIF's holder authorizes the Stripe Connect connection.
     *
     * @param string $authorizationUrl
     *
     * @return self
     */
    public function setAuthorizationUrl(string $authorizationUrl): self
    {
        $this->initialized['authorizationUrl'] = true;
        $this->authorizationUrl = $authorizationUrl;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['authorizationUrl' => ['authorization_url', 'getAuthorizationUrl', 'setAuthorizationUrl']];
    }
}