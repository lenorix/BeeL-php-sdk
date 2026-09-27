<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class IrpfType implements AdditionalPropertiesInterface
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
     * IRPF withholding percentage
     *
     * @var float
     */
    protected $percentage;

    /**
     * IRPF type description
     *
     * @var string
     */
    protected $description;

    /**
     * Whether the IRPF type is active
     *
     * @var bool
     */
    protected $active = true;

    /**
     * IRPF withholding percentage
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }

    /**
     * IRPF withholding percentage
     */
    public function setPercentage(float $percentage): self
    {
        $this->initialized['percentage'] = true;
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * IRPF type description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * IRPF type description
     */
    public function setDescription(string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;

        return $this;
    }

    /**
     * Whether the IRPF type is active
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Whether the IRPF type is active
     */
    public function setActive(bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['percentage' => ['percentage', 'getPercentage', 'setPercentage'], 'description' => ['description', 'getDescription', 'setDescription'], 'active' => ['active', 'getActive', 'setActive']];
    }
}
