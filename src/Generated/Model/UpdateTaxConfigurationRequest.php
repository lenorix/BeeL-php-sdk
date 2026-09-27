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
     * Equivalence surcharge percentage in decimal format.
     * Pairs allowed (rate ↔ recargo): 4↔0.5, 5↔0.625 (RD-ley 11/2022), 10↔1.4, 21↔5.2.
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
     * Personal income tax/withholding percentage in integer format.
     * Allowed values: 0 (exempt), 1 (agricultural/livestock/forestry), 2 (reduced for modules), 7, 15, 19, 24 (non-residents).
     *
     *
     * @var int
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
     */
    public function setDefaultMainTax(UpdateTaxConfigurationRequestDefaultMainTax $defaultMainTax): self
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
     * Custom exemption text, mandatory when `default_exemption_reason` is `OTRO`.
     *
     * Only `EXENTA_ART_20` and `OTRO` can be declared as a default — the reasons a
     * NIF can verify on its own. The rest depend on the recipient, the operation or
     * the regime, so they are declared per invoice line; sending one returns 422.
     * A 0% VAT/IPSI without a reason is also rejected with 422: in those taxes 0% is
     * not a rate, it is the sentinel of an operation carrying no tax.
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
     */
    public function getApplyEquivalenceSurcharge(): bool
    {
        return $this->applyEquivalenceSurcharge;
    }

    /**
     * Whether the freelancer is under the equivalence surcharge regime.

    Omit it to leave the current value untouched. On creation, omitting it means `false`.
     */
    public function setApplyEquivalenceSurcharge(bool $applyEquivalenceSurcharge): self
    {
        $this->initialized['applyEquivalenceSurcharge'] = true;
        $this->applyEquivalenceSurcharge = $applyEquivalenceSurcharge;

        return $this;
    }

    /**
     * Equivalence surcharge percentage in decimal format.
     * Pairs allowed (rate ↔ recargo): 4↔0.5, 5↔0.625 (RD-ley 11/2022), 10↔1.4, 21↔5.2.
     * The backend automatically normalizes equivalent formats (5.20 → 5.2).
     */
    public function getDefaultEquivalenceSurcharge(): float
    {
        return $this->defaultEquivalenceSurcharge;
    }

    /**
     * Equivalence surcharge percentage in decimal format.
    Pairs allowed (rate ↔ recargo): 4↔0.5, 5↔0.625 (RD-ley 11/2022), 10↔1.4, 21↔5.2.
    The backend automatically normalizes equivalent formats (5.20 → 5.2).
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
     */
    public function getApplyIrpf(): bool
    {
        return $this->applyIrpf;
    }

    /**
     * Whether IRPF withholding should be applied.

    Omit it to leave the current value untouched. On creation, omitting it means `false`:
    a withholding nobody declared is not applied.
     */
    public function setApplyIrpf(bool $applyIrpf): self
    {
        $this->initialized['applyIrpf'] = true;
        $this->applyIrpf = $applyIrpf;

        return $this;
    }

    /**
     * Personal income tax/withholding percentage in integer format.
     * Allowed values: 0 (exempt), 1 (agricultural/livestock/forestry), 2 (reduced for modules), 7, 15, 19, 24 (non-residents).
     */
    public function getDefaultIrpfRate(): int
    {
        return $this->defaultIrpfRate;
    }

    /**
     * Personal income tax/withholding percentage in integer format.
    Allowed values: 0 (exempt), 1 (agricultural/livestock/forestry), 2 (reduced for modules), 7, 15, 19, 24 (non-residents).
     */
    public function setDefaultIrpfRate(int $defaultIrpfRate): self
    {
        $this->initialized['defaultIrpfRate'] = true;
        $this->defaultIrpfRate = $defaultIrpfRate;

        return $this;
    }

    /**
     * Whether the freelancer is exempt from IRPF withholding.
     *
     * Omit it to leave the current value untouched. On creation, omitting it means `false`.
     */
    public function getIrpfExempt(): bool
    {
        return $this->irpfExempt;
    }

    /**
     * Whether the freelancer is exempt from IRPF withholding.

    Omit it to leave the current value untouched. On creation, omitting it means `false`.
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
    public function getDefaultPaymentMethod(): ?string
    {
        return $this->defaultPaymentMethod;
    }

    /**
     * Default payment method for new invoices.
    If NONE is selected, no payment information will be shown on the invoice.
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
     */
    public function getPaymentTermDays(): ?int
    {
        return $this->paymentTermDays;
    }

    /**
     * Default payment term in days (0-365). Omit it to leave the current value untouched;
    send `null` to clear it.
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
     */
    public function getProformaValidityDays(): ?int
    {
        return $this->proformaValidityDays;
    }

    /**
     * Default validity term in days for new proformas (0-365). Omit it to leave the current
    value untouched; send `null` to clear it (proformas stop getting a prefilled expiry date).
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
