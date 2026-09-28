<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class SurchargeBreakdownItem implements AdditionalPropertiesInterface
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
     * Surcharge rate percentage
     *
     * @var float
     */
    protected $type;
    /**
     * Taxable base subject to this surcharge rate
     *
     * @var float
     */
    protected $base;
    /**
     * Surcharge amount (base * rate / 100)
     *
     * @var float
     */
    protected $amount;
    /**
     * Surcharge rate percentage
     *
     * @return float
     */
    public function getType(): float
    {
        return $this->type;
    }
    /**
     * Surcharge rate percentage
     *
     * @param float $type
     *
     * @return self
     */
    public function setType(float $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
    /**
     * Taxable base subject to this surcharge rate
     *
     * @return float
     */
    public function getBase(): float
    {
        return $this->base;
    }
    /**
     * Taxable base subject to this surcharge rate
     *
     * @param float $base
     *
     * @return self
     */
    public function setBase(float $base): self
    {
        $this->initialized['base'] = true;
        $this->base = $base;
        return $this;
    }
    /**
     * Surcharge amount (base * rate / 100)
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
    /**
     * Surcharge amount (base * rate / 100)
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
        return ['type' => ['type', 'getType', 'setType'], 'base' => ['base', 'getBase', 'setBase'], 'amount' => ['amount', 'getAmount', 'setAmount']];
    }
}