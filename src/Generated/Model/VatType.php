<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class VatType implements AdditionalPropertiesInterface
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
     * VAT percentage
     *
     * @var float
     */
    protected $percentage;

    /**
     * VAT type description
     *
     * @var string
     */
    protected $description;

    /**
     * VAT type code according to VeriFactu regulations
     *
     * @var string
     */
    protected $verifactuCode;

    /**
     * Whether the VAT type is active
     *
     * @var bool
     */
    protected $active = true;

    /**
     * VAT percentage
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }

    /**
     * VAT percentage
     */
    public function setPercentage(float $percentage): self
    {
        $this->initialized['percentage'] = true;
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * VAT type description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * VAT type description
     */
    public function setDescription(string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;

        return $this;
    }

    /**
     * VAT type code according to VeriFactu regulations
     */
    public function getVerifactuCode(): string
    {
        return $this->verifactuCode;
    }

    /**
     * VAT type code according to VeriFactu regulations
     */
    public function setVerifactuCode(string $verifactuCode): self
    {
        $this->initialized['verifactuCode'] = true;
        $this->verifactuCode = $verifactuCode;

        return $this;
    }

    /**
     * Whether the VAT type is active
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Whether the VAT type is active
     */
    public function setActive(bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['percentage' => ['percentage', 'getPercentage', 'setPercentage'], 'description' => ['description', 'getDescription', 'setDescription'], 'verifactuCode' => ['verifactu_code', 'getVerifactuCode', 'setVerifactuCode'], 'active' => ['active', 'getActive', 'setActive']];
    }
}
