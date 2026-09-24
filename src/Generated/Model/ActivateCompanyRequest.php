<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ActivateCompanyRequest implements AdditionalPropertiesInterface
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
     * Mode a record lives in — its Test/Live twin. It decides where invoices, customers and
     * quota are accounted.
     *
     * For a company it also decides which AEAT its NIF is registered against: switching a
     * company on in `PROD` is what registers it with the real AEAT, so `aeat_environment`
     * is that same mode and uses this same enum.
     *
     *
     * @var string
     */
    protected $environment;

    /**
     * Where Stripe returns after the card is captured. Only used when switching on in Live with no card on file. May embed Stripe's `{CHECKOUT_SESSION_ID}` template, which is why it is a plain string and not a `uri`: the braces are not legal URI characters.
     *
     * @var string
     */
    protected $successUrl;

    /**
     * Where Stripe returns if the checkout is abandoned.
     *
     * @var string
     */
    protected $cancelUrl;

    /**
     * Mode a record lives in — its Test/Live twin. It decides where invoices, customers and
     * quota are accounted.
     *
     * For a company it also decides which AEAT its NIF is registered against: switching a
     * company on in `PROD` is what registers it with the real AEAT, so `aeat_environment`
     * is that same mode and uses this same enum.
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * Mode a record lives in — its Test/Live twin. It decides where invoices, customers and
    quota are accounted.

    For a company it also decides which AEAT its NIF is registered against: switching a
    company on in `PROD` is what registers it with the real AEAT, so `aeat_environment`
    is that same mode and uses this same enum.
     */
    public function setEnvironment(string $environment): self
    {
        $this->initialized['environment'] = true;
        $this->environment = $environment;

        return $this;
    }

    /**
     * Where Stripe returns after the card is captured. Only used when switching on in Live with no card on file. May embed Stripe's `{CHECKOUT_SESSION_ID}` template, which is why it is a plain string and not a `uri`: the braces are not legal URI characters.
     */
    public function getSuccessUrl(): string
    {
        return $this->successUrl;
    }

    /**
     * Where Stripe returns after the card is captured. Only used when switching on in Live with no card on file. May embed Stripe's `{CHECKOUT_SESSION_ID}` template, which is why it is a plain string and not a `uri`: the braces are not legal URI characters.
     */
    public function setSuccessUrl(string $successUrl): self
    {
        $this->initialized['successUrl'] = true;
        $this->successUrl = $successUrl;

        return $this;
    }

    /**
     * Where Stripe returns if the checkout is abandoned.
     */
    public function getCancelUrl(): string
    {
        return $this->cancelUrl;
    }

    /**
     * Where Stripe returns if the checkout is abandoned.
     */
    public function setCancelUrl(string $cancelUrl): self
    {
        $this->initialized['cancelUrl'] = true;
        $this->cancelUrl = $cancelUrl;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['environment' => ['environment', 'getEnvironment', 'setEnvironment'], 'successUrl' => ['success_url', 'getSuccessUrl', 'setSuccessUrl'], 'cancelUrl' => ['cancel_url', 'getCancelUrl', 'setCancelUrl']];
    }
}
