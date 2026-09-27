<?php

namespace Lenorix\BeelSdk\Generated\Model;

class WebhookEventDataRecurringInvoicePaused
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
     * @var string
     */
    protected $recurringInvoiceId;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string
     */
    protected $reason;

    /**
     * What blocked the emission, in the same vocabulary the emission API returns (the
     * `blockers[]` of a 422 `EMISSION_NOT_READY`). Only for `GENERATION_FAILURE`.
     *
     *
     * @var string|null
     */
    protected $blocker;

    /**
     * @var \DateTime
     */
    protected $since;

    public function getRecurringInvoiceId(): string
    {
        return $this->recurringInvoiceId;
    }

    public function setRecurringInvoiceId(string $recurringInvoiceId): self
    {
        $this->initialized['recurringInvoiceId'] = true;
        $this->recurringInvoiceId = $recurringInvoiceId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;

        return $this;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->initialized['reason'] = true;
        $this->reason = $reason;

        return $this;
    }

    /**
     * What blocked the emission, in the same vocabulary the emission API returns (the
     * `blockers[]` of a 422 `EMISSION_NOT_READY`). Only for `GENERATION_FAILURE`.
     */
    public function getBlocker(): ?string
    {
        return $this->blocker;
    }

    /**
     * What blocked the emission, in the same vocabulary the emission API returns (the
    `blockers[]` of a 422 `EMISSION_NOT_READY`). Only for `GENERATION_FAILURE`.
     */
    public function setBlocker(?string $blocker): self
    {
        $this->initialized['blocker'] = true;
        $this->blocker = $blocker;

        return $this;
    }

    public function getSince(): \DateTime
    {
        return $this->since;
    }

    public function setSince(\DateTime $since): self
    {
        $this->initialized['since'] = true;
        $this->since = $since;

        return $this;
    }
}
