<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Builder;

use Lenorix\BeelSdk\Generated\Model\Address;
use Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest;

final class CustomerBuilder
{
    private CreateCustomerRequest $request;

    private ?Address $address = null;

    private ?string $name = null;

    private ?string $nif = null;

    private function __construct()
    {
        $this->request = new CreateCustomerRequest;
    }

    public static function create(): self
    {
        return new self;
    }

    public function name(string $legalName): self
    {
        $this->name = $legalName;
        $this->request->setLegalName($legalName);

        return $this;
    }

    public function nif(string $nif): self
    {
        $this->nif = $nif;
        $this->request->setNif($nif);

        return $this;
    }

    public function email(string $email): self
    {
        $this->request->setEmail($email);

        return $this;
    }

    public function phone(string $phone): self
    {
        $this->request->setPhone($phone);

        return $this;
    }

    public function notes(string $notes): self
    {
        $this->request->setNotes($notes);

        return $this;
    }

    public function address(string $street, string $number, string $postalCode, string $city, string $province, string $country, string $countryCode = 'ES'): self
    {
        $this->address = (new Address)->setStreet($street)->setNumber($number)->setPostalCode($postalCode)->setCity($city)->setProvince($province)->setCountry($country)->setCountryCode($countryCode);

        return $this;
    }

    public function build(): CreateCustomerRequest
    {
        if ($this->name === null || trim($this->name) === '') {
            throw new \LogicException('Legal name is required.');
        }
        if ($this->nif === null || trim($this->nif) === '') {
            throw new \LogicException('NIF/CIF is required.');
        }
        if ($this->address === null) {
            throw new \LogicException('Set the customer address before building.');
        }

        return $this->request->setAddress($this->address);
    }
}
