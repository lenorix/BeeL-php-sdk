<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1InvoicesBulkStatusPostBody implements AdditionalPropertiesInterface
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
     * List of invoice IDs to update
     *
     * @var list<string>
     */
    protected $invoiceIds;

    /**
     * Target status for the invoices
     *
     * @var string
     */
    protected $newStatus;

    /**
     * Payment date (required when new_status is PAID)
     *
     * @var \DateTime
     */
    protected $paymentDate;

    /**
     * List of invoice IDs to update
     *
     * @return list<string>
     */
    public function getInvoiceIds(): array
    {
        return $this->invoiceIds;
    }

    /**
     * List of invoice IDs to update
     *
     * @param  list<string>  $invoiceIds
     */
    public function setInvoiceIds(array $invoiceIds): self
    {
        $this->initialized['invoiceIds'] = true;
        $this->invoiceIds = $invoiceIds;

        return $this;
    }

    /**
     * Target status for the invoices
     */
    public function getNewStatus(): string
    {
        return $this->newStatus;
    }

    /**
     * Target status for the invoices
     */
    public function setNewStatus(string $newStatus): self
    {
        $this->initialized['newStatus'] = true;
        $this->newStatus = $newStatus;

        return $this;
    }

    /**
     * Payment date (required when new_status is PAID)
     */
    public function getPaymentDate(): \DateTime
    {
        return $this->paymentDate;
    }

    /**
     * Payment date (required when new_status is PAID)
     */
    public function setPaymentDate(\DateTime $paymentDate): self
    {
        $this->initialized['paymentDate'] = true;
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['invoiceIds' => ['invoice_ids', 'getInvoiceIds', 'setInvoiceIds'], 'newStatus' => ['new_status', 'getNewStatus', 'setNewStatus'], 'paymentDate' => ['payment_date', 'getPaymentDate', 'setPaymentDate']];
    }
}
