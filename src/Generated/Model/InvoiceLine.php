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
     * Equivalence surcharge rate the line was issued with. It is what the invoice holds,
     * not what a request accepts (see `EquivalenceSurchargePercentage`): invoices issued
     * with VAT at 5 % before the surcharge was corrected to 0.62 keep the `0.625` they were
     * issued with, because an issued invoice never changes. Their billing record declares
     * 0.62, as the AEAT information note on the new surcharge rates allows.
     * 
     *
     * @var float
     */
    protected $equivalenceSurchargeRate;
    /**
     * Withholding (IRPF) rate the line holds. It is what the invoice holds, not what a
     * request accepts (see `IrpfPercentage`): a line saved with a rate the table no longer
     * has keeps it, and an issued invoice never changes.
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
     * How the line amount was entered. `UNIT_PRICE` = classic mode: the amount is
     * derived from `unit_price` (`quantity × unit_price × (1 − discount / 100)`).
     * `TOTAL_EXCLUDING_TAX` = total-declared
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
     * 
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
    * Description of the invoiced concept. Required for NORMAL lines;
    optional for SUPLIDO lines (may be empty or absent).
    
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
     * Product/service quantity (can be negative in corrective invoices)
     *
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }
    /**
     * Product/service quantity (can be negative in corrective invoices)
     *
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
     * Unit price before taxes (can be negative in corrective invoices).
     * Supports up to 4 decimal places for micro-pricing (e.g., €0.0897/unit for labels, packaging).
     * Final amounts are always rounded to 2 decimals.
     * 
     * This range is wider than the `maximum` the request accepts for `unit_price`, and on
     * purpose: on a line priced by declared total the unit price is not sent but derived
     * (total ÷ quantity), so what comes back can exceed what you are allowed to send.
     * 
     *
     * @return float
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
     * Discount percentage applied (0-100)
     *
     * @return float
     */
    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }
    /**
     * Discount percentage applied (0-100)
     *
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
     * Equivalence surcharge rate the line was issued with. It is what the invoice holds,
     * not what a request accepts (see `EquivalenceSurchargePercentage`): invoices issued
     * with VAT at 5 % before the surcharge was corrected to 0.62 keep the `0.625` they were
     * issued with, because an issued invoice never changes. Their billing record declares
     * 0.62, as the AEAT information note on the new surcharge rates allows.
     * 
     *
     * @return float
     */
    public function getEquivalenceSurchargeRate(): float
    {
        return $this->equivalenceSurchargeRate;
    }
    /**
    * Equivalence surcharge rate the line was issued with. It is what the invoice holds,
    not what a request accepts (see `EquivalenceSurchargePercentage`): invoices issued
    with VAT at 5 % before the surcharge was corrected to 0.62 keep the `0.625` they were
    issued with, because an issued invoice never changes. Their billing record declares
    0.62, as the AEAT information note on the new surcharge rates allows.
    
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
     * Withholding (IRPF) rate the line holds. It is what the invoice holds, not what a
     * request accepts (see `IrpfPercentage`): a line saved with a rate the table no longer
     * has keeps it, and an issued invoice never changes.
     * 
     *
     * @return float
     */
    public function getIrpfRate(): float
    {
        return $this->irpfRate;
    }
    /**
    * Withholding (IRPF) rate the line holds. It is what the invoice holds, not what a
    request accepts (see `IrpfPercentage`): a line saved with a rate the table no longer
    has keeps it, and an issued invoice never changes.
    
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
     * Custom exemption text. Only used when exemption_reason is OTRO.
     *
     * @return string|null
     */
    public function getExemptionReasonText(): ?string
    {
        return $this->exemptionReasonText;
    }
    /**
     * Custom exemption text. Only used when exemption_reason is OTRO.
     *
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
     * Line taxable base (after discount, can be negative in corrective invoices)
     *
     * @return float
     */
    public function getTaxableBase(): float
    {
        return $this->taxableBase;
    }
    /**
     * Line taxable base (after discount, can be negative in corrective invoices)
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
     * Line total with taxes (can be negative in corrective invoices)
     *
     * @return float
     */
    public function getLineTotal(): float
    {
        return $this->lineTotal;
    }
    /**
     * Line total with taxes (can be negative in corrective invoices)
     *
     * @param float $lineTotal
     *
     * @return self
     */
    public function setLineTotal(float $lineTotal): self
    {
        $this->initialized['lineTotal'] = true;
        $this->lineTotal = $lineTotal;
        return $this;
    }
    /**
     * How the line amount was entered. `UNIT_PRICE` = classic mode: the amount is
     * derived from `unit_price` (`quantity × unit_price × (1 − discount / 100)`).
     * `TOTAL_EXCLUDING_TAX` = total-declared
     * mode: `total_excluding_tax` is the exact taxable base and `unit_price`
     * is derived and informational (`total / quantity`, 4 decimals).
     * `TOTAL_INCLUDING_TAX` = tax-inclusive total-declared mode:
     * `total_including_tax` is what the customer paid (taxable base + VAT +
     * equivalence surcharge) and the engine works the breakdown backwards so
     * the rounded amounts add up to the declared total exactly.
     * 
     *
     * @return string
     */
    public function getPricingMode(): string
    {
        return $this->pricingMode;
    }
    /**
    * How the line amount was entered. `UNIT_PRICE` = classic mode: the amount is
    derived from `unit_price` (`quantity × unit_price × (1 − discount / 100)`).
    `TOTAL_EXCLUDING_TAX` = total-declared
    mode: `total_excluding_tax` is the exact taxable base and `unit_price`
    is derived and informational (`total / quantity`, 4 decimals).
    `TOTAL_INCLUDING_TAX` = tax-inclusive total-declared mode:
    `total_including_tax` is what the customer paid (taxable base + VAT +
    equivalence surcharge) and the engine works the breakdown backwards so
    the rounded amounts add up to the declared total exactly.
    
    *
    * @param string $pricingMode
    *
    * @return self
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
     * 
     *
     * @return float
     */
    public function getTotalExcludingTax(): float
    {
        return $this->totalExcludingTax;
    }
    /**
    * Declared line total excluding taxes. Only present on lines with
    `pricing_mode = TOTAL_EXCLUDING_TAX`. Unlike `line_total`, it never
    includes taxes nor subtracts IRPF withholding.
    
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
     * Declared line total including taxes (taxable base + VAT + equivalence
     * surcharge; IRPF withholding is never subtracted). Only present on lines
     * with `pricing_mode = TOTAL_INCLUDING_TAX`. The invariant
     * `taxable_base + VAT + surcharge = total_including_tax` holds exactly.
     * 
     *
     * @return float
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
     * Fiscal line type.
     * - **NORMAL**: standard line; contributes to the taxable base and VAT.
     * - **SUPLIDO**: payment made on behalf of the final client (art. 78.Tres.3 LIVA);
     *   excluded from the taxable base, VAT and VeriFactu.
     * 
     *
     * @return string
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
     * Reference to the original invoice issued by the third party in the client's name.
     * Required when line_type=SUPLIDO.
     * 
     *
     * @return string|null
     */
    public function getSourceInvoiceReference(): ?string
    {
        return $this->sourceInvoiceReference;
    }
    /**
    * Reference to the original invoice issued by the third party in the client's name.
    Required when line_type=SUPLIDO.
    
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
        return ['description' => ['description', 'getDescription', 'setDescription'], 'quantity' => ['quantity', 'getQuantity', 'setQuantity'], 'unit' => ['unit', 'getUnit', 'setUnit'], 'unitPrice' => ['unit_price', 'getUnitPrice', 'setUnitPrice'], 'discountPercentage' => ['discount_percentage', 'getDiscountPercentage', 'setDiscountPercentage'], 'mainTax' => ['main_tax', 'getMainTax', 'setMainTax'], 'equivalenceSurchargeRate' => ['equivalence_surcharge_rate', 'getEquivalenceSurchargeRate', 'setEquivalenceSurchargeRate'], 'irpfRate' => ['irpf_rate', 'getIrpfRate', 'setIrpfRate'], 'exemptionReason' => ['exemption_reason', 'getExemptionReason', 'setExemptionReason'], 'exemptionReasonText' => ['exemption_reason_text', 'getExemptionReasonText', 'setExemptionReasonText'], 'taxableBase' => ['taxable_base', 'getTaxableBase', 'setTaxableBase'], 'lineTotal' => ['line_total', 'getLineTotal', 'setLineTotal'], 'pricingMode' => ['pricing_mode', 'getPricingMode', 'setPricingMode'], 'totalExcludingTax' => ['total_excluding_tax', 'getTotalExcludingTax', 'setTotalExcludingTax'], 'totalIncludingTax' => ['total_including_tax', 'getTotalIncludingTax', 'setTotalIncludingTax'], 'lineType' => ['line_type', 'getLineType', 'setLineType'], 'sourceInvoiceReference' => ['source_invoice_reference', 'getSourceInvoiceReference', 'setSourceInvoiceReference'], 'sourceInvoiceIds' => ['source_invoice_ids', 'getSourceInvoiceIds', 'setSourceInvoiceIds']];
    }
}