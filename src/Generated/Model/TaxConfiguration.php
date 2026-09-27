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
     * Tax exemption reason code per Spanish VAT Law (Ley 37/1992 LIVA).
     * VeriFactu mapping: EXENTA_ART_20→E1, EXENTA_ART_21→E2, EXENTA_ART_22→E3,
     * EXENTA_ART_24→E4, EXENTA_ART_25→E5, rest→E6. ISP→S2, NO_SUJETA→N1/N2.
     * When OTRO, a custom text must be provided in exemption_reason_text.
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
     * Default equivalence surcharge.
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
     * Default IRPF for new invoices.
     *
     * **Business rule**: REQUIRED if `apply_irpf` is `true` and `irpf_exempt` is `false`.
     *
     *
     * @var int
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

    public function getDefaultMainTax(): TaxConfigurationDefaultMainTax
    {
        return $this->defaultMainTax;
    }

    public function setDefaultMainTax(TaxConfigurationDefaultMainTax $defaultMainTax): self
    {
        $this->initialized['defaultMainTax'] = true;
        $this->defaultMainTax = $defaultMainTax;

        return $this;
    }

    /**
     * Tax exemption reason code per Spanish VAT Law (Ley 37/1992 LIVA).
     * VeriFactu mapping: EXENTA_ART_20→E1, EXENTA_ART_21→E2, EXENTA_ART_22→E3,
     * EXENTA_ART_24→E4, EXENTA_ART_25→E5, rest→E6. ISP→S2, NO_SUJETA→N1/N2.
     * When OTRO, a custom text must be provided in exemption_reason_text.
     */
    public function getDefaultExemptionReason(): string
    {
        return $this->defaultExemptionReason;
    }

    /**
     * Tax exemption reason code per Spanish VAT Law (Ley 37/1992 LIVA).
    VeriFactu mapping: EXENTA_ART_20→E1, EXENTA_ART_21→E2, EXENTA_ART_22→E3,
    EXENTA_ART_24→E4, EXENTA_ART_25→E5, rest→E6. ISP→S2, NO_SUJETA→N1/N2.
    When OTRO, a custom text must be provided in exemption_reason_text.
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
     */
    public function getDefaultExemptionReasonText(): ?string
    {
        return $this->defaultExemptionReasonText;
    }

    /**
     * Custom exemption text. Only used when `default_exemption_reason` is `OTRO`,
    where it is mandatory — same rule as in the invoice line.
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
     */
    public function getApplyEquivalenceSurcharge(): bool
    {
        return $this->applyEquivalenceSurcharge;
    }

    /**
     * Whether the freelancer is under the equivalence surcharge regime.
     **Business rule**: If `true`, the `default_equivalence_surcharge` field is REQUIRED.
     */
    public function setApplyEquivalenceSurcharge(bool $applyEquivalenceSurcharge): self
    {
        $this->initialized['applyEquivalenceSurcharge'] = true;
        $this->applyEquivalenceSurcharge = $applyEquivalenceSurcharge;

        return $this;
    }

    /**
     * Default equivalence surcharge.
     *
     * **Business rule**: REQUIRED if `apply_equivalence_surcharge` is `true`.
     */
    public function getDefaultEquivalenceSurcharge(): float
    {
        return $this->defaultEquivalenceSurcharge;
    }

    /**
     * Default equivalence surcharge.
     **Business rule**: REQUIRED if `apply_equivalence_surcharge` is `true`.
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
     */
    public function setApplyIrpf(bool $applyIrpf): self
    {
        $this->initialized['applyIrpf'] = true;
        $this->applyIrpf = $applyIrpf;

        return $this;
    }

    /**
     * Default IRPF for new invoices.
     *
     * **Business rule**: REQUIRED if `apply_irpf` is `true` and `irpf_exempt` is `false`.
     */
    public function getDefaultIrpfRate(): int
    {
        return $this->defaultIrpfRate;
    }

    /**
     * Default IRPF for new invoices.
     **Business rule**: REQUIRED if `apply_irpf` is `true` and `irpf_exempt` is `false`.
     */
    public function setDefaultIrpfRate(int $defaultIrpfRate): self
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
     */
    public function getIrpfExempt(): bool
    {
        return $this->irpfExempt;
    }

    /**
     * Whether the freelancer is exempt from IRPF withholding (e.g., business start).

     **Note**: When `true`, any provided `default_irpf_rate` is saved but not applied to invoices.
    This allows pre-configuring the rate for when the exemption ends.
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
     */
    public function getDefaultPaymentMethod(): string
    {
        return $this->defaultPaymentMethod;
    }

    /**
     * Default payment method for new invoices.
    If NONE is selected, no payment information will be shown on the invoice.
     */
    public function setDefaultPaymentMethod(string $defaultPaymentMethod): self
    {
        $this->initialized['defaultPaymentMethod'] = true;
        $this->defaultPaymentMethod = $defaultPaymentMethod;

        return $this;
    }

    /**
     * Default payment term in days (0-365). Null means no default term.
     */
    public function getPaymentTermDays(): ?int
    {
        return $this->paymentTermDays;
    }

    /**
     * Default payment term in days (0-365). Null means no default term.
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
