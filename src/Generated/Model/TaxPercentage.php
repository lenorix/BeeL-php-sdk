<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class TaxPercentage implements AdditionalPropertiesInterface
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
     * Tax percentage
     *
     * @var float
     */
    protected $percentage;
    /**
     * Tax type description
     *
     * @var string
     */
    protected $description;
    /**
     * Indicates whether the type is active
     *
     * @var bool
     */
    protected $active = true;
    /**
     * Associated equivalence surcharge percentage (only for VAT)
     *
     * @var float|null
     */
    protected $associatedEquivalenceSurcharge;
    /**
     * Tax percentage
     *
     * @return float
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }
    /**
     * Tax percentage
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
     * Tax type description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
     * Tax type description
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
     * Indicates whether the type is active
     *
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }
    /**
     * Indicates whether the type is active
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
    /**
     * Associated equivalence surcharge percentage (only for VAT)
     *
     * @return float|null
     */
    public function getAssociatedEquivalenceSurcharge(): ?float
    {
        return $this->associatedEquivalenceSurcharge;
    }
    /**
     * Associated equivalence surcharge percentage (only for VAT)
     *
     * @param float|null $associatedEquivalenceSurcharge
     *
     * @return self
     */
    public function setAssociatedEquivalenceSurcharge(?float $associatedEquivalenceSurcharge): self
    {
        $this->initialized['associatedEquivalenceSurcharge'] = true;
        $this->associatedEquivalenceSurcharge = $associatedEquivalenceSurcharge;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['percentage' => ['percentage', 'getPercentage', 'setPercentage'], 'description' => ['description', 'getDescription', 'setDescription'], 'active' => ['active', 'getActive', 'setActive'], 'associatedEquivalenceSurcharge' => ['associated_equivalence_surcharge', 'getAssociatedEquivalenceSurcharge', 'setAssociatedEquivalenceSurcharge']];
    }
}