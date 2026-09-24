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
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * The provisioned account this event refers to.
     */
    public function setAccountId(string $accountId): self
    {
        $this->initialized['accountId'] = true;
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Your own identifier for the account, to reconcile against your system.
     */
    public function getExternalRef(): string
    {
        return $this->externalRef;
    }

    /**
     * Your own identifier for the account, to reconcile against your system.
     */
    public function setExternalRef(string $externalRef): self
    {
        $this->initialized['externalRef'] = true;
        $this->externalRef = $externalRef;

        return $this;
    }

    /**
     * The NIF (tax id) the holder registered.
     */
    public function getNif(): string
    {
        return $this->nif;
    }

    /**
     * The NIF (tax id) the holder registered.
     */
    public function setNif(string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;

        return $this;
    }

    /**
     * Unique identifier (UUID) of the created company.
     */
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }

    /**
     * Unique identifier (UUID) of the created company.
     */
    public function setCompanyId(?string $companyId): self
    {
        $this->initialized['companyId'] = true;
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Registered legal/fiscal name.
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    /**
     * Registered legal/fiscal name.
     */
    public function setLegalName(?string $legalName): self
    {
        $this->initialized['legalName'] = true;
        $this->legalName = $legalName;

        return $this;
    }
}
