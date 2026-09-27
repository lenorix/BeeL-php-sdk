<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class LegalRepresentative implements AdditionalPropertiesInterface
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
     * Full name of the legal representative
     *
     * @var string
     */
    protected $fullName;
    /**
     * Tax ID of the legal representative (DNI/CIF/NIE)
     *
     * @var string
     */
    protected $nif;
    /**
     * @var LegalRepresentativeAddress
     */
    protected $address;
    /**
     * Full name of the legal representative
     *
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }
    /**
     * Full name of the legal representative
     *
     * @param string $fullName
     *
     * @return self
     */
    public function setFullName(string $fullName): self
    {
        $this->initialized['fullName'] = true;
        $this->fullName = $fullName;
        return $this;
    }
    /**
     * Tax ID of the legal representative (DNI/CIF/NIE)
     *
     * @return string
     */
    public function getNif(): string
    {
        return $this->nif;
    }
    /**
     * Tax ID of the legal representative (DNI/CIF/NIE)
     *
     * @param string $nif
     *
     * @return self
     */
    public function setNif(string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;
        return $this;
    }
    /**
     * @return LegalRepresentativeAddress
     */
    public function getAddress(): LegalRepresentativeAddress
    {
        return $this->address;
    }
    /**
     * @param LegalRepresentativeAddress $address
     *
     * @return self
     */
    public function setAddress(LegalRepresentativeAddress $address): self
    {
        $this->initialized['address'] = true;
        $this->address = $address;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['fullName' => ['full_name', 'getFullName', 'setFullName'], 'nif' => ['nif', 'getNif', 'setNif'], 'address' => ['address', 'getAddress', 'setAddress']];
    }
}