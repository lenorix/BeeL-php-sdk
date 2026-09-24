<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CompanyData implements AdditionalPropertiesInterface
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
     * Unique company identifier.
     *
     * @var string
     */
    protected $id;

    /**
     * How much access the signed-in person has to this company, so a dashboard can label it ("read only") and hide write actions instead of discovering the answer through a `403`. Read-only and derived from who is asking — never sent.
     * **Only present when authenticating with a user session.** With an API key the field is absent: what a key may do is set by its own scopes, which are per resource (`invoices:write`, `customers:read`, …) and cannot be reduced to one of three levels. Absent therefore means "does not apply here", never "no access".
     *
     * @var string
     */
    protected $accessLevel;

    /**
     * Spanish Tax ID (NIF/CIF). Immutable once set.
     *
     * @var string
     */
    protected $nif;

    /**
     * Legal/fiscal name of the company. Immutable once set.
     *
     * It is the name that was sent when the NIF was registered, not one AEAT
     * confirmed: for a legal entity the census identifies the CIF and the name is
     * **not verified**. Validate a NIF (`POST /v1/nif/validate`) to read the
     * business name the census actually holds.
     *
     *
     * @var string
     */
    protected $legalName;

    /**
     * Commercial/trade name shown in the UI and on invoices. Editable.
     *
     * @var string
     */
    protected $tradeName;

    /**
     * Self-employed individual or legal entity. Immutable once set.
     *
     * @var string
     */
    protected $entityType;

    /**
     * True for the account's primary company (the owner's own NIF).
     *
     * @var bool
     */
    protected $isPrimary;

    /**
     * AEAT/VeriFactu registration state of this NIF. `NOT_CONFIGURED` means the
     * VeriFactu representation is not set up, so invoices are issued without being
     * submitted to AEAT. Part of the AEAT-emission axis — independent of `environment`.
     *
     *
     * @var string
     */
    protected $verifactuStatus;

    /**
     * **Deprecated** — use `in_test` / `in_prod` instead.
     *
     * A company is a single env-agnostic record; what is per-mode is its
     * *activation*, and a company can be activated in Test, in Live, in both, or
     * in neither. This single scalar cannot express that: it collapses the pair to
     * one value, so it misreports any company activated in both modes. It is kept
     * for backwards compatibility and will be removed in a future version.
     *
     * **How the collapse is decided** — the same rule wherever this field appears
     * (the single company, the account's list of companies, any of their aliases):
     * the environment of the credential you are calling with, *if* the company is
     * activated there; otherwise the environment it is really activated in. A
     * company activated only in Test therefore reads `TEST` even to a live key: the
     * scalar is never re-labelled to the environment you are looking from.
     *
     * This is the data/billing axis, NOT a measure of AEAT capability.
     *
     *
     * @deprecated
     *
     * @var string
     */
    protected $environment;

    /**
     * Whether this company is **activated in Live** (production), regardless
     * of whether the AEAT representation is already signed. Derived from the real
     * activation fact — NOT from the stamped `environment` scalar — so it stays true
     * even for a NIF registered in production but not yet signed. Drives the UI's
     * "already in production" state (no spurious "add NIF" prompt when the
     * account switches to Live).
     *
     *
     * @var bool
     */
    protected $inProd;

    /**
     * Whether this company is **activated in Test** (sandbox). Symmetric to
     * `in_prod` and derived from the same activation fact: activation is independent
     * per mode, so a company may be activated in Test only, in Live only, in both, or
     * in neither. A company that is not activated in the mode you are working in is
     * shown *switched off* in the dashboard (visible and labelled, but not selectable)
     * rather than hidden.
     *
     *
     * @var bool
     */
    protected $inTest;

    /**
     * **Deprecated** — use the activation pair `in_test` / `in_prod`, together with
     * `verifactu_status`, instead.
     *
     * AEAT/VeriFactu environment this NIF is registered against. It is derived, never
     * stored: a single scalar cannot express a NIF activated in both modes, nor one
     * activated in neither. It is `null` whenever no registration can be asserted —
     * no mode activated, or `verifactu_status: NOT_CONFIGURED` — and it is kept for
     * backwards compatibility only.
     *
     *
     * @deprecated
     *
     * @var string|null
     */
    protected $aeatEnvironment;

    /**
     * Account-level lifecycle, identical for every company of the account. AEAT emission
     * additionally requires the per-NIF representation to be signed.
     *
     *
     * @var string
     */
    protected $accountState;

    /**
     * Fiscal address of the company, as set via `POST /v1/accounts/{account_id}/companies` and
     * `PATCH /v1/accounts/{account_id}/companies/{company_id}`. All fields are optional — a company
     * may have a partial address — and the object is `null` when no address
     * has been set.
     *
     *
     * @var CompanyDataAddress|null
     */
    protected $address;

    /**
     * Legal form (SL, SA, ...). Only for `entity_type: LEGAL_ENTITY`, immutable once set.
     * The field `UpdateCompanyRequest.legal_form` writes.
     *
     *
     * @var string|null
     */
    protected $legalForm;

    /**
     * Legal representative of the company, as stored — the field
     * `UpdateCompanyRequest.legal_representative` writes. Only for
     * `entity_type: LEGAL_ENTITY`; absent when none is recorded.
     *
     *
     * @var CompanyDataLegalRepresentative|null
     */
    protected $legalRepresentative;

    /**
     * Contact phone. The field `UpdateCompanyRequest.phone` writes.
     *
     * @var string|null
     */
    protected $phone;

    /**
     * Contact email. The field `UpdateCompanyRequest.email` writes.
     *
     * @var string|null
     */
    protected $email;

    /**
     * Website. The field `UpdateCompanyRequest.website` writes.
     *
     * @var string|null
     */
    protected $website;

    /**
     * Logo URL printed on the invoice. The field `UpdateCompanyRequest.logo_url` writes.
     * Also returned by `GET /v1/companies/{company_id}/invoice-customization`.
     *
     *
     * @var string|null
     */
    protected $logoUrl;

    /**
     * Free note printed on the invoice — the field
     * `UpdateCompanyRequest.additional_info` writes.
     *
     *
     * @var string|null
     */
    protected $additionalInfo;

    /**
     * Default IBAN shown on the invoice. The field `UpdateCompanyRequest.default_iban`
     * writes.
     *
     *
     * @var string|null
     */
    protected $defaultIban;

    /**
     * Default SWIFT/BIC. The field `UpdateCompanyRequest.default_swift` writes.
     *
     *
     * @var string|null
     */
    protected $defaultSwift;

    /**
     * Bank account holder. The field `UpdateCompanyRequest.account_holder` writes.
     *
     *
     * @var string|null
     */
    protected $accountHolder;

    /**
     * IAE code. The field `UpdateCompanyRequest.iae` writes.
     *
     * @var string|null
     */
    protected $iae;

    /**
     * Activity start date. The field `UpdateCompanyRequest.activity_start_date` writes.
     *
     *
     * @var \DateTime|null
     */
    protected $activityStartDate;

    /**
     * Default payment term in days. The field
     * `UpdateCompanyRequest.default_payment_term` writes.
     *
     *
     * @var int|null
     */
    protected $defaultPaymentTerm;

    /**
     * Invoice PDF template type. The field
     * `UpdateCompanyRequest.invoice_template_type` writes. Also returned by
     * `GET /v1/companies/{company_id}/invoice-customization`.
     *
     *
     * @var string|null
     */
    protected $invoiceTemplateType;

    /**
     * Invoice PDF accent color (`#RRGGBB`). The field
     * `UpdateCompanyRequest.invoice_accent_color` writes. Also returned by
     * `GET /v1/companies/{company_id}/invoice-customization`.
     *
     *
     * @var string|null
     */
    protected $invoiceAccentColor;

    /**
     * Language used to render invoice PDFs. The field
     * `UpdateCompanyRequest.invoice_language` writes. Also returned by
     * `GET /v1/companies/{company_id}/invoice-customization`.
     *
     *
     * @var string|null
     */
    protected $invoiceLanguage;

    /**
     * Language used for emails. The field `UpdateCompanyRequest.email_language`
     * writes. Also returned by `GET /v1/companies/{company_id}/invoice-customization`.
     *
     *
     * @var string|null
     */
    protected $emailLanguage;

    /**
     * Default IRPF withholding rate applied to this company's invoices — the same number
     * `POST /v1/accounts/{account_id}/companies` accepts and
     * `GET`/`PUT /v1/companies/{company_id}/tax-configuration` manages, read back
     * where you wrote it.
     *
     * **Absent means no rate was ever declared**, which is not the same as `0`. A company
     * created without `default_irpf_rate` withholds nothing *because nobody said what to
     * withhold*; a company with `0` withholds nothing *because its owner declared so*. Both
     * invoice the same, only one is a declaration — so do not fill the absent case in with a
     * zero. Exemption is a declaration too and reads as `0`.
     *
     * Read-only here. Change it with `PUT /v1/companies/{company_id}/tax-configuration`;
     * this resource does not accept it on `PATCH`.
     *
     * Absent from the `201` of `POST /v1/accounts/{account_id}/companies` (that response describes the company just
     * created, not its resolved tax configuration) — read it back with `GET`.
     *
     *
     * @var float|null
     */
    protected $defaultIrpfRate;

    /**
     * When the company was created (ISO 8601).
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * Issuing-readiness status of this company. Present ONLY when the request
     * asks for it via `?include=readiness`; otherwise omitted/null. Same shape as
     * `GET /v1/companies/{company_id}/issuing-readiness`.
     *
     *
     * @var CompanyDataReadiness|null
     */
    protected $readiness;

    /**
     * Unique company identifier.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Unique company identifier.
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;

        return $this;
    }

    /**
     * How much access the signed-in person has to this company, so a dashboard can label it ("read only") and hide write actions instead of discovering the answer through a `403`. Read-only and derived from who is asking — never sent.
     * **Only present when authenticating with a user session.** With an API key the field is absent: what a key may do is set by its own scopes, which are per resource (`invoices:write`, `customers:read`, …) and cannot be reduced to one of three levels. Absent therefore means "does not apply here", never "no access".
     */
    public function getAccessLevel(): string
    {
        return $this->accessLevel;
    }

    /**
     * How much access the signed-in person has to this company, so a dashboard can label it ("read only") and hide write actions instead of discovering the answer through a `403`. Read-only and derived from who is asking — never sent.
     **Only present when authenticating with a user session.** With an API key the field is absent: what a key may do is set by its own scopes, which are per resource (`invoices:write`, `customers:read`, …) and cannot be reduced to one of three levels. Absent therefore means "does not apply here", never "no access".
     */
    public function setAccessLevel(string $accessLevel): self
    {
        $this->initialized['accessLevel'] = true;
        $this->accessLevel = $accessLevel;

        return $this;
    }

    /**
     * Spanish Tax ID (NIF/CIF). Immutable once set.
     */
    public function getNif(): string
    {
        return $this->nif;
    }

    /**
     * Spanish Tax ID (NIF/CIF). Immutable once set.
     */
    public function setNif(string $nif): self
    {
        $this->initialized['nif'] = true;
        $this->nif = $nif;

        return $this;
    }

    /**
     * Legal/fiscal name of the company. Immutable once set.
     *
     * It is the name that was sent when the NIF was registered, not one AEAT
     * confirmed: for a legal entity the census identifies the CIF and the name is
     * **not verified**. Validate a NIF (`POST /v1/nif/validate`) to read the
     * business name the census actually holds.
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }

    /**
     * Legal/fiscal name of the company. Immutable once set.

    It is the name that was sent when the NIF was registered, not one AEAT
    confirmed: for a legal entity the census identifies the CIF and the name is
     **not verified**. Validate a NIF (`POST /v1/nif/validate`) to read the
    business name the census actually holds.
     */
    public function setLegalName(string $legalName): self
    {
        $this->initialized['legalName'] = true;
        $this->legalName = $legalName;

        return $this;
    }

    /**
     * Commercial/trade name shown in the UI and on invoices. Editable.
     */
    public function getTradeName(): string
    {
        return $this->tradeName;
    }

    /**
     * Commercial/trade name shown in the UI and on invoices. Editable.
     */
    public function setTradeName(string $tradeName): self
    {
        $this->initialized['tradeName'] = true;
        $this->tradeName = $tradeName;

        return $this;
    }

    /**
     * Self-employed individual or legal entity. Immutable once set.
     */
    public function getEntityType(): string
    {
        return $this->entityType;
    }

    /**
     * Self-employed individual or legal entity. Immutable once set.
     */
    public function setEntityType(string $entityType): self
    {
        $this->initialized['entityType'] = true;
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * True for the account's primary company (the owner's own NIF).
     */
    public function getIsPrimary(): bool
    {
        return $this->isPrimary;
    }

    /**
     * True for the account's primary company (the owner's own NIF).
     */
    public function setIsPrimary(bool $isPrimary): self
    {
        $this->initialized['isPrimary'] = true;
        $this->isPrimary = $isPrimary;

        return $this;
    }

    /**
     * AEAT/VeriFactu registration state of this NIF. `NOT_CONFIGURED` means the
     * VeriFactu representation is not set up, so invoices are issued without being
     * submitted to AEAT. Part of the AEAT-emission axis — independent of `environment`.
     */
    public function getVerifactuStatus(): string
    {
        return $this->verifactuStatus;
    }

    /**
     * AEAT/VeriFactu registration state of this NIF. `NOT_CONFIGURED` means the
    VeriFactu representation is not set up, so invoices are issued without being
    submitted to AEAT. Part of the AEAT-emission axis — independent of `environment`.
     */
    public function setVerifactuStatus(string $verifactuStatus): self
    {
        $this->initialized['verifactuStatus'] = true;
        $this->verifactuStatus = $verifactuStatus;

        return $this;
    }

    /**
     * **Deprecated** — use `in_test` / `in_prod` instead.
     *
     * A company is a single env-agnostic record; what is per-mode is its
     * *activation*, and a company can be activated in Test, in Live, in both, or
     * in neither. This single scalar cannot express that: it collapses the pair to
     * one value, so it misreports any company activated in both modes. It is kept
     * for backwards compatibility and will be removed in a future version.
     *
     * **How the collapse is decided** — the same rule wherever this field appears
     * (the single company, the account's list of companies, any of their aliases):
     * the environment of the credential you are calling with, *if* the company is
     * activated there; otherwise the environment it is really activated in. A
     * company activated only in Test therefore reads `TEST` even to a live key: the
     * scalar is never re-labelled to the environment you are looking from.
     *
     * This is the data/billing axis, NOT a measure of AEAT capability.
     *
     *
     * @deprecated
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * **Deprecated** — use `in_test` / `in_prod` instead.

    A company is a single env-agnostic record; what is per-mode is its
     *activation*, and a company can be activated in Test, in Live, in both, or
    in neither. This single scalar cannot express that: it collapses the pair to
    one value, so it misreports any company activated in both modes. It is kept
    for backwards compatibility and will be removed in a future version.

     **How the collapse is decided** — the same rule wherever this field appears
    (the single company, the account's list of companies, any of their aliases):
    the environment of the credential you are calling with, *if* the company is
    activated there; otherwise the environment it is really activated in. A
    company activated only in Test therefore reads `TEST` even to a live key: the
    scalar is never re-labelled to the environment you are looking from.

    This is the data/billing axis, NOT a measure of AEAT capability.

     *
     *
     * @deprecated
     */
    public function setEnvironment(string $environment): self
    {
        $this->initialized['environment'] = true;
        $this->environment = $environment;

        return $this;
    }

    /**
     * Whether this company is **activated in Live** (production), regardless
     * of whether the AEAT representation is already signed. Derived from the real
     * activation fact — NOT from the stamped `environment` scalar — so it stays true
     * even for a NIF registered in production but not yet signed. Drives the UI's
     * "already in production" state (no spurious "add NIF" prompt when the
     * account switches to Live).
     */
    public function getInProd(): bool
    {
        return $this->inProd;
    }

    /**
     * Whether this company is **activated in Live** (production), regardless
    of whether the AEAT representation is already signed. Derived from the real
    activation fact — NOT from the stamped `environment` scalar — so it stays true
    even for a NIF registered in production but not yet signed. Drives the UI's
    "already in production" state (no spurious "add NIF" prompt when the
    account switches to Live).
     */
    public function setInProd(bool $inProd): self
    {
        $this->initialized['inProd'] = true;
        $this->inProd = $inProd;

        return $this;
    }

    /**
     * Whether this company is **activated in Test** (sandbox). Symmetric to
     * `in_prod` and derived from the same activation fact: activation is independent
     * per mode, so a company may be activated in Test only, in Live only, in both, or
     * in neither. A company that is not activated in the mode you are working in is
     * shown *switched off* in the dashboard (visible and labelled, but not selectable)
     * rather than hidden.
     */
    public function getInTest(): bool
    {
        return $this->inTest;
    }

    /**
     * Whether this company is **activated in Test** (sandbox). Symmetric to
    `in_prod` and derived from the same activation fact: activation is independent
    per mode, so a company may be activated in Test only, in Live only, in both, or
    in neither. A company that is not activated in the mode you are working in is
    shown *switched off* in the dashboard (visible and labelled, but not selectable)
    rather than hidden.
     */
    public function setInTest(bool $inTest): self
    {
        $this->initialized['inTest'] = true;
        $this->inTest = $inTest;

        return $this;
    }

    /**
     * **Deprecated** — use the activation pair `in_test` / `in_prod`, together with
     * `verifactu_status`, instead.
     *
     * AEAT/VeriFactu environment this NIF is registered against. It is derived, never
     * stored: a single scalar cannot express a NIF activated in both modes, nor one
     * activated in neither. It is `null` whenever no registration can be asserted —
     * no mode activated, or `verifactu_status: NOT_CONFIGURED` — and it is kept for
     * backwards compatibility only.
     *
     *
     * @deprecated
     */
    public function getAeatEnvironment(): ?string
    {
        return $this->aeatEnvironment;
    }

    /**
     * **Deprecated** — use the activation pair `in_test` / `in_prod`, together with
    `verifactu_status`, instead.

    AEAT/VeriFactu environment this NIF is registered against. It is derived, never
    stored: a single scalar cannot express a NIF activated in both modes, nor one
    activated in neither. It is `null` whenever no registration can be asserted —
    no mode activated, or `verifactu_status: NOT_CONFIGURED` — and it is kept for
    backwards compatibility only.

     *
     *
     * @deprecated
     */
    public function setAeatEnvironment(?string $aeatEnvironment): self
    {
        $this->initialized['aeatEnvironment'] = true;
        $this->aeatEnvironment = $aeatEnvironment;

        return $this;
    }

    /**
     * Account-level lifecycle, identical for every company of the account. AEAT emission
     * additionally requires the per-NIF representation to be signed.
     */
    public function getAccountState(): string
    {
        return $this->accountState;
    }

    /**
     * Account-level lifecycle, identical for every company of the account. AEAT emission
    additionally requires the per-NIF representation to be signed.
     */
    public function setAccountState(string $accountState): self
    {
        $this->initialized['accountState'] = true;
        $this->accountState = $accountState;

        return $this;
    }

    /**
     * Fiscal address of the company, as set via `POST /v1/accounts/{account_id}/companies` and
     * `PATCH /v1/accounts/{account_id}/companies/{company_id}`. All fields are optional — a company
     * may have a partial address — and the object is `null` when no address
     * has been set.
     */
    public function getAddress(): ?CompanyDataAddress
    {
        return $this->address;
    }

    /**
     * Fiscal address of the company, as set via `POST /v1/accounts/{account_id}/companies` and
    `PATCH /v1/accounts/{account_id}/companies/{company_id}`. All fields are optional — a company
    may have a partial address — and the object is `null` when no address
    has been set.
     */
    public function setAddress(?CompanyDataAddress $address): self
    {
        $this->initialized['address'] = true;
        $this->address = $address;

        return $this;
    }

    /**
     * Legal form (SL, SA, ...). Only for `entity_type: LEGAL_ENTITY`, immutable once set.
     * The field `UpdateCompanyRequest.legal_form` writes.
     */
    public function getLegalForm(): ?string
    {
        return $this->legalForm;
    }

    /**
     * Legal form (SL, SA, ...). Only for `entity_type: LEGAL_ENTITY`, immutable once set.
    The field `UpdateCompanyRequest.legal_form` writes.
     */
    public function setLegalForm(?string $legalForm): self
    {
        $this->initialized['legalForm'] = true;
        $this->legalForm = $legalForm;

        return $this;
    }

    /**
     * Legal representative of the company, as stored — the field
     * `UpdateCompanyRequest.legal_representative` writes. Only for
     * `entity_type: LEGAL_ENTITY`; absent when none is recorded.
     */
    public function getLegalRepresentative(): ?CompanyDataLegalRepresentative
    {
        return $this->legalRepresentative;
    }

    /**
     * Legal representative of the company, as stored — the field
    `UpdateCompanyRequest.legal_representative` writes. Only for
    `entity_type: LEGAL_ENTITY`; absent when none is recorded.
     */
    public function setLegalRepresentative(?CompanyDataLegalRepresentative $legalRepresentative): self
    {
        $this->initialized['legalRepresentative'] = true;
        $this->legalRepresentative = $legalRepresentative;

        return $this;
    }

    /**
     * Contact phone. The field `UpdateCompanyRequest.phone` writes.
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Contact phone. The field `UpdateCompanyRequest.phone` writes.
     */
    public function setPhone(?string $phone): self
    {
        $this->initialized['phone'] = true;
        $this->phone = $phone;

        return $this;
    }

    /**
     * Contact email. The field `UpdateCompanyRequest.email` writes.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Contact email. The field `UpdateCompanyRequest.email` writes.
     */
    public function setEmail(?string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;

        return $this;
    }

    /**
     * Website. The field `UpdateCompanyRequest.website` writes.
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * Website. The field `UpdateCompanyRequest.website` writes.
     */
    public function setWebsite(?string $website): self
    {
        $this->initialized['website'] = true;
        $this->website = $website;

        return $this;
    }

    /**
     * Logo URL printed on the invoice. The field `UpdateCompanyRequest.logo_url` writes.
     * Also returned by `GET /v1/companies/{company_id}/invoice-customization`.
     */
    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    /**
     * Logo URL printed on the invoice. The field `UpdateCompanyRequest.logo_url` writes.
    Also returned by `GET /v1/companies/{company_id}/invoice-customization`.
     */
    public function setLogoUrl(?string $logoUrl): self
    {
        $this->initialized['logoUrl'] = true;
        $this->logoUrl = $logoUrl;

        return $this;
    }

    /**
     * Free note printed on the invoice — the field
     * `UpdateCompanyRequest.additional_info` writes.
     */
    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    /**
     * Free note printed on the invoice — the field
    `UpdateCompanyRequest.additional_info` writes.
     */
    public function setAdditionalInfo(?string $additionalInfo): self
    {
        $this->initialized['additionalInfo'] = true;
        $this->additionalInfo = $additionalInfo;

        return $this;
    }

    /**
     * Default IBAN shown on the invoice. The field `UpdateCompanyRequest.default_iban`
     * writes.
     */
    public function getDefaultIban(): ?string
    {
        return $this->defaultIban;
    }

    /**
     * Default IBAN shown on the invoice. The field `UpdateCompanyRequest.default_iban`
    writes.
     */
    public function setDefaultIban(?string $defaultIban): self
    {
        $this->initialized['defaultIban'] = true;
        $this->defaultIban = $defaultIban;

        return $this;
    }

    /**
     * Default SWIFT/BIC. The field `UpdateCompanyRequest.default_swift` writes.
     */
    public function getDefaultSwift(): ?string
    {
        return $this->defaultSwift;
    }

    /**
     * Default SWIFT/BIC. The field `UpdateCompanyRequest.default_swift` writes.
     */
    public function setDefaultSwift(?string $defaultSwift): self
    {
        $this->initialized['defaultSwift'] = true;
        $this->defaultSwift = $defaultSwift;

        return $this;
    }

    /**
     * Bank account holder. The field `UpdateCompanyRequest.account_holder` writes.
     */
    public function getAccountHolder(): ?string
    {
        return $this->accountHolder;
    }

    /**
     * Bank account holder. The field `UpdateCompanyRequest.account_holder` writes.
     */
    public function setAccountHolder(?string $accountHolder): self
    {
        $this->initialized['accountHolder'] = true;
        $this->accountHolder = $accountHolder;

        return $this;
    }

    /**
     * IAE code. The field `UpdateCompanyRequest.iae` writes.
     */
    public function getIae(): ?string
    {
        return $this->iae;
    }

    /**
     * IAE code. The field `UpdateCompanyRequest.iae` writes.
     */
    public function setIae(?string $iae): self
    {
        $this->initialized['iae'] = true;
        $this->iae = $iae;

        return $this;
    }

    /**
     * Activity start date. The field `UpdateCompanyRequest.activity_start_date` writes.
     */
    public function getActivityStartDate(): ?\DateTime
    {
        return $this->activityStartDate;
    }

    /**
     * Activity start date. The field `UpdateCompanyRequest.activity_start_date` writes.
     */
    public function setActivityStartDate(?\DateTime $activityStartDate): self
    {
        $this->initialized['activityStartDate'] = true;
        $this->activityStartDate = $activityStartDate;

        return $this;
    }

    /**
     * Default payment term in days. The field
     * `UpdateCompanyRequest.default_payment_term` writes.
     */
    public function getDefaultPaymentTerm(): ?int
    {
        return $this->defaultPaymentTerm;
    }

    /**
     * Default payment term in days. The field
    `UpdateCompanyRequest.default_payment_term` writes.
     */
    public function setDefaultPaymentTerm(?int $defaultPaymentTerm): self
    {
        $this->initialized['defaultPaymentTerm'] = true;
        $this->defaultPaymentTerm = $defaultPaymentTerm;

        return $this;
    }

    /**
     * Invoice PDF template type. The field
     * `UpdateCompanyRequest.invoice_template_type` writes. Also returned by
     * `GET /v1/companies/{company_id}/invoice-customization`.
     */
    public function getInvoiceTemplateType(): ?string
    {
        return $this->invoiceTemplateType;
    }

    /**
     * Invoice PDF template type. The field
    `UpdateCompanyRequest.invoice_template_type` writes. Also returned by
    `GET /v1/companies/{company_id}/invoice-customization`.
     */
    public function setInvoiceTemplateType(?string $invoiceTemplateType): self
    {
        $this->initialized['invoiceTemplateType'] = true;
        $this->invoiceTemplateType = $invoiceTemplateType;

        return $this;
    }

    /**
     * Invoice PDF accent color (`#RRGGBB`). The field
     * `UpdateCompanyRequest.invoice_accent_color` writes. Also returned by
     * `GET /v1/companies/{company_id}/invoice-customization`.
     */
    public function getInvoiceAccentColor(): ?string
    {
        return $this->invoiceAccentColor;
    }

    /**
     * Invoice PDF accent color (`#RRGGBB`). The field
    `UpdateCompanyRequest.invoice_accent_color` writes. Also returned by
    `GET /v1/companies/{company_id}/invoice-customization`.
     */
    public function setInvoiceAccentColor(?string $invoiceAccentColor): self
    {
        $this->initialized['invoiceAccentColor'] = true;
        $this->invoiceAccentColor = $invoiceAccentColor;

        return $this;
    }

    /**
     * Language used to render invoice PDFs. The field
     * `UpdateCompanyRequest.invoice_language` writes. Also returned by
     * `GET /v1/companies/{company_id}/invoice-customization`.
     */
    public function getInvoiceLanguage(): ?string
    {
        return $this->invoiceLanguage;
    }

    /**
     * Language used to render invoice PDFs. The field
    `UpdateCompanyRequest.invoice_language` writes. Also returned by
    `GET /v1/companies/{company_id}/invoice-customization`.
     */
    public function setInvoiceLanguage(?string $invoiceLanguage): self
    {
        $this->initialized['invoiceLanguage'] = true;
        $this->invoiceLanguage = $invoiceLanguage;

        return $this;
    }

    /**
     * Language used for emails. The field `UpdateCompanyRequest.email_language`
     * writes. Also returned by `GET /v1/companies/{company_id}/invoice-customization`.
     */
    public function getEmailLanguage(): ?string
    {
        return $this->emailLanguage;
    }

    /**
     * Language used for emails. The field `UpdateCompanyRequest.email_language`
    writes. Also returned by `GET /v1/companies/{company_id}/invoice-customization`.
     */
    public function setEmailLanguage(?string $emailLanguage): self
    {
        $this->initialized['emailLanguage'] = true;
        $this->emailLanguage = $emailLanguage;

        return $this;
    }

    /**
     * Default IRPF withholding rate applied to this company's invoices — the same number
     * `POST /v1/accounts/{account_id}/companies` accepts and
     * `GET`/`PUT /v1/companies/{company_id}/tax-configuration` manages, read back
     * where you wrote it.
     *
     * **Absent means no rate was ever declared**, which is not the same as `0`. A company
     * created without `default_irpf_rate` withholds nothing *because nobody said what to
     * withhold*; a company with `0` withholds nothing *because its owner declared so*. Both
     * invoice the same, only one is a declaration — so do not fill the absent case in with a
     * zero. Exemption is a declaration too and reads as `0`.
     *
     * Read-only here. Change it with `PUT /v1/companies/{company_id}/tax-configuration`;
     * this resource does not accept it on `PATCH`.
     *
     * Absent from the `201` of `POST /v1/accounts/{account_id}/companies` (that response describes the company just
     * created, not its resolved tax configuration) — read it back with `GET`.
     */
    public function getDefaultIrpfRate(): ?float
    {
        return $this->defaultIrpfRate;
    }

    /**
     * Default IRPF withholding rate applied to this company's invoices — the same number
    `POST /v1/accounts/{account_id}/companies` accepts and
    `GET`/`PUT /v1/companies/{company_id}/tax-configuration` manages, read back
    where you wrote it.

     **Absent means no rate was ever declared**, which is not the same as `0`. A company
    created without `default_irpf_rate` withholds nothing *because nobody said what to
    withhold*; a company with `0` withholds nothing *because its owner declared so*. Both
    invoice the same, only one is a declaration — so do not fill the absent case in with a
    zero. Exemption is a declaration too and reads as `0`.

    Read-only here. Change it with `PUT /v1/companies/{company_id}/tax-configuration`;
    this resource does not accept it on `PATCH`.

    Absent from the `201` of `POST /v1/accounts/{account_id}/companies` (that response describes the company just
    created, not its resolved tax configuration) — read it back with `GET`.
     */
    public function setDefaultIrpfRate(?float $defaultIrpfRate): self
    {
        $this->initialized['defaultIrpfRate'] = true;
        $this->defaultIrpfRate = $defaultIrpfRate;

        return $this;
    }

    /**
     * When the company was created (ISO 8601).
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * When the company was created (ISO 8601).
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->initialized['createdAt'] = true;
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Issuing-readiness status of this company. Present ONLY when the request
     * asks for it via `?include=readiness`; otherwise omitted/null. Same shape as
     * `GET /v1/companies/{company_id}/issuing-readiness`.
     */
    public function getReadiness(): ?CompanyDataReadiness
    {
        return $this->readiness;
    }

    /**
     * Issuing-readiness status of this company. Present ONLY when the request
    asks for it via `?include=readiness`; otherwise omitted/null. Same shape as
    `GET /v1/companies/{company_id}/issuing-readiness`.
     */
    public function setReadiness(?CompanyDataReadiness $readiness): self
    {
        $this->initialized['readiness'] = true;
        $this->readiness = $readiness;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'accessLevel' => ['access_level', 'getAccessLevel', 'setAccessLevel'], 'nif' => ['nif', 'getNif', 'setNif'], 'legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'tradeName' => ['trade_name', 'getTradeName', 'setTradeName'], 'entityType' => ['entity_type', 'getEntityType', 'setEntityType'], 'isPrimary' => ['is_primary', 'getIsPrimary', 'setIsPrimary'], 'verifactuStatus' => ['verifactu_status', 'getVerifactuStatus', 'setVerifactuStatus'], 'environment' => ['environment', 'getEnvironment', 'setEnvironment'], 'inProd' => ['in_prod', 'getInProd', 'setInProd'], 'inTest' => ['in_test', 'getInTest', 'setInTest'], 'aeatEnvironment' => ['aeat_environment', 'getAeatEnvironment', 'setAeatEnvironment'], 'accountState' => ['account_state', 'getAccountState', 'setAccountState'], 'address' => ['address', 'getAddress', 'setAddress'], 'legalForm' => ['legal_form', 'getLegalForm', 'setLegalForm'], 'legalRepresentative' => ['legal_representative', 'getLegalRepresentative', 'setLegalRepresentative'], 'phone' => ['phone', 'getPhone', 'setPhone'], 'email' => ['email', 'getEmail', 'setEmail'], 'website' => ['website', 'getWebsite', 'setWebsite'], 'logoUrl' => ['logo_url', 'getLogoUrl', 'setLogoUrl'], 'additionalInfo' => ['additional_info', 'getAdditionalInfo', 'setAdditionalInfo'], 'defaultIban' => ['default_iban', 'getDefaultIban', 'setDefaultIban'], 'defaultSwift' => ['default_swift', 'getDefaultSwift', 'setDefaultSwift'], 'accountHolder' => ['account_holder', 'getAccountHolder', 'setAccountHolder'], 'iae' => ['iae', 'getIae', 'setIae'], 'activityStartDate' => ['activity_start_date', 'getActivityStartDate', 'setActivityStartDate'], 'defaultPaymentTerm' => ['default_payment_term', 'getDefaultPaymentTerm', 'setDefaultPaymentTerm'], 'invoiceTemplateType' => ['invoice_template_type', 'getInvoiceTemplateType', 'setInvoiceTemplateType'], 'invoiceAccentColor' => ['invoice_accent_color', 'getInvoiceAccentColor', 'setInvoiceAccentColor'], 'invoiceLanguage' => ['invoice_language', 'getInvoiceLanguage', 'setInvoiceLanguage'], 'emailLanguage' => ['email_language', 'getEmailLanguage', 'setEmailLanguage'], 'defaultIrpfRate' => ['default_irpf_rate', 'getDefaultIrpfRate', 'setDefaultIrpfRate'], 'createdAt' => ['created_at', 'getCreatedAt', 'setCreatedAt'], 'readiness' => ['readiness', 'getReadiness', 'setReadiness']];
    }
}
