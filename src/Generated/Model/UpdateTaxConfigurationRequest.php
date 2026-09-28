<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class UpdateTaxConfigurationRequest implements AdditionalPropertiesInterface
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
     * Default main tax configuration.
     * If provided, completely replaces the current configuration.
     * 
     * It travels together with `default_exemption_reason`: sending the tax without a
     * reason clears the stored one (going back from 0% to 21% cannot leave an orphan
     * "art. 20 exempt" behind), and sending only the reason applies it to the tax
     * already stored. Sending neither leaves the current declaration untouched.
     * 
     *
     * @var UpdateTaxConfigurationRequestDefaultMainTax
     */
    protected $defaultMainTax;
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
    protected $defaultExemptionReason;
    /**
     * Custom exemption text, mandatory when `default_exemption_reason` is `OTRO`.
     * 
     * Only `EXENTA_ART_20` and `OTRO` can be declared as a default — the reasons a
     * NIF can verify on its own. The rest depend on the recipient, the operation or
     * the regime, so they are declared per invoice line; sending one returns 422.
     * A 0% VAT/IPSI without a reason is also rejected with 422: in those taxes 0% is
     * not a rate, it is the sentinel of an operation carrying no tax.
     * 
     *
     * @var string|null
     */
    protected $defaultExemptionReasonText;
    /**
     * Whether the freelancer is under the equivalence surcharge regime.
     * 
     * Omit it to leave the current value untouched. On creation, omitting it means `false`.
     * 
     *
     * @var bool
     */
    protected $applyEquivalenceSurcharge;
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
    protected $defaultEquivalenceSurcharge;
    /**
     * Whether IRPF withholding should be applied.
     * 
     * Omit it to leave the current value untouched. On creation, omitting it means `false`:
     * a withholding nobody declared is not applied.
     * 
     *
     * @var bool
     */
    protected $applyIrpf;
    /**
     * Withholding (IRPF) percentage, as the IRPF regulation (Royal Decree 439/2007) sets it: 0 (no withholding), 1 (pig fattening and poultry, and some activities
     * under objective estimation), 2 (other agricultural, livestock and forestry activities),
     * 7 (professional activity in its first three years, and the other 7 % cases), 15
     * (professional activities, and intellectual property income), 19 (rent of urban property
     * and other income of art. 75.2.b; also the general rate of the Corporate Income Tax
     * withholding) and 24 (image rights). A company that pays Corporate Income Tax can only use
     * 0, 19, 24 and 9.5: see `WithholdingOptions`.
     * 
     * Ceuta and Melilla: income with the Ceuta and Melilla deduction bears the base rate reduced as
     * the law sets it. Under IRPF, 15 % and 7 % (professional activities) and 19 % (rent of urban
     * property located there) are reduced by 60 %: 6, 2.8 and 7.6. Under Corporate Income Tax, 19 %
     * on those rents is halved: 9.5, which only a company can use
     * (`IRPF_RATE_ONLY_FOR_CORPORATE_ISSUER` otherwise). Whether the reduction applies is the
     * issuer's choice: the NIF does not show it.
     * 
     * The value counts, not how it is written: `15.0` is `15` and `2.80` is `2.8`.
     * 
     *
     * @var float
     */
    protected $defaultIrpfRate;
    /**
     * Whether the freelancer is exempt from IRPF withholding.
     * 
     * Omit it to leave the current value untouched. On creation, omitting it means `false`.
     * 
     *
     * @var bool
     */
    protected $irpfExempt;
    /**
     * Default payment method for new invoices.
     * If NONE is selected, no payment information will be shown on the invoice.
     * 
     *
     * @var string|null
     */
    protected $defaultPaymentMethod;
    /**
     * Default payment term in days (0-365). Omit it to leave the current value untouched;
     * send `null` to clear it.
     * 
     *
     * @var int|null
     */
    protected $paymentTermDays;
    /**
     * Default validity term in days for new proformas (0-365). Omit it to leave the current
     * value untouched; send `null` to clear it (proformas stop getting a prefilled expiry date).
     * 
     *
     * @var int|null
     */
    protected $proformaValidityDays;
    /**
     * Default main tax configuration.
     * If provided, completely replaces the current configuration.
     * 
     * It travels together with `default_exemption_reason`: sending the tax without a
     * reason clears the stored one (going back from 0% to 21% cannot leave an orphan
     * "art. 20 exempt" behind), and sending only the reason applies it to the tax
     * already stored. Sending neither leaves the current declaration untouched.
     * 
     *
     * @return UpdateTaxConfigurationRequestDefaultMainTax
     */
    public function getDefaultMainTax(): UpdateTaxConfigurationRequestDefaultMainTax
    {
        return $this->defaultMainTax;
    }
    /**
    * Default main tax configuration.
    If provided, completely replaces the current configuration.
    
    It travels together with `default_exemption_reason`: sending the tax without a
    reason clears the stored one (going back from 0% to 21% cannot leave an orphan
    "art. 20 exempt" behind), and sending only the reason applies it to the tax
    already stored. Sending neither leaves the current declaration untouched.
    
    *
    * @param UpdateTaxConfigurationRequestDefaultMainTax $defaultMainTax
    *
    * @return self
    */
    public function setDefaultMainTax(UpdateTaxConfigurationRequestDefaultMainTax $defaultMainTax): self
    {
        $this->initialized['defaultMainTax'] = true;
        $this->defaultMainTax = $defaultMainTax;
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
    public function getDefaultExemptionReason(): string
    {
        return $this->defaultExemptionReason;
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
    * @param string $defaultExemptionReason
    *
    * @return self
    */
    public function setDefaultExemptionReason(string $defaultExemptionReason): self
    {
        $this->initialized['defaultExemptionReason'] = true;
        $this->defaultExemptionReason = $defaultExemptionReason;
        return $this;
    }
    /**
     * Custom exemption text, mandatory when `default_exemption_reason` is `OTRO`.
     * 
     * Only `EXENTA_ART_20` and `OTRO` can be declared as a default — the reasons a
     * NIF can verify on its own. The rest depend on the recipient, the operation or
     * the regime, so they are declared per invoice line; sending one returns 422.
     * A 0% VAT/IPSI without a reason is also rejected with 422: in those taxes 0% is
     * not a rate, it is the sentinel of an operation carrying no tax.
     * 
     *
     * @return string|null
     */
    public function getDefaultExemptionReasonText(): ?string
    {
        return $this->defaultExemptionReasonText;
    }
    /**
    * Custom exemption text, mandatory when `default_exemption_reason` is `OTRO`.
    
    Only `EXENTA_ART_20` and `OTRO` can be declared as a default — the reasons a
    NIF can verify on its own. The rest depend on the recipient, the operation or
    the regime, so they are declared per invoice line; sending one returns 422.
    A 0% VAT/IPSI without a reason is also rejected with 422: in those taxes 0% is
    not a rate, it is the sentinel of an operation carrying no tax.
    
    *
    * @param string|null $defaultExemptionReasonText
    *
    * @return self
    */
    public function setDefaultExemptionReasonText(?string $defaultExemptionReasonText): self
    {
        $this->initialized['defaultExemptionReasonText'] = true;
        $this->defaultExemptionReasonText = $defaultExemptionReasonText;
        return $this;
    }
    /**
     * Whether the freelancer is under the equivalence surcharge regime.
     * 
     * Omit it to leave the current value untouched. On creation, omitting it means `false`.
     * 
     *
     * @return bool
     */
    public function getApplyEquivalenceSurcharge(): bool
    {
        return $this->applyEquivalenceSurcharge;
    }
    /**
    * Whether the freelancer is under the equivalence surcharge regime.
    
    Omit it to leave the current value untouched. On creation, omitting it means `false`.
    
    *
    * @param bool $applyEquivalenceSurcharge
    *
    * @return self
    */
    public function setApplyEquivalenceSurcharge(bool $applyEquivalenceSurcharge): self
    {
        $this->initialized['applyEquivalenceSurcharge'] = true;
        $this->applyEquivalenceSurcharge = $applyEquivalenceSurcharge;
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
    public function getDefaultEquivalenceSurcharge(): float
    {
        return $this->defaultEquivalenceSurcharge;
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
    * @param float $defaultEquivalenceSurcharge
    *
    * @return self
    */
    public function setDefaultEquivalenceSurcharge(float $defaultEquivalenceSurcharge): self
    {
        $this->initialized['defaultEquivalenceSurcharge'] = true;
        $this->defaultEquivalenceSurcharge = $defaultEquivalenceSurcharge;
        return $this;
    }
    /**
     * Whether IRPF withholding should be applied.
     * 
     * Omit it to leave the current value untouched. On creation, omitting it means `false`:
     * a withholding nobody declared is not applied.
     * 
     *
     * @return bool
     */
    public function getApplyIrpf(): bool
    {
        return $this->applyIrpf;
    }
    /**
    * Whether IRPF withholding should be applied.
    
    Omit it to leave the current value untouched. On creation, omitting it means `false`:
    a withholding nobody declared is not applied.
    
    *
    * @param bool $applyIrpf
    *
    * @return self
    */
    public function setApplyIrpf(bool $applyIrpf): self
    {
        $this->initialized['applyIrpf'] = true;
        $this->applyIrpf = $applyIrpf;
        return $this;
    }
    /**
     * Withholding (IRPF) percentage, as the IRPF regulation (Royal Decree 439/2007) sets it: 0 (no withholding), 1 (pig fattening and poultry, and some activities
     * under objective estimation), 2 (other agricultural, livestock and forestry activities),
     * 7 (professional activity in its first three years, and the other 7 % cases), 15
     * (professional activities, and intellectual property income), 19 (rent of urban property
     * and other income of art. 75.2.b; also the general rate of the Corporate Income Tax
     * withholding) and 24 (image rights). A company that pays Corporate Income Tax can only use
     * 0, 19, 24 and 9.5: see `WithholdingOptions`.
     * 
     * Ceuta and Melilla: income with the Ceuta and Melilla deduction bears the base rate reduced as
     * the law sets it. Under IRPF, 15 % and 7 % (professional activities) and 19 % (rent of urban
     * property located there) are reduced by 60 %: 6, 2.8 and 7.6. Under Corporate Income Tax, 19 %
     * on those rents is halved: 9.5, which only a company can use
     * (`IRPF_RATE_ONLY_FOR_CORPORATE_ISSUER` otherwise). Whether the reduction applies is the
     * issuer's choice: the NIF does not show it.
     * 
     * The value counts, not how it is written: `15.0` is `15` and `2.80` is `2.8`.
     * 
     *
     * @return float
     */
    public function getDefaultIrpfRate(): float
    {
        return $this->defaultIrpfRate;
    }
    /**
    * Withholding (IRPF) percentage, as the IRPF regulation (Royal Decree 439/2007) sets it: 0 (no withholding), 1 (pig fattening and poultry, and some activities
    under objective estimation), 2 (other agricultural, livestock and forestry activities),
    7 (professional activity in its first three years, and the other 7 % cases), 15
    (professional activities, and intellectual property income), 19 (rent of urban property
    and other income of art. 75.2.b; also the general rate of the Corporate Income Tax
    withholding) and 24 (image rights). A company that pays Corporate Income Tax can only use
    0, 19, 24 and 9.5: see `WithholdingOptions`.
    
    Ceuta and Melilla: income with the Ceuta and Melilla deduction bears the base rate reduced as
    the law sets it. Under IRPF, 15 % and 7 % (professional activities) and 19 % (rent of urban
    property located there) are reduced by 60 %: 6, 2.8 and 7.6. Under Corporate Income Tax, 19 %
    on those rents is halved: 9.5, which only a company can use
    (`IRPF_RATE_ONLY_FOR_CORPORATE_ISSUER` otherwise). Whether the reduction applies is the
    issuer's choice: the NIF does not show it.
    
    The value counts, not how it is written: `15.0` is `15` and `2.80` is `2.8`.
    
    *
    * @param float $defaultIrpfRate
    *
    * @return self
    */
    public function setDefaultIrpfRate(float $defaultIrpfRate): self
    {
        $this->initialized['defaultIrpfRate'] = true;
        $this->defaultIrpfRate = $defaultIrpfRate;
        return $this;
    }
    /**
     * Whether the freelancer is exempt from IRPF withholding.
     * 
     * Omit it to leave the current value untouched. On creation, omitting it means `false`.
     * 
     *
     * @return bool
     */
    public function getIrpfExempt(): bool
    {
        return $this->irpfExempt;
    }
    /**
    * Whether the freelancer is exempt from IRPF withholding.
    
    Omit it to leave the current value untouched. On creation, omitting it means `false`.
    
    *
    * @param bool $irpfExempt
    *
    * @return self
    */
    public function setIrpfExempt(bool $irpfExempt): self
    {
        $this->initialized['irpfExempt'] = true;
        $this->irpfExempt = $irpfExempt;
        return $this;
    }
    /**
     * Default payment method for new invoices.
     * If NONE is selected, no payment information will be shown on the invoice.
     * 
     *
     * @return string|null
     */
    public function getDefaultPaymentMethod(): ?string
    {
        return $this->defaultPaymentMethod;
    }
    /**
    * Default payment method for new invoices.
    If NONE is selected, no payment information will be shown on the invoice.
    
    *
    * @param string|null $defaultPaymentMethod
    *
    * @return self
    */
    public function setDefaultPaymentMethod(?string $defaultPaymentMethod): self
    {
        $this->initialized['defaultPaymentMethod'] = true;
        $this->defaultPaymentMethod = $defaultPaymentMethod;
        return $this;
    }
    /**
     * Default payment term in days (0-365). Omit it to leave the current value untouched;
     * send `null` to clear it.
     * 
     *
     * @return int|null
     */
    public function getPaymentTermDays(): ?int
    {
        return $this->paymentTermDays;
    }
    /**
    * Default payment term in days (0-365). Omit it to leave the current value untouched;
    send `null` to clear it.
    
    *
    * @param int|null $paymentTermDays
    *
    * @return self
    */
    public function setPaymentTermDays(?int $paymentTermDays): self
    {
        $this->initialized['paymentTermDays'] = true;
        $this->paymentTermDays = $paymentTermDays;
        return $this;
    }
    /**
     * Default validity term in days for new proformas (0-365). Omit it to leave the current
     * value untouched; send `null` to clear it (proformas stop getting a prefilled expiry date).
     * 
     *
     * @return int|null
     */
    public function getProformaValidityDays(): ?int
    {
        return $this->proformaValidityDays;
    }
    /**
    * Default validity term in days for new proformas (0-365). Omit it to leave the current
    value untouched; send `null` to clear it (proformas stop getting a prefilled expiry date).
    
    *
    * @param int|null $proformaValidityDays
    *
    * @return self
    */
    public function setProformaValidityDays(?int $proformaValidityDays): self
    {
        $this->initialized['proformaValidityDays'] = true;
        $this->proformaValidityDays = $proformaValidityDays;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['defaultMainTax' => ['default_main_tax', 'getDefaultMainTax', 'setDefaultMainTax'], 'defaultExemptionReason' => ['default_exemption_reason', 'getDefaultExemptionReason', 'setDefaultExemptionReason'], 'defaultExemptionReasonText' => ['default_exemption_reason_text', 'getDefaultExemptionReasonText', 'setDefaultExemptionReasonText'], 'applyEquivalenceSurcharge' => ['apply_equivalence_surcharge', 'getApplyEquivalenceSurcharge', 'setApplyEquivalenceSurcharge'], 'defaultEquivalenceSurcharge' => ['default_equivalence_surcharge', 'getDefaultEquivalenceSurcharge', 'setDefaultEquivalenceSurcharge'], 'applyIrpf' => ['apply_irpf', 'getApplyIrpf', 'setApplyIrpf'], 'defaultIrpfRate' => ['default_irpf_rate', 'getDefaultIrpfRate', 'setDefaultIrpfRate'], 'irpfExempt' => ['irpf_exempt', 'getIrpfExempt', 'setIrpfExempt'], 'defaultPaymentMethod' => ['default_payment_method', 'getDefaultPaymentMethod', 'setDefaultPaymentMethod'], 'paymentTermDays' => ['payment_term_days', 'getPaymentTermDays', 'setPaymentTermDays'], 'proformaValidityDays' => ['proforma_validity_days', 'getProformaValidityDays', 'setProformaValidityDays']];
    }
}