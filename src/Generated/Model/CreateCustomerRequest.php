<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CreateCustomerRequest implements AdditionalPropertiesInterface
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
     * Customer legal name (required).
     * 
     * When you also send a Spanish `nif`, how it is used depends on the customer:
     * for an **individual** the AEAT census matches NIF and name together, so a
     * name it does not recognise makes the customer invalid; for a **company**
     * the name is **not verified** and only the CIF decides.
     * 
     *
     * @var string
     */
    protected $legalName;
    /**
     * Customer trade name. Optional, but **not empty by default**: leave it out on creation
     * and it is filled with `legal_name`, which is what then shows as the recipient's trade
     * name on the invoice PDF. Send it explicitly if the two differ.
     * 
     * The default applies **on creation only**. A `PUT` replaces the customer whole, so
     * omitting `trade_name` there **clears** it instead of refilling it from `legal_name`.
     * 
     *
     * @var string|null
     */
    protected $tradeName;
    /**
     * Spanish Tax ID (required if id_otro is not provided)
     *
     * @var string
     */
    protected $nif;
    /**
     * Alternative identifier for customers without Spanish Tax ID.
     * 
     * ### VeriFactu rules (enforced server-side, returns `422 ALTERNATIVE_ID_INVALID` on violation)
     * - If `country_code = ES`, then `type` **must** be `PASSPORT` (03) or `NOT_REGISTERED` (07).
     * - If `type = NOT_REGISTERED` (07), then `country_code` **must** be `ES`.
     * 
     * ### Matrix of allowed combinations
     * | `type`                 | `country_code = ES` | `country_code ≠ ES` |
     * |------------------------|:-------------------:|:-------------------:|
     * | `NIF_IVA` (02)         | ✗                   | ✓                   |
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
     * Customer legal name (required).
     * 
     * When you also send a Spanish `nif`, how it is used depends on the customer:
     * for an **individual** the AEAT census matches NIF and name together, so a
     * name it does not recognise makes the customer invalid; for a **company**
     * the name is **not verified** and only the CIF decides.
     * 
     *
     * @return string
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }
    /**
    * Customer legal name (required).
    
    When you also send a Spanish `nif`, how it is used depends on the customer:
    for an **individual** the AEAT census matches NIF and name together, so a
    name it does not recognise makes the customer invalid; for a **company**
    the name is **not verified** and only the CIF decides.
    
    *
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
     * Customer trade name. Optional, but **not empty by default**: leave it out on creation
     * and it is filled with `legal_name`, which is what then shows as the recipient's trade
     * name on the invoice PDF. Send it explicitly if the two differ.
     * 
     * The default applies **on creation only**. A `PUT` replaces the customer whole, so
     * omitting `trade_name` there **clears** it instead of refilling it from `legal_name`.
     * 
     *
     * @return string|null
     */
    public function getTradeName(): ?string
    {
        return $this->tradeName;
    }
    /**
    * Customer trade name. Optional, but **not empty by default**: leave it out on creation
    and it is filled with `legal_name`, which is what then shows as the recipient's trade
    name on the invoice PDF. Send it explicitly if the two differ.
    
    The default applies **on creation only**. A `PUT` replaces the customer whole, so
    omitting `trade_name` there **clears** it instead of refilling it from `legal_name`.
    
    *
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
     * Spanish Tax ID (required if id_otro is not provided)
     *
     * @return string
     */
    public function getNif(): string
    {
        return $this->nif;
    }
    /**
     * Spanish Tax ID (required if id_otro is not provided)
     *
     * @param string $nif
     *
     * @return self
     */
    public function setNif(string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;
        return $this;
    }
    /**
     * Alternative identifier for customers without Spanish Tax ID.
     * 
     * ### VeriFactu rules (enforced server-side, returns `422 ALTERNATIVE_ID_INVALID` on violation)
     * - If `country_code = ES`, then `type` **must** be `PASSPORT` (03) or `NOT_REGISTERED` (07).
     * - If `type = NOT_REGISTERED` (07), then `country_code` **must** be `ES`.
     * 
     * ### Matrix of allowed combinations
     * | `type`                 | `country_code = ES` | `country_code ≠ ES` |
     * |------------------------|:-------------------:|:-------------------:|
     * | `NIF_IVA` (02)         | ✗                   | ✓                   |
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
    
    ### VeriFactu rules (enforced server-side, returns `422 ALTERNATIVE_ID_INVALID` on violation)
    - If `country_code = ES`, then `type` **must** be `PASSPORT` (03) or `NOT_REGISTERED` (07).
    - If `type = NOT_REGISTERED` (07), then `country_code` **must** be `ES`.
    
    ### Matrix of allowed combinations
    | `type`                 | `country_code = ES` | `country_code ≠ ES` |
    |------------------------|:-------------------:|:-------------------:|
    | `NIF_IVA` (02)         | ✗                   | ✓                   |
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
    /**
     * Address you send when you create or update a company, a customer or an onboarding.
     * 
     * Addresses you read back are described by their own schema.
     * 
     *
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }
    /**
    * Address you send when you create or update a company, a customer or an onboarding.
    
    Addresses you read back are described by their own schema.
    
    *
    * @param Address $address
    *
    * @return self
    */
    public function setAddress(Address $address): self
    {
        $this->initialized['address'] = true;
        $this->address = $address;
        return $this;
    }
    /**
     * Phone number. Allows digits, spaces, dashes, parentheses, and optional leading +
     *
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
    /**
     * Phone number. Allows digits, spaces, dashes, parentheses, and optional leading +
     *
     * @param string $phone
     *
     * @return self
     */
    public function setPhone(string $phone): self
    {
        $this->initialized['phone'] = true;
        $this->phone = $phone;
        return $this;
    }
    /**
     * Email address (minimum valid email is 5 chars, e.g. a@b.co)
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    /**
     * Email address (minimum valid email is 5 chars, e.g. a@b.co)
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
     * Contact person name (optional)
     *
     * @return string|null
     */
    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }
    /**
     * Contact person name (optional)
     *
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
     * Additional notes about the customer (optional)
     *
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }
    /**
     * Additional notes about the customer (optional)
     *
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
     * @return PaymentInfo
     */
    public function getPreferredPaymentMethod(): PaymentInfo
    {
        return $this->preferredPaymentMethod;
    }
    /**
     * @param PaymentInfo $preferredPaymentMethod
     *
     * @return self
     */
    public function setPreferredPaymentMethod(PaymentInfo $preferredPaymentMethod): self
    {
        $this->initialized['preferredPaymentMethod'] = true;
        $this->preferredPaymentMethod = $preferredPaymentMethod;
        return $this;
    }
    /**
     * General discount percentage (optional)
     *
     * @return float|null
     */
    public function getGeneralDiscount(): ?float
    {
        return $this->generalDiscount;
    }
    /**
     * General discount percentage (optional)
     *
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
    public function definedProperties(): array
    {
        return ['legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'tradeName' => ['trade_name', 'getTradeName', 'setTradeName'], 'nif' => ['nif', 'getNif', 'setNif'], 'alternativeId' => ['alternative_id', 'getAlternativeId', 'setAlternativeId'], 'address' => ['address', 'getAddress', 'setAddress'], 'phone' => ['phone', 'getPhone', 'setPhone'], 'email' => ['email', 'getEmail', 'setEmail'], 'website' => ['website', 'getWebsite', 'setWebsite'], 'billingEmails' => ['billing_emails', 'getBillingEmails', 'setBillingEmails'], 'contactPerson' => ['contact_person', 'getContactPerson', 'setContactPerson'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'preferredPaymentMethod' => ['preferred_payment_method', 'getPreferredPaymentMethod', 'setPreferredPaymentMethod'], 'generalDiscount' => ['general_discount', 'getGeneralDiscount', 'setGeneralDiscount']];
    }
}