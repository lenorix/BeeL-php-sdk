<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class MyIdentity implements AdditionalPropertiesInterface
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
     * @var string
     */
    protected $accountId;

    /**
     * trade_name ?? legal_name of the active fiscal profile. Null pre-onboarding.
     *
     * @var string|null
     */
    protected $name;

    /**
     * Email address (minimum valid email is 5 chars, e.g. a@b.co)
     *
     * @var string
     */
    protected $email;

    /**
     * URL of the active fiscal profile logo, or null.
     *
     * @var string|null
     */
    protected $logoUrl;

    /**
     * @var string
     */
    protected $language;

    /**
     * The credential this call was authenticated with. Lets a client discover, in a single request, what it is allowed to do and which environment it operates on, instead of learning it from a `403`.
     *
     * @var MyCredential
     */
    protected $credential;

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function setAccountId(string $accountId): self
    {
        $this->initialized['accountId'] = true;
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * trade_name ?? legal_name of the active fiscal profile. Null pre-onboarding.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * trade_name ?? legal_name of the active fiscal profile. Null pre-onboarding.
     */
    public function setName(?string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;

        return $this;
    }

    /**
     * Email address (minimum valid email is 5 chars, e.g. a@b.co)
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Email address (minimum valid email is 5 chars, e.g. a@b.co)
     */
    public function setEmail(string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;

        return $this;
    }

    /**
     * URL of the active fiscal profile logo, or null.
     */
    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    /**
     * URL of the active fiscal profile logo, or null.
     */
    public function setLogoUrl(?string $logoUrl): self
    {
        $this->initialized['logoUrl'] = true;
        $this->logoUrl = $logoUrl;

        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->initialized['language'] = true;
        $this->language = $language;

        return $this;
    }

    /**
     * The credential this call was authenticated with. Lets a client discover, in a single request, what it is allowed to do and which environment it operates on, instead of learning it from a `403`.
     */
    public function getCredential(): MyCredential
    {
        return $this->credential;
    }

    /**
     * The credential this call was authenticated with. Lets a client discover, in a single request, what it is allowed to do and which environment it operates on, instead of learning it from a `403`.
     */
    public function setCredential(MyCredential $credential): self
    {
        $this->initialized['credential'] = true;
        $this->credential = $credential;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['accountId' => ['account_id', 'getAccountId', 'setAccountId'], 'name' => ['name', 'getName', 'setName'], 'email' => ['email', 'getEmail', 'setEmail'], 'logoUrl' => ['logo_url', 'getLogoUrl', 'setLogoUrl'], 'language' => ['language', 'getLanguage', 'setLanguage'], 'credential' => ['credential', 'getCredential', 'setCredential']];
    }
}
