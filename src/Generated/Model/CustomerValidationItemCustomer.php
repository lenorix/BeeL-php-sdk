<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CustomerValidationItemCustomer implements AdditionalPropertiesInterface
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
     * Address you send when you create or update a company, a customer or an onboarding.
     * 
     * Addresses you read back are described by their own schema.
     * 
     *
     * @var Address
     */
    protected $address;
    /**
     * A phone number, as the record holds it: digits, spaces, dashes, parentheses and an
     * optional leading `+`, up to 20 characters.
     * 
     * This is the schema a **response** carries, and the length above is the only rule it
     * states. It deliberately does not repeat the character rule, because a number can reach a
     * record through a path that predates that rule or never passed through this API at all —
     * a payment provider's customer data, a bulk import. Read the field defensively and do not
     * assume it parses.
     * 
     * What a **request** has to satisfy is `PhoneInput`, which adds the rules this API enforces
     * on the way in.
     * 
     *
     * @var string
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
    protected $generalDiscount;
    /**
     * @var bool
     */
    protected $active;
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
     * A phone number, as the record holds it: digits, spaces, dashes, parentheses and an
     * optional leading `+`, up to 20 characters.
     * 
     * This is the schema a **response** carries, and the length above is the only rule it
     * states. It deliberately does not repeat the character rule, because a number can reach a
     * record through a path that predates that rule or never passed through this API at all —
     * a payment provider's customer data, a bulk import. Read the field defensively and do not
     * assume it parses.
     * 
     * What a **request** has to satisfy is `PhoneInput`, which adds the rules this API enforces
     * on the way in.
     * 
     *
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
    /**
    * A phone number, as the record holds it: digits, spaces, dashes, parentheses and an
    optional leading `+`, up to 20 characters.
    
    This is the schema a **response** carries, and the length above is the only rule it
    states. It deliberately does not repeat the character rule, because a number can reach a
    record through a path that predates that rule or never passed through this API at all —
    a payment provider's customer data, a bulk import. Read the field defensively and do not
    assume it parses.
    
    What a **request** has to satisfy is `PhoneInput`, which adds the rules this API enforces
    on the way in.
    
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
     * @return list<string>
     */
    public function getBillingEmails(): array
    {
        return $this->billingEmails;
    }
    /**
    * Addresses that receive the customer's invoice emails. When the send request names no
    `recipients` and the invoice has no `email_config` recipients, invoices go to these
    addresses, and not to `email`; `email` is used only when `billing_emails` is empty.
    
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
    public function definedProperties(): array
    {
        return ['legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'tradeName' => ['trade_name', 'getTradeName', 'setTradeName'], 'nif' => ['nif', 'getNif', 'setNif'], 'alternativeId' => ['alternative_id', 'getAlternativeId', 'setAlternativeId'], 'address' => ['address', 'getAddress', 'setAddress'], 'phone' => ['phone', 'getPhone', 'setPhone'], 'email' => ['email', 'getEmail', 'setEmail'], 'website' => ['website', 'getWebsite', 'setWebsite'], 'billingEmails' => ['billing_emails', 'getBillingEmails', 'setBillingEmails'], 'contactPerson' => ['contact_person', 'getContactPerson', 'setContactPerson'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'preferredPaymentMethod' => ['preferred_payment_method', 'getPreferredPaymentMethod', 'setPreferredPaymentMethod'], 'generalDiscount' => ['general_discount', 'getGeneralDiscount', 'setGeneralDiscount'], 'active' => ['active', 'getActive', 'setActive']];
    }
}