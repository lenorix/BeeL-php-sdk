<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class TaxBreakdownItem implements AdditionalPropertiesInterface
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
     * Tax type: IVA, IGIC, IPSI, OTHER
     *
     * @var string
     */
    protected $taxType;

    /**
     * Tax rate percentage
     *
     * @var float
     */
    protected $percentage;

    /**
     * Taxable base for this tax type/rate
     *
     * @var float
     */
    protected $taxableBase;

    /**
     * Tax amount (base * rate / 100)
     *
     * @var float
     */
    protected $taxAmount;

    /**
     * VeriFactu regime key of the rows grouped here. Rows are grouped by
     * (tax type, rate, regime key), so an invoice mixing general-regime and OSS lines
     * at the same rate yields TWO rows at `percentage: 21` that only this field tells
     * apart (`01` vs `17`). Index by `(tax_type, percentage, regime_key)`, never by
     * `(tax_type, percentage)` alone.
     *
     *
     * @var string
     */
    protected $regimeKey;

    /**
     * Tax type: IVA, IGIC, IPSI, OTHER
     */
    public function getTaxType(): string
    {
        return $this->taxType;
    }

    /**
     * Tax type: IVA, IGIC, IPSI, OTHER
     */
    public function setTaxType(string $taxType): self
    {
        $this->initialized['taxType'] = true;
        $this->taxType = $taxType;

        return $this;
    }

    /**
     * Tax rate percentage
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }

    /**
     * Tax rate percentage
     */
    public function setPercentage(float $percentage): self
    {
        $this->initialized['percentage'] = true;
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * Taxable base for this tax type/rate
     */
    public function getTaxableBase(): float
    {
        return $this->taxableBase;
    }

    /**
     * Taxable base for this tax type/rate
     */
    public function setTaxableBase(float $taxableBase): self
    {
        $this->initialized['taxableBase'] = true;
        $this->taxableBase = $taxableBase;

        return $this;
    }

    /**
     * Tax amount (base * rate / 100)
     */
    public function getTaxAmount(): float
    {
        return $this->taxAmount;
    }

    /**
     * Tax amount (base * rate / 100)
     */
    public function setTaxAmount(float $taxAmount): self
    {
        $this->initialized['taxAmount'] = true;
        $this->taxAmount = $taxAmount;

        return $this;
    }

    /**
     * VeriFactu regime key of the rows grouped here. Rows are grouped by
     * (tax type, rate, regime key), so an invoice mixing general-regime and OSS lines
     * at the same rate yields TWO rows at `percentage: 21` that only this field tells
     * apart (`01` vs `17`). Index by `(tax_type, percentage, regime_key)`, never by
     * `(tax_type, percentage)` alone.
     */
    public function getRegimeKey(): string
    {
        return $this->regimeKey;
    }

    /**
     * VeriFactu regime key of the rows grouped here. Rows are grouped by
    (tax type, rate, regime key), so an invoice mixing general-regime and OSS lines
    at the same rate yields TWO rows at `percentage: 21` that only this field tells
    apart (`01` vs `17`). Index by `(tax_type, percentage, regime_key)`, never by
    `(tax_type, percentage)` alone.
     */
    public function setRegimeKey(string $regimeKey): self
    {
        $this->initialized['regimeKey'] = true;
        $this->regimeKey = $regimeKey;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['taxType' => ['tax_type', 'getTaxType', 'setTaxType'], 'percentage' => ['percentage', 'getPercentage', 'setPercentage'], 'taxableBase' => ['taxable_base', 'getTaxableBase', 'setTaxableBase'], 'taxAmount' => ['tax_amount', 'getTaxAmount', 'setTaxAmount'], 'regimeKey' => ['regime_key', 'getRegimeKey', 'setRegimeKey']];
    }
}
