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
     *
     * @return float
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }
    /**
     * VAT percentage
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
     * VAT type description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
     * VAT type description
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
     * VAT type code according to VeriFactu regulations
     *
     * @return string
     */
    public function getVerifactuCode(): string
    {
        return $this->verifactuCode;
    }
    /**
     * VAT type code according to VeriFactu regulations
     *
     * @param string $verifactuCode
     *
     * @return self
     */
    public function setVerifactuCode(string $verifactuCode): self
    {
        $this->initialized['verifactuCode'] = true;
        $this->verifactuCode = $verifactuCode;
        return $this;
    }
    /**
     * Whether the VAT type is active
     *
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }
    /**
     * Whether the VAT type is active
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
        return ['percentage' => ['percentage', 'getPercentage', 'setPercentage'], 'description' => ['description', 'getDescription', 'setDescription'], 'verifactuCode' => ['verifactu_code', 'getVerifactuCode', 'setVerifactuCode'], 'active' => ['active', 'getActive', 'setActive']];
    }
}