<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CsvCustomerPreviewCustomer implements AdditionalPropertiesInterface
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
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $legalName;
    /**
     * @var string|null
     */
    protected $tradeName;
    /**
     * @var string|null
     */
    protected $nif;
    /**
     * Customer address as stored. Read shape: records registered before the street number
     * was collected have none, so no field is guaranteed.
     * 
     *
     * @var CustomerAddress
     */
    protected $address;
    /**
     * @var string|null
     */
    protected $phone;
    /**
     * Main contact address (minimum valid email is 5 chars, e.g. a@b.co). Invoice emails go
     * here only when the customer has no `billing_emails`.
     * 
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
     * Addresses that receive the customer's invoice emails. When the send request names no
     * `recipients` and the invoice has no `email_config` recipients, invoices go to these
     * addresses, and not to `email`; `email` is used only when `billing_emails` is empty.
     * 
     *
     * @var list<string>|null
     */
    protected $billingEmails;
    /**
     * @var string|null
     */
    protected $contactPerson;
    /**
     * @var string|null
     */
    protected $notes;
    /**
     * @var PaymentInfo|null
     */
    protected $preferredPaymentMethod;
    /**
     * @var float|null
     */
    protected $generalDiscount = 0;
    /**
     * @var bool|null
     */
    protected $active = true;
    /**
     * @var \DateTime
     */
    protected $createdAt;
    /**
     * @var \DateTime|null
     */
    protected $updatedAt;
    /**
     * Alternative identifier for customers without Spanish Tax ID.
     * 
     * ### VeriFactu rules (checked when you send it, `422` on violation)
     * - `country_code` is required, except for `PASSPORT` (03) and `NOT_REGISTERED` (07), the two
     *   types AEAT accepts with `ES`: omitted, `ES` applies. Missing for any other type, the
     *   identifier is rejected with `ALTERNATIVE_ID_COUNTRY_REQUIRED`, and `error.details` names
     *   the field where it was sent: `alternative_id.country_code` on a customer,
     *   `recipient.alternative_id.country_code` on an invoice recipient. Same code in both.
     * - If `country_code = ES`, then `type` **must** be `PASSPORT` (03) or `NOT_REGISTERED` (07)
     *   (`ALTERNATIVE_ID_SPAIN_INVALID_TYPE`).
     * - If `type = NOT_REGISTERED` (07), then `country_code` **must** be `ES`
     *   (`ALTERNATIVE_ID_REQUIRES_SPAIN`), and `number` **must** be a Spanish DNI or NIE: a
     *   Spanish company is always registered (`RECIPIENT_UNREGISTERED_ID_MUST_BE_DNI_OR_NIE`).
     * - If `type = NIF_IVA` (02), `country_code` **must** be an EU member state other than Spain
     *   (`ALTERNATIVE_ID_VAT_REQUIRES_EU_COUNTRY`), and `number` **must** have that country's
     *   EU VAT number structure as AEAT defines it: the country prefix (`EL` for Greece) followed
     *   by the national number, e.g. `FR40303265045`, `DE123456789`, `EL094014201`
     *   (`ALTERNATIVE_ID_VAT_INVALID_FORMAT`). Lowercase letters are accepted and stored in
     *   uppercase. A customer from outside the EU is identified with another type, such as
     *   `OTHER_DOCUMENT` or `COUNTRY_ID`.
     * 
     * A `number` that is blank once trimmed is rejected with `ALTERNATIVE_ID_INVALID`.
     * 
     * Well-formed is not the same as registered: an EU VAT number that is not in the VIES
     * census is still rejected by VeriFactu after the invoice is issued.
     * 
     * An identifier returned in a response is the one stored. A customer saved before a rule
     * existed keeps its identifier and can still be read; issuing an invoice to it with an
     * identifier that breaks these rules is rejected with the same code, before a number is used.
     * 
     * ### Matrix of allowed combinations
     * | `type`                 | `country_code = ES` | `country_code ≠ ES` |
     * |------------------------|:-------------------:|:-------------------:|
     * | `NIF_IVA` (02)         | ✗                   | EU member states only |
     * | `PASSPORT` (03)        | ✓                   | ✓                   |
     * | `COUNTRY_ID` (04)      | ✗                   | ✓                   |
     * | `RESIDENCE_CERTIFICATE` (05) | ✗             | ✓                   |
     * | `OTHER_DOCUMENT` (06)  | ✗                   | ✓                   |
     * | `NOT_REGISTERED` (07)  | ✓                   | ✗                   |
     * 
     *
     * @var AlternativeIdentifier|null
     */
    protected $alternativeId;
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * @return string
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }
    /**
     * @param string $legalName
     *
     * @return self
     */
    public function setLegalName(string $legalName): self
    {
        $this->initialized['legalName'] = true;
        $this->legalName = $legalName;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getTradeName(): ?string
    {
        return $this->tradeName;
    }
    /**
     * @param string|null $tradeName
     *
     * @return self
     */
    public function setTradeName(?string $tradeName): self
    {
        $this->initialized['tradeName'] = true;
        $this->tradeName = $tradeName;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getNif(): ?string
    {
        return $this->nif;
    }
    /**
     * @param string|null $nif
     *
     * @return self
     */
    public function setNif(?string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;
        return $this;
    }
    /**
     * Customer address as stored. Read shape: records registered before the street number
     * was collected have none, so no field is guaranteed.
     * 
     *
     * @return CustomerAddress
     */
    public function getAddress(): CustomerAddress
    {
        return $this->address;
    }
    /**
    * Customer address as stored. Read shape: records registered before the street number
    was collected have none, so no field is guaranteed.
    
    *
    * @param CustomerAddress $address
    *
    * @return self
    */
    public function setAddress(CustomerAddress $address): self
    {
        $this->initialized['address'] = true;
        $this->address = $address;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    /**
     * @param string|null $phone
     *
     * @return self
     */
    public function setPhone(?string $phone): self
    {
        $this->initialized['phone'] = true;
        $this->phone = $phone;
        return $this;
    }
    /**
     * Main contact address (minimum valid email is 5 chars, e.g. a@b.co). Invoice emails go
     * here only when the customer has no `billing_emails`.
     * 
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    /**
    * Main contact address (minimum valid email is 5 chars, e.g. a@b.co). Invoice emails go
    here only when the customer has no `billing_emails`.
    
    *
    * @param string|null $email
    *
    * @return self
    */
    public function setEmail(?string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;
        return $this;
    }
    /**
     * Website URL
     *
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }
    /**
     * Website URL
     *
     * @param string|null $website
     *
     * @return self
     */
    public function setWebsite(?string $website): self
    {
        $this->initialized['website'] = true;
        $this->website = $website;
        return $this;
    }
    /**
     * Addresses that receive the customer's invoice emails. When the send request names no
     * `recipients` and the invoice has no `email_config` recipients, invoices go to these
     * addresses, and not to `email`; `email` is used only when `billing_emails` is empty.
     * 
     *
     * @return list<string>|null
     */
    public function getBillingEmails(): ?array
    {
        return $this->billingEmails;
    }
    /**
    * Addresses that receive the customer's invoice emails. When the send request names no
    `recipients` and the invoice has no `email_config` recipients, invoices go to these
    addresses, and not to `email`; `email` is used only when `billing_emails` is empty.
    
    *
    * @param list<string>|null $billingEmails
    *
    * @return self
    */
    public function setBillingEmails(?array $billingEmails): self
    {
        $this->initialized['billingEmails'] = true;
        $this->billingEmails = $billingEmails;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }
    /**
     * @param string|null $contactPerson
     *
     * @return self
     */
    public function setContactPerson(?string $contactPerson): self
    {
        $this->initialized['contactPerson'] = true;
        $this->contactPerson = $contactPerson;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }
    /**
     * @param string|null $notes
     *
     * @return self
     */
    public function setNotes(?string $notes): self
    {
        $this->initialized['notes'] = true;
        $this->notes = $notes;
        return $this;
    }
    /**
     * @return PaymentInfo|null
     */
    public function getPreferredPaymentMethod(): ?PaymentInfo
    {
        return $this->preferredPaymentMethod;
    }
    /**
     * @param PaymentInfo|null $preferredPaymentMethod
     *
     * @return self
     */
    public function setPreferredPaymentMethod(?PaymentInfo $preferredPaymentMethod): self
    {
        $this->initialized['preferredPaymentMethod'] = true;
        $this->preferredPaymentMethod = $preferredPaymentMethod;
        return $this;
    }
    /**
     * @return float|null
     */
    public function getGeneralDiscount(): ?float
    {
        return $this->generalDiscount;
    }
    /**
     * @param float|null $generalDiscount
     *
     * @return self
     */
    public function setGeneralDiscount(?float $generalDiscount): self
    {
        $this->initialized['generalDiscount'] = true;
        $this->generalDiscount = $generalDiscount;
        return $this;
    }
    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }
    /**
     * @param bool|null $active
     *
     * @return self
     */
    public function setActive(?bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
    /**
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->initialized['createdAt'] = true;
        $this->createdAt = $createdAt;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }
    /**
     * @param \DateTime|null $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(?\DateTime $updatedAt): self
    {
        $this->initialized['updatedAt'] = true;
        $this->updatedAt = $updatedAt;
        return $this;
    }
    /**
     * Alternative identifier for customers without Spanish Tax ID.
     * 
     * ### VeriFactu rules (checked when you send it, `422` on violation)
     * - `country_code` is required, except for `PASSPORT` (03) and `NOT_REGISTERED` (07), the two
     *   types AEAT accepts with `ES`: omitted, `ES` applies. Missing for any other type, the
     *   identifier is rejected with `ALTERNATIVE_ID_COUNTRY_REQUIRED`, and `error.details` names
     *   the field where it was sent: `alternative_id.country_code` on a customer,
     *   `recipient.alternative_id.country_code` on an invoice recipient. Same code in both.
     * - If `country_code = ES`, then `type` **must** be `PASSPORT` (03) or `NOT_REGISTERED` (07)
     *   (`ALTERNATIVE_ID_SPAIN_INVALID_TYPE`).
     * - If `type = NOT_REGISTERED` (07), then `country_code` **must** be `ES`
     *   (`ALTERNATIVE_ID_REQUIRES_SPAIN`), and `number` **must** be a Spanish DNI or NIE: a
     *   Spanish company is always registered (`RECIPIENT_UNREGISTERED_ID_MUST_BE_DNI_OR_NIE`).
     * - If `type = NIF_IVA` (02), `country_code` **must** be an EU member state other than Spain
     *   (`ALTERNATIVE_ID_VAT_REQUIRES_EU_COUNTRY`), and `number` **must** have that country's
     *   EU VAT number structure as AEAT defines it: the country prefix (`EL` for Greece) followed
     *   by the national number, e.g. `FR40303265045`, `DE123456789`, `EL094014201`
     *   (`ALTERNATIVE_ID_VAT_INVALID_FORMAT`). Lowercase letters are accepted and stored in
     *   uppercase. A customer from outside the EU is identified with another type, such as
     *   `OTHER_DOCUMENT` or `COUNTRY_ID`.
     * 
     * A `number` that is blank once trimmed is rejected with `ALTERNATIVE_ID_INVALID`.
     * 
     * Well-formed is not the same as registered: an EU VAT number that is not in the VIES
     * census is still rejected by VeriFactu after the invoice is issued.
     * 
     * An identifier returned in a response is the one stored. A customer saved before a rule
     * existed keeps its identifier and can still be read; issuing an invoice to it with an
     * identifier that breaks these rules is rejected with the same code, before a number is used.
     * 
     * ### Matrix of allowed combinations
     * | `type`                 | `country_code = ES` | `country_code ≠ ES` |
     * |------------------------|:-------------------:|:-------------------:|
     * | `NIF_IVA` (02)         | ✗                   | EU member states only |
     * | `PASSPORT` (03)        | ✓                   | ✓                   |
     * | `COUNTRY_ID` (04)      | ✗                   | ✓                   |
     * | `RESIDENCE_CERTIFICATE` (05) | ✗             | ✓                   |
     * | `OTHER_DOCUMENT` (06)  | ✗                   | ✓                   |
     * | `NOT_REGISTERED` (07)  | ✓                   | ✗                   |
     * 
     *
     * @return AlternativeIdentifier|null
     */
    public function getAlternativeId(): ?AlternativeIdentifier
    {
        return $this->alternativeId;
    }
    /**
    * Alternative identifier for customers without Spanish Tax ID.
    
    ### VeriFactu rules (checked when you send it, `422` on violation)
    - `country_code` is required, except for `PASSPORT` (03) and `NOT_REGISTERED` (07), the two
     types AEAT accepts with `ES`: omitted, `ES` applies. Missing for any other type, the
     identifier is rejected with `ALTERNATIVE_ID_COUNTRY_REQUIRED`, and `error.details` names
     the field where it was sent: `alternative_id.country_code` on a customer,
     `recipient.alternative_id.country_code` on an invoice recipient. Same code in both.
    - If `country_code = ES`, then `type` **must** be `PASSPORT` (03) or `NOT_REGISTERED` (07)
     (`ALTERNATIVE_ID_SPAIN_INVALID_TYPE`).
    - If `type = NOT_REGISTERED` (07), then `country_code` **must** be `ES`
     (`ALTERNATIVE_ID_REQUIRES_SPAIN`), and `number` **must** be a Spanish DNI or NIE: a
     Spanish company is always registered (`RECIPIENT_UNREGISTERED_ID_MUST_BE_DNI_OR_NIE`).
    - If `type = NIF_IVA` (02), `country_code` **must** be an EU member state other than Spain
     (`ALTERNATIVE_ID_VAT_REQUIRES_EU_COUNTRY`), and `number` **must** have that country's
     EU VAT number structure as AEAT defines it: the country prefix (`EL` for Greece) followed
     by the national number, e.g. `FR40303265045`, `DE123456789`, `EL094014201`
     (`ALTERNATIVE_ID_VAT_INVALID_FORMAT`). Lowercase letters are accepted and stored in
     uppercase. A customer from outside the EU is identified with another type, such as
     `OTHER_DOCUMENT` or `COUNTRY_ID`.
    
    A `number` that is blank once trimmed is rejected with `ALTERNATIVE_ID_INVALID`.
    
    Well-formed is not the same as registered: an EU VAT number that is not in the VIES
    census is still rejected by VeriFactu after the invoice is issued.
    
    An identifier returned in a response is the one stored. A customer saved before a rule
    existed keeps its identifier and can still be read; issuing an invoice to it with an
    identifier that breaks these rules is rejected with the same code, before a number is used.
    
    ### Matrix of allowed combinations
    | `type`                 | `country_code = ES` | `country_code ≠ ES` |
    |------------------------|:-------------------:|:-------------------:|
    | `NIF_IVA` (02)         | ✗                   | EU member states only |
    | `PASSPORT` (03)        | ✓                   | ✓                   |
    | `COUNTRY_ID` (04)      | ✗                   | ✓                   |
    | `RESIDENCE_CERTIFICATE` (05) | ✗             | ✓                   |
    | `OTHER_DOCUMENT` (06)  | ✗                   | ✓                   |
    | `NOT_REGISTERED` (07)  | ✓                   | ✗                   |
    
    *
    * @param AlternativeIdentifier|null $alternativeId
    *
    * @return self
    */
    public function setAlternativeId(?AlternativeIdentifier $alternativeId): self
    {
        $this->initialized['alternativeId'] = true;
        $this->alternativeId = $alternativeId;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'tradeName' => ['trade_name', 'getTradeName', 'setTradeName'], 'nif' => ['nif', 'getNif', 'setNif'], 'address' => ['address', 'getAddress', 'setAddress'], 'phone' => ['phone', 'getPhone', 'setPhone'], 'email' => ['email', 'getEmail', 'setEmail'], 'website' => ['website', 'getWebsite', 'setWebsite'], 'billingEmails' => ['billing_emails', 'getBillingEmails', 'setBillingEmails'], 'contactPerson' => ['contact_person', 'getContactPerson', 'setContactPerson'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'preferredPaymentMethod' => ['preferred_payment_method', 'getPreferredPaymentMethod', 'setPreferredPaymentMethod'], 'generalDiscount' => ['general_discount', 'getGeneralDiscount', 'setGeneralDiscount'], 'active' => ['active', 'getActive', 'setActive'], 'createdAt' => ['created_at', 'getCreatedAt', 'setCreatedAt'], 'updatedAt' => ['updated_at', 'getUpdatedAt', 'setUpdatedAt'], 'alternativeId' => ['alternative_id', 'getAlternativeId', 'setAlternativeId']];
    }
}