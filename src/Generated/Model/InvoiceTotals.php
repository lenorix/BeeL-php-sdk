<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class InvoiceTotals implements AdditionalPropertiesInterface
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
     * Total taxable base (can be negative in corrective invoices)
     *
     * @var float
     */
    protected $taxableBase;
    /**
     * Total discounts applied (can be negative in corrective invoices)
     *
     * @var float
     */
    protected $totalDiscounts = 0;
    /**
     * @var list<InvoiceTotalsVatBreakdownItem>
     */
    protected $vatBreakdown;
    /**
     * Total indirect tax (IVA, IGIC, IPSI and other rates), not only VAT.
     * Can be negative in corrective invoices.
     * 
     *
     * @var float
     */
    protected $totalVat;
    /**
     * @var list<InvoiceTotalsSurchargeBreakdownItem>
     */
    protected $surchargeBreakdown;
    /**
     * Total equivalence surcharge (can be negative in corrective invoices)
     *
     * @var float
     */
    protected $totalEquivalenceSurcharge = 0;
    /**
     * @var list<InvoiceTotalsIrpfBreakdownItem>
     */
    protected $irpfBreakdown;
    /**
     * Total personal income tax withheld (can be negative in corrective invoices)
     *
     * @var float
     */
    protected $totalIrpf = 0;
    /**
     * Total amount to pay (base + VAT + RE - IRPF, can be negative in corrective invoices)
     *
     * @var float
     */
    protected $invoiceTotal;
    /**
     * Sum of SUPLIDO lines (payments on behalf of the client, art. 78.Tres.3 LIVA).
     * Excluded from the taxable base, VAT and VeriFactu.
     * 
     *
     * @var float
     */
    protected $totalDisbursements = 0;
    /**
     * Total amount paid by the client = `invoice_total` + `total_disbursements`.
     * This is the amount on the PDF and the actual charge. When there are no
     * disbursements (suplidos) it matches `invoice_total`.
     * 
     *
     * @var float
     */
    protected $totalToPay;
    /**
     * Total taxable base (can be negative in corrective invoices)
     *
     * @return float
     */
    public function getTaxableBase(): float
    {
        return $this->taxableBase;
    }
    /**
     * Total taxable base (can be negative in corrective invoices)
     *
     * @param float $taxableBase
     *
     * @return self
     */
    public function setTaxableBase(float $taxableBase): self
    {
        $this->initialized['taxableBase'] = true;
        $this->taxableBase = $taxableBase;
        return $this;
    }
    /**
     * Total discounts applied (can be negative in corrective invoices)
     *
     * @return float
     */
    public function getTotalDiscounts(): float
    {
        return $this->totalDiscounts;
    }
    /**
     * Total discounts applied (can be negative in corrective invoices)
     *
     * @param float $totalDiscounts
     *
     * @return self
     */
    public function setTotalDiscounts(float $totalDiscounts): self
    {
        $this->initialized['totalDiscounts'] = true;
        $this->totalDiscounts = $totalDiscounts;
        return $this;
    }
    /**
     * @return list<InvoiceTotalsVatBreakdownItem>
     */
    public function getVatBreakdown(): array
    {
        return $this->vatBreakdown;
    }
    /**
     * @param list<InvoiceTotalsVatBreakdownItem> $vatBreakdown
     *
     * @return self
     */
    public function setVatBreakdown(array $vatBreakdown): self
    {
        $this->initialized['vatBreakdown'] = true;
        $this->vatBreakdown = $vatBreakdown;
        return $this;
    }
    /**
     * Total indirect tax (IVA, IGIC, IPSI and other rates), not only VAT.
     * Can be negative in corrective invoices.
     * 
     *
     * @return float
     */
    public function getTotalVat(): float
    {
        return $this->totalVat;
    }
    /**
    * Total indirect tax (IVA, IGIC, IPSI and other rates), not only VAT.
    Can be negative in corrective invoices.
    
    *
    * @param float $totalVat
    *
    * @return self
    */
    public function setTotalVat(float $totalVat): self
    {
        $this->initialized['totalVat'] = true;
        $this->totalVat = $totalVat;
        return $this;
    }
    /**
     * @return list<InvoiceTotalsSurchargeBreakdownItem>
     */
    public function getSurchargeBreakdown(): array
    {
        return $this->surchargeBreakdown;
    }
    /**
     * @param list<InvoiceTotalsSurchargeBreakdownItem> $surchargeBreakdown
     *
     * @return self
     */
    public function setSurchargeBreakdown(array $surchargeBreakdown): self
    {
        $this->initialized['surchargeBreakdown'] = true;
        $this->surchargeBreakdown = $surchargeBreakdown;
        return $this;
    }
    /**
     * Total equivalence surcharge (can be negative in corrective invoices)
     *
     * @return float
     */
    public function getTotalEquivalenceSurcharge(): float
    {
        return $this->totalEquivalenceSurcharge;
    }
    /**
     * Total equivalence surcharge (can be negative in corrective invoices)
     *
     * @param float $totalEquivalenceSurcharge
     *
     * @return self
     */
    public function setTotalEquivalenceSurcharge(float $totalEquivalenceSurcharge): self
    {
        $this->initialized['totalEquivalenceSurcharge'] = true;
        $this->totalEquivalenceSurcharge = $totalEquivalenceSurcharge;
        return $this;
    }
    /**
     * @return list<InvoiceTotalsIrpfBreakdownItem>
     */
    public function getIrpfBreakdown(): array
    {
        return $this->irpfBreakdown;
    }
    /**
     * @param list<InvoiceTotalsIrpfBreakdownItem> $irpfBreakdown
     *
     * @return self
     */
    public function setIrpfBreakdown(array $irpfBreakdown): self
    {
        $this->initialized['irpfBreakdown'] = true;
        $this->irpfBreakdown = $irpfBreakdown;
        return $this;
    }
    /**
     * Total personal income tax withheld (can be negative in corrective invoices)
     *
     * @return float
     */
    public function getTotalIrpf(): float
    {
        return $this->totalIrpf;
    }
    /**
     * Total personal income tax withheld (can be negative in corrective invoices)
     *
     * @param float $totalIrpf
     *
     * @return self
     */
    public function setTotalIrpf(float $totalIrpf): self
    {
        $this->initialized['totalIrpf'] = true;
        $this->totalIrpf = $totalIrpf;
        return $this;
    }
    /**
     * Total amount to pay (base + VAT + RE - IRPF, can be negative in corrective invoices)
     *
     * @return float
     */
    public function getInvoiceTotal(): float
    {
        return $this->invoiceTotal;
    }
    /**
     * Total amount to pay (base + VAT + RE - IRPF, can be negative in corrective invoices)
     *
     * @param float $invoiceTotal
     *
     * @return self
     */
    public function setInvoiceTotal(float $invoiceTotal): self
    {
        $this->initialized['invoiceTotal'] = true;
        $this->invoiceTotal = $invoiceTotal;
        return $this;
    }
    /**
     * Sum of SUPLIDO lines (payments on behalf of the client, art. 78.Tres.3 LIVA).
     * Excluded from the taxable base, VAT and VeriFactu.
     * 
     *
     * @return float
     */
    public function getTotalDisbursements(): float
    {
        return $this->totalDisbursements;
    }
    /**
    * Sum of SUPLIDO lines (payments on behalf of the client, art. 78.Tres.3 LIVA).
    Excluded from the taxable base, VAT and VeriFactu.
    
    *
    * @param float $totalDisbursements
    *
    * @return self
    */
    public function setTotalDisbursements(float $totalDisbursements): self
    {
        $this->initialized['totalDisbursements'] = true;
        $this->totalDisbursements = $totalDisbursements;
        return $this;
    }
    /**
     * Total amount paid by the client = `invoice_total` + `total_disbursements`.
     * This is the amount on the PDF and the actual charge. When there are no
     * disbursements (suplidos) it matches `invoice_total`.
     * 
     *
     * @return float
     */
    public function getTotalToPay(): float
    {
        return $this->totalToPay;
    }
    /**
    * Total amount paid by the client = `invoice_total` + `total_disbursements`.
    This is the amount on the PDF and the actual charge. When there are no
    disbursements (suplidos) it matches `invoice_total`.
    
    *
    * @param float $totalToPay
    *
    * @return self
    */
    public function setTotalToPay(float $totalToPay): self
    {
        $this->initialized['totalToPay'] = true;
        $this->totalToPay = $totalToPay;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['taxableBase' => ['taxable_base', 'getTaxableBase', 'setTaxableBase'], 'totalDiscounts' => ['total_discounts', 'getTotalDiscounts', 'setTotalDiscounts'], 'vatBreakdown' => ['vat_breakdown', 'getVatBreakdown', 'setVatBreakdown'], 'totalVat' => ['total_vat', 'getTotalVat', 'setTotalVat'], 'surchargeBreakdown' => ['surcharge_breakdown', 'getSurchargeBreakdown', 'setSurchargeBreakdown'], 'totalEquivalenceSurcharge' => ['total_equivalence_surcharge', 'getTotalEquivalenceSurcharge', 'setTotalEquivalenceSurcharge'], 'irpfBreakdown' => ['irpf_breakdown', 'getIrpfBreakdown', 'setIrpfBreakdown'], 'totalIrpf' => ['total_irpf', 'getTotalIrpf', 'setTotalIrpf'], 'invoiceTotal' => ['invoice_total', 'getInvoiceTotal', 'setInvoiceTotal'], 'totalDisbursements' => ['total_disbursements', 'getTotalDisbursements', 'setTotalDisbursements'], 'totalToPay' => ['total_to_pay', 'getTotalToPay', 'setTotalToPay']];
    }
}