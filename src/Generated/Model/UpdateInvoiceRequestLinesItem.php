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
     * - IVA: real rates 4, 10, 21, and the temporary 2, 5 and 7.5 (see below for 0)
     * - IGIC: 0, 3, 5, 7, 9.5, 15, 20 — here 0 is the real "Tipo Cero"
     * - IPSI: real rates 0.5, 1, 2, 4, 8, 10 (see below for 0)
     * - OTHER: any percentage between 0 and 100
     * 
     * **0 % under IVA and IPSI is not a rate, it is the exemption sentinel.** It is accepted
     * on a line, but only together with an `exemption_reason` (exempt or non-subject
     * operation); on its own it says nothing and the line is rejected. That is why
     * `GET /v1/tax-types` publishes the IVA rates without 0: the legitimate way
     * to a 0 % IVA line is through an exemption reason, which the same response also
     * publishes. IGIC is different — its 0 % is a real legal rate (basic necessities) and
     * needs no reason.
     * 
     * **IVA 5 %** (the temporary rate applied from 2022 to electricity, gas and certain
     * foodstuffs) is no longer in force for new operations. AEAT only accepts it on operations
     * dated from 2022-07-01 to 2024-09-30: send the `operation_date` of that period, because
     * without one the issue date decides and a line at 5 % is rejected with
     * `422 VAT_RATE_NOT_ACCEPTED_ON_DATE`. Its equivalence surcharge pair is 0.5 up to 2022-12-31
     * and 0.62 from 2023-01-01. **IVA 2 % and 7.5 %** (temporary rates of the last quarter of 2024)
     * are accepted only on operations dated from 2024-10-01 to 2024-12-31, with surcharges 0.26
     * and 1.
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
     * Equivalence surcharge percentage in decimal format, one of the values AEAT accepts.
     * Pairs allowed (VAT rate ↔ surcharge): 21↔5.2, 21↔1.75 (tobacco products), 10↔1.4,
     * 4↔0.5, and the temporary ones, only on operations of their period: 5↔0.5 up to
     * 2022-12-31, 5↔0.62 from 2023-01-01 to 2024-09-30, and 7.5↔1 and 2↔0.26 from
     * 2024-10-01 to 2024-12-31. A pair outside its period is rejected with
     * `422 SURCHARGE_RATE_NOT_ACCEPTED_ON_DATE`. `GET /v1/tax-types` publishes every pair with
     * its `valid_from` / `valid_until`.
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
     * The rate must be one the issuer can bear (see `WithholdingOptions` in the
     * tax configuration). No entity pays IRPF: a legal person or a permanent
     * establishment (NIF starting with `A`, `B`, `C`, `D`, `F`, `G`, `Q`, `R`,
     * `U` or `W`) only accepts `0`, `19`, `24` and `9.5` (rents in Ceuta and
     * Melilla), a non-resident entity (`N`) `0`, `19` and `24`, and the State,
     * an Autonomous Community or a local entity (`S`, `P`) only `0`; any other
     * rate is rejected with `IRPF_RATE_NOT_FOR_CORPORATE_ISSUER`. `9.5` from an
     * individual is rejected with `IRPF_RATE_ONLY_FOR_CORPORATE_ISSUER`: under IRPF the Ceuta
     * and Melilla reduced rates are `6`, `2.8` and `7.6`. Checked on creation,
     * on edit and again on issue; corrective invoices are not checked: they
     * correct by differences what the original carried.
     * 
     *
     * @var float
     */
    protected $irpfRate;
    /**
     * Tax exemption reason code per the Spanish VAT Law (Ley 37/1992, LIVA), with the
     * VeriFactu code each one is reported as.
     * 
     * - `EXENTA_ART_20`: exempt, art. 20 (domestic operations such as medical, educational,
     *   cultural and financial services, or housing rentals). E1.
     * - `EXENTA_ART_21`: exempt, art. 21 (exports of goods). E2.
     * - `EXENTA_ART_22`: exempt, art. 22 (operations treated as exports). E3.
     * - `EXENTA_ART_24`: exempt, art. 24 (free zones, warehouses and customs regimes). E4.
     * - `EXENTA_ART_25`: exempt, art. 25 (intra-community supplies of goods). E5.
     * - `EXENTA_ART_26`: exempt, art. 26 (intra-community acquisitions of goods). It exempts the
     *   buyer's acquisition, not a supply the seller invoices, so an invoice line that carries it
     *   is rejected with `EXEMPTION_NOT_FOR_ISSUED_INVOICE`; a supply to another Member State is
     *   `EXENTA_ART_25`.
     * - `NO_SUJETA_ART_7_9`: not subject under art. 7 (such as the transfer of a business as
     *   a going concern, art. 7.1º). N1.
     * - `NO_SUJETA_LOCALIZACION`: not subject by the place-of-supply rules (intra-community
     *   or non-EU services, arts. 69 and 70). N2.
     * - `ISP_ART_84_2_A` … `ISP_ART_84_2_F`: reverse charge (the invoice states «inversión del
     *   sujeto pasivo»), art. 84.Uno.2.º letters a) (supplier not established in Spain), b) (unwrought
     *   or semi-finished gold), c) (scrap, waste and recovery materials, plastic, paper, cardboard, glass and textile waste, and semi-finished non-ferrous metal products), d) (greenhouse gas emission
     *   allowances), e) (certain real estate supplies: in insolvency proceedings, with the exemption
     *   waived, or enforcing a security) and f) (construction or renovation works). S2.
     * - `ISP_ART_84_2_G`: reverse charge of letter g) (silver, platinum, palladium, mobile phones,
     *   consoles, laptops and tablets). The law requires these supplies to be invoiced in a special
     *   series, so an invoice line that carries it is rejected with
     *   `REVERSE_CHARGE_CASE_NOT_SUPPORTED`.
     * - `EXENTA_ART_140`: investment gold exemption, art. 140 bis (usually with `regime_key`
     *   `04`). E6.
     * - `REGIMEN_ART_129` (agriculture,
     *   livestock and fishing, arts. 124 to 134 bis), `REGIMEN_ART_135` (second-hand goods,
     *   art and antiques), `REGIMEN_ART_141` (travel agencies), `REGIMEN_ART_154` (equivalence
     *   surcharge) and `REGIMEN_ART_163_DECIES` (cash basis, arts. 163 decies to 163
     *   sexiesdecies): operations of special regimes, which VeriFactu identifies by the regime
     *   key rather than by an exemption code. An
     *   invoice line that carries one is rejected with `EXEMPTION_REGIME_NOT_SUPPORTED_IN_VERIFACTU`;
     *   declare the regime with `regime_key` instead.
     * - `OTRO`: any other provision. Requires the text in `exemption_reason_text`. E6.
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
     * 
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
     * Required for NORMAL lines; optional for SUPLIDO lines.
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;
        return $this;
    }
    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }
    /**
     * @param float $quantity
     *
     * @return self
     */
    public function setQuantity(float $quantity): self
    {
        $this->initialized['quantity'] = true;
        $this->quantity = $quantity;
        return $this;
    }
    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
    /**
     * @param string $unit
     *
     * @return self
     */
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
     * 
     *
     * @return float
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
    
    *
    * @param float $unitPrice
    *
    * @return self
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
     * 
     *
     * @return float
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
    
    *
    * @param float $totalExcludingTax
    *
    * @return self
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
     * 
     *
     * @return float
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
    
    *
    * @param float $totalIncludingTax
    *
    * @return self
    */
    public function setTotalIncludingTax(float $totalIncludingTax): self
    {
        $this->initialized['totalIncludingTax'] = true;
        $this->totalIncludingTax = $totalIncludingTax;
        return $this;
    }
    /**
     * @return float
     */
    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }
    /**
     * @param float $discountPercentage
     *
     * @return self
     */
    public function setDiscountPercentage(float $discountPercentage): self
    {
        $this->initialized['discountPercentage'] = true;
        $this->discountPercentage = $discountPercentage;
        return $this;
    }
    /**
     * Complete tax information with cross-validations:
     * - IVA: real rates 4, 10, 21, and the temporary 2, 5 and 7.5 (see below for 0)
     * - IGIC: 0, 3, 5, 7, 9.5, 15, 20 — here 0 is the real "Tipo Cero"
     * - IPSI: real rates 0.5, 1, 2, 4, 8, 10 (see below for 0)
     * - OTHER: any percentage between 0 and 100
     * 
     * **0 % under IVA and IPSI is not a rate, it is the exemption sentinel.** It is accepted
     * on a line, but only together with an `exemption_reason` (exempt or non-subject
     * operation); on its own it says nothing and the line is rejected. That is why
     * `GET /v1/tax-types` publishes the IVA rates without 0: the legitimate way
     * to a 0 % IVA line is through an exemption reason, which the same response also
     * publishes. IGIC is different — its 0 % is a real legal rate (basic necessities) and
     * needs no reason.
     * 
     * **IVA 5 %** (the temporary rate applied from 2022 to electricity, gas and certain
     * foodstuffs) is no longer in force for new operations. AEAT only accepts it on operations
     * dated from 2022-07-01 to 2024-09-30: send the `operation_date` of that period, because
     * without one the issue date decides and a line at 5 % is rejected with
     * `422 VAT_RATE_NOT_ACCEPTED_ON_DATE`. Its equivalence surcharge pair is 0.5 up to 2022-12-31
     * and 0.62 from 2023-01-01. **IVA 2 % and 7.5 %** (temporary rates of the last quarter of 2024)
     * are accepted only on operations dated from 2024-10-01 to 2024-12-31, with surcharges 0.26
     * and 1.
     * 
     * Exception: when regime_key = "17" (OSS/IOSS) the invoice applies the destination
     * country VAT instead of the Spanish one, so any percentage in the EU range [0, 27]
     * is accepted regardless of the tax type set — including 0 without an exemption reason.
     * 
     *
     * @return TaxInfo
     */
    public function getMainTax(): TaxInfo
    {
        return $this->mainTax;
    }
    /**
    * Complete tax information with cross-validations:
    - IVA: real rates 4, 10, 21, and the temporary 2, 5 and 7.5 (see below for 0)
    - IGIC: 0, 3, 5, 7, 9.5, 15, 20 — here 0 is the real "Tipo Cero"
    - IPSI: real rates 0.5, 1, 2, 4, 8, 10 (see below for 0)
    - OTHER: any percentage between 0 and 100
    
    **0 % under IVA and IPSI is not a rate, it is the exemption sentinel.** It is accepted
    on a line, but only together with an `exemption_reason` (exempt or non-subject
    operation); on its own it says nothing and the line is rejected. That is why
    `GET /v1/tax-types` publishes the IVA rates without 0: the legitimate way
    to a 0 % IVA line is through an exemption reason, which the same response also
    publishes. IGIC is different — its 0 % is a real legal rate (basic necessities) and
    needs no reason.
    
    **IVA 5 %** (the temporary rate applied from 2022 to electricity, gas and certain
    foodstuffs) is no longer in force for new operations. AEAT only accepts it on operations
    dated from 2022-07-01 to 2024-09-30: send the `operation_date` of that period, because
    without one the issue date decides and a line at 5 % is rejected with
    `422 VAT_RATE_NOT_ACCEPTED_ON_DATE`. Its equivalence surcharge pair is 0.5 up to 2022-12-31
    and 0.62 from 2023-01-01. **IVA 2 % and 7.5 %** (temporary rates of the last quarter of 2024)
    are accepted only on operations dated from 2024-10-01 to 2024-12-31, with surcharges 0.26
    and 1.
    
    Exception: when regime_key = "17" (OSS/IOSS) the invoice applies the destination
    country VAT instead of the Spanish one, so any percentage in the EU range [0, 27]
    is accepted regardless of the tax type set — including 0 without an exemption reason.
    
    *
    * @param TaxInfo $mainTax
    *
    * @return self
    */
    public function setMainTax(TaxInfo $mainTax): self
    {
        $this->initialized['mainTax'] = true;
        $this->mainTax = $mainTax;
        return $this;
    }
    /**
     * Equivalence surcharge percentage in decimal format, one of the values AEAT accepts.
     * Pairs allowed (VAT rate ↔ surcharge): 21↔5.2, 21↔1.75 (tobacco products), 10↔1.4,
     * 4↔0.5, and the temporary ones, only on operations of their period: 5↔0.5 up to
     * 2022-12-31, 5↔0.62 from 2023-01-01 to 2024-09-30, and 7.5↔1 and 2↔0.26 from
     * 2024-10-01 to 2024-12-31. A pair outside its period is rejected with
     * `422 SURCHARGE_RATE_NOT_ACCEPTED_ON_DATE`. `GET /v1/tax-types` publishes every pair with
     * its `valid_from` / `valid_until`.
     * The backend automatically normalizes equivalent formats (5.20 → 5.2).
     * 
     *
     * @return float
     */
    public function getEquivalenceSurchargeRate(): float
    {
        return $this->equivalenceSurchargeRate;
    }
    /**
    * Equivalence surcharge percentage in decimal format, one of the values AEAT accepts.
    Pairs allowed (VAT rate ↔ surcharge): 21↔5.2, 21↔1.75 (tobacco products), 10↔1.4,
    4↔0.5, and the temporary ones, only on operations of their period: 5↔0.5 up to
    2022-12-31, 5↔0.62 from 2023-01-01 to 2024-09-30, and 7.5↔1 and 2↔0.26 from
    2024-10-01 to 2024-12-31. A pair outside its period is rejected with
    `422 SURCHARGE_RATE_NOT_ACCEPTED_ON_DATE`. `GET /v1/tax-types` publishes every pair with
    its `valid_from` / `valid_until`.
    The backend automatically normalizes equivalent formats (5.20 → 5.2).
    
    *
    * @param float $equivalenceSurchargeRate
    *
    * @return self
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
     * 
     * The rate must be one the issuer can bear (see `WithholdingOptions` in the
     * tax configuration). No entity pays IRPF: a legal person or a permanent
     * establishment (NIF starting with `A`, `B`, `C`, `D`, `F`, `G`, `Q`, `R`,
     * `U` or `W`) only accepts `0`, `19`, `24` and `9.5` (rents in Ceuta and
     * Melilla), a non-resident entity (`N`) `0`, `19` and `24`, and the State,
     * an Autonomous Community or a local entity (`S`, `P`) only `0`; any other
     * rate is rejected with `IRPF_RATE_NOT_FOR_CORPORATE_ISSUER`. `9.5` from an
     * individual is rejected with `IRPF_RATE_ONLY_FOR_CORPORATE_ISSUER`: under IRPF the Ceuta
     * and Melilla reduced rates are `6`, `2.8` and `7.6`. Checked on creation,
     * on edit and again on issue; corrective invoices are not checked: they
     * correct by differences what the original carried.
     * 
     *
     * @return float
     */
    public function getIrpfRate(): float
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
    
    The rate must be one the issuer can bear (see `WithholdingOptions` in the
    tax configuration). No entity pays IRPF: a legal person or a permanent
    establishment (NIF starting with `A`, `B`, `C`, `D`, `F`, `G`, `Q`, `R`,
    `U` or `W`) only accepts `0`, `19`, `24` and `9.5` (rents in Ceuta and
    Melilla), a non-resident entity (`N`) `0`, `19` and `24`, and the State,
    an Autonomous Community or a local entity (`S`, `P`) only `0`; any other
    rate is rejected with `IRPF_RATE_NOT_FOR_CORPORATE_ISSUER`. `9.5` from an
    individual is rejected with `IRPF_RATE_ONLY_FOR_CORPORATE_ISSUER`: under IRPF the Ceuta
    and Melilla reduced rates are `6`, `2.8` and `7.6`. Checked on creation,
    on edit and again on issue; corrective invoices are not checked: they
    correct by differences what the original carried.
    
    *
    * @param float $irpfRate
    *
    * @return self
    */
    public function setIrpfRate(float $irpfRate): self
    {
        $this->initialized['irpfRate'] = true;
        $this->irpfRate = $irpfRate;
        return $this;
    }
    /**
     * Tax exemption reason code per the Spanish VAT Law (Ley 37/1992, LIVA), with the
     * VeriFactu code each one is reported as.
     * 
     * - `EXENTA_ART_20`: exempt, art. 20 (domestic operations such as medical, educational,
     *   cultural and financial services, or housing rentals). E1.
     * - `EXENTA_ART_21`: exempt, art. 21 (exports of goods). E2.
     * - `EXENTA_ART_22`: exempt, art. 22 (operations treated as exports). E3.
     * - `EXENTA_ART_24`: exempt, art. 24 (free zones, warehouses and customs regimes). E4.
     * - `EXENTA_ART_25`: exempt, art. 25 (intra-community supplies of goods). E5.
     * - `EXENTA_ART_26`: exempt, art. 26 (intra-community acquisitions of goods). It exempts the
     *   buyer's acquisition, not a supply the seller invoices, so an invoice line that carries it
     *   is rejected with `EXEMPTION_NOT_FOR_ISSUED_INVOICE`; a supply to another Member State is
     *   `EXENTA_ART_25`.
     * - `NO_SUJETA_ART_7_9`: not subject under art. 7 (such as the transfer of a business as
     *   a going concern, art. 7.1º). N1.
     * - `NO_SUJETA_LOCALIZACION`: not subject by the place-of-supply rules (intra-community
     *   or non-EU services, arts. 69 and 70). N2.
     * - `ISP_ART_84_2_A` … `ISP_ART_84_2_F`: reverse charge (the invoice states «inversión del
     *   sujeto pasivo»), art. 84.Uno.2.º letters a) (supplier not established in Spain), b) (unwrought
     *   or semi-finished gold), c) (scrap, waste and recovery materials, plastic, paper, cardboard, glass and textile waste, and semi-finished non-ferrous metal products), d) (greenhouse gas emission
     *   allowances), e) (certain real estate supplies: in insolvency proceedings, with the exemption
     *   waived, or enforcing a security) and f) (construction or renovation works). S2.
     * - `ISP_ART_84_2_G`: reverse charge of letter g) (silver, platinum, palladium, mobile phones,
     *   consoles, laptops and tablets). The law requires these supplies to be invoiced in a special
     *   series, so an invoice line that carries it is rejected with
     *   `REVERSE_CHARGE_CASE_NOT_SUPPORTED`.
     * - `EXENTA_ART_140`: investment gold exemption, art. 140 bis (usually with `regime_key`
     *   `04`). E6.
     * - `REGIMEN_ART_129` (agriculture,
     *   livestock and fishing, arts. 124 to 134 bis), `REGIMEN_ART_135` (second-hand goods,
     *   art and antiques), `REGIMEN_ART_141` (travel agencies), `REGIMEN_ART_154` (equivalence
     *   surcharge) and `REGIMEN_ART_163_DECIES` (cash basis, arts. 163 decies to 163
     *   sexiesdecies): operations of special regimes, which VeriFactu identifies by the regime
     *   key rather than by an exemption code. An
     *   invoice line that carries one is rejected with `EXEMPTION_REGIME_NOT_SUPPORTED_IN_VERIFACTU`;
     *   declare the regime with `regime_key` instead.
     * - `OTRO`: any other provision. Requires the text in `exemption_reason_text`. E6.
     * 
     *
     * @return string
     */
    public function getExemptionReason(): string
    {
        return $this->exemptionReason;
    }
    /**
    * Tax exemption reason code per the Spanish VAT Law (Ley 37/1992, LIVA), with the
    VeriFactu code each one is reported as.
    
    - `EXENTA_ART_20`: exempt, art. 20 (domestic operations such as medical, educational,
     cultural and financial services, or housing rentals). E1.
    - `EXENTA_ART_21`: exempt, art. 21 (exports of goods). E2.
    - `EXENTA_ART_22`: exempt, art. 22 (operations treated as exports). E3.
    - `EXENTA_ART_24`: exempt, art. 24 (free zones, warehouses and customs regimes). E4.
    - `EXENTA_ART_25`: exempt, art. 25 (intra-community supplies of goods). E5.
    - `EXENTA_ART_26`: exempt, art. 26 (intra-community acquisitions of goods). It exempts the
     buyer's acquisition, not a supply the seller invoices, so an invoice line that carries it
     is rejected with `EXEMPTION_NOT_FOR_ISSUED_INVOICE`; a supply to another Member State is
     `EXENTA_ART_25`.
    - `NO_SUJETA_ART_7_9`: not subject under art. 7 (such as the transfer of a business as
     a going concern, art. 7.1º). N1.
    - `NO_SUJETA_LOCALIZACION`: not subject by the place-of-supply rules (intra-community
     or non-EU services, arts. 69 and 70). N2.
    - `ISP_ART_84_2_A` … `ISP_ART_84_2_F`: reverse charge (the invoice states «inversión del
     sujeto pasivo»), art. 84.Uno.2.º letters a) (supplier not established in Spain), b) (unwrought
     or semi-finished gold), c) (scrap, waste and recovery materials, plastic, paper, cardboard, glass and textile waste, and semi-finished non-ferrous metal products), d) (greenhouse gas emission
     allowances), e) (certain real estate supplies: in insolvency proceedings, with the exemption
     waived, or enforcing a security) and f) (construction or renovation works). S2.
    - `ISP_ART_84_2_G`: reverse charge of letter g) (silver, platinum, palladium, mobile phones,
     consoles, laptops and tablets). The law requires these supplies to be invoiced in a special
     series, so an invoice line that carries it is rejected with
     `REVERSE_CHARGE_CASE_NOT_SUPPORTED`.
    - `EXENTA_ART_140`: investment gold exemption, art. 140 bis (usually with `regime_key`
     `04`). E6.
    - `REGIMEN_ART_129` (agriculture,
     livestock and fishing, arts. 124 to 134 bis), `REGIMEN_ART_135` (second-hand goods,
     art and antiques), `REGIMEN_ART_141` (travel agencies), `REGIMEN_ART_154` (equivalence
     surcharge) and `REGIMEN_ART_163_DECIES` (cash basis, arts. 163 decies to 163
     sexiesdecies): operations of special regimes, which VeriFactu identifies by the regime
     key rather than by an exemption code. An
     invoice line that carries one is rejected with `EXEMPTION_REGIME_NOT_SUPPORTED_IN_VERIFACTU`;
     declare the regime with `regime_key` instead.
    - `OTRO`: any other provision. Requires the text in `exemption_reason_text`. E6.
    
    *
    * @param string $exemptionReason
    *
    * @return self
    */
    public function setExemptionReason(string $exemptionReason): self
    {
        $this->initialized['exemptionReason'] = true;
        $this->exemptionReason = $exemptionReason;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getExemptionReasonText(): ?string
    {
        return $this->exemptionReasonText;
    }
    /**
     * @param string|null $exemptionReasonText
     *
     * @return self
     */
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
     * 
     *
     * @return string
     */
    public function getLineType(): string
    {
        return $this->lineType;
    }
    /**
    * Fiscal line type. Omitted, `NORMAL` applies.
    Use `SUPLIDO` for payments on behalf of the final client
    (art. 78.Tres.3 LIVA). Requires `source_invoice_reference`.
    
    *
    * @param string $lineType
    *
    * @return self
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
     * 
     *
     * @return string|null
     */
    public function getSourceInvoiceReference(): ?string
    {
        return $this->sourceInvoiceReference;
    }
    /**
    * Reference to the original invoice issued by the third party in the
    client's name. Required when `line_type=SUPLIDO`.
    
    *
    * @param string|null $sourceInvoiceReference
    *
    * @return self
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
    * @param list<string> $sourceInvoiceIds
    *
    * @return self
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