<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CreateCompanyRequest implements AdditionalPropertiesInterface
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
     * NIF/CIF of the business
     *
     * @var string
     */
    protected $nif;
    /**
     * Legal/fiscal name
     *
     * @var string
     */
    protected $legalName;
    /**
     * Taxpayer type.
     * INDIVIDUAL: Natural person (individual self-employed).
     * LEGAL_ENTITY: Legal entity (company with legal form: SL, SA, etc.).
     * 
     *
     * @var string
     */
    protected $entityType;
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
     * Legal form (SL, SA, ...). Recommended for LEGAL_ENTITY.
     *
     * @var string
     */
    protected $legalForm;
    /**
     * Legal representative data for a legal entity.
     * Only used when entity_type = LEGAL_ENTITY.
     * 
     *
     * @var LegalRepresentative
     */
    protected $legalRepresentative;
    /**
     * Commercial/trade name (optional)
     *
     * @var string
     */
    protected $tradeName;
    /**
     * Complete tax information with cross-validations:
     * - IVA: real rates 4, 5, 10, 21 (see below for 0)
     * - IGIC: 0, 3, 5, 7, 9.5, 15, 20 — here 0 is the real "Tipo Cero"
     * - IPSI: real rates 0.5, 1, 2, 4, 8, 10 (see below for 0)
     * - OTHER: any percentage between 0 and 100
     * 
     * **0 % under IVA and IPSI is not a rate, it is the exemption sentinel.** It is accepted
     * on a line, but only together with an `exemption_reason` (exempt or non-subject
     * operation); on its own it says nothing and the line is rejected. That is why
     * `GET /v1/tax-types` publishes 4, 5, 10 and 21 for IVA and not 0: the legitimate way
     * to a 0 % IVA line is through an exemption reason, which the same response also
     * publishes. IGIC is different — its 0 % is a real legal rate (basic necessities) and
     * needs no reason.
     * 
     * **IVA 5 %** (RD-ley 11/2022 and its extensions, on electricity, gas and basic
     * foodstuffs) is no longer in force for new operations, but it stays valid: corrective
     * invoices and late-filed invoices for the periods when it applied must be able to carry
     * it. Its equivalence surcharge pair is 0.625.
     * 
     * Exception: when regime_key = "17" (OSS/IOSS) the invoice applies the destination
     * country VAT instead of the Spanish one, so any percentage in the EU range [0, 27]
     * is accepted regardless of the tax type set — including 0 without an exemption reason.
     * 
     *
     * @var TaxInfo
     */
    protected $defaultMainTax;
    /**
     * Default IRPF retention rate for this company's invoices. Omit it and the company is created with no withholding — BeeL never assumes a rate nobody declared.
     *
     * @var float
     */
    protected $defaultIrpfRate;
    /**
     * Configuration of the invoice series the company is born with. Optional and additive:
     * omit it — or any field — and the system default applies for that field: series
     * `F`/`S`/`R`, format `{CODIGO}-{YYYY}-{NUM:4}`, `ANNUAL` counter reset, starting at 1,
     * exactly as before.
     * 
     * Send it when the business already issued invoices with another system this year and
     * wants to **continue** its numbering, or simply wants its series born with a specific
     * shape — this is the only moment it can be expressed in the same call. Once a series
     * issues its first invoice its numbering is frozen by law: `PATCH
     * /v1/companies/{company_id}/series/{series_id}` then rejects `initial_number` with
     * `SERIES_INITIAL_NUMBER_LOCKED_HAS_INVOICES`.
     * 
     * It covers the **three** series a company is born with:
     * 
     * * the **ordinary** one (real invoices) — the fields at this level, default `F`.
     * * the **simplified** one (ticket-style invoices) — `simplified`, default `S`.
     * * the **corrective** one (rectificativas) — `corrective`, default `R`.
     * 
     * Each series takes `code`, `initial_number`, `format` and `counter_reset`, all
     * optional and independent: omit a field and that series keeps the system default
     * for it.
     * 
     * `format` and `counter_reset` must be able to tell reset periods apart, with the
     * same rules and error codes as `POST /v1/companies/{company_id}/series`: a `MONTHLY` reset
     * requires `{MM}` plus a year token in the format
     * (`SERIES_MONTHLY_REQUIRES_MONTH_AND_YEAR`); an `ANNUAL` reset requires a year token
     * (`SERIES_ANNUAL_REQUIRES_YEAR`). Mind the default reset is `ANNUAL`: a format
     * without a year token (e.g. `{CODIGO}-{NUM:6}`) also needs `counter_reset: NEVER`
     * in the same series block.
     * 
     * The list of series is **not** negotiable — a company always starts with exactly
     * these three, one default per document type, because a company without a default
     * series cannot issue at all (`NO_DEFAULT_SERIES`). You configure how each of them is
     * born, not which ones exist. More series can be added later with
     * `POST /v1/companies/{company_id}/series`.
     * 
     * **Per environment**: each activation is self-contained and seeds exactly what its
     * request carries. Activating the same NIF in the other environment later does **not**
     * copy this configuration — repeat your `numbering` block in that activation call if
     * you want the same series there; without it the other environment gets the system
     * defaults.
     * 
     * Only valid when the request activates the company: with `activate: false` no series
     * are seeded, so a `numbering` block that asks for anything is rejected with `422`
     * `NUMBERING_REQUIRES_ACTIVATION` instead of being silently discarded.
     * 
     *
     * @var CompanyNumbering
     */
    protected $numbering;
    /**
     * AEAT/VeriFactu environment to register this NIF against.
     * * `TEST` — Sandbox NIF, invoices reach VeriFactu test (default).
     * * `PROD` — Production NIF; requires the AEAT representation
     *   model to be signed (`POST /v1/companies/{company_id}/representation/submit`)
     *   before real invoices can be issued.
     * 
     * This field was previously named `environment`. The old name is still accepted as an
     * alias for backwards compatibility and will be withdrawn in a future major version —
     * send `aeat_environment`.
     * 
     *
     * @var string
     */
    protected $aeatEnvironment = 'TEST';
    /**
     * Whether to **switch the company on** in `aeat_environment` as part of this call.
     * 
     * Creating a company and activating it are two different acts. The company record is free
     * and always creatable; the activation is what seeds the invoice series, registers the
     * NIF and — in `PROD` — is what gets billed.
     * 
     * * `true` (default) — unchanged behaviour: the company is created and switched on in
     *   `aeat_environment`, with its default series seeded there.
     * * `false` — only the company record is created. It is switched on nowhere, has
     *   no series and cannot issue yet; `aeat_environment` is ignored. Activate it later
     *   with `POST /v1/companies/{company_id}/activations`, which is also
     *   the only door that opens a Stripe Checkout when the account has no card on file.
     * 
     * Series numbering travels with the activation that seeds it: a request with
     * `activate: false` and a `numbering` block that asks for anything is rejected with
     * `422` `NUMBERING_REQUIRES_ACTIVATION` — the later activation door does not accept
     * numbering, so silently accepting it here would discard it forever. Either drop the
     * `numbering` block or activate a mode in the same call.
     * 
     *
     * @var bool
     */
    protected $activate = true;
    /**
     * NIF/CIF of the business
     *
     * @return string
     */
    public function getNif(): string
    {
        return $this->nif;
    }
    /**
     * NIF/CIF of the business
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
     * Legal/fiscal name
     *
     * @return string
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }
    /**
     * Legal/fiscal name
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
     * Taxpayer type.
     * INDIVIDUAL: Natural person (individual self-employed).
     * LEGAL_ENTITY: Legal entity (company with legal form: SL, SA, etc.).
     * 
     *
     * @return string
     */
    public function getEntityType(): string
    {
        return $this->entityType;
    }
    /**
    * Taxpayer type.
    INDIVIDUAL: Natural person (individual self-employed).
    LEGAL_ENTITY: Legal entity (company with legal form: SL, SA, etc.).
    
    *
    * @param string $entityType
    *
    * @return self
    */
    public function setEntityType(string $entityType): self
    {
        $this->initialized['entityType'] = true;
        $this->entityType = $entityType;
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
     * Legal form (SL, SA, ...). Recommended for LEGAL_ENTITY.
     *
     * @return string
     */
    public function getLegalForm(): string
    {
        return $this->legalForm;
    }
    /**
     * Legal form (SL, SA, ...). Recommended for LEGAL_ENTITY.
     *
     * @param string $legalForm
     *
     * @return self
     */
    public function setLegalForm(string $legalForm): self
    {
        $this->initialized['legalForm'] = true;
        $this->legalForm = $legalForm;
        return $this;
    }
    /**
     * Legal representative data for a legal entity.
     * Only used when entity_type = LEGAL_ENTITY.
     * 
     *
     * @return LegalRepresentative
     */
    public function getLegalRepresentative(): LegalRepresentative
    {
        return $this->legalRepresentative;
    }
    /**
    * Legal representative data for a legal entity.
    Only used when entity_type = LEGAL_ENTITY.
    
    *
    * @param LegalRepresentative $legalRepresentative
    *
    * @return self
    */
    public function setLegalRepresentative(LegalRepresentative $legalRepresentative): self
    {
        $this->initialized['legalRepresentative'] = true;
        $this->legalRepresentative = $legalRepresentative;
        return $this;
    }
    /**
     * Commercial/trade name (optional)
     *
     * @return string
     */
    public function getTradeName(): string
    {
        return $this->tradeName;
    }
    /**
     * Commercial/trade name (optional)
     *
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
     * Complete tax information with cross-validations:
     * - IVA: real rates 4, 5, 10, 21 (see below for 0)
     * - IGIC: 0, 3, 5, 7, 9.5, 15, 20 — here 0 is the real "Tipo Cero"
     * - IPSI: real rates 0.5, 1, 2, 4, 8, 10 (see below for 0)
     * - OTHER: any percentage between 0 and 100
     * 
     * **0 % under IVA and IPSI is not a rate, it is the exemption sentinel.** It is accepted
     * on a line, but only together with an `exemption_reason` (exempt or non-subject
     * operation); on its own it says nothing and the line is rejected. That is why
     * `GET /v1/tax-types` publishes 4, 5, 10 and 21 for IVA and not 0: the legitimate way
     * to a 0 % IVA line is through an exemption reason, which the same response also
     * publishes. IGIC is different — its 0 % is a real legal rate (basic necessities) and
     * needs no reason.
     * 
     * **IVA 5 %** (RD-ley 11/2022 and its extensions, on electricity, gas and basic
     * foodstuffs) is no longer in force for new operations, but it stays valid: corrective
     * invoices and late-filed invoices for the periods when it applied must be able to carry
     * it. Its equivalence surcharge pair is 0.625.
     * 
     * Exception: when regime_key = "17" (OSS/IOSS) the invoice applies the destination
     * country VAT instead of the Spanish one, so any percentage in the EU range [0, 27]
     * is accepted regardless of the tax type set — including 0 without an exemption reason.
     * 
     *
     * @return TaxInfo
     */
    public function getDefaultMainTax(): TaxInfo
    {
        return $this->defaultMainTax;
    }
    /**
    * Complete tax information with cross-validations:
    - IVA: real rates 4, 5, 10, 21 (see below for 0)
    - IGIC: 0, 3, 5, 7, 9.5, 15, 20 — here 0 is the real "Tipo Cero"
    - IPSI: real rates 0.5, 1, 2, 4, 8, 10 (see below for 0)
    - OTHER: any percentage between 0 and 100
    
    **0 % under IVA and IPSI is not a rate, it is the exemption sentinel.** It is accepted
    on a line, but only together with an `exemption_reason` (exempt or non-subject
    operation); on its own it says nothing and the line is rejected. That is why
    `GET /v1/tax-types` publishes 4, 5, 10 and 21 for IVA and not 0: the legitimate way
    to a 0 % IVA line is through an exemption reason, which the same response also
    publishes. IGIC is different — its 0 % is a real legal rate (basic necessities) and
    needs no reason.
    
    **IVA 5 %** (RD-ley 11/2022 and its extensions, on electricity, gas and basic
    foodstuffs) is no longer in force for new operations, but it stays valid: corrective
    invoices and late-filed invoices for the periods when it applied must be able to carry
    it. Its equivalence surcharge pair is 0.625.
    
    Exception: when regime_key = "17" (OSS/IOSS) the invoice applies the destination
    country VAT instead of the Spanish one, so any percentage in the EU range [0, 27]
    is accepted regardless of the tax type set — including 0 without an exemption reason.
    
    *
    * @param TaxInfo $defaultMainTax
    *
    * @return self
    */
    public function setDefaultMainTax(TaxInfo $defaultMainTax): self
    {
        $this->initialized['defaultMainTax'] = true;
        $this->defaultMainTax = $defaultMainTax;
        return $this;
    }
    /**
     * Default IRPF retention rate for this company's invoices. Omit it and the company is created with no withholding — BeeL never assumes a rate nobody declared.
     *
     * @return float
     */
    public function getDefaultIrpfRate(): float
    {
        return $this->defaultIrpfRate;
    }
    /**
     * Default IRPF retention rate for this company's invoices. Omit it and the company is created with no withholding — BeeL never assumes a rate nobody declared.
     *
     * @param float $defaultIrpfRate
     *
     * @return self
     */
    public function setDefaultIrpfRate(float $defaultIrpfRate): self
    {
        $this->initialized['defaultIrpfRate'] = true;
        $this->defaultIrpfRate = $defaultIrpfRate;
        return $this;
    }
    /**
     * Configuration of the invoice series the company is born with. Optional and additive:
     * omit it — or any field — and the system default applies for that field: series
     * `F`/`S`/`R`, format `{CODIGO}-{YYYY}-{NUM:4}`, `ANNUAL` counter reset, starting at 1,
     * exactly as before.
     * 
     * Send it when the business already issued invoices with another system this year and
     * wants to **continue** its numbering, or simply wants its series born with a specific
     * shape — this is the only moment it can be expressed in the same call. Once a series
     * issues its first invoice its numbering is frozen by law: `PATCH
     * /v1/companies/{company_id}/series/{series_id}` then rejects `initial_number` with
     * `SERIES_INITIAL_NUMBER_LOCKED_HAS_INVOICES`.
     * 
     * It covers the **three** series a company is born with:
     * 
     * * the **ordinary** one (real invoices) — the fields at this level, default `F`.
     * * the **simplified** one (ticket-style invoices) — `simplified`, default `S`.
     * * the **corrective** one (rectificativas) — `corrective`, default `R`.
     * 
     * Each series takes `code`, `initial_number`, `format` and `counter_reset`, all
     * optional and independent: omit a field and that series keeps the system default
     * for it.
     * 
     * `format` and `counter_reset` must be able to tell reset periods apart, with the
     * same rules and error codes as `POST /v1/companies/{company_id}/series`: a `MONTHLY` reset
     * requires `{MM}` plus a year token in the format
     * (`SERIES_MONTHLY_REQUIRES_MONTH_AND_YEAR`); an `ANNUAL` reset requires a year token
     * (`SERIES_ANNUAL_REQUIRES_YEAR`). Mind the default reset is `ANNUAL`: a format
     * without a year token (e.g. `{CODIGO}-{NUM:6}`) also needs `counter_reset: NEVER`
     * in the same series block.
     * 
     * The list of series is **not** negotiable — a company always starts with exactly
     * these three, one default per document type, because a company without a default
     * series cannot issue at all (`NO_DEFAULT_SERIES`). You configure how each of them is
     * born, not which ones exist. More series can be added later with
     * `POST /v1/companies/{company_id}/series`.
     * 
     * **Per environment**: each activation is self-contained and seeds exactly what its
     * request carries. Activating the same NIF in the other environment later does **not**
     * copy this configuration — repeat your `numbering` block in that activation call if
     * you want the same series there; without it the other environment gets the system
     * defaults.
     * 
     * Only valid when the request activates the company: with `activate: false` no series
     * are seeded, so a `numbering` block that asks for anything is rejected with `422`
     * `NUMBERING_REQUIRES_ACTIVATION` instead of being silently discarded.
     * 
     *
     * @return CompanyNumbering
     */
    public function getNumbering(): CompanyNumbering
    {
        return $this->numbering;
    }
    /**
    * Configuration of the invoice series the company is born with. Optional and additive:
    omit it — or any field — and the system default applies for that field: series
    `F`/`S`/`R`, format `{CODIGO}-{YYYY}-{NUM:4}`, `ANNUAL` counter reset, starting at 1,
    exactly as before.
    
    Send it when the business already issued invoices with another system this year and
    wants to **continue** its numbering, or simply wants its series born with a specific
    shape — this is the only moment it can be expressed in the same call. Once a series
    issues its first invoice its numbering is frozen by law: `PATCH
    /v1/companies/{company_id}/series/{series_id}` then rejects `initial_number` with
    `SERIES_INITIAL_NUMBER_LOCKED_HAS_INVOICES`.
    
    It covers the **three** series a company is born with:
    
    * the **ordinary** one (real invoices) — the fields at this level, default `F`.
    * the **simplified** one (ticket-style invoices) — `simplified`, default `S`.
    * the **corrective** one (rectificativas) — `corrective`, default `R`.
    
    Each series takes `code`, `initial_number`, `format` and `counter_reset`, all
    optional and independent: omit a field and that series keeps the system default
    for it.
    
    `format` and `counter_reset` must be able to tell reset periods apart, with the
    same rules and error codes as `POST /v1/companies/{company_id}/series`: a `MONTHLY` reset
    requires `{MM}` plus a year token in the format
    (`SERIES_MONTHLY_REQUIRES_MONTH_AND_YEAR`); an `ANNUAL` reset requires a year token
    (`SERIES_ANNUAL_REQUIRES_YEAR`). Mind the default reset is `ANNUAL`: a format
    without a year token (e.g. `{CODIGO}-{NUM:6}`) also needs `counter_reset: NEVER`
    in the same series block.
    
    The list of series is **not** negotiable — a company always starts with exactly
    these three, one default per document type, because a company without a default
    series cannot issue at all (`NO_DEFAULT_SERIES`). You configure how each of them is
    born, not which ones exist. More series can be added later with
    `POST /v1/companies/{company_id}/series`.
    
    **Per environment**: each activation is self-contained and seeds exactly what its
    request carries. Activating the same NIF in the other environment later does **not**
    copy this configuration — repeat your `numbering` block in that activation call if
    you want the same series there; without it the other environment gets the system
    defaults.
    
    Only valid when the request activates the company: with `activate: false` no series
    are seeded, so a `numbering` block that asks for anything is rejected with `422`
    `NUMBERING_REQUIRES_ACTIVATION` instead of being silently discarded.
    
    *
    * @param CompanyNumbering $numbering
    *
    * @return self
    */
    public function setNumbering(CompanyNumbering $numbering): self
    {
        $this->initialized['numbering'] = true;
        $this->numbering = $numbering;
        return $this;
    }
    /**
     * AEAT/VeriFactu environment to register this NIF against.
     * * `TEST` — Sandbox NIF, invoices reach VeriFactu test (default).
     * * `PROD` — Production NIF; requires the AEAT representation
     *   model to be signed (`POST /v1/companies/{company_id}/representation/submit`)
     *   before real invoices can be issued.
     * 
     * This field was previously named `environment`. The old name is still accepted as an
     * alias for backwards compatibility and will be withdrawn in a future major version —
     * send `aeat_environment`.
     * 
     *
     * @return string
     */
    public function getAeatEnvironment(): string
    {
        return $this->aeatEnvironment;
    }
    /**
    * AEAT/VeriFactu environment to register this NIF against.
    * `TEST` — Sandbox NIF, invoices reach VeriFactu test (default).
    * `PROD` — Production NIF; requires the AEAT representation
     model to be signed (`POST /v1/companies/{company_id}/representation/submit`)
     before real invoices can be issued.
    
    This field was previously named `environment`. The old name is still accepted as an
    alias for backwards compatibility and will be withdrawn in a future major version —
    send `aeat_environment`.
    
    *
    * @param string $aeatEnvironment
    *
    * @return self
    */
    public function setAeatEnvironment(string $aeatEnvironment): self
    {
        $this->initialized['aeatEnvironment'] = true;
        $this->aeatEnvironment = $aeatEnvironment;
        return $this;
    }
    /**
     * Whether to **switch the company on** in `aeat_environment` as part of this call.
     * 
     * Creating a company and activating it are two different acts. The company record is free
     * and always creatable; the activation is what seeds the invoice series, registers the
     * NIF and — in `PROD` — is what gets billed.
     * 
     * * `true` (default) — unchanged behaviour: the company is created and switched on in
     *   `aeat_environment`, with its default series seeded there.
     * * `false` — only the company record is created. It is switched on nowhere, has
     *   no series and cannot issue yet; `aeat_environment` is ignored. Activate it later
     *   with `POST /v1/companies/{company_id}/activations`, which is also
     *   the only door that opens a Stripe Checkout when the account has no card on file.
     * 
     * Series numbering travels with the activation that seeds it: a request with
     * `activate: false` and a `numbering` block that asks for anything is rejected with
     * `422` `NUMBERING_REQUIRES_ACTIVATION` — the later activation door does not accept
     * numbering, so silently accepting it here would discard it forever. Either drop the
     * `numbering` block or activate a mode in the same call.
     * 
     *
     * @return bool
     */
    public function getActivate(): bool
    {
        return $this->activate;
    }
    /**
    * Whether to **switch the company on** in `aeat_environment` as part of this call.
    
    Creating a company and activating it are two different acts. The company record is free
    and always creatable; the activation is what seeds the invoice series, registers the
    NIF and — in `PROD` — is what gets billed.
    
    * `true` (default) — unchanged behaviour: the company is created and switched on in
     `aeat_environment`, with its default series seeded there.
    * `false` — only the company record is created. It is switched on nowhere, has
     no series and cannot issue yet; `aeat_environment` is ignored. Activate it later
     with `POST /v1/companies/{company_id}/activations`, which is also
     the only door that opens a Stripe Checkout when the account has no card on file.
    
    Series numbering travels with the activation that seeds it: a request with
    `activate: false` and a `numbering` block that asks for anything is rejected with
    `422` `NUMBERING_REQUIRES_ACTIVATION` — the later activation door does not accept
    numbering, so silently accepting it here would discard it forever. Either drop the
    `numbering` block or activate a mode in the same call.
    
    *
    * @param bool $activate
    *
    * @return self
    */
    public function setActivate(bool $activate): self
    {
        $this->initialized['activate'] = true;
        $this->activate = $activate;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['nif' => ['nif', 'getNif', 'setNif'], 'legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'entityType' => ['entity_type', 'getEntityType', 'setEntityType'], 'address' => ['address', 'getAddress', 'setAddress'], 'legalForm' => ['legal_form', 'getLegalForm', 'setLegalForm'], 'legalRepresentative' => ['legal_representative', 'getLegalRepresentative', 'setLegalRepresentative'], 'tradeName' => ['trade_name', 'getTradeName', 'setTradeName'], 'defaultMainTax' => ['default_main_tax', 'getDefaultMainTax', 'setDefaultMainTax'], 'defaultIrpfRate' => ['default_irpf_rate', 'getDefaultIrpfRate', 'setDefaultIrpfRate'], 'numbering' => ['numbering', 'getNumbering', 'setNumbering'], 'aeatEnvironment' => ['aeat_environment', 'getAeatEnvironment', 'setAeatEnvironment'], 'activate' => ['activate', 'getActivate', 'setActivate']];
    }
}