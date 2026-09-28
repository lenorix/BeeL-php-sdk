<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class FiscalSummaryResponse implements AdditionalPropertiesInterface
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
     * Information about the queried period
     *
     * @var QueriedPeriod
     */
    protected $queriedPeriod;
    /**
     * Total taxable base for the period
     *
     * @var float
     */
    protected $totalTaxableBase;
    /**
     * Total indirect tax for the period (IVA, IGIC, IPSI and other rates), not only VAT. See tax_breakdown for the split by tax type.
     *
     * @var float
     */
    protected $totalVat;
    /**
     * Tax breakdown by type (IVA, IGIC, IPSI) and rate. Allows a single invoice to have multiple tax types.
     *
     * @var list<TaxBreakdownItem>
     */
    protected $taxBreakdown;
    /**
     * DEPRECATED: Use tax_breakdown instead.
     * 
     * Indirect tax breakdown by rate (rate -> amount). It aggregates EVERY indirect tax
     * (IVA, IGIC, IPSI and other rates) by percentage alone, so two different tax types at
     * the same rate collapse into a single entry and cannot be told apart. The rate key is
     * always rendered with three decimals ("21.000", "0.000").
     * 
     * `tax_breakdown` is the replacement: it keeps `tax_type` and `percentage` separate.
     * 
     *
     * @deprecated
     *
     * @var array<string, float>
     */
    protected $vatBreakdownByRate;
    /**
     * Equivalence surcharge breakdown by rate, aggregated over the period. Same shape as
     * `surcharge_breakdown` in the invoice detail. Empty (or absent) when no invoice in the
     * period carries an equivalence surcharge.
     * 
     *
     * @var list<SurchargeBreakdownItem>
     */
    protected $surchargeBreakdown;
    /**
     * Total equivalence surcharge for the period. It is NOT part of `total_vat`: the surcharge
     * is settled by the retailer, not by the issuer, and `total_vat` only carries the main
     * indirect tax.
     * 
     *
     * @var float
     */
    protected $totalEquivalenceSurcharge;
    /**
     * Total IRPF withheld in the period
     *
     * @var float
     */
    protected $totalIrpfWithheld;
    /**
     * Taxable base for the period
     *
     * @var float
     */
    protected $periodBase;
    /**
     * Projected annual taxable base
     *
     * @var float
     */
    protected $projectedAnnualBase;
    /**
     * Estimated annual IRPF based on projected income
     *
     * @var float
     */
    protected $estimatedAnnualIrpf;
    /**
     * Pending annual IRPF (estimated - retained)
     *
     * @var float
     */
    protected $pendingAnnualIrpf;
    /**
     * IRPF breakdown by tax brackets
     *
     * @var list<IrpfBracket>
     */
    protected $bracketDetails;
    /**
     * List of invoices included in the calculation
     *
     * @var list<InvoiceFiscalData>
     */
    protected $invoices;
    /**
     * Total number of invoices
     *
     * @var int
     */
    protected $totalInvoices;
    /**
     * Information about the queried period
     *
     * @return QueriedPeriod
     */
    public function getQueriedPeriod(): QueriedPeriod
    {
        return $this->queriedPeriod;
    }
    /**
     * Information about the queried period
     *
     * @param QueriedPeriod $queriedPeriod
     *
     * @return self
     */
    public function setQueriedPeriod(QueriedPeriod $queriedPeriod): self
    {
        $this->initialized['queriedPeriod'] = true;
        $this->queriedPeriod = $queriedPeriod;
        return $this;
    }
    /**
     * Total taxable base for the period
     *
     * @return float
     */
    public function getTotalTaxableBase(): float
    {
        return $this->totalTaxableBase;
    }
    /**
     * Total taxable base for the period
     *
     * @param float $totalTaxableBase
     *
     * @return self
     */
    public function setTotalTaxableBase(float $totalTaxableBase): self
    {
        $this->initialized['totalTaxableBase'] = true;
        $this->totalTaxableBase = $totalTaxableBase;
        return $this;
    }
    /**
     * Total indirect tax for the period (IVA, IGIC, IPSI and other rates), not only VAT. See tax_breakdown for the split by tax type.
     *
     * @return float
     */
    public function getTotalVat(): float
    {
        return $this->totalVat;
    }
    /**
     * Total indirect tax for the period (IVA, IGIC, IPSI and other rates), not only VAT. See tax_breakdown for the split by tax type.
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
     * Tax breakdown by type (IVA, IGIC, IPSI) and rate. Allows a single invoice to have multiple tax types.
     *
     * @return list<TaxBreakdownItem>
     */
    public function getTaxBreakdown(): array
    {
        return $this->taxBreakdown;
    }
    /**
     * Tax breakdown by type (IVA, IGIC, IPSI) and rate. Allows a single invoice to have multiple tax types.
     *
     * @param list<TaxBreakdownItem> $taxBreakdown
     *
     * @return self
     */
    public function setTaxBreakdown(array $taxBreakdown): self
    {
        $this->initialized['taxBreakdown'] = true;
        $this->taxBreakdown = $taxBreakdown;
        return $this;
    }
    /**
     * DEPRECATED: Use tax_breakdown instead.
     * 
     * Indirect tax breakdown by rate (rate -> amount). It aggregates EVERY indirect tax
     * (IVA, IGIC, IPSI and other rates) by percentage alone, so two different tax types at
     * the same rate collapse into a single entry and cannot be told apart. The rate key is
     * always rendered with three decimals ("21.000", "0.000").
     * 
     * `tax_breakdown` is the replacement: it keeps `tax_type` and `percentage` separate.
     * 
     *
     * @deprecated
     *
     * @return array<string, float>
     */
    public function getVatBreakdownByRate(): iterable
    {
        return $this->vatBreakdownByRate;
    }
    /**
    * DEPRECATED: Use tax_breakdown instead.
    
    Indirect tax breakdown by rate (rate -> amount). It aggregates EVERY indirect tax
    (IVA, IGIC, IPSI and other rates) by percentage alone, so two different tax types at
    the same rate collapse into a single entry and cannot be told apart. The rate key is
    always rendered with three decimals ("21.000", "0.000").
    
    `tax_breakdown` is the replacement: it keeps `tax_type` and `percentage` separate.
    
    *
    * @param array<string, float> $vatBreakdownByRate
    *
    * @deprecated
    *
    * @return self
    */
    public function setVatBreakdownByRate(iterable $vatBreakdownByRate): self
    {
        $this->initialized['vatBreakdownByRate'] = true;
        $this->vatBreakdownByRate = $vatBreakdownByRate;
        return $this;
    }
    /**
     * Equivalence surcharge breakdown by rate, aggregated over the period. Same shape as
     * `surcharge_breakdown` in the invoice detail. Empty (or absent) when no invoice in the
     * period carries an equivalence surcharge.
     * 
     *
     * @return list<SurchargeBreakdownItem>
     */
    public function getSurchargeBreakdown(): array
    {
        return $this->surchargeBreakdown;
    }
    /**
    * Equivalence surcharge breakdown by rate, aggregated over the period. Same shape as
    `surcharge_breakdown` in the invoice detail. Empty (or absent) when no invoice in the
    period carries an equivalence surcharge.
    
    *
    * @param list<SurchargeBreakdownItem> $surchargeBreakdown
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
     * Total equivalence surcharge for the period. It is NOT part of `total_vat`: the surcharge
     * is settled by the retailer, not by the issuer, and `total_vat` only carries the main
     * indirect tax.
     * 
     *
     * @return float
     */
    public function getTotalEquivalenceSurcharge(): float
    {
        return $this->totalEquivalenceSurcharge;
    }
    /**
    * Total equivalence surcharge for the period. It is NOT part of `total_vat`: the surcharge
    is settled by the retailer, not by the issuer, and `total_vat` only carries the main
    indirect tax.
    
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
     * Total IRPF withheld in the period
     *
     * @return float
     */
    public function getTotalIrpfWithheld(): float
    {
        return $this->totalIrpfWithheld;
    }
    /**
     * Total IRPF withheld in the period
     *
     * @param float $totalIrpfWithheld
     *
     * @return self
     */
    public function setTotalIrpfWithheld(float $totalIrpfWithheld): self
    {
        $this->initialized['totalIrpfWithheld'] = true;
        $this->totalIrpfWithheld = $totalIrpfWithheld;
        return $this;
    }
    /**
     * Taxable base for the period
     *
     * @return float
     */
    public function getPeriodBase(): float
    {
        return $this->periodBase;
    }
    /**
     * Taxable base for the period
     *
     * @param float $periodBase
     *
     * @return self
     */
    public function setPeriodBase(float $periodBase): self
    {
        $this->initialized['periodBase'] = true;
        $this->periodBase = $periodBase;
        return $this;
    }
    /**
     * Projected annual taxable base
     *
     * @return float
     */
    public function getProjectedAnnualBase(): float
    {
        return $this->projectedAnnualBase;
    }
    /**
     * Projected annual taxable base
     *
     * @param float $projectedAnnualBase
     *
     * @return self
     */
    public function setProjectedAnnualBase(float $projectedAnnualBase): self
    {
        $this->initialized['projectedAnnualBase'] = true;
        $this->projectedAnnualBase = $projectedAnnualBase;
        return $this;
    }
    /**
     * Estimated annual IRPF based on projected income
     *
     * @return float
     */
    public function getEstimatedAnnualIrpf(): float
    {
        return $this->estimatedAnnualIrpf;
    }
    /**
     * Estimated annual IRPF based on projected income
     *
     * @param float $estimatedAnnualIrpf
     *
     * @return self
     */
    public function setEstimatedAnnualIrpf(float $estimatedAnnualIrpf): self
    {
        $this->initialized['estimatedAnnualIrpf'] = true;
        $this->estimatedAnnualIrpf = $estimatedAnnualIrpf;
        return $this;
    }
    /**
     * Pending annual IRPF (estimated - retained)
     *
     * @return float
     */
    public function getPendingAnnualIrpf(): float
    {
        return $this->pendingAnnualIrpf;
    }
    /**
     * Pending annual IRPF (estimated - retained)
     *
     * @param float $pendingAnnualIrpf
     *
     * @return self
     */
    public function setPendingAnnualIrpf(float $pendingAnnualIrpf): self
    {
        $this->initialized['pendingAnnualIrpf'] = true;
        $this->pendingAnnualIrpf = $pendingAnnualIrpf;
        return $this;
    }
    /**
     * IRPF breakdown by tax brackets
     *
     * @return list<IrpfBracket>
     */
    public function getBracketDetails(): array
    {
        return $this->bracketDetails;
    }
    /**
     * IRPF breakdown by tax brackets
     *
     * @param list<IrpfBracket> $bracketDetails
     *
     * @return self
     */
    public function setBracketDetails(array $bracketDetails): self
    {
        $this->initialized['bracketDetails'] = true;
        $this->bracketDetails = $bracketDetails;
        return $this;
    }
    /**
     * List of invoices included in the calculation
     *
     * @return list<InvoiceFiscalData>
     */
    public function getInvoices(): array
    {
        return $this->invoices;
    }
    /**
     * List of invoices included in the calculation
     *
     * @param list<InvoiceFiscalData> $invoices
     *
     * @return self
     */
    public function setInvoices(array $invoices): self
    {
        $this->initialized['invoices'] = true;
        $this->invoices = $invoices;
        return $this;
    }
    /**
     * Total number of invoices
     *
     * @return int
     */
    public function getTotalInvoices(): int
    {
        return $this->totalInvoices;
    }
    /**
     * Total number of invoices
     *
     * @param int $totalInvoices
     *
     * @return self
     */
    public function setTotalInvoices(int $totalInvoices): self
    {
        $this->initialized['totalInvoices'] = true;
        $this->totalInvoices = $totalInvoices;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['queriedPeriod' => ['queried_period', 'getQueriedPeriod', 'setQueriedPeriod'], 'totalTaxableBase' => ['total_taxable_base', 'getTotalTaxableBase', 'setTotalTaxableBase'], 'totalVat' => ['total_vat', 'getTotalVat', 'setTotalVat'], 'taxBreakdown' => ['tax_breakdown', 'getTaxBreakdown', 'setTaxBreakdown'], 'vatBreakdownByRate' => ['vat_breakdown_by_rate', 'getVatBreakdownByRate', 'setVatBreakdownByRate'], 'surchargeBreakdown' => ['surcharge_breakdown', 'getSurchargeBreakdown', 'setSurchargeBreakdown'], 'totalEquivalenceSurcharge' => ['total_equivalence_surcharge', 'getTotalEquivalenceSurcharge', 'setTotalEquivalenceSurcharge'], 'totalIrpfWithheld' => ['total_irpf_withheld', 'getTotalIrpfWithheld', 'setTotalIrpfWithheld'], 'periodBase' => ['period_base', 'getPeriodBase', 'setPeriodBase'], 'projectedAnnualBase' => ['projected_annual_base', 'getProjectedAnnualBase', 'setProjectedAnnualBase'], 'estimatedAnnualIrpf' => ['estimated_annual_irpf', 'getEstimatedAnnualIrpf', 'setEstimatedAnnualIrpf'], 'pendingAnnualIrpf' => ['pending_annual_irpf', 'getPendingAnnualIrpf', 'setPendingAnnualIrpf'], 'bracketDetails' => ['bracket_details', 'getBracketDetails', 'setBracketDetails'], 'invoices' => ['invoices', 'getInvoices', 'setInvoices'], 'totalInvoices' => ['total_invoices', 'getTotalInvoices', 'setTotalInvoices']];
    }
}