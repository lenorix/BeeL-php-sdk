<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class EquivalenceSurcharge implements AdditionalPropertiesInterface
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
     * Equivalence surcharge percentage
     *
     * @var float
     */
    protected $percentage;
    /**
     * VAT percentage to which this surcharge is associated
     *
     * @var float
     */
    protected $associatedVat;
    /**
     * Equivalence surcharge description
     *
     * @var string
     */
    protected $description;
    /**
     * Whether the surcharge is active
     *
     * @var bool
     */
    protected $active = true;
    /**
     * Equivalence surcharge percentage
     *
     * @return float
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }
    /**
     * Equivalence surcharge percentage
     *
     * @param float $percentage
     *
     * @return self
     */
    public function setPercentage(float $percentage): self
    {
        $this->initialized['percentage'] = true;
        $this->percentage = $percentage;
        return $this;
    }
    /**
     * VAT percentage to which this surcharge is associated
     *
     * @return float
     */
    public function getAssociatedVat(): float
    {
        return $this->associatedVat;
    }
    /**
     * VAT percentage to which this surcharge is associated
     *
     * @param float $associatedVat
     *
     * @return self
     */
    public function setAssociatedVat(float $associatedVat): self
    {
        $this->initialized['associatedVat'] = true;
        $this->associatedVat = $associatedVat;
        return $this;
    }
    /**
     * Equivalence surcharge description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
     * Equivalence surcharge description
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
     * Whether the surcharge is active
     *
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }
    /**
     * Whether the surcharge is active
     *
     * @param bool $active
     *
     * @return self
     */
    public function setActive(bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['percentage' => ['percentage', 'getPercentage', 'setPercentage'], 'associatedVat' => ['associated_vat', 'getAssociatedVat', 'setAssociatedVat'], 'description' => ['description', 'getDescription', 'setDescription'], 'active' => ['active', 'getActive', 'setActive']];
    }
}