<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class InvoiceTotalsSurchargeBreakdownItem implements AdditionalPropertiesInterface
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
     * @var float
     */
    protected $type;
    /**
     * @var float
     */
    protected $base;
    /**
     * @var float
     */
    protected $amount;
    /**
     * @return float
     */
    public function getType(): float
    {
        return $this->type;
    }
    /**
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
     * @return float
     */
    public function getBase(): float
    {
        return $this->base;
    }
    /**
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
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
    /**
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