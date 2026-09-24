<?php

namespace Lenorix\BeelSdk\Generated\Model;

class WebhookEventDataAccountClaimed
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
     * Email of the account holder who claimed the account.
     *
     * @var string|null
     */
    protected $email;

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
     * Email of the account holder who claimed the account.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Email of the account holder who claimed the account.
     */
    public function setEmail(?string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;

        return $this;
    }
}
