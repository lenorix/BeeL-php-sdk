<?php

namespace Lenorix\BeelSdk\Generated\Model;

class WebhookEventDataRepresentationSigned
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
     * Unique identifier (UUID) of the company whose fiscal representation was signed.
     *
     * @var string
     */
    protected $companyId;

    /**
     * The NIF whose fiscal representation was signed.
     *
     * @var string
     */
    protected $nif;

    /**
     * When the fiscal representation was signed (enabling production invoicing for this NIF).
     *
     * @var \DateTime
     */
    protected $signedAt;

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
     * Unique identifier (UUID) of the company whose fiscal representation was signed.
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    /**
     * Unique identifier (UUID) of the company whose fiscal representation was signed.
     */
    public function setCompanyId(string $companyId): self
    {
        $this->initialized['companyId'] = true;
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * The NIF whose fiscal representation was signed.
     */
    public function getNif(): string
    {
        return $this->nif;
    }

    /**
     * The NIF whose fiscal representation was signed.
     */
    public function setNif(string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;

        return $this;
    }

    /**
     * When the fiscal representation was signed (enabling production invoicing for this NIF).
     */
    public function getSignedAt(): \DateTime
    {
        return $this->signedAt;
    }

    /**
     * When the fiscal representation was signed (enabling production invoicing for this NIF).
     */
    public function setSignedAt(\DateTime $signedAt): self
    {
        $this->initialized['signedAt'] = true;
        $this->signedAt = $signedAt;

        return $this;
    }
}
