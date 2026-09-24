<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class InvoiceLine implements AdditionalPropertiesInterface
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
     * Description of the invoiced concept. Required for NORMAL lines;
     * optional for SUPLIDO lines (may be empty or absent).
     *
     *
     * @var string
     */
    protected $description;

    /**
     * Product/service quantity (can be negative in corrective invoices)
     *
     * @var float
     */
    protected $quantity;

    /**
     * @var string
     */
    protected $unit = 'hours';

    /**
     * Unit price before taxes (can be negative in corrective invoices).
     * Supports up to 4 decimal places for micro-pricing (e.g., €0.0897/unit for labels, packaging).
     * Final amounts are always rounded to 2 decimals.
     *
     * This range is wider than the `maximum` the request accepts for `unit_price`, and on
     * purpose: on a line priced by declared total the unit price is not sent but derived
     * (total ÷ quantity), so what comes back can exceed what you are allowed to send.
     *
     *
     * @var float
     */
    protected $unitPrice;

    /**
     * Discount percentage applied (0-100)
     *
     * @var float
     */
    protected $discountPercentage = 0;

    /**
     * Complete tax information with cross-validations:
     * - IVA: real rates 4, 5, 10, 21 (see below for 0)
     * - IGIC: 0, 3, 5, 7, 9.5, 15, 20 — here 0 is the real "Tipo Cero"
     * - IPSI: real rates 0.5, 1, 2, 4, 8, 10 (see below for 0)
     * - OTHER: any percentage between 0 and 100
     *
     * **0 % under IVA and IPSI is not a rate, it is the exemption sentinel.** It is accepted
     * on a line, but only together with an `exemption_reason` (exempt or non-subject
     * operation); on its own it says nothing and the line is rejected. That is why
     * `GET /v1/tax-types` publishes 4, 5, 10 and 21 for IVA and not 0: the legitimate way
     * to a 0 % IVA line is through an exemption reason, which the same response also
     * publishes. IGIC is different — its 0 % is a real legal rate (basic necessities) and
     * needs no reason.
     *
     * **IVA 5 %** (RD-ley 11/2022 and its extensions, on electricity, gas and basic
     * foodstuffs) is no longer in force for new operations, but it stays valid: corrective
     * invoices and late-filed invoices for the periods when it applied must be able to carry
     * it. Its equivalence surcharge pair is 0.625.
     *
     * Exception: when regime_key = "17" (OSS/IOSS) the invoice applies the destination
     * country VAT instead of the Spanish one, so any percentage in the EU range [0, 27]
     * is accepted regardless of the tax type set — including 0 without an exemption reason.
     *
     *
     * @var TaxInfo
     */
    protected $mainTax;

    /**
     * Equivalence surcharge percentage in decimal format.
     * Pairs allowed (rate ↔ recargo): 4↔0.5, 5↔0.625 (RD-ley 11/2022), 10↔1.4, 21↔5.2.
     * The backend automatically normalizes equivalent formats (5.20 → 5.2).
     *
     *
     * @var float
     */
    protected $equivalenceSurchargeRate;

    /**
     * Personal income tax/withholding percentage in integer format.
     * Allowed values: 0 (exempt), 1 (agricultural/livestock/forestry), 2 (reduced for modules), 7, 15, 19, 24 (non-residents).
     *
     *
     * @var int
     */
    protected $irpfRate;

    /**
     * Tax exemption reason code per Spanish VAT Law (Ley 37/1992 LIVA).
     * VeriFactu mapping: EXENTA_ART_20→E1, EXENTA_ART_21→E2, EXENTA_ART_22→E3,
     * EXENTA_ART_24→E4, EXENTA_ART_25→E5, rest→E6. ISP→S2, NO_SUJETA→N1/N2.
     * When OTRO, a custom text must be provided in exemption_reason_text.
     *
     *
     * @var string
     */
    protected $exemptionReason;

    /**
     * Custom exemption text. Only used when exemption_reason is OTRO.
     *
     * @var string|null
     */
    protected $exemptionReasonText;

    /**
     * Line taxable base (after discount, can be negative in corrective invoices)
     *
     * @var float
     */
    protected $taxableBase;

    /**
     * Line total with taxes (can be negative in corrective invoices)
     *
     * @var float
     */
    protected $lineTotal;

    /**
     * How the line amount was entered. `TOTAL_EXCLUDING_TAX` = total-declared
     * mode: `total_excluding_tax` is the exact taxable base and `unit_price`
     * is derived and informational (`total / quantity`, 4 decimals).
     * `TOTAL_INCLUDING_TAX` = tax-inclusive total-declared mode:
     * `total_including_tax` is what the customer paid (taxable base + VAT +
     * equivalence surcharge) and the engine works the breakdown backwards so
     * the rounded amounts add up to the declared total exactly.
     *
     *
     * @var string
     */
    protected $pricingMode = 'UNIT_PRICE';

    /**
     * Declared line total excluding taxes. Only present on lines with
     * `pricing_mode = TOTAL_EXCLUDING_TAX`. Unlike `line_total`, it never
     * includes taxes nor subtracts IRPF withholding.
     *
     *
     * @var float
     */
    protected $totalExcludingTax;

    /**
     * Declared line total including taxes (taxable base + VAT + equivalence
     * surcharge; IRPF withholding is never subtracted). Only present on lines
     * with `pricing_mode = TOTAL_INCLUDING_TAX`. The invariant
     * `taxable_base + VAT + surcharge = total_including_tax` holds exactly.
     *
     *
     * @var float
     */
    protected $totalIncludingTax;

    /**
     * Fiscal line type.
     * - **NORMAL**: standard line; contributes to the taxable base and VAT.
     * - **SUPLIDO**: payment made on behalf of the final client (art. 78.Tres.3 LIVA);
     *   excluded from the taxable base, VAT and VeriFactu.
     *
     *
     * @var string
     */
    protected $lineType = 'NORMAL';

    /**
     * Reference to the original invoice issued by the third party in the client's name.
     * Required when line_type=SUPLIDO.
     *
     *
     * @var string|null
     */
    protected $sourceInvoiceReference;

    /**
     * Ids of the issued invoices that make up the SUPLIDO. They may belong to the issuing
     * account or to accounts it manages with VIEW access. Their
     * sum is the disbursement amount (never typed by hand). Audit traceability.
     * Only present on lines with line_type=SUPLIDO.
     *
     *
     * @var list<string>
     */
    protected $sourceInvoiceIds;

    /**
     * Description of the invoiced concept. Required for NORMAL lines;
     * optional for SUPLIDO lines (may be empty or absent).
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Description of the invoiced concept. Required for NORMAL lines;
    optional for SUPLIDO lines (may be empty or absent).
     */
    public function setDescription(string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;

        return $this;
    }

    /**
     * Product/service quantity (can be negative in corrective invoices)
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * Product/service quantity (can be negative in corrective invoices)
     */
    public function setQuantity(float $quantity): self
    {
        $this->initialized['quantity'] = true;
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->initialized['unit'] = true;
        $this->unit = $unit;

        return $this;
    }

    /**
     * Unit price before taxes (can be negative in corrective invoices).
     * Supports up to 4 decimal places for micro-pricing (e.g., €0.0897/unit for labels, packaging).
     * Final amounts are always rounded to 2 decimals.
     *
     * This range is wider than the `maximum` the request accepts for `unit_price`, and on
     * purpose: on a line priced by declared total the unit price is not sent but derived
     * (total ÷ quantity), so what comes back can exceed what you are allowed to send.
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * Unit price before taxes (can be negative in corrective invoices).
    Supports up to 4 decimal places for micro-pricing (e.g., €0.0897/unit for labels, packaging).
    Final amounts are always rounded to 2 decimals.

    This range is wider than the `maximum` the request accepts for `unit_price`, and on
    purpose: on a line priced by declared total the unit price is not sent but derived
    (total ÷ quantity), so what comes back can exceed what you are allowed to send.
     */
    public function setUnitPrice(float $unitPrice): self
    {
        $this->initialized['unitPrice'] = true;
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Discount percentage applied (0-100)
     */
    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }

    /**
     * Discount percentage applied (0-100)
     */
    public function setDiscountPercentage(float $discountPercentage): self
    {
        $this->initialized['discountPercentage'] = true;
        $this->discountPercentage = $discountPercentage;

        return $this;
    }

    /**
     * Complete tax information with cross-validations:
     * - IVA: real rates 4, 5, 10, 21 (see below for 0)
     * - IGIC: 0, 3, 5, 7, 9.5, 15, 20 — here 0 is the real "Tipo Cero"
     * - IPSI: real rates 0.5, 1, 2, 4, 8, 10 (see below for 0)
     * - OTHER: any percentage between 0 and 100
     *
     * **0 % under IVA and IPSI is not a rate, it is the exemption sentinel.** It is accepted
     * on a line, but only together with an `exemption_reason` (exempt or non-subject
     * operation); on its own it says nothing and the line is rejected. That is why
     * `GET /v1/tax-types` publishes 4, 5, 10 and 21 for IVA and not 0: the legitimate way
     * to a 0 % IVA line is through an exemption reason, which the same response also
     * publishes. IGIC is different — its 0 % is a real legal rate (basic necessities) and
     * needs no reason.
     *
     * **IVA 5 %** (RD-ley 11/2022 and its extensions, on electricity, gas and basic
     * foodstuffs) is no longer in force for new operations, but it stays valid: corrective
     * invoices and late-filed invoices for the periods when it applied must be able to carry
     * it. Its equivalence surcharge pair is 0.625.
     *
     * Exception: when regime_key = "17" (OSS/IOSS) the invoice applies the destination
     * country VAT instead of the Spanish one, so any percentage in the EU range [0, 27]
     * is accepted regardless of the tax type set — including 0 without an exemption reason.
     */
    public function getMainTax(): TaxInfo
    {
        return $this->mainTax;
    }

    /**
     * Complete tax information with cross-validations:
    - IVA: real rates 4, 5, 10, 21 (see below for 0)
    - IGIC: 0, 3, 5, 7, 9.5, 15, 20 — here 0 is the real "Tipo Cero"
    - IPSI: real rates 0.5, 1, 2, 4, 8, 10 (see below for 0)
    - OTHER: any percentage between 0 and 100

     **0 % under IVA and IPSI is not a rate, it is the exemption sentinel.** It is accepted
    on a line, but only together with an `exemption_reason` (exempt or non-subject
    operation); on its own it says nothing and the line is rejected. That is why
    `GET /v1/tax-types` publishes 4, 5, 10 and 21 for IVA and not 0: the legitimate way
    to a 0 % IVA line is through an exemption reason, which the same response also
    publishes. IGIC is different — its 0 % is a real legal rate (basic necessities) and
    needs no reason.

     **IVA 5 %** (RD-ley 11/2022 and its extensions, on electricity, gas and basic
    foodstuffs) is no longer in force for new operations, but it stays valid: corrective
    invoices and late-filed invoices for the periods when it applied must be able to carry
    it. Its equivalence surcharge pair is 0.625.

    Exception: when regime_key = "17" (OSS/IOSS) the invoice applies the destination
    country VAT instead of the Spanish one, so any percentage in the EU range [0, 27]
    is accepted regardless of the tax type set — including 0 without an exemption reason.
     */
    public function setMainTax(TaxInfo $mainTax): self
    {
        $this->initialized['mainTax'] = true;
        $this->mainTax = $mainTax;

        return $this;
    }

    /**
     * Equivalence surcharge percentage in decimal format.
     * Pairs allowed (rate ↔ recargo): 4↔0.5, 5↔0.625 (RD-ley 11/2022), 10↔1.4, 21↔5.2.
     * The backend automatically normalizes equivalent formats (5.20 → 5.2).
     */
    public function getEquivalenceSurchargeRate(): float
    {
        return $this->equivalenceSurchargeRate;
    }

    /**
     * Equivalence surcharge percentage in decimal format.
    Pairs allowed (rate ↔ recargo): 4↔0.5, 5↔0.625 (RD-ley 11/2022), 10↔1.4, 21↔5.2.
    The backend automatically normalizes equivalent formats (5.20 → 5.2).
     */
    public function setEquivalenceSurchargeRate(float $equivalenceSurchargeRate): self
    {
        $this->initialized['equivalenceSurchargeRate'] = true;
        $this->equivalenceSurchargeRate = $equivalenceSurchargeRate;

        return $this;
    }

    /**
     * Personal income tax/withholding percentage in integer format.
     * Allowed values: 0 (exempt), 1 (agricultural/livestock/forestry), 2 (reduced for modules), 7, 15, 19, 24 (non-residents).
     */
    public function getIrpfRate(): int
    {
        return $this->irpfRate;
    }

    /**
     * Personal income tax/withholding percentage in integer format.
    Allowed values: 0 (exempt), 1 (agricultural/livestock/forestry), 2 (reduced for modules), 7, 15, 19, 24 (non-residents).
     */
    public function setIrpfRate(int $irpfRate): self
    {
        $this->initialized['irpfRate'] = true;
        $this->irpfRate = $irpfRate;

        return $this;
    }

    /**
     * Tax exemption reason code per Spanish VAT Law (Ley 37/1992 LIVA).
     * VeriFactu mapping: EXENTA_ART_20→E1, EXENTA_ART_21→E2, EXENTA_ART_22→E3,
     * EXENTA_ART_24→E4, EXENTA_ART_25→E5, rest→E6. ISP→S2, NO_SUJETA→N1/N2.
     * When OTRO, a custom text must be provided in exemption_reason_text.
     */
    public function getExemptionReason(): string
    {
        return $this->exemptionReason;
    }

    /**
     * Tax exemption reason code per Spanish VAT Law (Ley 37/1992 LIVA).
    VeriFactu mapping: EXENTA_ART_20→E1, EXENTA_ART_21→E2, EXENTA_ART_22→E3,
    EXENTA_ART_24→E4, EXENTA_ART_25→E5, rest→E6. ISP→S2, NO_SUJETA→N1/N2.
    When OTRO, a custom text must be provided in exemption_reason_text.
     */
    public function setExemptionReason(string $exemptionReason): self
    {
        $this->initialized['exemptionReason'] = true;
        $this->exemptionReason = $exemptionReason;

        return $this;
    }

    /**
     * Custom exemption text. Only used when exemption_reason is OTRO.
     */
    public function getExemptionReasonText(): ?string
    {
        return $this->exemptionReasonText;
    }

    /**
     * Custom exemption text. Only used when exemption_reason is OTRO.
     */
    public function setExemptionReasonText(?string $exemptionReasonText): self
    {
        $this->initialized['exemptionReasonText'] = true;
        $this->exemptionReasonText = $exemptionReasonText;

        return $this;
    }

    /**
     * Line taxable base (after discount, can be negative in corrective invoices)
     */
    public function getTaxableBase(): float
    {
        return $this->taxableBase;
    }

    /**
     * Line taxable base (after discount, can be negative in corrective invoices)
     */
    public function setTaxableBase(float $taxableBase): self
    {
        $this->initialized['taxableBase'] = true;
        $this->taxableBase = $taxableBase;

        return $this;
    }

    /**
     * Line total with taxes (can be negative in corrective invoices)
     */
    public function getLineTotal(): float
    {
        return $this->lineTotal;
    }

    /**
     * Line total with taxes (can be negative in corrective invoices)
     */
    public function setLineTotal(float $lineTotal): self
    {
        $this->initialized['lineTotal'] = true;
        $this->lineTotal = $lineTotal;

        return $this;
    }

    /**
     * How the line amount was entered. `TOTAL_EXCLUDING_TAX` = total-declared
     * mode: `total_excluding_tax` is the exact taxable base and `unit_price`
     * is derived and informational (`total / quantity`, 4 decimals).
     * `TOTAL_INCLUDING_TAX` = tax-inclusive total-declared mode:
     * `total_including_tax` is what the customer paid (taxable base + VAT +
     * equivalence surcharge) and the engine works the breakdown backwards so
     * the rounded amounts add up to the declared total exactly.
     */
    public function getPricingMode(): string
    {
        return $this->pricingMode;
    }

    /**
     * How the line amount was entered. `TOTAL_EXCLUDING_TAX` = total-declared
    mode: `total_excluding_tax` is the exact taxable base and `unit_price`
    is derived and informational (`total / quantity`, 4 decimals).
    `TOTAL_INCLUDING_TAX` = tax-inclusive total-declared mode:
    `total_including_tax` is what the customer paid (taxable base + VAT +
    equivalence surcharge) and the engine works the breakdown backwards so
    the rounded amounts add up to the declared total exactly.
     */
    public function setPricingMode(string $pricingMode): self
    {
        $this->initialized['pricingMode'] = true;
        $this->pricingMode = $pricingMode;

        return $this;
    }

    /**
     * Declared line total excluding taxes. Only present on lines with
     * `pricing_mode = TOTAL_EXCLUDING_TAX`. Unlike `line_total`, it never
     * includes taxes nor subtracts IRPF withholding.
     */
    public function getTotalExcludingTax(): float
    {
        return $this->totalExcludingTax;
    }

    /**
     * Declared line total excluding taxes. Only present on lines with
    `pricing_mode = TOTAL_EXCLUDING_TAX`. Unlike `line_total`, it never
    includes taxes nor subtracts IRPF withholding.
     */
    public function setTotalExcludingTax(float $totalExcludingTax): self
    {
        $this->initialized['totalExcludingTax'] = true;
        $this->totalExcludingTax = $totalExcludingTax;

        return $this;
    }

    /**
     * Declared line total including taxes (taxable base + VAT + equivalence
     * surcharge; IRPF withholding is never subtracted). Only present on lines
     * with `pricing_mode = TOTAL_INCLUDING_TAX`. The invariant
     * `taxable_base + VAT + surcharge = total_including_tax` holds exactly.
     */
    public function getTotalIncludingTax(): float
    {
        return $this->totalIncludingTax;
    }

    /**
     * Declared line total including taxes (taxable base + VAT + equivalence
    surcharge; IRPF withholding is never subtracted). Only present on lines
    with `pricing_mode = TOTAL_INCLUDING_TAX`. The invariant
    `taxable_base + VAT + surcharge = total_including_tax` holds exactly.
     */
    public function setTotalIncludingTax(float $totalIncludingTax): self
    {
        $this->initialized['totalIncludingTax'] = true;
        $this->totalIncludingTax = $totalIncludingTax;

        return $this;
    }

    /**
     * Fiscal line type.
     * - **NORMAL**: standard line; contributes to the taxable base and VAT.
     * - **SUPLIDO**: payment made on behalf of the final client (art. 78.Tres.3 LIVA);
     *   excluded from the taxable base, VAT and VeriFactu.
     */
    public function getLineType(): string
    {
        return $this->lineType;
    }

    /**
     * Fiscal line type.
    - **NORMAL**: standard line; contributes to the taxable base and VAT.
    - **SUPLIDO**: payment made on behalf of the final client (art. 78.Tres.3 LIVA);
     excluded from the taxable base, VAT and VeriFactu.
     */
    public function setLineType(string $lineType): self
    {
        $this->initialized['lineType'] = true;
        $this->lineType = $lineType;

        return $this;
    }

    /**
     * Reference to the original invoice issued by the third party in the client's name.
     * Required when line_type=SUPLIDO.
     */
    public function getSourceInvoiceReference(): ?string
    {
        return $this->sourceInvoiceReference;
    }

    /**
     * Reference to the original invoice issued by the third party in the client's name.
    Required when line_type=SUPLIDO.
     */
    public function setSourceInvoiceReference(?string $sourceInvoiceReference): self
    {
        $this->initialized['sourceInvoiceReference'] = true;
        $this->sourceInvoiceReference = $sourceInvoiceReference;

        return $this;
    }

    /**
     * Ids of the issued invoices that make up the SUPLIDO. They may belong to the issuing
     * account or to accounts it manages with VIEW access. Their
     * sum is the disbursement amount (never typed by hand). Audit traceability.
     * Only present on lines with line_type=SUPLIDO.
     *
     *
     * @return list<string>
     */
    public function getSourceInvoiceIds(): array
    {
        return $this->sourceInvoiceIds;
    }

    /**
     * Ids of the issued invoices that make up the SUPLIDO. They may belong to the issuing
    account or to accounts it manages with VIEW access. Their
    sum is the disbursement amount (never typed by hand). Audit traceability.
    Only present on lines with line_type=SUPLIDO.

     *
     * @param  list<string>  $sourceInvoiceIds
     */
    public function setSourceInvoiceIds(array $sourceInvoiceIds): self
    {
        $this->initialized['sourceInvoiceIds'] = true;
        $this->sourceInvoiceIds = $sourceInvoiceIds;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['description' => ['description', 'getDescription', 'setDescription'], 'quantity' => ['quantity', 'getQuantity', 'setQuantity'], 'unit' => ['unit', 'getUnit', 'setUnit'], 'unitPrice' => ['unit_price', 'getUnitPrice', 'setUnitPrice'], 'discountPercentage' => ['discount_percentage', 'getDiscountPercentage', 'setDiscountPercentage'], 'mainTax' => ['main_tax', 'getMainTax', 'setMainTax'], 'equivalenceSurchargeRate' => ['equivalence_surcharge_rate', 'getEquivalenceSurchargeRate', 'setEquivalenceSurchargeRate'], 'irpfRate' => ['irpf_rate', 'getIrpfRate', 'setIrpfRate'], 'exemptionReason' => ['exemption_reason', 'getExemptionReason', 'setExemptionReason'], 'exemptionReasonText' => ['exemption_reason_text', 'getExemptionReasonText', 'setExemptionReasonText'], 'taxableBase' => ['taxable_base', 'getTaxableBase', 'setTaxableBase'], 'lineTotal' => ['line_total', 'getLineTotal', 'setLineTotal'], 'pricingMode' => ['pricing_mode', 'getPricingMode', 'setPricingMode'], 'totalExcludingTax' => ['total_excluding_tax', 'getTotalExcludingTax', 'setTotalExcludingTax'], 'totalIncludingTax' => ['total_including_tax', 'getTotalIncludingTax', 'setTotalIncludingTax'], 'lineType' => ['line_type', 'getLineType', 'setLineType'], 'sourceInvoiceReference' => ['source_invoice_reference', 'getSourceInvoiceReference', 'setSourceInvoiceReference'], 'sourceInvoiceIds' => ['source_invoice_ids', 'getSourceInvoiceIds', 'setSourceInvoiceIds']];
    }
}
