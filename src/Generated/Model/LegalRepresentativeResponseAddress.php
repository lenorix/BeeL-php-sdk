<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class LegalRepresentativeResponseAddress implements AdditionalPropertiesInterface
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
     * Full address (street, number, floor, etc.)
     *
     * @var string
     */
    protected $street;

    /**
     * Street number. Absent when the stored address has none.
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
     * City or town
     *
     * @var string
     */
    protected $city;

    /**
     * Province or state
     *
     * @var string
     */
    protected $province;

    /**
     * Country
     *
     * @var string
     */
    protected $country;

    /**
     * ISO 3166-1 alpha-2 country code
     *
     * @var string
     */
    protected $countryCode;

    /**
     * Full address (street, number, floor, etc.)
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * Full address (street, number, floor, etc.)
     */
    public function setStreet(string $street): self
    {
        $this->initialized['street'] = true;
        $this->street = $street;

        return $this;
    }

    /**
     * Street number. Absent when the stored address has none.
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * Street number. Absent when the stored address has none.
     */
    public function setNumber(string $number): self
    {
        $this->initialized['number'] = true;
        $this->number = $number;

        return $this;
    }

    /**
     * Floor or level
     */
    public function getFloor(): string
    {
        return $this->floor;
    }

    /**
     * Floor or level
     */
    public function setFloor(string $floor): self
    {
        $this->initialized['floor'] = true;
        $this->floor = $floor;

        return $this;
    }

    /**
     * Door or apartment
     */
    public function getDoor(): string
    {
        return $this->door;
    }

    /**
     * Door or apartment
     */
    public function setDoor(string $door): self
    {
        $this->initialized['door'] = true;
        $this->door = $door;

        return $this;
    }

    /**
     * Postal code (5 digits for Spain, free format for other countries)
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * Postal code (5 digits for Spain, free format for other countries)
     */
    public function setPostalCode(string $postalCode): self
    {
        $this->initialized['postalCode'] = true;
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * City or town
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * City or town
     */
    public function setCity(string $city): self
    {
        $this->initialized['city'] = true;
        $this->city = $city;

        return $this;
    }

    /**
     * Province or state
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * Province or state
     */
    public function setProvince(string $province): self
    {
        $this->initialized['province'] = true;
        $this->province = $province;

        return $this;
    }

    /**
     * Country
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * Country
     */
    public function setCountry(string $country): self
    {
        $this->initialized['country'] = true;
        $this->country = $country;

        return $this;
    }

    /**
     * ISO 3166-1 alpha-2 country code
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * ISO 3166-1 alpha-2 country code
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
