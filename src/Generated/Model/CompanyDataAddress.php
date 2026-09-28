<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CompanyDataAddress implements AdditionalPropertiesInterface
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
     * Street of the fiscal address.
     *
     * @var string
     */
    protected $street;
    /**
     * Street number.
     *
     * @var string
     */
    protected $number;
    /**
     * Floor or level.
     *
     * @var string
     */
    protected $floor;
    /**
     * Door or apartment.
     *
     * @var string
     */
    protected $door;
    /**
     * Postal code.
     *
     * @var string
     */
    protected $postalCode;
    /**
     * City or town.
     *
     * @var string
     */
    protected $city;
    /**
     * Province.
     *
     * @var string
     */
    protected $province;
    /**
     * Country name.
     *
     * @var string
     */
    protected $country;
    /**
     * ISO 3166-1 alpha-2 country code.
     *
     * @var string
     */
    protected $countryCode;
    /**
     * Street of the fiscal address.
     *
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }
    /**
     * Street of the fiscal address.
     *
     * @param string $street
     *
     * @return self
     */
    public function setStreet(string $street): self
    {
        $this->initialized['street'] = true;
        $this->street = $street;
        return $this;
    }
    /**
     * Street number.
     *
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }
    /**
     * Street number.
     *
     * @param string $number
     *
     * @return self
     */
    public function setNumber(string $number): self
    {
        $this->initialized['number'] = true;
        $this->number = $number;
        return $this;
    }
    /**
     * Floor or level.
     *
     * @return string
     */
    public function getFloor(): string
    {
        return $this->floor;
    }
    /**
     * Floor or level.
     *
     * @param string $floor
     *
     * @return self
     */
    public function setFloor(string $floor): self
    {
        $this->initialized['floor'] = true;
        $this->floor = $floor;
        return $this;
    }
    /**
     * Door or apartment.
     *
     * @return string
     */
    public function getDoor(): string
    {
        return $this->door;
    }
    /**
     * Door or apartment.
     *
     * @param string $door
     *
     * @return self
     */
    public function setDoor(string $door): self
    {
        $this->initialized['door'] = true;
        $this->door = $door;
        return $this;
    }
    /**
     * Postal code.
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }
    /**
     * Postal code.
     *
     * @param string $postalCode
     *
     * @return self
     */
    public function setPostalCode(string $postalCode): self
    {
        $this->initialized['postalCode'] = true;
        $this->postalCode = $postalCode;
        return $this;
    }
    /**
     * City or town.
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }
    /**
     * City or town.
     *
     * @param string $city
     *
     * @return self
     */
    public function setCity(string $city): self
    {
        $this->initialized['city'] = true;
        $this->city = $city;
        return $this;
    }
    /**
     * Province.
     *
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }
    /**
     * Province.
     *
     * @param string $province
     *
     * @return self
     */
    public function setProvince(string $province): self
    {
        $this->initialized['province'] = true;
        $this->province = $province;
        return $this;
    }
    /**
     * Country name.
     *
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
    /**
     * Country name.
     *
     * @param string $country
     *
     * @return self
     */
    public function setCountry(string $country): self
    {
        $this->initialized['country'] = true;
        $this->country = $country;
        return $this;
    }
    /**
     * ISO 3166-1 alpha-2 country code.
     *
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
    /**
     * ISO 3166-1 alpha-2 country code.
     *
     * @param string $countryCode
     *
     * @return self
     */
    public function setCountryCode(string $countryCode): self
    {
        $this->initialized['countryCode'] = true;
        $this->countryCode = $countryCode;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['street' => ['street', 'getStreet', 'setStreet'], 'number' => ['number', 'getNumber', 'setNumber'], 'floor' => ['floor', 'getFloor', 'setFloor'], 'door' => ['door', 'getDoor', 'setDoor'], 'postalCode' => ['postal_code', 'getPostalCode', 'setPostalCode'], 'city' => ['city', 'getCity', 'setCity'], 'province' => ['province', 'getProvince', 'setProvince'], 'country' => ['country', 'getCountry', 'setCountry'], 'countryCode' => ['country_code', 'getCountryCode', 'setCountryCode']];
    }
}