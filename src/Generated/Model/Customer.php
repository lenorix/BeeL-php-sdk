<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class Customer implements AdditionalPropertiesInterface
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
     * @var string
     */
    protected $tradeName;
    /**
     * Spanish Tax ID (9 characters, uppercase only). Structural validation:
     * - DNI: 8 digits + 1 letter (e.g., 12345678A)
     * - NIE: X/Y/Z + 7 digits + 1 letter (e.g., X1234567A)
     * - CIF: Organization letter + 7 digits + 1 control digit/letter (e.g., B12345674)
     * 
     *
     * @var string
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
     * Additional emails for invoice delivery
     *
     * @var list<string>
     */
    protected $billingEmails;
    /**
     * @var string
     */
    protected $contactPerson;
    /**
     * @var string
     */
    protected $notes;
    /**
     * @var PaymentInfo
     */
    protected $preferredPaymentMethod;
    /**
     * @var float
     */
    protected $generalDiscount = 0;
    /**
     * @var bool
     */
    protected $active = true;
    /**
     * @var \DateTime
     */
    protected $createdAt;
    /**
     * @var \DateTime
     */
    protected $updatedAt;
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
     * @return string
     */
    public function getTradeName(): string
    {
        return $this->tradeName;
    }
    /**
     * @param string $tradeName
     *
     * @return self
     */
    public function setTradeName(string $tradeName): self
    {
        $this->initialized['tradeName'] = true;
        $this->tradeName = $tradeName;
        return $this;
    }
    /**
     * Spanish Tax ID (9 characters, uppercase only). Structural validation:
     * - DNI: 8 digits + 1 letter (e.g., 12345678A)
     * - NIE: X/Y/Z + 7 digits + 1 letter (e.g., X1234567A)
     * - CIF: Organization letter + 7 digits + 1 control digit/letter (e.g., B12345674)
     * 
     *
     * @return string
     */
    public function getNif(): string
    {
        return $this->nif;
    }
    /**
    * Spanish Tax ID (9 characters, uppercase only). Structural validation:
    - DNI: 8 digits + 1 letter (e.g., 12345678A)
    - NIE: X/Y/Z + 7 digits + 1 letter (e.g., X1234567A)
    - CIF: Organization letter + 7 digits + 1 control digit/letter (e.g., B12345674)
    
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
     * Additional emails for invoice delivery
     *
     * @return list<string>
     */
    public function getBillingEmails(): array
    {
        return $this->billingEmails;
    }
    /**
     * Additional emails for invoice delivery
     *
     * @param list<string> $billingEmails
     *
     * @return self
     */
    public function setBillingEmails(array $billingEmails): self
    {
        $this->initialized['billingEmails'] = true;
        $this->billingEmails = $billingEmails;
        return $this;
    }
    /**
     * @return string
     */
    public function getContactPerson(): string
    {
        return $this->contactPerson;
    }
    /**
     * @param string $contactPerson
     *
     * @return self
     */
    public function setContactPerson(string $contactPerson): self
    {
        $this->initialized['contactPerson'] = true;
        $this->contactPerson = $contactPerson;
        return $this;
    }
    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }
    /**
     * @param string $notes
     *
     * @return self
     */
    public function setNotes(string $notes): self
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
     * @return float
     */
    public function getGeneralDiscount(): float
    {
        return $this->generalDiscount;
    }
    /**
     * @param float $generalDiscount
     *
     * @return self
     */
    public function setGeneralDiscount(float $generalDiscount): self
    {
        $this->initialized['generalDiscount'] = true;
        $this->generalDiscount = $generalDiscount;
        return $this;
    }
    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }
    /**
     * @param bool $active
     *
     * @return self
     */
    public function setActive(bool $active): self
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
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
    /**
     * @param \DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->initialized['updatedAt'] = true;
        $this->updatedAt = $updatedAt;
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
    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'tradeName' => ['trade_name', 'getTradeName', 'setTradeName'], 'nif' => ['nif', 'getNif', 'setNif'], 'address' => ['address', 'getAddress', 'setAddress'], 'phone' => ['phone', 'getPhone', 'setPhone'], 'email' => ['email', 'getEmail', 'setEmail'], 'website' => ['website', 'getWebsite', 'setWebsite'], 'billingEmails' => ['billing_emails', 'getBillingEmails', 'setBillingEmails'], 'contactPerson' => ['contact_person', 'getContactPerson', 'setContactPerson'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'preferredPaymentMethod' => ['preferred_payment_method', 'getPreferredPaymentMethod', 'setPreferredPaymentMethod'], 'generalDiscount' => ['general_discount', 'getGeneralDiscount', 'setGeneralDiscount'], 'active' => ['active', 'getActive', 'setActive'], 'createdAt' => ['created_at', 'getCreatedAt', 'setCreatedAt'], 'updatedAt' => ['updated_at', 'getUpdatedAt', 'setUpdatedAt'], 'alternativeId' => ['alternative_id', 'getAlternativeId', 'setAlternativeId']];
    }
}