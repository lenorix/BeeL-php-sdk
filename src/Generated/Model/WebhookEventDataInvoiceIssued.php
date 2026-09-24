<?php

namespace Lenorix\BeelSdk\Generated\Model;

class WebhookEventDataInvoiceIssued
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
     * @var string
     */
    protected $invoiceNumber;

    /**
     * @var string|null
     */
    protected $customerEmail;

    /**
     * @var string|null
     */
    protected $customerName;

    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(string $invoiceId): self
    {
        $this->initialized['invoiceId'] = true;
        $this->invoiceId = $invoiceId;

        return $this;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(string $invoiceNumber): self
    {
        $this->initialized['invoiceNumber'] = true;
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    public function getCustomerEmail(): ?string
    {
        return $this->customerEmail;
    }

    public function setCustomerEmail(?string $customerEmail): self
    {
        $this->initialized['customerEmail'] = true;
        $this->customerEmail = $customerEmail;

        return $this;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(?string $customerName): self
    {
        $this->initialized['customerName'] = true;
        $this->customerName = $customerName;

        return $this;
    }
}
