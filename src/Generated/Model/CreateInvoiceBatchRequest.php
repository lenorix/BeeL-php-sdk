<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CreateInvoiceBatchRequest implements AdditionalPropertiesInterface
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
     * - **ISSUE**: issue the draft invoices, each one assigned its definitive number.
     * - **STATUS**: change the status of the invoices; requires `new_status`.
     *
     *
     * @var string
     */
    protected $operation;

    /**
     * @var list<string>
     */
    protected $invoiceIds;

    /**
     * Target status. Required when `operation` is `STATUS`.
     *
     * @var string
     */
    protected $newStatus;

    /**
     * Payment date. Required when `new_status` is `PAID`.
     *
     * @var \DateTime
     */
    protected $paymentDate;

    /**
     * - **ISSUE**: issue the draft invoices, each one assigned its definitive number.
     * - **STATUS**: change the status of the invoices; requires `new_status`.
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * - **ISSUE**: issue the draft invoices, each one assigned its definitive number.
    - **STATUS**: change the status of the invoices; requires `new_status`.
     */
    public function setOperation(string $operation): self
    {
        $this->initialized['operation'] = true;
        $this->operation = $operation;

        return $this;
    }

    /**
     * @return list<string>
     */
    public function getInvoiceIds(): array
    {
        return $this->invoiceIds;
    }

    /**
     * @param  list<string>  $invoiceIds
     */
    public function setInvoiceIds(array $invoiceIds): self
    {
        $this->initialized['invoiceIds'] = true;
        $this->invoiceIds = $invoiceIds;

        return $this;
    }

    /**
     * Target status. Required when `operation` is `STATUS`.
     */
    public function getNewStatus(): string
    {
        return $this->newStatus;
    }

    /**
     * Target status. Required when `operation` is `STATUS`.
     */
    public function setNewStatus(string $newStatus): self
    {
        $this->initialized['newStatus'] = true;
        $this->newStatus = $newStatus;

        return $this;
    }

    /**
     * Payment date. Required when `new_status` is `PAID`.
     */
    public function getPaymentDate(): \DateTime
    {
        return $this->paymentDate;
    }

    /**
     * Payment date. Required when `new_status` is `PAID`.
     */
    public function setPaymentDate(\DateTime $paymentDate): self
    {
        $this->initialized['paymentDate'] = true;
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['operation' => ['operation', 'getOperation', 'setOperation'], 'invoiceIds' => ['invoice_ids', 'getInvoiceIds', 'setInvoiceIds'], 'newStatus' => ['new_status', 'getNewStatus', 'setNewStatus'], 'paymentDate' => ['payment_date', 'getPaymentDate', 'setPaymentDate']];
    }
}
