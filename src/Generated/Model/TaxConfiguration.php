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
     * @var string|null
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
     * @var float|null
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
     * @var float|null
     */
    protected $defaultIrpfRate;
    /**
     * Whether the freelancer is exempt from IRPF withholding (e.g., business start).
     * 
     * **Note**: When `true`, any provided `default_irpf_rate` is saved but not applied to invoices.
     * This allows pre-configuring the rate for when the exemption ends.
     * 
     *
     * @var bool|null
     */
    protected $irpfExempt = false;
    /**
     * Default payment method for new invoices.
     * If NONE is selected, no payment information will be shown on the invoice.
     * 
     *
     * @var string|null
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
     * @var TaxConfigurationWithholdingOptions|null
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
     * @return string|null
     */
    public function getDefaultExemptionReason(): ?string
    {
        return $this->defaultExemptionReason;
    }
    /**
     * @param string|null $defaultExemptionReason
     *
     * @return self
     */
    public function setDefaultExemptionReason(?string $defaultExemptionReason): self
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
     * @return float|null
     */
    public function getDefaultEquivalenceSurcharge(): ?float
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
    * @param float|null $defaultEquivalenceSurcharge
    *
    * @return self
    */
    public function setDefaultEquivalenceSurcharge(?float $defaultEquivalenceSurcharge): self
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
     * @return float|null
     */
    public function getDefaultIrpfRate(): ?float
    {
        return $this->defaultIrpfRate;
    }
    /**
    * Default IRPF for new invoices, as the configuration holds it. It is what is stored,
    not what a request accepts (see `IrpfPercentage`): a configuration saved with a rate
    the table no longer has is returned as it is until it is updated.
    
    **Business rule**: REQUIRED if `apply_irpf` is `true` and `irpf_exempt` is `false`.
    
    *
    * @param float|null $defaultIrpfRate
    *
    * @return self
    */
    public function setDefaultIrpfRate(?float $defaultIrpfRate): self
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
     * @return bool|null
     */
    public function getIrpfExempt(): ?bool
    {
        return $this->irpfExempt;
    }
    /**
    * Whether the freelancer is exempt from IRPF withholding (e.g., business start).
    
    **Note**: When `true`, any provided `default_irpf_rate` is saved but not applied to invoices.
    This allows pre-configuring the rate for when the exemption ends.
    
    *
    * @param bool|null $irpfExempt
    *
    * @return self
    */
    public function setIrpfExempt(?bool $irpfExempt): self
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
     * @return TaxConfigurationWithholdingOptions|null
     */
    public function getWithholdingOptions(): ?TaxConfigurationWithholdingOptions
    {
        return $this->withholdingOptions;
    }
    /**
    * The withholding (IRPF) rates this company can put on its invoices, deduced from its
    NIF, and the one suggested by default. Read-only: it is ignored if sent.
    
    Use it to build the IRPF picker of this company instead of the whole list of
    `GET /v1/tax-types`, which is the same for everyone.
    
    *
    * @param TaxConfigurationWithholdingOptions|null $withholdingOptions
    *
    * @return self
    */
    public function setWithholdingOptions(?TaxConfigurationWithholdingOptions $withholdingOptions): self
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