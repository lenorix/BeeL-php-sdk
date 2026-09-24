<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class LegalRepresentativeAddress implements AdditionalPropertiesInterface
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
     * Full address (street, number, floor, etc.) - Latin characters only
     *
     * @var string
     */
    protected $street;
    /**
     * Street number. Optional: omit it when the address has none, or when `street` already
     * carries the address in full.
     * 
     *
     * @var string
     */
    protected $number;
    /**
     * Floor or level
     *
     * @var string
     */
    protected $floor;
    /**
     * Door or apartment
     *
     * @var string
     */
    protected $door;
    /**
     * Postal code (5 digits for Spain, free format for other countries)
     *
     * @var string
     */
    protected $postalCode;
    /**
     * City or town - Latin characters only
     *
     * @var string
     */
    protected $city;
    /**
     * Province or state - Latin characters only
     *
     * @var string
     */
    protected $province;
    /**
     * Country - Latin characters only.
     * Omitted, it is derived from `country_code` (its Spanish name); with neither field
     * present, `España` is the last resort.
     * 
     *
     * @var string
     */
    protected $country;
    /**
     * ISO 3166-1 alpha-2 country code.
     * Omitted, the address is stored as `ES`.
     * 
     *
     * @var string
     */
    protected $countryCode;
    /**
     * Full address (street, number, floor, etc.) - Latin characters only
     *
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }
    /**
     * Full address (street, number, floor, etc.) - Latin characters only
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
     * Street number. Optional: omit it when the address has none, or when `street` already
     * carries the address in full.
     * 
     *
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }
    /**
    * Street number. Optional: omit it when the address has none, or when `street` already
    carries the address in full.
    
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
     * Floor or level
     *
     * @return string
     */
    public function getFloor(): string
    {
        return $this->floor;
    }
    /**
     * Floor or level
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
     * Door or apartment
     *
     * @return string
     */
    public function getDoor(): string
    {
        return $this->door;
    }
    /**
     * Door or apartment
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
     * Postal code (5 digits for Spain, free format for other countries)
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }
    /**
     * Postal code (5 digits for Spain, free format for other countries)
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
     * City or town - Latin characters only
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }
    /**
     * City or town - Latin characters only
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
     * Province or state - Latin characters only
     *
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }
    /**
     * Province or state - Latin characters only
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
     * Country - Latin characters only.
     * Omitted, it is derived from `country_code` (its Spanish name); with neither field
     * present, `España` is the last resort.
     * 
     *
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
    /**
    * Country - Latin characters only.
    Omitted, it is derived from `country_code` (its Spanish name); with neither field
    present, `España` is the last resort.
    
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
     * Omitted, the address is stored as `ES`.
     * 
     *
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
    /**
    * ISO 3166-1 alpha-2 country code.
    Omitted, the address is stored as `ES`.
    
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