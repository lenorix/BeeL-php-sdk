<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class LineUnitPriceOutOfRangeDetails implements AdditionalPropertiesInterface
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
     * The line the quotient came from, by its position in the request's `lines` array
     * (`lines[0]` is the first line). Just `lines` when the line carries no position yet.
     *
     *
     * @var string
     */
    protected $field;

    /**
     * Largest unit price that can be stored, per unit.
     *
     * @var float
     */
    protected $max;

    /**
     * The quotient of total ÷ quantity that was rejected, computed at 4 decimal places.
     * It is a JSON number, so trailing zeros are not preserved: a quotient computed as
     * 9999999999.0000 is published as `9999999999`.
     *
     *
     * @var float
     */
    protected $derivedUnitPrice;

    /**
     * The line the quotient came from, by its position in the request's `lines` array
     * (`lines[0]` is the first line). Just `lines` when the line carries no position yet.
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * The line the quotient came from, by its position in the request's `lines` array
    (`lines[0]` is the first line). Just `lines` when the line carries no position yet.
     */
    public function setField(string $field): self
    {
        $this->initialized['field'] = true;
        $this->field = $field;

        return $this;
    }

    /**
     * Largest unit price that can be stored, per unit.
     */
    public function getMax(): float
    {
        return $this->max;
    }

    /**
     * Largest unit price that can be stored, per unit.
     */
    public function setMax(float $max): self
    {
        $this->initialized['max'] = true;
        $this->max = $max;

        return $this;
    }

    /**
     * The quotient of total ÷ quantity that was rejected, computed at 4 decimal places.
     * It is a JSON number, so trailing zeros are not preserved: a quotient computed as
     * 9999999999.0000 is published as `9999999999`.
     */
    public function getDerivedUnitPrice(): float
    {
        return $this->derivedUnitPrice;
    }

    /**
     * The quotient of total ÷ quantity that was rejected, computed at 4 decimal places.
    It is a JSON number, so trailing zeros are not preserved: a quotient computed as
    9999999999.0000 is published as `9999999999`.
     */
    public function setDerivedUnitPrice(float $derivedUnitPrice): self
    {
        $this->initialized['derivedUnitPrice'] = true;
        $this->derivedUnitPrice = $derivedUnitPrice;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['field' => ['field', 'getField', 'setField'], 'max' => ['max', 'getMax', 'setMax'], 'derivedUnitPrice' => ['derived_unit_price', 'getDerivedUnitPrice', 'setDerivedUnitPrice']];
    }
}
