<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class InitiatePaymentConnectionRequest implements AdditionalPropertiesInterface
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
     * Payment provider slug in **lowercase**. Currently only `stripe` (Stripe Connect) is
     * operative; `woocommerce` and `shopify` are reserved for future providers. Any other
     * value answers `422`.
     * 
     *
     * @var string
     */
    protected $provider;
    /**
     * URL of your portal to redirect the account holder back to after the OAuth callback
     * completes. Must be an absolute `https://` URL. On **success** BeeL appends
     * `status=success`, `provider` (slug), `company_id`, `connection_id` and `account`
     * (the provider account id, e.g. `acct_...`). On **error** it appends `status=error`,
     * `provider` and `message`, always a stable uppercase error code: `OAUTH_STATE_INVALID`
     * (the authorization is unknown, expired or already used), `OAUTH_TOKEN_EXCHANGE_FAILED`
     * (the provider rejected the code exchange), `ACCESS_DENIED` (the account holder declined
     * at the provider), `OAUTH_ACCOUNT_CONNECTED_TO_OTHER_COMPANY` (the provider account is
     * already connected to another NIF; disconnect it there first),
     * `PROVIDER_ERROR` (any other provider-reported failure) or
     * `OAUTH_UNEXPECTED`. When omitted, the callback redirects to BeeL's default integrations
     * screen. A `return_url` that is not an absolute `https://` URL with a host is rejected
     * up front with `422` `PAYMENT_RETURN_URL_INVALID`, and no authorization is opened.
     * 
     *
     * @var string
     */
    protected $returnUrl;
    /**
     * Payment provider slug in **lowercase**. Currently only `stripe` (Stripe Connect) is
     * operative; `woocommerce` and `shopify` are reserved for future providers. Any other
     * value answers `422`.
     * 
     *
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }
    /**
    * Payment provider slug in **lowercase**. Currently only `stripe` (Stripe Connect) is
    operative; `woocommerce` and `shopify` are reserved for future providers. Any other
    value answers `422`.
    
    *
    * @param string $provider
    *
    * @return self
    */
    public function setProvider(string $provider): self
    {
        $this->initialized['provider'] = true;
        $this->provider = $provider;
        return $this;
    }
    /**
     * URL of your portal to redirect the account holder back to after the OAuth callback
     * completes. Must be an absolute `https://` URL. On **success** BeeL appends
     * `status=success`, `provider` (slug), `company_id`, `connection_id` and `account`
     * (the provider account id, e.g. `acct_...`). On **error** it appends `status=error`,
     * `provider` and `message`, always a stable uppercase error code: `OAUTH_STATE_INVALID`
     * (the authorization is unknown, expired or already used), `OAUTH_TOKEN_EXCHANGE_FAILED`
     * (the provider rejected the code exchange), `ACCESS_DENIED` (the account holder declined
     * at the provider), `OAUTH_ACCOUNT_CONNECTED_TO_OTHER_COMPANY` (the provider account is
     * already connected to another NIF; disconnect it there first),
     * `PROVIDER_ERROR` (any other provider-reported failure) or
     * `OAUTH_UNEXPECTED`. When omitted, the callback redirects to BeeL's default integrations
     * screen. A `return_url` that is not an absolute `https://` URL with a host is rejected
     * up front with `422` `PAYMENT_RETURN_URL_INVALID`, and no authorization is opened.
     * 
     *
     * @return string
     */
    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }
    /**
    * URL of your portal to redirect the account holder back to after the OAuth callback
    completes. Must be an absolute `https://` URL. On **success** BeeL appends
    `status=success`, `provider` (slug), `company_id`, `connection_id` and `account`
    (the provider account id, e.g. `acct_...`). On **error** it appends `status=error`,
    `provider` and `message`, always a stable uppercase error code: `OAUTH_STATE_INVALID`
    (the authorization is unknown, expired or already used), `OAUTH_TOKEN_EXCHANGE_FAILED`
    (the provider rejected the code exchange), `ACCESS_DENIED` (the account holder declined
    at the provider), `OAUTH_ACCOUNT_CONNECTED_TO_OTHER_COMPANY` (the provider account is
    already connected to another NIF; disconnect it there first),
    `PROVIDER_ERROR` (any other provider-reported failure) or
    `OAUTH_UNEXPECTED`. When omitted, the callback redirects to BeeL's default integrations
    screen. A `return_url` that is not an absolute `https://` URL with a host is rejected
    up front with `422` `PAYMENT_RETURN_URL_INVALID`, and no authorization is opened.
    
    *
    * @param string $returnUrl
    *
    * @return self
    */
    public function setReturnUrl(string $returnUrl): self
    {
        $this->initialized['returnUrl'] = true;
        $this->returnUrl = $returnUrl;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['provider' => ['provider', 'getProvider', 'setProvider'], 'returnUrl' => ['return_url', 'getReturnUrl', 'setReturnUrl']];
    }
}