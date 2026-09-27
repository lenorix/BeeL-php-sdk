<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class RecipientData implements AdditionalPropertiesInterface
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
     * Customer UUID in the system (optional)
     *
     * @var string|null
     */
    protected $customerId;

    /**
     * Recipient legal name
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
     * Optional for simplified invoices (SIMPLIFIED type).
     * Valid formats:
     * - DNI: 8 digits + letter (e.g., 12345678A)
     * - NIE: X/Y/Z + 7 digits + letter (e.g., X1234567A)
     * - CIF: Letter + 7 digits + digit/letter (e.g., B12345674)
     *
     *
     * @var string|null
     */
    protected $nif;

    /**
     * @var RecipientDataAlternativeId
     */
    protected $alternativeId;

    /**
     * Recipient address as stored (optional for simplified invoices). Read shape: an
     * invoice recorded without recipient address still carries the stamped country code,
     * so no field is guaranteed.
     *
     *
     * @var RecipientDataAddress
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
     * Customer UUID in the system (optional)
     */
    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    /**
     * Customer UUID in the system (optional)
     */
    public function setCustomerId(?string $customerId): self
    {
        $this->initialized['customerId'] = true;
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Recipient legal name
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }

    /**
     * Recipient legal name
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
     * Optional for simplified invoices (SIMPLIFIED type).
     * Valid formats:
     * - DNI: 8 digits + letter (e.g., 12345678A)
     * - NIE: X/Y/Z + 7 digits + letter (e.g., X1234567A)
     * - CIF: Letter + 7 digits + digit/letter (e.g., B12345674)
     */
    public function getNif(): ?string
    {
        return $this->nif;
    }

    /**
     * Spanish Tax ID (9 alphanumeric characters).
    Optional for simplified invoices (SIMPLIFIED type).
    Valid formats:
    - DNI: 8 digits + letter (e.g., 12345678A)
    - NIE: X/Y/Z + 7 digits + letter (e.g., X1234567A)
    - CIF: Letter + 7 digits + digit/letter (e.g., B12345674)
     */
    public function setNif(?string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;

        return $this;
    }

    public function getAlternativeId(): RecipientDataAlternativeId
    {
        return $this->alternativeId;
    }

    public function setAlternativeId(RecipientDataAlternativeId $alternativeId): self
    {
        $this->initialized['alternativeId'] = true;
        $this->alternativeId = $alternativeId;

        return $this;
    }

    /**
     * Recipient address as stored (optional for simplified invoices). Read shape: an
     * invoice recorded without recipient address still carries the stamped country code,
     * so no field is guaranteed.
     */
    public function getAddress(): RecipientDataAddress
    {
        return $this->address;
    }

    /**
     * Recipient address as stored (optional for simplified invoices). Read shape: an
    invoice recorded without recipient address still carries the stamped country code,
    so no field is guaranteed.
     */
    public function setAddress(RecipientDataAddress $address): self
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
