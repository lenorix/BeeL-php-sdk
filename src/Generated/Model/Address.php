<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class Address implements AdditionalPropertiesInterface
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
     * @var string|null
     */
    protected $number;
    /**
     * Floor or level
     *
     * @var string|null
     */
    protected $floor;
    /**
     * Door or apartment
     *
     * @var string|null
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
     * Province or state - Latin characters only. Required for an address in Spain
     * (`country_code` `ES`, or no country at all); optional elsewhere, where many addresses
     * have none. A Spanish address without it is rejected with a `422`.
     * 
     *
     * @var string|null
     */
    protected $province;
    /**
     * Country of the address, as its ISO 3166-1 alpha-2 code (`GB`) or its official name
     * in Spanish, English or Catalan (`Reino Unido`, `United Kingdom`, `Regne Unit`;
     * case and accents are ignored). Anything else, such as `UK`, is rejected with
     * `422 COUNTRY_CODE_REQUIRED`: send `country_code` instead. If it names a different
     * country than `country_code`, `422 COUNTRY_CODE_MISMATCH` (`España` alone yields to
     * a foreign `country_code`: it was the old default). What is stored and
     * returned is always the Spanish name derived from the resulting code, never the
     * text sent. With neither field present, the address is Spanish (`España`).
     * 
     *
     * @var string|null
     */
    protected $country;
    /**
     * ISO 3166-1 alpha-2 country code: the canonical field that decides the country of
     * the address. It must be a real country code (`GB`, not `UK`); otherwise
     * `422 COUNTRY_CODE_REQUIRED`. When it is omitted, the code comes from `country`
     * (see there). With neither field present, the address is stored as `ES`.
     * 
     *
     * @var string|null
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
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }
    /**
    * Street number. Optional: omit it when the address has none, or when `street` already
    carries the address in full.
    
    *
    * @param string|null $number
    *
    * @return self
    */
    public function setNumber(?string $number): self
    {
        $this->initialized['number'] = true;
        $this->number = $number;
        return $this;
    }
    /**
     * Floor or level
     *
     * @return string|null
     */
    public function getFloor(): ?string
    {
        return $this->floor;
    }
    /**
     * Floor or level
     *
     * @param string|null $floor
     *
     * @return self
     */
    public function setFloor(?string $floor): self
    {
        $this->initialized['floor'] = true;
        $this->floor = $floor;
        return $this;
    }
    /**
     * Door or apartment
     *
     * @return string|null
     */
    public function getDoor(): ?string
    {
        return $this->door;
    }
    /**
     * Door or apartment
     *
     * @param string|null $door
     *
     * @return self
     */
    public function setDoor(?string $door): self
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
     * Province or state - Latin characters only. Required for an address in Spain
     * (`country_code` `ES`, or no country at all); optional elsewhere, where many addresses
     * have none. A Spanish address without it is rejected with a `422`.
     * 
     *
     * @return string|null
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }
    /**
    * Province or state - Latin characters only. Required for an address in Spain
    (`country_code` `ES`, or no country at all); optional elsewhere, where many addresses
    have none. A Spanish address without it is rejected with a `422`.
    
    *
    * @param string|null $province
    *
    * @return self
    */
    public function setProvince(?string $province): self
    {
        $this->initialized['province'] = true;
        $this->province = $province;
        return $this;
    }
    /**
     * Country of the address, as its ISO 3166-1 alpha-2 code (`GB`) or its official name
     * in Spanish, English or Catalan (`Reino Unido`, `United Kingdom`, `Regne Unit`;
     * case and accents are ignored). Anything else, such as `UK`, is rejected with
     * `422 COUNTRY_CODE_REQUIRED`: send `country_code` instead. If it names a different
     * country than `country_code`, `422 COUNTRY_CODE_MISMATCH` (`España` alone yields to
     * a foreign `country_code`: it was the old default). What is stored and
     * returned is always the Spanish name derived from the resulting code, never the
     * text sent. With neither field present, the address is Spanish (`España`).
     * 
     *
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }
    /**
    * Country of the address, as its ISO 3166-1 alpha-2 code (`GB`) or its official name
    in Spanish, English or Catalan (`Reino Unido`, `United Kingdom`, `Regne Unit`;
    case and accents are ignored). Anything else, such as `UK`, is rejected with
    `422 COUNTRY_CODE_REQUIRED`: send `country_code` instead. If it names a different
    country than `country_code`, `422 COUNTRY_CODE_MISMATCH` (`España` alone yields to
    a foreign `country_code`: it was the old default). What is stored and
    returned is always the Spanish name derived from the resulting code, never the
    text sent. With neither field present, the address is Spanish (`España`).
    
    *
    * @param string|null $country
    *
    * @return self
    */
    public function setCountry(?string $country): self
    {
        $this->initialized['country'] = true;
        $this->country = $country;
        return $this;
    }
    /**
     * ISO 3166-1 alpha-2 country code: the canonical field that decides the country of
     * the address. It must be a real country code (`GB`, not `UK`); otherwise
     * `422 COUNTRY_CODE_REQUIRED`. When it is omitted, the code comes from `country`
     * (see there). With neither field present, the address is stored as `ES`.
     * 
     *
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }
    /**
    * ISO 3166-1 alpha-2 country code: the canonical field that decides the country of
    the address. It must be a real country code (`GB`, not `UK`); otherwise
    `422 COUNTRY_CODE_REQUIRED`. When it is omitted, the code comes from `country`
    (see there). With neither field present, the address is stored as `ES`.
    
    *
    * @param string|null $countryCode
    *
    * @return self
    */
    public function setCountryCode(?string $countryCode): self
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