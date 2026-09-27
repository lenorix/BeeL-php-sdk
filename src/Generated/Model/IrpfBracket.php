<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class IrpfBracket implements AdditionalPropertiesInterface
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
     * Lower bound of taxable base
     *
     * @var float
     */
    protected $baseFrom;
    /**
     * Upper bound of taxable base (null for unlimited)
     *
     * @var float|null
     */
    protected $baseTo;
    /**
     * Tax rate percentage for this bracket
     *
     * @var float
     */
    protected $ratePercentage;
    /**
     * Portion of income falling in this bracket
     *
     * @var float
     */
    protected $applicableBase;
    /**
     * Tax amount for this bracket
     *
     * @var float
     */
    protected $amount;
    /**
     * Lower bound of taxable base
     *
     * @return float
     */
    public function getBaseFrom(): float
    {
        return $this->baseFrom;
    }
    /**
     * Lower bound of taxable base
     *
     * @param float $baseFrom
     *
     * @return self
     */
    public function setBaseFrom(float $baseFrom): self
    {
        $this->initialized['baseFrom'] = true;
        $this->baseFrom = $baseFrom;
        return $this;
    }
    /**
     * Upper bound of taxable base (null for unlimited)
     *
     * @return float|null
     */
    public function getBaseTo(): ?float
    {
        return $this->baseTo;
    }
    /**
     * Upper bound of taxable base (null for unlimited)
     *
     * @param float|null $baseTo
     *
     * @return self
     */
    public function setBaseTo(?float $baseTo): self
    {
        $this->initialized['baseTo'] = true;
        $this->baseTo = $baseTo;
        return $this;
    }
    /**
     * Tax rate percentage for this bracket
     *
     * @return float
     */
    public function getRatePercentage(): float
    {
        return $this->ratePercentage;
    }
    /**
     * Tax rate percentage for this bracket
     *
     * @param float $ratePercentage
     *
     * @return self
     */
    public function setRatePercentage(float $ratePercentage): self
    {
        $this->initialized['ratePercentage'] = true;
        $this->ratePercentage = $ratePercentage;
        return $this;
    }
    /**
     * Portion of income falling in this bracket
     *
     * @return float
     */
    public function getApplicableBase(): float
    {
        return $this->applicableBase;
    }
    /**
     * Portion of income falling in this bracket
     *
     * @param float $applicableBase
     *
     * @return self
     */
    public function setApplicableBase(float $applicableBase): self
    {
        $this->initialized['applicableBase'] = true;
        $this->applicableBase = $applicableBase;
        return $this;
    }
    /**
     * Tax amount for this bracket
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
    /**
     * Tax amount for this bracket
     *
     * @param float $amount
     *
     * @return self
     */
    public function setAmount(float $amount): self
    {
        $this->initialized['amount'] = true;
        $this->amount = $amount;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['baseFrom' => ['base_from', 'getBaseFrom', 'setBaseFrom'], 'baseTo' => ['base_to', 'getBaseTo', 'setBaseTo'], 'ratePercentage' => ['rate_percentage', 'getRatePercentage', 'setRatePercentage'], 'applicableBase' => ['applicable_base', 'getApplicableBase', 'setApplicableBase'], 'amount' => ['amount', 'getAmount', 'setAmount']];
    }
}