<?php

namespace Lenorix\BeelSdk\Generated\Model;

class WebhookEventDataInvoiceScheduleFailed
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
    protected $invoiceId;
    /**
     * Usually `null`: the number is assigned on emission, and this invoice was never emitted.
     * 
     *
     * @var string|null
     */
    protected $invoiceNumber;
    /**
     * Legal name of the recipient — what identifies a draft that has no number yet.
     *
     * @var string|null
     */
    protected $customerName;
    /**
     * The date the invoice was due to be issued.
     *
     * @var \DateTime|null
     */
    protected $scheduledFor;
    /**
     * What blocked the emission, in the same vocabulary the emission API returns (the
     * `blockers[]` of a 422 `EMISSION_NOT_READY`). It may be absent when the permanent
     * failure was not a readiness one.
     * 
     *
     * @var string|null
     */
    protected $blocker;
    /**
     * @return string
     */
    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }
    /**
     * @param string $invoiceId
     *
     * @return self
     */
    public function setInvoiceId(string $invoiceId): self
    {
        $this->initialized['invoiceId'] = true;
        $this->invoiceId = $invoiceId;
        return $this;
    }
    /**
     * Usually `null`: the number is assigned on emission, and this invoice was never emitted.
     * 
     *
     * @return string|null
     */
    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }
    /**
     * Usually `null`: the number is assigned on emission, and this invoice was never emitted.
     *
     * @param string|null $invoiceNumber
     *
     * @return self
     */
    public function setInvoiceNumber(?string $invoiceNumber): self
    {
        $this->initialized['invoiceNumber'] = true;
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }
    /**
     * Legal name of the recipient — what identifies a draft that has no number yet.
     *
     * @return string|null
     */
    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }
    /**
     * Legal name of the recipient — what identifies a draft that has no number yet.
     *
     * @param string|null $customerName
     *
     * @return self
     */
    public function setCustomerName(?string $customerName): self
    {
        $this->initialized['customerName'] = true;
        $this->customerName = $customerName;
        return $this;
    }
    /**
     * The date the invoice was due to be issued.
     *
     * @return \DateTime|null
     */
    public function getScheduledFor(): ?\DateTime
    {
        return $this->scheduledFor;
    }
    /**
     * The date the invoice was due to be issued.
     *
     * @param \DateTime|null $scheduledFor
     *
     * @return self
     */
    public function setScheduledFor(?\DateTime $scheduledFor): self
    {
        $this->initialized['scheduledFor'] = true;
        $this->scheduledFor = $scheduledFor;
        return $this;
    }
    /**
     * What blocked the emission, in the same vocabulary the emission API returns (the
     * `blockers[]` of a 422 `EMISSION_NOT_READY`). It may be absent when the permanent
     * failure was not a readiness one.
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
    `blockers[]` of a 422 `EMISSION_NOT_READY`). It may be absent when the permanent
    failure was not a readiness one.
    
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
}