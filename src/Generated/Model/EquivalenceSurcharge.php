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
     * First operation date on which AEAT accepts this VAT ↔ surcharge pair; `null` when it has no start.
     * The date judged is the invoice's `operation_date`, or its issue date when it has none.
     *
     *
     * @var \DateTime|null
     */
    protected $validFrom;

    /**
     * Last operation date on which AEAT accepts this VAT ↔ surcharge pair; `null` when it has no end.
     * A rate with a `valid_until` in the past only fits invoices for operations of its period.
     *
     *
     * @var \DateTime|null
     */
    protected $validUntil;

    /**
     * Equivalence surcharge percentage
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }

    /**
     * Equivalence surcharge percentage
     */
    public function setPercentage(float $percentage): self
    {
        $this->initialized['percentage'] = true;
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * VAT percentage to which this surcharge is associated
     */
    public function getAssociatedVat(): float
    {
        return $this->associatedVat;
    }

    /**
     * VAT percentage to which this surcharge is associated
     */
    public function setAssociatedVat(float $associatedVat): self
    {
        $this->initialized['associatedVat'] = true;
        $this->associatedVat = $associatedVat;

        return $this;
    }

    /**
     * Equivalence surcharge description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Equivalence surcharge description
     */
    public function setDescription(string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;

        return $this;
    }

    /**
     * Whether the surcharge is active
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Whether the surcharge is active
     */
    public function setActive(bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;

        return $this;
    }

    /**
     * First operation date on which AEAT accepts this VAT ↔ surcharge pair; `null` when it has no start.
     * The date judged is the invoice's `operation_date`, or its issue date when it has none.
     */
    public function getValidFrom(): ?\DateTime
    {
        return $this->validFrom;
    }

    /**
     * First operation date on which AEAT accepts this VAT ↔ surcharge pair; `null` when it has no start.
    The date judged is the invoice's `operation_date`, or its issue date when it has none.
     */
    public function setValidFrom(?\DateTime $validFrom): self
    {
        $this->initialized['validFrom'] = true;
        $this->validFrom = $validFrom;

        return $this;
    }

    /**
     * Last operation date on which AEAT accepts this VAT ↔ surcharge pair; `null` when it has no end.
     * A rate with a `valid_until` in the past only fits invoices for operations of its period.
     */
    public function getValidUntil(): ?\DateTime
    {
        return $this->validUntil;
    }

    /**
     * Last operation date on which AEAT accepts this VAT ↔ surcharge pair; `null` when it has no end.
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
        return ['percentage' => ['percentage', 'getPercentage', 'setPercentage'], 'associatedVat' => ['associated_vat', 'getAssociatedVat', 'setAssociatedVat'], 'description' => ['description', 'getDescription', 'setDescription'], 'active' => ['active', 'getActive', 'setActive'], 'validFrom' => ['valid_from', 'getValidFrom', 'setValidFrom'], 'validUntil' => ['valid_until', 'getValidUntil', 'setValidUntil']];
    }
}
