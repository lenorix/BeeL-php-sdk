<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class InvoiceFiscalData implements AdditionalPropertiesInterface
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
     * Invoice ID
     *
     * @var string
     */
    protected $id;

    /**
     * Invoice number
     *
     * @var string
     */
    protected $invoiceNumber;

    /**
     * Issue date
     *
     * @var \DateTime
     */
    protected $issueDate;

    /**
     * Customer name
     *
     * @var string
     */
    protected $customerName;

    /**
     * Taxable base
     *
     * @var float
     */
    protected $taxableBase;

    /**
     * Total indirect tax amount (IVA, IGIC, IPSI and other rates), not only VAT. See tax_breakdown for the split by tax type.
     *
     * @var float
     */
    protected $totalVat;

    /**
     * IRPF withholding amount
     *
     * @var float
     */
    protected $totalIrpf;

    /**
     * Total invoice amount
     *
     * @var float
     */
    protected $invoiceTotal;

    /**
     * Invoice ID
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Invoice ID
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;

        return $this;
    }

    /**
     * Invoice number
     */
    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    /**
     * Invoice number
     */
    public function setInvoiceNumber(string $invoiceNumber): self
    {
        $this->initialized['invoiceNumber'] = true;
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * Issue date
     */
    public function getIssueDate(): \DateTime
    {
        return $this->issueDate;
    }

    /**
     * Issue date
     */
    public function setIssueDate(\DateTime $issueDate): self
    {
        $this->initialized['issueDate'] = true;
        $this->issueDate = $issueDate;

        return $this;
    }

    /**
     * Customer name
     */
    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    /**
     * Customer name
     */
    public function setCustomerName(string $customerName): self
    {
        $this->initialized['customerName'] = true;
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * Taxable base
     */
    public function getTaxableBase(): float
    {
        return $this->taxableBase;
    }

    /**
     * Taxable base
     */
    public function setTaxableBase(float $taxableBase): self
    {
        $this->initialized['taxableBase'] = true;
        $this->taxableBase = $taxableBase;

        return $this;
    }

    /**
     * Total indirect tax amount (IVA, IGIC, IPSI and other rates), not only VAT. See tax_breakdown for the split by tax type.
     */
    public function getTotalVat(): float
    {
        return $this->totalVat;
    }

    /**
     * Total indirect tax amount (IVA, IGIC, IPSI and other rates), not only VAT. See tax_breakdown for the split by tax type.
     */
    public function setTotalVat(float $totalVat): self
    {
        $this->initialized['totalVat'] = true;
        $this->totalVat = $totalVat;

        return $this;
    }

    /**
     * IRPF withholding amount
     */
    public function getTotalIrpf(): float
    {
        return $this->totalIrpf;
    }

    /**
     * IRPF withholding amount
     */
    public function setTotalIrpf(float $totalIrpf): self
    {
        $this->initialized['totalIrpf'] = true;
        $this->totalIrpf = $totalIrpf;

        return $this;
    }

    /**
     * Total invoice amount
     */
    public function getInvoiceTotal(): float
    {
        return $this->invoiceTotal;
    }

    /**
     * Total invoice amount
     */
    public function setInvoiceTotal(float $invoiceTotal): self
    {
        $this->initialized['invoiceTotal'] = true;
        $this->invoiceTotal = $invoiceTotal;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'invoiceNumber' => ['invoice_number', 'getInvoiceNumber', 'setInvoiceNumber'], 'issueDate' => ['issue_date', 'getIssueDate', 'setIssueDate'], 'customerName' => ['customer_name', 'getCustomerName', 'setCustomerName'], 'taxableBase' => ['taxable_base', 'getTaxableBase', 'setTaxableBase'], 'totalVat' => ['total_vat', 'getTotalVat', 'setTotalVat'], 'totalIrpf' => ['total_irpf', 'getTotalIrpf', 'setTotalIrpf'], 'invoiceTotal' => ['invoice_total', 'getInvoiceTotal', 'setInvoiceTotal']];
    }
}
