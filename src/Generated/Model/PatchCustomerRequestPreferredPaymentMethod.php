<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class PatchCustomerRequestPreferredPaymentMethod implements AdditionalPropertiesInterface
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
     * Preferred payment method. Omitted, `BANK_TRANSFER` applies.
     * If NONE is selected, no payment information will be shown on the invoice.
     *
     *
     * @var string
     */
    protected $method;

    /**
     * IBAN (International Bank Account Number).
     * Required when payment method is BANK_TRANSFER.
     *
     *
     * @var string
     */
    protected $iban;

    /**
     * SWIFT/BIC code
     *
     * @var string
     */
    protected $swift;

    /**
     * Payment term in days. When marking an invoice as paid, every field of this object
     * that travels replaces the stored one and every omitted field keeps its current value.
     *
     *
     * @var int|null
     */
    protected $paymentTermDays;

    /**
     * Preferred payment method. Omitted, `BANK_TRANSFER` applies.
     * If NONE is selected, no payment information will be shown on the invoice.
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Preferred payment method. Omitted, `BANK_TRANSFER` applies.
    If NONE is selected, no payment information will be shown on the invoice.
     */
    public function setMethod(string $method): self
    {
        $this->initialized['method'] = true;
        $this->method = $method;

        return $this;
    }

    /**
     * IBAN (International Bank Account Number).
     * Required when payment method is BANK_TRANSFER.
     */
    public function getIban(): string
    {
        return $this->iban;
    }

    /**
     * IBAN (International Bank Account Number).
    Required when payment method is BANK_TRANSFER.
     */
    public function setIban(string $iban): self
    {
        $this->initialized['iban'] = true;
        $this->iban = $iban;

        return $this;
    }

    /**
     * SWIFT/BIC code
     */
    public function getSwift(): string
    {
        return $this->swift;
    }

    /**
     * SWIFT/BIC code
     */
    public function setSwift(string $swift): self
    {
        $this->initialized['swift'] = true;
        $this->swift = $swift;

        return $this;
    }

    /**
     * Payment term in days. When marking an invoice as paid, every field of this object
     * that travels replaces the stored one and every omitted field keeps its current value.
     */
    public function getPaymentTermDays(): ?int
    {
        return $this->paymentTermDays;
    }

    /**
     * Payment term in days. When marking an invoice as paid, every field of this object
    that travels replaces the stored one and every omitted field keeps its current value.
     */
    public function setPaymentTermDays(?int $paymentTermDays): self
    {
        $this->initialized['paymentTermDays'] = true;
        $this->paymentTermDays = $paymentTermDays;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['method' => ['method', 'getMethod', 'setMethod'], 'iban' => ['iban', 'getIban', 'setIban'], 'swift' => ['swift', 'getSwift', 'setSwift'], 'paymentTermDays' => ['payment_term_days', 'getPaymentTermDays', 'setPaymentTermDays']];
    }
}
