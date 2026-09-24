<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class ProvisionAccountRequestTaxProfile implements AdditionalPropertiesInterface
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
     * Spanish tax id (NIF/CIF). Validated against the AEAT census; an invalid NIF returns 422.
     *
     * @var string
     */
    protected $nif;
    /**
     * Registered fiscal name.
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
     * Legal form (e.g. `SL`). Recommended for `LEGAL_ENTITY`.
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
     * Commercial/trade name shown on invoices (defaults to `legal_name`).
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
     * Default IRPF withholding percentage (use `0` for exempt). Omit it and the company is created with **no withholding at all** — BeeL never assumes a rate nobody declared. You know your account holder's regime; set it explicitly when they do withhold.
     *
     * @var float
     */
    protected $defaultIrpfRate;
    /**
     * Spanish tax id (NIF/CIF). Validated against the AEAT census; an invalid NIF returns 422.
     *
     * @return string
     */
    public function getNif(): string
    {
        return $this->nif;
    }
    /**
     * Spanish tax id (NIF/CIF). Validated against the AEAT census; an invalid NIF returns 422.
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
     * Registered fiscal name.
     *
     * @return string
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }
    /**
     * Registered fiscal name.
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
     * Legal form (e.g. `SL`). Recommended for `LEGAL_ENTITY`.
     *
     * @return string
     */
    public function getLegalForm(): string
    {
        return $this->legalForm;
    }
    /**
     * Legal form (e.g. `SL`). Recommended for `LEGAL_ENTITY`.
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
     * Commercial/trade name shown on invoices (defaults to `legal_name`).
     *
     * @return string
     */
    public function getTradeName(): string
    {
        return $this->tradeName;
    }
    /**
     * Commercial/trade name shown on invoices (defaults to `legal_name`).
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
     * Default IRPF withholding percentage (use `0` for exempt). Omit it and the company is created with **no withholding at all** — BeeL never assumes a rate nobody declared. You know your account holder's regime; set it explicitly when they do withhold.
     *
     * @return float
     */
    public function getDefaultIrpfRate(): float
    {
        return $this->defaultIrpfRate;
    }
    /**
     * Default IRPF withholding percentage (use `0` for exempt). Omit it and the company is created with **no withholding at all** — BeeL never assumes a rate nobody declared. You know your account holder's regime; set it explicitly when they do withhold.
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
    public function definedProperties(): array
    {
        return ['nif' => ['nif', 'getNif', 'setNif'], 'legalName' => ['legal_name', 'getLegalName', 'setLegalName'], 'entityType' => ['entity_type', 'getEntityType', 'setEntityType'], 'address' => ['address', 'getAddress', 'setAddress'], 'legalForm' => ['legal_form', 'getLegalForm', 'setLegalForm'], 'legalRepresentative' => ['legal_representative', 'getLegalRepresentative', 'setLegalRepresentative'], 'tradeName' => ['trade_name', 'getTradeName', 'setTradeName'], 'defaultMainTax' => ['default_main_tax', 'getDefaultMainTax', 'setDefaultMainTax'], 'defaultIrpfRate' => ['default_irpf_rate', 'getDefaultIrpfRate', 'setDefaultIrpfRate']];
    }
}