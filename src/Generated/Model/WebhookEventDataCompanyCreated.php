<?php

namespace Lenorix\BeelSdk\Generated\Model;

class WebhookEventDataCompanyCreated
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * The provisioned account this event refers to.
     *
     * @var string
     */
    protected $accountId;
    /**
     * Your own identifier for the account, to reconcile against your system.
     *
     * @var string
     */
    protected $externalRef;
    /**
     * The NIF (tax id) the holder registered.
     *
     * @var string
     */
    protected $nif;
    /**
     * Unique identifier (UUID) of the created company.
     *
     * @var string|null
     */
    protected $companyId;
    /**
     * Registered legal/fiscal name.
     *
     * @var string|null
     */
    protected $legalName;
    /**
     * The provisioned account this event refers to.
     *
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }
    /**
     * The provisioned account this event refers to.
     *
     * @param string $accountId
     *
     * @return self
     */
    public function setAccountId(string $accountId): self
    {
        $this->initialized['accountId'] = true;
        $this->accountId = $accountId;
        return $this;
    }
    /**
     * Your own identifier for the account, to reconcile against your system.
     *
     * @return string
     */
    public function getExternalRef(): string
    {
        return $this->externalRef;
    }
    /**
     * Your own identifier for the account, to reconcile against your system.
     *
     * @param string $externalRef
     *
     * @return self
     */
    public function setExternalRef(string $externalRef): self
    {
        $this->initialized['externalRef'] = true;
        $this->externalRef = $externalRef;
        return $this;
    }
    /**
     * The NIF (tax id) the holder registered.
     *
     * @return string
     */
    public function getNif(): string
    {
        return $this->nif;
    }
    /**
     * The NIF (tax id) the holder registered.
     *
     * @param string $nif
     *
     * @return self
     */
    public function setNif(string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;
        return $this;
    }
    /**
     * Unique identifier (UUID) of the created company.
     *
     * @return string|null
     */
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }
    /**
     * Unique identifier (UUID) of the created company.
     *
     * @param string|null $companyId
     *
     * @return self
     */
    public function setCompanyId(?string $companyId): self
    {
        $this->initialized['companyId'] = true;
        $this->companyId = $companyId;
        return $this;
    }
    /**
     * Registered legal/fiscal name.
     *
     * @return string|null
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }
    /**
     * Registered legal/fiscal name.
     *
     * @param string|null $legalName
     *
     * @return self
     */
    public function setLegalName(?string $legalName): self
    {
        $this->initialized['legalName'] = true;
        $this->legalName = $legalName;
        return $this;
    }
}