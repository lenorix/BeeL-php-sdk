<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class InvoiceTotalsIrpfBreakdownItem implements AdditionalPropertiesInterface
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

    public function getType(): float
    {
        return $this->type;
    }

    public function setType(float $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;

        return $this;
    }

    public function getBase(): float
    {
        return $this->base;
    }

    public function setBase(float $base): self
    {
        $this->initialized['base'] = true;
        $this->base = $base;

        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

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
