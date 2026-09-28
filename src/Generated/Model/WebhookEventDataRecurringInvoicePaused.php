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
    /**
     * @return string
     */
    public function getRecurringInvoiceId(): string
    {
        return $this->recurringInvoiceId;
    }
    /**
     * @param string $recurringInvoiceId
     *
     * @return self
     */
    public function setRecurringInvoiceId(string $recurringInvoiceId): self
    {
        $this->initialized['recurringInvoiceId'] = true;
        $this->recurringInvoiceId = $recurringInvoiceId;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * @param string|null $name
     *
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }
    /**
     * @param string $reason
     *
     * @return self
     */
    public function setReason(string $reason): self
    {
        $this->initialized['reason'] = true;
        $this->reason = $reason;
        return $this;
    }
    /**
     * What blocked the emission, in the same vocabulary the emission API returns (the
     * `blockers[]` of a 422 `EMISSION_NOT_READY`). Only for `GENERATION_FAILURE`.
     * 
     *
     * @return string|null
     */
    public function getBlocker(): ?string
    {
        return $this->blocker;
    }
    /**
    * What blocked the emission, in the same vocabulary the emission API returns (the
    `blockers[]` of a 422 `EMISSION_NOT_READY`). Only for `GENERATION_FAILURE`.
    
    *
    * @param string|null $blocker
    *
    * @return self
    */
    public function setBlocker(?string $blocker): self
    {
        $this->initialized['blocker'] = true;
        $this->blocker = $blocker;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getSince(): \DateTime
    {
        return $this->since;
    }
    /**
     * @param \DateTime $since
     *
     * @return self
     */
    public function setSince(\DateTime $since): self
    {
        $this->initialized['since'] = true;
        $this->since = $since;
        return $this;
    }
}