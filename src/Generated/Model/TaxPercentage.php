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
     * First operation date on which AEAT accepts this rate; `null` when it has no start.
     * The date judged is the invoice's `operation_date`, or its issue date when it has none.
     *
     *
     * @var \DateTime|null
     */
    protected $validFrom;

    /**
     * Last operation date on which AEAT accepts this rate; `null` when it has no end.
     * A rate with a `valid_until` in the past only fits invoices for operations of its period.
     *
     *
     * @var \DateTime|null
     */
    protected $validUntil;

    /**
     * Tax percentage
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }

    /**
     * Tax percentage
     */
    public function setPercentage(float $percentage): self
    {
        $this->initialized['percentage'] = true;
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * Tax type description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Tax type description
     */
    public function setDescription(string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;

        return $this;
    }

    /**
     * Indicates whether the type is active
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Indicates whether the type is active
     */
    public function setActive(bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;

        return $this;
    }

    /**
     * Associated equivalence surcharge percentage (only for VAT)
     */
    public function getAssociatedEquivalenceSurcharge(): ?float
    {
        return $this->associatedEquivalenceSurcharge;
    }

    /**
     * Associated equivalence surcharge percentage (only for VAT)
     */
    public function setAssociatedEquivalenceSurcharge(?float $associatedEquivalenceSurcharge): self
    {
        $this->initialized['associatedEquivalenceSurcharge'] = true;
        $this->associatedEquivalenceSurcharge = $associatedEquivalenceSurcharge;

        return $this;
    }

    /**
     * First operation date on which AEAT accepts this rate; `null` when it has no start.
     * The date judged is the invoice's `operation_date`, or its issue date when it has none.
     */
    public function getValidFrom(): ?\DateTime
    {
        return $this->validFrom;
    }

    /**
     * First operation date on which AEAT accepts this rate; `null` when it has no start.
    The date judged is the invoice's `operation_date`, or its issue date when it has none.
     */
    public function setValidFrom(?\DateTime $validFrom): self
    {
        $this->initialized['validFrom'] = true;
        $this->validFrom = $validFrom;

        return $this;
    }

    /**
     * Last operation date on which AEAT accepts this rate; `null` when it has no end.
     * A rate with a `valid_until` in the past only fits invoices for operations of its period.
     */
    public function getValidUntil(): ?\DateTime
    {
        return $this->validUntil;
    }

    /**
     * Last operation date on which AEAT accepts this rate; `null` when it has no end.
    A rate with a `valid_until` in the past only fits invoices for operations of its period.
     */
    public function setValidUntil(?\DateTime $validUntil): self
    {
        $this->initialized['validUntil'] = true;
        $this->validUntil = $validUntil;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['percentage' => ['percentage', 'getPercentage', 'setPercentage'], 'description' => ['description', 'getDescription', 'setDescription'], 'active' => ['active', 'getActive', 'setActive'], 'associatedEquivalenceSurcharge' => ['associated_equivalence_surcharge', 'getAssociatedEquivalenceSurcharge', 'setAssociatedEquivalenceSurcharge'], 'validFrom' => ['valid_from', 'getValidFrom', 'setValidFrom'], 'validUntil' => ['valid_until', 'getValidUntil', 'setValidUntil']];
    }
}
