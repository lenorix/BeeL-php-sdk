<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class UpdateInvoiceRequestRecipient implements AdditionalPropertiesInterface
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
     * UUID of a registered customer. If present, the invoice uses the customer's
     * stored data and all other recipient fields are ignored.
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
     * Always optional for SIMPLIFIED invoices (with or without NIF: limit 3,000€ VAT included).
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
     * Phone number. Allows digits, spaces, dashes, parentheses, and optional leading +
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
     * UUID of a registered customer. If present, the invoice uses the customer's
     * stored data and all other recipient fields are ignored.
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * UUID of a registered customer. If present, the invoice uses the customer's
    stored data and all other recipient fields are ignored.
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
     * Always optional for SIMPLIFIED invoices (with or without NIF: limit 3,000€ VAT included).
     */
    public function getNif(): string
    {
        return $this->nif;
    }

    /**
     * Spanish Tax ID (9 alphanumeric characters).
    Required when customer_id is not provided and alternative_id is absent.
    Always optional for SIMPLIFIED invoices (with or without NIF: limit 3,000€ VAT included).
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
     * Phone number. Allows digits, spaces, dashes, parentheses, and optional leading +
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Phone number. Allows digits, spaces, dashes, parentheses, and optional leading +
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
