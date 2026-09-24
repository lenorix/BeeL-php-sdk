<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class TaxRegime implements AdditionalPropertiesInterface
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
     * Tax regime code
     *
     * @var string
     */
    protected $code;
    /**
     * Tax regime name
     *
     * @var string
     */
    protected $name;
    /**
     * Detailed description of the tax regime
     *
     * @var string
     */
    protected $description;
    /**
     * Available percentages in this regime
     *
     * @var list<TaxPercentage>
     */
    protected $taxRates;
    /**
     * Whether this regime applies equivalence surcharge
     *
     * @var bool
     */
    protected $appliesEquivalenceSurcharge;
    /**
     * Valid VeriFactu regime keys for this tax type
     *
     * @var list<VeriFactuRegimeKey>
     */
    protected $regimeKeys;
    /**
     * Tax regime code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
    /**
     * Tax regime code
     *
     * @param string $code
     *
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;
        return $this;
    }
    /**
     * Tax regime name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * Tax regime name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * Detailed description of the tax regime
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
     * Detailed description of the tax regime
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;
        return $this;
    }
    /**
     * Available percentages in this regime
     *
     * @return list<TaxPercentage>
     */
    public function getTaxRates(): array
    {
        return $this->taxRates;
    }
    /**
     * Available percentages in this regime
     *
     * @param list<TaxPercentage> $taxRates
     *
     * @return self
     */
    public function setTaxRates(array $taxRates): self
    {
        $this->initialized['taxRates'] = true;
        $this->taxRates = $taxRates;
        return $this;
    }
    /**
     * Whether this regime applies equivalence surcharge
     *
     * @return bool
     */
    public function getAppliesEquivalenceSurcharge(): bool
    {
        return $this->appliesEquivalenceSurcharge;
    }
    /**
     * Whether this regime applies equivalence surcharge
     *
     * @param bool $appliesEquivalenceSurcharge
     *
     * @return self
     */
    public function setAppliesEquivalenceSurcharge(bool $appliesEquivalenceSurcharge): self
    {
        $this->initialized['appliesEquivalenceSurcharge'] = true;
        $this->appliesEquivalenceSurcharge = $appliesEquivalenceSurcharge;
        return $this;
    }
    /**
     * Valid VeriFactu regime keys for this tax type
     *
     * @return list<VeriFactuRegimeKey>
     */
    public function getRegimeKeys(): array
    {
        return $this->regimeKeys;
    }
    /**
     * Valid VeriFactu regime keys for this tax type
     *
     * @param list<VeriFactuRegimeKey> $regimeKeys
     *
     * @return self
     */
    public function setRegimeKeys(array $regimeKeys): self
    {
        $this->initialized['regimeKeys'] = true;
        $this->regimeKeys = $regimeKeys;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['code' => ['code', 'getCode', 'setCode'], 'name' => ['name', 'getName', 'setName'], 'description' => ['description', 'getDescription', 'setDescription'], 'taxRates' => ['tax_rates', 'getTaxRates', 'setTaxRates'], 'appliesEquivalenceSurcharge' => ['applies_equivalence_surcharge', 'getAppliesEquivalenceSurcharge', 'setAppliesEquivalenceSurcharge'], 'regimeKeys' => ['regime_keys', 'getRegimeKeys', 'setRegimeKeys']];
    }
}