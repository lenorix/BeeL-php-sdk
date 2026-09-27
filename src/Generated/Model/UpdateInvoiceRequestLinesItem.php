<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class UpdateInvoiceRequestLinesItem implements AdditionalPropertiesInterface
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
     * Required for NORMAL lines; optional for SUPLIDO lines.
     *
     *
     * @var string
     */
    protected $description;

    /**
     * @var float
     */
    protected $quantity;

    /**
     * @var string
     */
    protected $unit;

    /**
     * Unit price before taxes. `0` is accepted (a discount granted before or
     * simultaneously with the sale, e.g. a free introductory month).
     * Supports up to 4 decimal places for micro-pricing (e.g., €0.0897/unit for labels, packaging).
     * Final amounts are always rounded to 2 decimals.
     *
     *
     * @var float
     */
    protected $unitPrice;

    /**
     * Declared line total excluding taxes (total-declared mode, e.g. 300 units
     * invoiced for exactly 1.00). The taxable base of the line is EXACTLY this
     * amount — it is never recalculated from the unit price. The unit price
     * becomes derived and informational (`total / quantity`, 4 decimals).
     * Each line must carry exactly one of `unit_price`, `total_excluding_tax`
     * or `total_including_tax` (anything else is rejected with
     * `LINE_UNIT_PRICE_XOR_DECLARED_TOTAL`). Incompatible with
     * `discount_percentage` (`LINE_DECLARED_TOTAL_FORBIDS_DISCOUNT`): any
     * discount is already included in the declared total. Can be negative
     * in corrective invoices.
     *
     *
     * @var float
     */
    protected $totalExcludingTax;

    /**
     * Declared line total including taxes (tax-inclusive total-declared
     * mode): what the customer paid for this line — taxable base + VAT +
     * equivalence surcharge. IRPF withholding is NOT part of it (it is a
     * retention, not price; it is computed on the derived base as usual).
     * The engine works the breakdown backwards from the unrounded base
     * (`base_raw = total / (1 + vat + surcharge)`, DGT V1919-18) so the
     * rounded amounts add up to the declared total exactly (e.g. 100.00
     * at 21% → 82.64 + 17.36 = 100.00). On exempt or 0% lines it is
     * equivalent to `total_excluding_tax` (base = total, quota 0).
     * Each line must carry exactly one of `unit_price`, `total_excluding_tax`
     * or `total_including_tax` (anything else is rejected with
     * `LINE_UNIT_PRICE_XOR_DECLARED_TOTAL`). Incompatible with
     * `discount_percentage` (`LINE_DECLARED_TOTAL_FORBIDS_DISCOUNT`).
     * Can be negative in corrective invoices.
     *
     *
     * @var float
     */
    protected $totalIncludingTax;

    /**
     * @var float
     */
    protected $discountPercentage;

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
     * IRPF withholding rate for this line.
     *
     * **Default behaviour:** if omitted, the line inherits the
     * account's default IRPF rate (configured in the tax profile,
     * e.g. 15%). To issue a line **without** withholding you must
     * send `irpf_rate: 0` explicitly. On SIMPLIFIED invoices (F2)
     * IRPF withholding is **not allowed** (AEAT forbids it on F2):
     * sending an `irpf_rate` other than 0 is **rejected** with
     * `SIMPLIFICADA_FORBIDS_IRPF` — it is not coerced to 0. Omit the
     * field or send `irpf_rate: 0` on F2 lines. On all other invoice
     * types an explicit value is always respected.
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
     * @var string|null
     */
    protected $exemptionReasonText;

    /**
     * Fiscal line type. Omitted, `NORMAL` applies.
     * Use `SUPLIDO` for payments on behalf of the final client
     * (art. 78.Tres.3 LIVA). Requires `source_invoice_reference`.
     *
     *
     * @var string
     */
    protected $lineType;

    /**
     * Reference to the original invoice issued by the third party in the
     * client's name. Required when `line_type=SUPLIDO`.
     *
     *
     * @var string|null
     */
    protected $sourceInvoiceReference;

    /**
     * Ids of the issued invoices that make up the SUPLIDO. They may belong to the
     * issuing account or to accounts it manages with VIEW access.
     * Their sum is the amount (never typed). Audit traceability.
     *
     *
     * @var list<string>
     */
    protected $sourceInvoiceIds;

    /**
     * Required for NORMAL lines; optional for SUPLIDO lines.
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Required for NORMAL lines; optional for SUPLIDO lines.
     */
    public function setDescription(string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;

        return $this;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

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
     * Unit price before taxes. `0` is accepted (a discount granted before or
     * simultaneously with the sale, e.g. a free introductory month).
     * Supports up to 4 decimal places for micro-pricing (e.g., €0.0897/unit for labels, packaging).
     * Final amounts are always rounded to 2 decimals.
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * Unit price before taxes. `0` is accepted (a discount granted before or
    simultaneously with the sale, e.g. a free introductory month).
    Supports up to 4 decimal places for micro-pricing (e.g., €0.0897/unit for labels, packaging).
    Final amounts are always rounded to 2 decimals.
     */
    public function setUnitPrice(float $unitPrice): self
    {
        $this->initialized['unitPrice'] = true;
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Declared line total excluding taxes (total-declared mode, e.g. 300 units
     * invoiced for exactly 1.00). The taxable base of the line is EXACTLY this
     * amount — it is never recalculated from the unit price. The unit price
     * becomes derived and informational (`total / quantity`, 4 decimals).
     * Each line must carry exactly one of `unit_price`, `total_excluding_tax`
     * or `total_including_tax` (anything else is rejected with
     * `LINE_UNIT_PRICE_XOR_DECLARED_TOTAL`). Incompatible with
     * `discount_percentage` (`LINE_DECLARED_TOTAL_FORBIDS_DISCOUNT`): any
     * discount is already included in the declared total. Can be negative
     * in corrective invoices.
     */
    public function getTotalExcludingTax(): float
    {
        return $this->totalExcludingTax;
    }

    /**
     * Declared line total excluding taxes (total-declared mode, e.g. 300 units
    invoiced for exactly 1.00). The taxable base of the line is EXACTLY this
    amount — it is never recalculated from the unit price. The unit price
    becomes derived and informational (`total / quantity`, 4 decimals).
    Each line must carry exactly one of `unit_price`, `total_excluding_tax`
    or `total_including_tax` (anything else is rejected with
    `LINE_UNIT_PRICE_XOR_DECLARED_TOTAL`). Incompatible with
    `discount_percentage` (`LINE_DECLARED_TOTAL_FORBIDS_DISCOUNT`): any
    discount is already included in the declared total. Can be negative
    in corrective invoices.
     */
    public function setTotalExcludingTax(float $totalExcludingTax): self
    {
        $this->initialized['totalExcludingTax'] = true;
        $this->totalExcludingTax = $totalExcludingTax;

        return $this;
    }

    /**
     * Declared line total including taxes (tax-inclusive total-declared
     * mode): what the customer paid for this line — taxable base + VAT +
     * equivalence surcharge. IRPF withholding is NOT part of it (it is a
     * retention, not price; it is computed on the derived base as usual).
     * The engine works the breakdown backwards from the unrounded base
     * (`base_raw = total / (1 + vat + surcharge)`, DGT V1919-18) so the
     * rounded amounts add up to the declared total exactly (e.g. 100.00
     * at 21% → 82.64 + 17.36 = 100.00). On exempt or 0% lines it is
     * equivalent to `total_excluding_tax` (base = total, quota 0).
     * Each line must carry exactly one of `unit_price`, `total_excluding_tax`
     * or `total_including_tax` (anything else is rejected with
     * `LINE_UNIT_PRICE_XOR_DECLARED_TOTAL`). Incompatible with
     * `discount_percentage` (`LINE_DECLARED_TOTAL_FORBIDS_DISCOUNT`).
     * Can be negative in corrective invoices.
     */
    public function getTotalIncludingTax(): float
    {
        return $this->totalIncludingTax;
    }

    /**
     * Declared line total including taxes (tax-inclusive total-declared
    mode): what the customer paid for this line — taxable base + VAT +
    equivalence surcharge. IRPF withholding is NOT part of it (it is a
    retention, not price; it is computed on the derived base as usual).
    The engine works the breakdown backwards from the unrounded base
    (`base_raw = total / (1 + vat + surcharge)`, DGT V1919-18) so the
    rounded amounts add up to the declared total exactly (e.g. 100.00
    at 21% → 82.64 + 17.36 = 100.00). On exempt or 0% lines it is
    equivalent to `total_excluding_tax` (base = total, quota 0).
    Each line must carry exactly one of `unit_price`, `total_excluding_tax`
    or `total_including_tax` (anything else is rejected with
    `LINE_UNIT_PRICE_XOR_DECLARED_TOTAL`). Incompatible with
    `discount_percentage` (`LINE_DECLARED_TOTAL_FORBIDS_DISCOUNT`).
    Can be negative in corrective invoices.
     */
    public function setTotalIncludingTax(float $totalIncludingTax): self
    {
        $this->initialized['totalIncludingTax'] = true;
        $this->totalIncludingTax = $totalIncludingTax;

        return $this;
    }

    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }

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
     * IRPF withholding rate for this line.
     *
     * **Default behaviour:** if omitted, the line inherits the
     * account's default IRPF rate (configured in the tax profile,
     * e.g. 15%). To issue a line **without** withholding you must
     * send `irpf_rate: 0` explicitly. On SIMPLIFIED invoices (F2)
     * IRPF withholding is **not allowed** (AEAT forbids it on F2):
     * sending an `irpf_rate` other than 0 is **rejected** with
     * `SIMPLIFICADA_FORBIDS_IRPF` — it is not coerced to 0. Omit the
     * field or send `irpf_rate: 0` on F2 lines. On all other invoice
     * types an explicit value is always respected.
     */
    public function getIrpfRate(): int
    {
        return $this->irpfRate;
    }

    /**
     * IRPF withholding rate for this line.

     **Default behaviour:** if omitted, the line inherits the
    account's default IRPF rate (configured in the tax profile,
    e.g. 15%). To issue a line **without** withholding you must
    send `irpf_rate: 0` explicitly. On SIMPLIFIED invoices (F2)
    IRPF withholding is **not allowed** (AEAT forbids it on F2):
    sending an `irpf_rate` other than 0 is **rejected** with
    `SIMPLIFICADA_FORBIDS_IRPF` — it is not coerced to 0. Omit the
    field or send `irpf_rate: 0` on F2 lines. On all other invoice
    types an explicit value is always respected.
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

    public function getExemptionReasonText(): ?string
    {
        return $this->exemptionReasonText;
    }

    public function setExemptionReasonText(?string $exemptionReasonText): self
    {
        $this->initialized['exemptionReasonText'] = true;
        $this->exemptionReasonText = $exemptionReasonText;

        return $this;
    }

    /**
     * Fiscal line type. Omitted, `NORMAL` applies.
     * Use `SUPLIDO` for payments on behalf of the final client
     * (art. 78.Tres.3 LIVA). Requires `source_invoice_reference`.
     */
    public function getLineType(): string
    {
        return $this->lineType;
    }

    /**
     * Fiscal line type. Omitted, `NORMAL` applies.
    Use `SUPLIDO` for payments on behalf of the final client
    (art. 78.Tres.3 LIVA). Requires `source_invoice_reference`.
     */
    public function setLineType(string $lineType): self
    {
        $this->initialized['lineType'] = true;
        $this->lineType = $lineType;

        return $this;
    }

    /**
     * Reference to the original invoice issued by the third party in the
     * client's name. Required when `line_type=SUPLIDO`.
     */
    public function getSourceInvoiceReference(): ?string
    {
        return $this->sourceInvoiceReference;
    }

    /**
     * Reference to the original invoice issued by the third party in the
    client's name. Required when `line_type=SUPLIDO`.
     */
    public function setSourceInvoiceReference(?string $sourceInvoiceReference): self
    {
        $this->initialized['sourceInvoiceReference'] = true;
        $this->sourceInvoiceReference = $sourceInvoiceReference;

        return $this;
    }

    /**
     * Ids of the issued invoices that make up the SUPLIDO. They may belong to the
     * issuing account or to accounts it manages with VIEW access.
     * Their sum is the amount (never typed). Audit traceability.
     *
     *
     * @return list<string>
     */
    public function getSourceInvoiceIds(): array
    {
        return $this->sourceInvoiceIds;
    }

    /**
     * Ids of the issued invoices that make up the SUPLIDO. They may belong to the
    issuing account or to accounts it manages with VIEW access.
    Their sum is the amount (never typed). Audit traceability.

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
        return ['description' => ['description', 'getDescription', 'setDescription'], 'quantity' => ['quantity', 'getQuantity', 'setQuantity'], 'unit' => ['unit', 'getUnit', 'setUnit'], 'unitPrice' => ['unit_price', 'getUnitPrice', 'setUnitPrice'], 'totalExcludingTax' => ['total_excluding_tax', 'getTotalExcludingTax', 'setTotalExcludingTax'], 'totalIncludingTax' => ['total_including_tax', 'getTotalIncludingTax', 'setTotalIncludingTax'], 'discountPercentage' => ['discount_percentage', 'getDiscountPercentage', 'setDiscountPercentage'], 'mainTax' => ['main_tax', 'getMainTax', 'setMainTax'], 'equivalenceSurchargeRate' => ['equivalence_surcharge_rate', 'getEquivalenceSurchargeRate', 'setEquivalenceSurchargeRate'], 'irpfRate' => ['irpf_rate', 'getIrpfRate', 'setIrpfRate'], 'exemptionReason' => ['exemption_reason', 'getExemptionReason', 'setExemptionReason'], 'exemptionReasonText' => ['exemption_reason_text', 'getExemptionReasonText', 'setExemptionReasonText'], 'lineType' => ['line_type', 'getLineType', 'setLineType'], 'sourceInvoiceReference' => ['source_invoice_reference', 'getSourceInvoiceReference', 'setSourceInvoiceReference'], 'sourceInvoiceIds' => ['source_invoice_ids', 'getSourceInvoiceIds', 'setSourceInvoiceIds']];
    }
}
