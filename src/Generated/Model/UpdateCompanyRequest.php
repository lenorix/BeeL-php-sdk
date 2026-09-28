<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class UpdateCompanyRequest implements AdditionalPropertiesInterface
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
     * @var string|null
     */
    protected $entityType;

    /**
     * Legal/fiscal name. Changing it triggers AEAT census re-validation of the NIF.
     * For a self-employed individual the census matches NIF and name together, so a
     * name it does not recognise is rejected. For a legal entity the name is
     * **not verified**: the re-validation only confirms the CIF, and the business
     * name held by the census is the only thing to contrast yours against.
     *
     *
     * @var string|null
     */
    protected $legalName;

    /**
     * @var string|null
     */
    protected $nif;

    /**
     * Legal form (SL, SA, ...). IMMUTABLE once set. Only for LEGAL_ENTITY.
     *
     * @var string|null
     */
    protected $legalForm;

    /**
     * Commercial/trade name for the company
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
     * Legal representative data for a legal entity.
     * Only used when entity_type = LEGAL_ENTITY.
     *
     *
     * @var LegalRepresentative
     */
    protected $legalRepresentative;

    /**
     * @var string|null
     */
    protected $phone;

    /**
     * @var string|null
     */
    protected $email;

    /**
     * Website
     *
     * @var string|null
     */
    protected $website;

    /**
     * Logo URL
     *
     * @var string|null
     */
    protected $logoUrl;

    /**
     * Free note printed on the invoice. It is presentation, not fiscal identity, so a
     * test credential may change it even on a company activated in Live. Read it back in
     * `CompanyData.additional_info` (`GET /v1/companies/{company_id}`).
     *
     *
     * @var string|null
     */
    protected $additionalInfo;

    /**
     * @var string|null
     */
    protected $defaultIban;

    /**
     * @var string|null
     */
    protected $defaultSwift;

    /**
     * Bank account holder
     *
     * @var string|null
     */
    protected $accountHolder;

    /**
     * IAE code
     *
     * @var string|null
     */
    protected $iae;

    /**
     * Activity start date
     *
     * @var \DateTime|null
     */
    protected $activityStartDate;

    /**
     * Default payment term in days
     *
     * @var int|null
     */
    protected $defaultPaymentTerm;

    /**
     * Invoice PDF template type
     *
     * @var string|null
     */
    protected $invoiceTemplateType;

    /**
     * Invoice PDF accent color (#RRGGBB)
     *
     * @var string|null
     */
    protected $invoiceAccentColor;

    /**
     * @var string|null
     */
    protected $invoiceLanguage;

    /**
     * @var string|null
     */
    protected $emailLanguage;

    public function getEntityType(): ?string
    {
        return $this->entityType;
    }

    public function setEntityType(?string $entityType): self
    {
        $this->initialized['entityType'] = true;
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * Legal/fiscal name. Changing it triggers AEAT census re-validation of the NIF.
     * For a self-employed individual the census matches NIF and name together, so a
     * name it does not recognise is rejected. For a legal entity the name is
     * **not verified**: the re-validation only confirms the CIF, and the business
     * name held by the census is the only thing to contrast yours against.
     */
    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    /**
     * Legal/fiscal name. Changing it triggers AEAT census re-validation of the NIF.
    For a self-employed individual the census matches NIF and name together, so a
    name it does not recognise is rejected. For a legal entity the name is
     **not verified**: the re-validation only confirms the CIF, and the business
    name held by the census is the only thing to contrast yours against.
     */
    public function setLegalName(?string $legalName): self
    {
        $this->initialized['legalName'] = true;
        $this->legalName = $legalName;

        return $this;
    }

    public function getNif(): ?string
    {
        return $this->nif;
    }

    public function setNif(?string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;

        return $this;
    }

    /**
     * Legal form (SL, SA, ...). IMMUTABLE once set. Only for LEGAL_ENTITY.
     */
    public function getLegalForm(): ?string
    {
        return $this->legalForm;
    }

    /**
     * Legal form (SL, SA, ...). IMMUTABLE once set. Only for LEGAL_ENTITY.
     */
    public function setLegalForm(?string $legalForm): self
    {
        $this->initialized['legalForm'] = true;
        $this->legalForm = $legalForm;

        return $this;
    }

    /**
     * Commercial/trade name for the company
     */
    public function getTradeName(): ?string
    {
        return $this->tradeName;
    }

    /**
     * Commercial/trade name for the company
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
     * Legal representative data for a legal entity.
     * Only used when entity_type = LEGAL_ENTITY.
     */
    public function getLegalRepresentative(): LegalRepresentative
    {
        return $this->legalRepresentative;
    }

    /**
     * Legal representative data for a legal entity.
    Only used when entity_type = LEGAL_ENTITY.
     */
    public function setLegalRepresentative(LegalRepresentative $legalRepresentative): self
    {
        $this->initialized['legalRepresentative'] = true;
        $this->legalRepresentative = $legalRepresentative;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->initialized['phone'] = true;
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;

        return $this;
    }

    /**
     * Website
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * Website
     */
    public function setWebsite(?string $website): self
    {
        $this->initialized['website'] = true;
        $this->website = $website;

        return $this;
    }

    /**
     * Logo URL
     */
    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    /**
     * Logo URL
     */
    public function setLogoUrl(?string $logoUrl): self
    {
        $this->initialized['logoUrl'] = true;
        $this->logoUrl = $logoUrl;

        return $this;
    }

    /**
     * Free note printed on the invoice. It is presentation, not fiscal identity, so a
     * test credential may change it even on a company activated in Live. Read it back in
     * `CompanyData.additional_info` (`GET /v1/companies/{company_id}`).
     */
    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    /**
     * Free note printed on the invoice. It is presentation, not fiscal identity, so a
    test credential may change it even on a company activated in Live. Read it back in
    `CompanyData.additional_info` (`GET /v1/companies/{company_id}`).
     */
    public function setAdditionalInfo(?string $additionalInfo): self
    {
        $this->initialized['additionalInfo'] = true;
        $this->additionalInfo = $additionalInfo;

        return $this;
    }

    public function getDefaultIban(): ?string
    {
        return $this->defaultIban;
    }

    public function setDefaultIban(?string $defaultIban): self
    {
        $this->initialized['defaultIban'] = true;
        $this->defaultIban = $defaultIban;

        return $this;
    }

    public function getDefaultSwift(): ?string
    {
        return $this->defaultSwift;
    }

    public function setDefaultSwift(?string $defaultSwift): self
    {
        $this->initialized['defaultSwift'] = true;
        $this->defaultSwift = $defaultSwift;

        return $this;
    }

    /**
     * Bank account holder
     */
    public function getAccountHolder(): ?string
    {
        return $this->accountHolder;
    }

    /**
     * Bank account holder
     */
    public function setAccountHolder(?string $accountHolder): self
    {
        $this->initialized['accountHolder'] = true;
        $this->accountHolder = $accountHolder;

        return $this;
    }

    /**
     * IAE code
     */
    public function getIae(): ?string
    {
        return $this->iae;
    }

    /**
     * IAE code
     */
    public function setIae(?string $iae): self
    {
        $this->initialized['iae'] = true;
        $this->iae = $iae;

        return $this;
    }

    /**
     * Activity start date
     */
    public function getActivityStartDate(): ?\DateTime
    {
        return $this->activityStartDate;
    }

    /**
     * Activity start date
     */
    public function setActivityStartDate(?\DateTime $activityStartDate): self
    {
        $this->initialized['activityStartDate'] = true;
        $this->activityStartDate = $activityStartDate;

        return $this;
    }

    /**
     * Default payment term in days
     */
    public function getDefaultPaymentTerm(): ?int
    {
        return $this->defaultPaymentTerm;
    }

    /**
     * Default payment term in days
     */
    public function setDefaultPaymentTerm(?int $defaultPaymentTerm): self
    {
        $this->initialized['defaultPaymentTerm'] = true;
        $this->defaultPaymentTerm = $defaultPaymentTerm;

        return $this;
    }

    /**
     * Invoice PDF template type
     */
    public function getInvoiceTemplateType(): ?string
    {
        return $this->invoiceTemplateType;
    }

    /**
     * Invoice PDF template type
     */
    public function setInvoiceTemplateType(?string $invoiceTemplateType): self
    {
        $this->initialized['invoiceTemplateType'] = true;
        $this->invoiceTemplateType = $invoiceTemplateType;

        return $this;
    }

    /**
     * Invoice PDF accent color (#RRGGBB)
     */
    public function getInvoiceAccentColor(): ?string
    {
        return $this->invoiceAccentColor;
    }

    /**
     * Invoice PDF accent color (#RRGGBB)
     */
    public function setInvoiceAccentColor(?string $invoiceAccentColor): self
    {
        $this->initialized['invoiceAccentColor'] = true;
        $this->invoiceAccentColor = $invoiceAccentColor;

        return $this;
    }

    public function getInvoiceLanguage(): ?string
    {
        return $this->invoiceLanguage;
    }

    public function setInvoiceLanguage(?string $invoiceLanguage): self
    {
        $this->initialized['invoiceLanguage'] = true;
        $this->invoiceLanguage = $invoiceLanguage;

        return $this;
    }

    public function getEmailLanguage(): ?string
    {
        return $this->emailLanguage;
    }

    public function setEmailLanguage(?string $emailLanguage): self
    {
        $this->initialized['emailLanguage'] = true;
        $this->emailLanguage = $emailLanguage;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['entityType' => ['entity_type', 'getEntityType', 'setEntityType'], 'legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'nif' => ['nif', 'getNif', 'setNif'], 'legalForm' => ['legal_form', 'getLegalForm', 'setLegalForm'], 'tradeName' => ['trade_name', 'getTradeName', 'setTradeName'], 'address' => ['address', 'getAddress', 'setAddress'], 'legalRepresentative' => ['legal_representative', 'getLegalRepresentative', 'setLegalRepresentative'], 'phone' => ['phone', 'getPhone', 'setPhone'], 'email' => ['email', 'getEmail', 'setEmail'], 'website' => ['website', 'getWebsite', 'setWebsite'], 'logoUrl' => ['logo_url', 'getLogoUrl', 'setLogoUrl'], 'additionalInfo' => ['additional_info', 'getAdditionalInfo', 'setAdditionalInfo'], 'defaultIban' => ['default_iban', 'getDefaultIban', 'setDefaultIban'], 'defaultSwift' => ['default_swift', 'getDefaultSwift', 'setDefaultSwift'], 'accountHolder' => ['account_holder', 'getAccountHolder', 'setAccountHolder'], 'iae' => ['iae', 'getIae', 'setIae'], 'activityStartDate' => ['activity_start_date', 'getActivityStartDate', 'setActivityStartDate'], 'defaultPaymentTerm' => ['default_payment_term', 'getDefaultPaymentTerm', 'setDefaultPaymentTerm'], 'invoiceTemplateType' => ['invoice_template_type', 'getInvoiceTemplateType', 'setInvoiceTemplateType'], 'invoiceAccentColor' => ['invoice_accent_color', 'getInvoiceAccentColor', 'setInvoiceAccentColor'], 'invoiceLanguage' => ['invoice_language', 'getInvoiceLanguage', 'setInvoiceLanguage'], 'emailLanguage' => ['email_language', 'getEmailLanguage', 'setEmailLanguage']];
    }
}
