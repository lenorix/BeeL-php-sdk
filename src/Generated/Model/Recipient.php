<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class Recipient implements AdditionalPropertiesInterface
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
     * UUID of a registered customer. The invoice takes the recipient data stored on
     * that customer. Send it alone: combined with any other recipient field it returns
     * 422 `RECIPIENT_CUSTOMER_AND_DATA_EXCLUSIVE`. To change the recipient's data, edit
     * the customer or send the data inline without `customer_id`.
     *
     *
     * @var string
     */
    protected $customerId;

    /**
     * Recipient legal name. Required when customer_id is not provided
     * (except for SIMPLIFIED invoices where all fields are optional).
     *
     *
     * @var string
     */
    protected $legalName;

    /**
     * Recipient trade name (optional)
     *
     * @var string|null
     */
    protected $tradeName;

    /**
     * Spanish Tax ID (9 alphanumeric characters).
     * Required when customer_id is not provided and alternative_id is absent.
     * Not accepted on SIMPLIFIED invoices: BeeL. requires a STANDARD invoice when the
     * recipient is identified.
     *
     *
     * @var string
     */
    protected $nif;

    /**
     * @var RecipientAlternativeId
     */
    protected $alternativeId;

    /**
     * Address you send when you create or update a company, a customer or an onboarding.
     *
     * Addresses you read back are described by their own schema.
     *
     *
     * @var Address
     */
    protected $address;

    /**
     * A phone number as this API accepts it: 9 to 20 characters, and only digits, spaces,
     * dashes, parentheses and an optional leading `+`. Every request that takes a phone number
     * uses this schema.
     *
     * It is `Phone` plus the rules enforced on input. A value this schema accepts always
     * satisfies `Phone`, so anything you send here is something a response can return.
     *
     *
     * @var string
     */
    protected $phone;

    /**
     * Email address (minimum valid email is 5 chars, e.g. a@b.co)
     *
     * @var string
     */
    protected $email;

    /**
     * UUID of a registered customer. The invoice takes the recipient data stored on
     * that customer. Send it alone: combined with any other recipient field it returns
     * 422 `RECIPIENT_CUSTOMER_AND_DATA_EXCLUSIVE`. To change the recipient's data, edit
     * the customer or send the data inline without `customer_id`.
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * UUID of a registered customer. The invoice takes the recipient data stored on
    that customer. Send it alone: combined with any other recipient field it returns
    422 `RECIPIENT_CUSTOMER_AND_DATA_EXCLUSIVE`. To change the recipient's data, edit
    the customer or send the data inline without `customer_id`.
     */
    public function setCustomerId(string $customerId): self
    {
        $this->initialized['customerId'] = true;
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Recipient legal name. Required when customer_id is not provided
     * (except for SIMPLIFIED invoices where all fields are optional).
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }

    /**
     * Recipient legal name. Required when customer_id is not provided
    (except for SIMPLIFIED invoices where all fields are optional).
     */
    public function setLegalName(string $legalName): self
    {
        $this->initialized['legalName'] = true;
        $this->legalName = $legalName;

        return $this;
    }

    /**
     * Recipient trade name (optional)
     */
    public function getTradeName(): ?string
    {
        return $this->tradeName;
    }

    /**
     * Recipient trade name (optional)
     */
    public function setTradeName(?string $tradeName): self
    {
        $this->initialized['tradeName'] = true;
        $this->tradeName = $tradeName;

        return $this;
    }

    /**
     * Spanish Tax ID (9 alphanumeric characters).
     * Required when customer_id is not provided and alternative_id is absent.
     * Not accepted on SIMPLIFIED invoices: BeeL. requires a STANDARD invoice when the
     * recipient is identified.
     */
    public function getNif(): string
    {
        return $this->nif;
    }

    /**
     * Spanish Tax ID (9 alphanumeric characters).
    Required when customer_id is not provided and alternative_id is absent.
    Not accepted on SIMPLIFIED invoices: BeeL. requires a STANDARD invoice when the
    recipient is identified.
     */
    public function setNif(string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;

        return $this;
    }

    public function getAlternativeId(): RecipientAlternativeId
    {
        return $this->alternativeId;
    }

    public function setAlternativeId(RecipientAlternativeId $alternativeId): self
    {
        $this->initialized['alternativeId'] = true;
        $this->alternativeId = $alternativeId;

        return $this;
    }

    /**
     * Address you send when you create or update a company, a customer or an onboarding.
     *
     * Addresses you read back are described by their own schema.
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * Address you send when you create or update a company, a customer or an onboarding.

    Addresses you read back are described by their own schema.
     */
    public function setAddress(Address $address): self
    {
        $this->initialized['address'] = true;
        $this->address = $address;

        return $this;
    }

    /**
     * A phone number as this API accepts it: 9 to 20 characters, and only digits, spaces,
     * dashes, parentheses and an optional leading `+`. Every request that takes a phone number
     * uses this schema.
     *
     * It is `Phone` plus the rules enforced on input. A value this schema accepts always
     * satisfies `Phone`, so anything you send here is something a response can return.
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * A phone number as this API accepts it: 9 to 20 characters, and only digits, spaces,
    dashes, parentheses and an optional leading `+`. Every request that takes a phone number
    uses this schema.

    It is `Phone` plus the rules enforced on input. A value this schema accepts always
    satisfies `Phone`, so anything you send here is something a response can return.
     */
    public function setPhone(string $phone): self
    {
        $this->initialized['phone'] = true;
        $this->phone = $phone;

        return $this;
    }

    /**
     * Email address (minimum valid email is 5 chars, e.g. a@b.co)
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Email address (minimum valid email is 5 chars, e.g. a@b.co)
     */
    public function setEmail(string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['customerId' => ['customer_id', 'getCustomerId', 'setCustomerId'], 'legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'tradeName' => ['trade_name', 'getTradeName', 'setTradeName'], 'nif' => ['nif', 'getNif', 'setNif'], 'alternativeId' => ['alternative_id', 'getAlternativeId', 'setAlternativeId'], 'address' => ['address', 'getAddress', 'setAddress'], 'phone' => ['phone', 'getPhone', 'setPhone'], 'email' => ['email', 'getEmail', 'setEmail']];
    }
}
