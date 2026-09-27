<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class InvoiceTotalsVatBreakdownItem implements AdditionalPropertiesInterface
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
     * VeriFactu regime key of the rows grouped here. Rows are grouped by
     * (tax type, rate, regime key), so an invoice mixing general-regime and
     * equivalence-surcharge lines at the same rate yields TWO rows at
     * `type: 21` that only this field tells apart (`01` vs `18`). Index by
     * `(type, regime_key)`, never by `type` alone.
     *
     *
     * @var string
     */
    protected $regimeKey;

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

    /**
     * VeriFactu regime key of the rows grouped here. Rows are grouped by
     * (tax type, rate, regime key), so an invoice mixing general-regime and
     * equivalence-surcharge lines at the same rate yields TWO rows at
     * `type: 21` that only this field tells apart (`01` vs `18`). Index by
     * `(type, regime_key)`, never by `type` alone.
     */
    public function getRegimeKey(): string
    {
        return $this->regimeKey;
    }

    /**
     * VeriFactu regime key of the rows grouped here. Rows are grouped by
    (tax type, rate, regime key), so an invoice mixing general-regime and
    equivalence-surcharge lines at the same rate yields TWO rows at
    `type: 21` that only this field tells apart (`01` vs `18`). Index by
    `(type, regime_key)`, never by `type` alone.
     */
    public function setRegimeKey(string $regimeKey): self
    {
        $this->initialized['regimeKey'] = true;
        $this->regimeKey = $regimeKey;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['type' => ['type', 'getType', 'setType'], 'base' => ['base', 'getBase', 'setBase'], 'amount' => ['amount', 'getAmount', 'setAmount'], 'regimeKey' => ['regime_key', 'getRegimeKey', 'setRegimeKey']];
    }
}
