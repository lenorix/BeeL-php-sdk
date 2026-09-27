<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class UpdateCustomerRequest implements AdditionalPropertiesInterface
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
     * New Spanish Tax ID for the customer. Mutually exclusive with
     * `alternative_id`. Omit to keep the current identifier.
     *
     *
     * @var string
     */
    protected $nif;

    /**
     * New alternative identifier (non-Spanish customers). Mutually
     * exclusive with `nif`. Omit to keep the current identifier.
     *
     *
     * @var UpdateCustomerRequestAlternativeId
     */
    protected $alternativeId;

    /**
     * Customer legal name. Matched against the AEAT census only for individuals;
     * for a company the name is **not verified**.
     *
     *
     * @var string
     */
    protected $legalName;

    /**
     * Customer trade name. Omitting it **clears** the field: this is a full replacement, and
     * the creation default (falling back to `legal_name`) does not apply here.
     *
     *
     * @var string|null
     */
    protected $tradeName;

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
     * @var string|null
     */
    protected $email;

    /**
     * Website URL
     *
     * @var string|null
     */
    protected $website;

    /**
     * Additional emails for invoice delivery (optional)
     *
     * @var list<string>|null
     */
    protected $billingEmails;

    /**
     * Contact person name (optional)
     *
     * @var string|null
     */
    protected $contactPerson;

    /**
     * Additional notes about the customer (optional)
     *
     * @var string|null
     */
    protected $notes;

    /**
     * @var PaymentInfo
     */
    protected $preferredPaymentMethod;

    /**
     * General discount percentage (optional)
     *
     * @var float|null
     */
    protected $generalDiscount;

    /**
     * Whether the customer is active or inactive
     *
     * @var bool
     */
    protected $active;

    /**
     * New Spanish Tax ID for the customer. Mutually exclusive with
     * `alternative_id`. Omit to keep the current identifier.
     */
    public function getNif(): string
    {
        return $this->nif;
    }

    /**
     * New Spanish Tax ID for the customer. Mutually exclusive with
    `alternative_id`. Omit to keep the current identifier.
     */
    public function setNif(string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;

        return $this;
    }

    /**
     * New alternative identifier (non-Spanish customers). Mutually
     * exclusive with `nif`. Omit to keep the current identifier.
     */
    public function getAlternativeId(): UpdateCustomerRequestAlternativeId
    {
        return $this->alternativeId;
    }

    /**
     * New alternative identifier (non-Spanish customers). Mutually
    exclusive with `nif`. Omit to keep the current identifier.
     */
    public function setAlternativeId(UpdateCustomerRequestAlternativeId $alternativeId): self
    {
        $this->initialized['alternativeId'] = true;
        $this->alternativeId = $alternativeId;

        return $this;
    }

    /**
     * Customer legal name. Matched against the AEAT census only for individuals;
     * for a company the name is **not verified**.
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }

    /**
     * Customer legal name. Matched against the AEAT census only for individuals;
    for a company the name is **not verified**.
     */
    public function setLegalName(string $legalName): self
    {
        $this->initialized['legalName'] = true;
        $this->legalName = $legalName;

        return $this;
    }

    /**
     * Customer trade name. Omitting it **clears** the field: this is a full replacement, and
     * the creation default (falling back to `legal_name`) does not apply here.
     */
    public function getTradeName(): ?string
    {
        return $this->tradeName;
    }

    /**
     * Customer trade name. Omitting it **clears** the field: this is a full replacement, and
    the creation default (falling back to `legal_name`) does not apply here.
     */
    public function setTradeName(?string $tradeName): self
    {
        $this->initialized['tradeName'] = true;
        $this->tradeName = $tradeName;

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
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Email address (minimum valid email is 5 chars, e.g. a@b.co)
     */
    public function setEmail(?string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;

        return $this;
    }

    /**
     * Website URL
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * Website URL
     */
    public function setWebsite(?string $website): self
    {
        $this->initialized['website'] = true;
        $this->website = $website;

        return $this;
    }

    /**
     * Additional emails for invoice delivery (optional)
     *
     * @return list<string>|null
     */
    public function getBillingEmails(): ?array
    {
        return $this->billingEmails;
    }

    /**
     * Additional emails for invoice delivery (optional)
     *
     * @param  list<string>|null  $billingEmails
     */
    public function setBillingEmails(?array $billingEmails): self
    {
        $this->initialized['billingEmails'] = true;
        $this->billingEmails = $billingEmails;

        return $this;
    }

    /**
     * Contact person name (optional)
     */
    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    /**
     * Contact person name (optional)
     */
    public function setContactPerson(?string $contactPerson): self
    {
        $this->initialized['contactPerson'] = true;
        $this->contactPerson = $contactPerson;

        return $this;
    }

    /**
     * Additional notes about the customer (optional)
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * Additional notes about the customer (optional)
     */
    public function setNotes(?string $notes): self
    {
        $this->initialized['notes'] = true;
        $this->notes = $notes;

        return $this;
    }

    public function getPreferredPaymentMethod(): PaymentInfo
    {
        return $this->preferredPaymentMethod;
    }

    public function setPreferredPaymentMethod(PaymentInfo $preferredPaymentMethod): self
    {
        $this->initialized['preferredPaymentMethod'] = true;
        $this->preferredPaymentMethod = $preferredPaymentMethod;

        return $this;
    }

    /**
     * General discount percentage (optional)
     */
    public function getGeneralDiscount(): ?float
    {
        return $this->generalDiscount;
    }

    /**
     * General discount percentage (optional)
     */
    public function setGeneralDiscount(?float $generalDiscount): self
    {
        $this->initialized['generalDiscount'] = true;
        $this->generalDiscount = $generalDiscount;

        return $this;
    }

    /**
     * Whether the customer is active or inactive
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Whether the customer is active or inactive
     */
    public function setActive(bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['nif' => ['nif', 'getNif', 'setNif'], 'alternativeId' => ['alternative_id', 'getAlternativeId', 'setAlternativeId'], 'legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'tradeName' => ['trade_name', 'getTradeName', 'setTradeName'], 'address' => ['address', 'getAddress', 'setAddress'], 'phone' => ['phone', 'getPhone', 'setPhone'], 'email' => ['email', 'getEmail', 'setEmail'], 'website' => ['website', 'getWebsite', 'setWebsite'], 'billingEmails' => ['billing_emails', 'getBillingEmails', 'setBillingEmails'], 'contactPerson' => ['contact_person', 'getContactPerson', 'setContactPerson'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'preferredPaymentMethod' => ['preferred_payment_method', 'getPreferredPaymentMethod', 'setPreferredPaymentMethod'], 'generalDiscount' => ['general_discount', 'getGeneralDiscount', 'setGeneralDiscount'], 'active' => ['active', 'getActive', 'setActive']];
    }
}
