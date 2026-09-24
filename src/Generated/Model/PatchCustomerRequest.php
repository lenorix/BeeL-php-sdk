<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class PatchCustomerRequest implements AdditionalPropertiesInterface
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
     * New Spanish Tax ID. Mutually exclusive with `alternative_id`.
     * Omit to keep the current identifier; it cannot be cleared.
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
     * @var PatchCustomerRequestAlternativeId
     */
    protected $alternativeId;

    /**
     * Customer legal name. Cannot be cleared. Matched against the AEAT census only
     * for individuals; for a company the name is **not verified**.
     *
     *
     * @var string
     */
    protected $legalName;

    /**
     * Customer trade name. Send `null` to clear it.
     *
     * @var string|null
     */
    protected $tradeName;

    /**
     * Full address. Replaced as a whole (the address itself is not
     * patched field by field) and cannot be cleared.
     *
     *
     * @var PatchCustomerRequestAddress
     */
    protected $address;

    /**
     * Phone number. Send `null` to clear it.
     *
     * @var string|null
     */
    protected $phone;

    /**
     * Email address. Send `null` to clear it.
     *
     * @var string|null
     */
    protected $email;

    /**
     * Website URL. Send `null` to clear it.
     *
     * @var string|null
     */
    protected $website;

    /**
     * Additional emails for invoice delivery. Replaced as a whole;
     * send `null` or `[]` to remove them all.
     *
     *
     * @var list<string>|null
     */
    protected $billingEmails;

    /**
     * Contact person name. Send `null` to clear it.
     *
     * @var string|null
     */
    protected $contactPerson;

    /**
     * Additional notes. Send `null` to clear it.
     *
     * @var string|null
     */
    protected $notes;

    /**
     * Default payment method. Replaced as a whole; omit it to keep the
     * current one.
     *
     *
     * @var PatchCustomerRequestPreferredPaymentMethod
     */
    protected $preferredPaymentMethod;

    /**
     * General discount percentage. Send `null` to clear it.
     *
     * @var float|null
     */
    protected $generalDiscount;

    /**
     * Whether the customer is active or inactive.
     *
     * @var bool
     */
    protected $active;

    /**
     * New Spanish Tax ID. Mutually exclusive with `alternative_id`.
     * Omit to keep the current identifier; it cannot be cleared.
     */
    public function getNif(): string
    {
        return $this->nif;
    }

    /**
     * New Spanish Tax ID. Mutually exclusive with `alternative_id`.
    Omit to keep the current identifier; it cannot be cleared.
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
    public function getAlternativeId(): PatchCustomerRequestAlternativeId
    {
        return $this->alternativeId;
    }

    /**
     * New alternative identifier (non-Spanish customers). Mutually
    exclusive with `nif`. Omit to keep the current identifier.
     */
    public function setAlternativeId(PatchCustomerRequestAlternativeId $alternativeId): self
    {
        $this->initialized['alternativeId'] = true;
        $this->alternativeId = $alternativeId;

        return $this;
    }

    /**
     * Customer legal name. Cannot be cleared. Matched against the AEAT census only
     * for individuals; for a company the name is **not verified**.
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }

    /**
     * Customer legal name. Cannot be cleared. Matched against the AEAT census only
    for individuals; for a company the name is **not verified**.
     */
    public function setLegalName(string $legalName): self
    {
        $this->initialized['legalName'] = true;
        $this->legalName = $legalName;

        return $this;
    }

    /**
     * Customer trade name. Send `null` to clear it.
     */
    public function getTradeName(): ?string
    {
        return $this->tradeName;
    }

    /**
     * Customer trade name. Send `null` to clear it.
     */
    public function setTradeName(?string $tradeName): self
    {
        $this->initialized['tradeName'] = true;
        $this->tradeName = $tradeName;

        return $this;
    }

    /**
     * Full address. Replaced as a whole (the address itself is not
     * patched field by field) and cannot be cleared.
     */
    public function getAddress(): PatchCustomerRequestAddress
    {
        return $this->address;
    }

    /**
     * Full address. Replaced as a whole (the address itself is not
    patched field by field) and cannot be cleared.
     */
    public function setAddress(PatchCustomerRequestAddress $address): self
    {
        $this->initialized['address'] = true;
        $this->address = $address;

        return $this;
    }

    /**
     * Phone number. Send `null` to clear it.
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Phone number. Send `null` to clear it.
     */
    public function setPhone(?string $phone): self
    {
        $this->initialized['phone'] = true;
        $this->phone = $phone;

        return $this;
    }

    /**
     * Email address. Send `null` to clear it.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Email address. Send `null` to clear it.
     */
    public function setEmail(?string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;

        return $this;
    }

    /**
     * Website URL. Send `null` to clear it.
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * Website URL. Send `null` to clear it.
     */
    public function setWebsite(?string $website): self
    {
        $this->initialized['website'] = true;
        $this->website = $website;

        return $this;
    }

    /**
     * Additional emails for invoice delivery. Replaced as a whole;
     * send `null` or `[]` to remove them all.
     *
     *
     * @return list<string>|null
     */
    public function getBillingEmails(): ?array
    {
        return $this->billingEmails;
    }

    /**
     * Additional emails for invoice delivery. Replaced as a whole;
    send `null` or `[]` to remove them all.

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
     * Contact person name. Send `null` to clear it.
     */
    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    /**
     * Contact person name. Send `null` to clear it.
     */
    public function setContactPerson(?string $contactPerson): self
    {
        $this->initialized['contactPerson'] = true;
        $this->contactPerson = $contactPerson;

        return $this;
    }

    /**
     * Additional notes. Send `null` to clear it.
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * Additional notes. Send `null` to clear it.
     */
    public function setNotes(?string $notes): self
    {
        $this->initialized['notes'] = true;
        $this->notes = $notes;

        return $this;
    }

    /**
     * Default payment method. Replaced as a whole; omit it to keep the
     * current one.
     */
    public function getPreferredPaymentMethod(): PatchCustomerRequestPreferredPaymentMethod
    {
        return $this->preferredPaymentMethod;
    }

    /**
     * Default payment method. Replaced as a whole; omit it to keep the
    current one.
     */
    public function setPreferredPaymentMethod(PatchCustomerRequestPreferredPaymentMethod $preferredPaymentMethod): self
    {
        $this->initialized['preferredPaymentMethod'] = true;
        $this->preferredPaymentMethod = $preferredPaymentMethod;

        return $this;
    }

    /**
     * General discount percentage. Send `null` to clear it.
     */
    public function getGeneralDiscount(): ?float
    {
        return $this->generalDiscount;
    }

    /**
     * General discount percentage. Send `null` to clear it.
     */
    public function setGeneralDiscount(?float $generalDiscount): self
    {
        $this->initialized['generalDiscount'] = true;
        $this->generalDiscount = $generalDiscount;

        return $this;
    }

    /**
     * Whether the customer is active or inactive.
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Whether the customer is active or inactive.
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
