<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class TaxConfiguration implements AdditionalPropertiesInterface
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
     * @var TaxConfigurationDefaultMainTax
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
     * Custom exemption text. Only used when `default_exemption_reason` is `OTRO`,
     * where it is mandatory — same rule as in the invoice line.
     * 
     *
     * @var string|null
     */
    protected $defaultExemptionReasonText;
    /**
     * Whether the freelancer is under the equivalence surcharge regime.
     * 
     * **Business rule**: If `true`, the `default_equivalence_surcharge` field is REQUIRED.
     * 
     *
     * @var bool
     */
    protected $applyEquivalenceSurcharge = false;
    /**
     * Default equivalence surcharge, as the configuration holds it. It is what is stored,
     * not what a request accepts (see `EquivalenceSurchargePercentage`): a configuration
     * saved with the `0.625` surcharge of VAT at 5 %, before it was corrected to 0.62,
     * is returned as `0.625` until it is updated.
     * 
     * **Business rule**: REQUIRED if `apply_equivalence_surcharge` is `true`.
     * 
     *
     * @var float
     */
    protected $defaultEquivalenceSurcharge;
    /**
     * Whether IRPF withholding should be applied to invoices.
     * 
     * Defaults to `false`: no withholding is applied until the user declares one
     * (a rate nobody declared is never invented).
     * 
     * **Business rule**: If `true` and `irpf_exempt` is `false`,
     * the `default_irpf_rate` field is REQUIRED.
     * 
     *
     * @var bool
     */
    protected $applyIrpf = false;
    /**
     * Default IRPF for new invoices, as the configuration holds it. It is what is stored,
     * not what a request accepts (see `IrpfPercentage`): a configuration saved with a rate
     * the table no longer has is returned as it is until it is updated.
     * 
     * **Business rule**: REQUIRED if `apply_irpf` is `true` and `irpf_exempt` is `false`.
     * 
     *
     * @var float
     */
    protected $defaultIrpfRate;
    /**
     * Whether the freelancer is exempt from IRPF withholding (e.g., business start).
     * 
     * **Note**: When `true`, any provided `default_irpf_rate` is saved but not applied to invoices.
     * This allows pre-configuring the rate for when the exemption ends.
     * 
     *
     * @var bool
     */
    protected $irpfExempt = false;
    /**
     * Default payment method for new invoices.
     * If NONE is selected, no payment information will be shown on the invoice.
     * 
     *
     * @var string
     */
    protected $defaultPaymentMethod = 'BANK_TRANSFER';
    /**
     * Default payment term in days (0-365). Null means no default term.
     *
     * @var int|null
     */
    protected $paymentTermDays;
    /**
     * Default validity term in days for new proformas (0-365). Null means no default:
     * proformas are created without an expiry date.
     * 
     * UI-only default: the dashboard uses it to prefill `valid_until` when creating a
     * proforma (issue date + N days, editable). It is never applied server-side, so the
     * public API contract of `valid_until` does not change.
     * 
     *
     * @var int|null
     */
    protected $proformaValidityDays;
    /**
     * The withholding (IRPF) rates this company can put on its invoices, deduced from its
     * NIF, and the one suggested by default. Read-only: it is ignored if sent.
     * 
     * Use it to build the IRPF picker of this company instead of the whole list of
     * `GET /v1/tax-types`, which is the same for everyone.
     * 
     *
     * @var TaxConfigurationWithholdingOptions
     */
    protected $withholdingOptions;
    /**
     * @return TaxConfigurationDefaultMainTax
     */
    public function getDefaultMainTax(): TaxConfigurationDefaultMainTax
    {
        return $this->defaultMainTax;
    }
    /**
     * @param TaxConfigurationDefaultMainTax $defaultMainTax
     *
     * @return self
     */
    public function setDefaultMainTax(TaxConfigurationDefaultMainTax $defaultMainTax): self
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
     * Custom exemption text. Only used when `default_exemption_reason` is `OTRO`,
     * where it is mandatory — same rule as in the invoice line.
     * 
     *
     * @return string|null
     */
    public function getDefaultExemptionReasonText(): ?string
    {
        return $this->defaultExemptionReasonText;
    }
    /**
    * Custom exemption text. Only used when `default_exemption_reason` is `OTRO`,
    where it is mandatory — same rule as in the invoice line.
    
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
     * **Business rule**: If `true`, the `default_equivalence_surcharge` field is REQUIRED.
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
     **Business rule**: If `true`, the `default_equivalence_surcharge` field is REQUIRED.
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
     * Default equivalence surcharge, as the configuration holds it. It is what is stored,
     * not what a request accepts (see `EquivalenceSurchargePercentage`): a configuration
     * saved with the `0.625` surcharge of VAT at 5 %, before it was corrected to 0.62,
     * is returned as `0.625` until it is updated.
     * 
     * **Business rule**: REQUIRED if `apply_equivalence_surcharge` is `true`.
     * 
     *
     * @return float
     */
    public function getDefaultEquivalenceSurcharge(): float
    {
        return $this->defaultEquivalenceSurcharge;
    }
    /**
    * Default equivalence surcharge, as the configuration holds it. It is what is stored,
    not what a request accepts (see `EquivalenceSurchargePercentage`): a configuration
    saved with the `0.625` surcharge of VAT at 5 %, before it was corrected to 0.62,
    is returned as `0.625` until it is updated.
    
    **Business rule**: REQUIRED if `apply_equivalence_surcharge` is `true`.
    
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
     * Whether IRPF withholding should be applied to invoices.
     * 
     * Defaults to `false`: no withholding is applied until the user declares one
     * (a rate nobody declared is never invented).
     * 
     * **Business rule**: If `true` and `irpf_exempt` is `false`,
     * the `default_irpf_rate` field is REQUIRED.
     * 
     *
     * @return bool
     */
    public function getApplyIrpf(): bool
    {
        return $this->applyIrpf;
    }
    /**
    * Whether IRPF withholding should be applied to invoices.
    
    Defaults to `false`: no withholding is applied until the user declares one
    (a rate nobody declared is never invented).
    
    **Business rule**: If `true` and `irpf_exempt` is `false`,
    the `default_irpf_rate` field is REQUIRED.
    
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
     * Default IRPF for new invoices, as the configuration holds it. It is what is stored,
     * not what a request accepts (see `IrpfPercentage`): a configuration saved with a rate
     * the table no longer has is returned as it is until it is updated.
     * 
     * **Business rule**: REQUIRED if `apply_irpf` is `true` and `irpf_exempt` is `false`.
     * 
     *
     * @return float
     */
    public function getDefaultIrpfRate(): float
    {
        return $this->defaultIrpfRate;
    }
    /**
    * Default IRPF for new invoices, as the configuration holds it. It is what is stored,
    not what a request accepts (see `IrpfPercentage`): a configuration saved with a rate
    the table no longer has is returned as it is until it is updated.
    
    **Business rule**: REQUIRED if `apply_irpf` is `true` and `irpf_exempt` is `false`.
    
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
     * Whether the freelancer is exempt from IRPF withholding (e.g., business start).
     * 
     * **Note**: When `true`, any provided `default_irpf_rate` is saved but not applied to invoices.
     * This allows pre-configuring the rate for when the exemption ends.
     * 
     *
     * @return bool
     */
    public function getIrpfExempt(): bool
    {
        return $this->irpfExempt;
    }
    /**
    * Whether the freelancer is exempt from IRPF withholding (e.g., business start).
    
    **Note**: When `true`, any provided `default_irpf_rate` is saved but not applied to invoices.
    This allows pre-configuring the rate for when the exemption ends.
    
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
     * @return string
     */
    public function getDefaultPaymentMethod(): string
    {
        return $this->defaultPaymentMethod;
    }
    /**
    * Default payment method for new invoices.
    If NONE is selected, no payment information will be shown on the invoice.
    
    *
    * @param string $defaultPaymentMethod
    *
    * @return self
    */
    public function setDefaultPaymentMethod(string $defaultPaymentMethod): self
    {
        $this->initialized['defaultPaymentMethod'] = true;
        $this->defaultPaymentMethod = $defaultPaymentMethod;
        return $this;
    }
    /**
     * Default payment term in days (0-365). Null means no default term.
     *
     * @return int|null
     */
    public function getPaymentTermDays(): ?int
    {
        return $this->paymentTermDays;
    }
    /**
     * Default payment term in days (0-365). Null means no default term.
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
     * Default validity term in days for new proformas (0-365). Null means no default:
     * proformas are created without an expiry date.
     * 
     * UI-only default: the dashboard uses it to prefill `valid_until` when creating a
     * proforma (issue date + N days, editable). It is never applied server-side, so the
     * public API contract of `valid_until` does not change.
     * 
     *
     * @return int|null
     */
    public function getProformaValidityDays(): ?int
    {
        return $this->proformaValidityDays;
    }
    /**
    * Default validity term in days for new proformas (0-365). Null means no default:
    proformas are created without an expiry date.
    
    UI-only default: the dashboard uses it to prefill `valid_until` when creating a
    proforma (issue date + N days, editable). It is never applied server-side, so the
    public API contract of `valid_until` does not change.
    
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
    /**
     * The withholding (IRPF) rates this company can put on its invoices, deduced from its
     * NIF, and the one suggested by default. Read-only: it is ignored if sent.
     * 
     * Use it to build the IRPF picker of this company instead of the whole list of
     * `GET /v1/tax-types`, which is the same for everyone.
     * 
     *
     * @return TaxConfigurationWithholdingOptions
     */
    public function getWithholdingOptions(): TaxConfigurationWithholdingOptions
    {
        return $this->withholdingOptions;
    }
    /**
    * The withholding (IRPF) rates this company can put on its invoices, deduced from its
    NIF, and the one suggested by default. Read-only: it is ignored if sent.
    
    Use it to build the IRPF picker of this company instead of the whole list of
    `GET /v1/tax-types`, which is the same for everyone.
    
    *
    * @param TaxConfigurationWithholdingOptions $withholdingOptions
    *
    * @return self
    */
    public function setWithholdingOptions(TaxConfigurationWithholdingOptions $withholdingOptions): self
    {
        $this->initialized['withholdingOptions'] = true;
        $this->withholdingOptions = $withholdingOptions;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['defaultMainTax' => ['default_main_tax', 'getDefaultMainTax', 'setDefaultMainTax'], 'defaultExemptionReason' => ['default_exemption_reason', 'getDefaultExemptionReason', 'setDefaultExemptionReason'], 'defaultExemptionReasonText' => ['default_exemption_reason_text', 'getDefaultExemptionReasonText', 'setDefaultExemptionReasonText'], 'applyEquivalenceSurcharge' => ['apply_equivalence_surcharge', 'getApplyEquivalenceSurcharge', 'setApplyEquivalenceSurcharge'], 'defaultEquivalenceSurcharge' => ['default_equivalence_surcharge', 'getDefaultEquivalenceSurcharge', 'setDefaultEquivalenceSurcharge'], 'applyIrpf' => ['apply_irpf', 'getApplyIrpf', 'setApplyIrpf'], 'defaultIrpfRate' => ['default_irpf_rate', 'getDefaultIrpfRate', 'setDefaultIrpfRate'], 'irpfExempt' => ['irpf_exempt', 'getIrpfExempt', 'setIrpfExempt'], 'defaultPaymentMethod' => ['default_payment_method', 'getDefaultPaymentMethod', 'setDefaultPaymentMethod'], 'paymentTermDays' => ['payment_term_days', 'getPaymentTermDays', 'setPaymentTermDays'], 'proformaValidityDays' => ['proforma_validity_days', 'getProformaValidityDays', 'setProformaValidityDays'], 'withholdingOptions' => ['withholding_options', 'getWithholdingOptions', 'setWithholdingOptions']];
    }
}