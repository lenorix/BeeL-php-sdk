<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class UpdateProductRequest implements AdditionalPropertiesInterface
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
     * Unique alphanumeric product code (optional)
     *
     * @var string|null
     */
    protected $code;
    /**
     * Product/service name
     *
     * @var string
     */
    protected $name;
    /**
     * Detailed description (optional)
     *
     * @var string
     */
    protected $description;
    /**
     * Product/service category:
     * * PRODUCT - Physical, tangible products
     * * SERVICE - General services
     * * CONSULTING - Consulting and advisory services
     * * SOFTWARE - Development, licenses, SaaS
     * * TRAINING - Courses, workshops, training
     * * OTHER - Other unclassified types
     * 
     *
     * @var string
     */
    protected $category;
    /**
     * Suggested default price (optional)
     *
     * @var float
     */
    protected $defaultPrice;
    /**
     * Unit of measure (optional)
     *
     * @var string
     */
    protected $unit;
    /**
     * Complete tax information with cross-validations:
     * - IVA: real rates 4, 10, 21, and the temporary 2, 5 and 7.5 (see below for 0)
     * - IGIC: 0, 3, 5, 7, 9.5, 15, 20 — here 0 is the real "Tipo Cero"
     * - IPSI: real rates 0.5, 1, 2, 4, 8, 10 (see below for 0)
     * - OTHER: any percentage between 0 and 100
     * 
     * **0 % under IVA and IPSI is not a rate, it is the exemption sentinel.** It is accepted
     * on a line, but only together with an `exemption_reason` (exempt or non-subject
     * operation); on its own it says nothing and the line is rejected. That is why
     * `GET /v1/tax-types` publishes the IVA rates without 0: the legitimate way
     * to a 0 % IVA line is through an exemption reason, which the same response also
     * publishes. IGIC is different — its 0 % is a real legal rate (basic necessities) and
     * needs no reason.
     * 
     * **IVA 5 %** (the temporary rate applied from 2022 to electricity, gas and certain
     * foodstuffs) is no longer in force for new operations. AEAT only accepts it on operations
     * dated from 2022-07-01 to 2024-09-30: send the `operation_date` of that period, because
     * without one the issue date decides and a line at 5 % is rejected with
     * `422 VAT_RATE_NOT_ACCEPTED_ON_DATE`. Its equivalence surcharge pair is 0.5 up to 2022-12-31
     * and 0.62 from 2023-01-01. **IVA 2 % and 7.5 %** (temporary rates of the last quarter of 2024)
     * are accepted only on operations dated from 2024-10-01 to 2024-12-31, with surcharges 0.26
     * and 1.
     * 
     * Exception: when regime_key = "17" (OSS/IOSS) the invoice applies the destination
     * country VAT instead of the Spanish one, so any percentage in the EU range [0, 27]
     * is accepted regardless of the tax type set — including 0 without an exemption reason.
     * 
     *
     * @var TaxInfo
     */
    protected $mainTax;
    /**
     * Equivalence surcharge percentage (optional).
     * 
     * Must be coherent with `main_tax.regime_key`: a surcharge > 0 is
     * only valid under regime `18`. When `regime_key` is omitted it is
     * derived automatically (`18` with a surcharge > 0, `01` otherwise).
     * An explicit `regime_key` that does not admit a surcharge combined
     * with a surcharge > 0 is rejected with a 422
     * (`SURCHARGE_REQUIRES_REGIME`), and an explicit regime `18` without
     * a surcharge > 0 is rejected with a 422
     * (`REGIME_REQUIRES_SURCHARGE`).
     * 
     *
     * @var float
     */
    protected $equivalenceSurchargeRate;
    /**
     * IRPF withholding percentage (optional).
     * 
     * The rate must be one of `IrpfPercentage` (`INVALID_IRPF` otherwise) and one
     * the company can bear, the same check as an invoice line (see
     * `WithholdingOptions` in the tax configuration): an entity gets the rates of
     * individuals rejected with `IRPF_RATE_NOT_FOR_CORPORATE_ISSUER`, and an individual gets
     * `9.5` rejected with `IRPF_RATE_ONLY_FOR_CORPORATE_ISSUER`.
     * 
     *
     * @var float
     */
    protected $irpfRate;
    /**
     * Indicates whether the product is active
     *
     * @var bool
     */
    protected $active;
    /**
     * Unique alphanumeric product code (optional)
     *
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }
    /**
     * Unique alphanumeric product code (optional)
     *
     * @param string|null $code
     *
     * @return self
     */
    public function setCode(?string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;
        return $this;
    }
    /**
     * Product/service name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * Product/service name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * Detailed description (optional)
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
     * Detailed description (optional)
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;
        return $this;
    }
    /**
     * Product/service category:
     * * PRODUCT - Physical, tangible products
     * * SERVICE - General services
     * * CONSULTING - Consulting and advisory services
     * * SOFTWARE - Development, licenses, SaaS
     * * TRAINING - Courses, workshops, training
     * * OTHER - Other unclassified types
     * 
     *
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }
    /**
    * Product/service category:
    * PRODUCT - Physical, tangible products
    * SERVICE - General services
    * CONSULTING - Consulting and advisory services
    * SOFTWARE - Development, licenses, SaaS
    * TRAINING - Courses, workshops, training
    * OTHER - Other unclassified types
    
    *
    * @param string $category
    *
    * @return self
    */
    public function setCategory(string $category): self
    {
        $this->initialized['category'] = true;
        $this->category = $category;
        return $this;
    }
    /**
     * Suggested default price (optional)
     *
     * @return float
     */
    public function getDefaultPrice(): float
    {
        return $this->defaultPrice;
    }
    /**
     * Suggested default price (optional)
     *
     * @param float $defaultPrice
     *
     * @return self
     */
    public function setDefaultPrice(float $defaultPrice): self
    {
        $this->initialized['defaultPrice'] = true;
        $this->defaultPrice = $defaultPrice;
        return $this;
    }
    /**
     * Unit of measure (optional)
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
    /**
     * Unit of measure (optional)
     *
     * @param string $unit
     *
     * @return self
     */
    public function setUnit(string $unit): self
    {
        $this->initialized['unit'] = true;
        $this->unit = $unit;
        return $this;
    }
    /**
     * Complete tax information with cross-validations:
     * - IVA: real rates 4, 10, 21, and the temporary 2, 5 and 7.5 (see below for 0)
     * - IGIC: 0, 3, 5, 7, 9.5, 15, 20 — here 0 is the real "Tipo Cero"
     * - IPSI: real rates 0.5, 1, 2, 4, 8, 10 (see below for 0)
     * - OTHER: any percentage between 0 and 100
     * 
     * **0 % under IVA and IPSI is not a rate, it is the exemption sentinel.** It is accepted
     * on a line, but only together with an `exemption_reason` (exempt or non-subject
     * operation); on its own it says nothing and the line is rejected. That is why
     * `GET /v1/tax-types` publishes the IVA rates without 0: the legitimate way
     * to a 0 % IVA line is through an exemption reason, which the same response also
     * publishes. IGIC is different — its 0 % is a real legal rate (basic necessities) and
     * needs no reason.
     * 
     * **IVA 5 %** (the temporary rate applied from 2022 to electricity, gas and certain
     * foodstuffs) is no longer in force for new operations. AEAT only accepts it on operations
     * dated from 2022-07-01 to 2024-09-30: send the `operation_date` of that period, because
     * without one the issue date decides and a line at 5 % is rejected with
     * `422 VAT_RATE_NOT_ACCEPTED_ON_DATE`. Its equivalence surcharge pair is 0.5 up to 2022-12-31
     * and 0.62 from 2023-01-01. **IVA 2 % and 7.5 %** (temporary rates of the last quarter of 2024)
     * are accepted only on operations dated from 2024-10-01 to 2024-12-31, with surcharges 0.26
     * and 1.
     * 
     * Exception: when regime_key = "17" (OSS/IOSS) the invoice applies the destination
     * country VAT instead of the Spanish one, so any percentage in the EU range [0, 27]
     * is accepted regardless of the tax type set — including 0 without an exemption reason.
     * 
     *
     * @return TaxInfo
     */
    public function getMainTax(): TaxInfo
    {
        return $this->mainTax;
    }
    /**
    * Complete tax information with cross-validations:
    - IVA: real rates 4, 10, 21, and the temporary 2, 5 and 7.5 (see below for 0)
    - IGIC: 0, 3, 5, 7, 9.5, 15, 20 — here 0 is the real "Tipo Cero"
    - IPSI: real rates 0.5, 1, 2, 4, 8, 10 (see below for 0)
    - OTHER: any percentage between 0 and 100
    
    **0 % under IVA and IPSI is not a rate, it is the exemption sentinel.** It is accepted
    on a line, but only together with an `exemption_reason` (exempt or non-subject
    operation); on its own it says nothing and the line is rejected. That is why
    `GET /v1/tax-types` publishes the IVA rates without 0: the legitimate way
    to a 0 % IVA line is through an exemption reason, which the same response also
    publishes. IGIC is different — its 0 % is a real legal rate (basic necessities) and
    needs no reason.
    
    **IVA 5 %** (the temporary rate applied from 2022 to electricity, gas and certain
    foodstuffs) is no longer in force for new operations. AEAT only accepts it on operations
    dated from 2022-07-01 to 2024-09-30: send the `operation_date` of that period, because
    without one the issue date decides and a line at 5 % is rejected with
    `422 VAT_RATE_NOT_ACCEPTED_ON_DATE`. Its equivalence surcharge pair is 0.5 up to 2022-12-31
    and 0.62 from 2023-01-01. **IVA 2 % and 7.5 %** (temporary rates of the last quarter of 2024)
    are accepted only on operations dated from 2024-10-01 to 2024-12-31, with surcharges 0.26
    and 1.
    
    Exception: when regime_key = "17" (OSS/IOSS) the invoice applies the destination
    country VAT instead of the Spanish one, so any percentage in the EU range [0, 27]
    is accepted regardless of the tax type set — including 0 without an exemption reason.
    
    *
    * @param TaxInfo $mainTax
    *
    * @return self
    */
    public function setMainTax(TaxInfo $mainTax): self
    {
        $this->initialized['mainTax'] = true;
        $this->mainTax = $mainTax;
        return $this;
    }
    /**
     * Equivalence surcharge percentage (optional).
     * 
     * Must be coherent with `main_tax.regime_key`: a surcharge > 0 is
     * only valid under regime `18`. When `regime_key` is omitted it is
     * derived automatically (`18` with a surcharge > 0, `01` otherwise).
     * An explicit `regime_key` that does not admit a surcharge combined
     * with a surcharge > 0 is rejected with a 422
     * (`SURCHARGE_REQUIRES_REGIME`), and an explicit regime `18` without
     * a surcharge > 0 is rejected with a 422
     * (`REGIME_REQUIRES_SURCHARGE`).
     * 
     *
     * @return float
     */
    public function getEquivalenceSurchargeRate(): float
    {
        return $this->equivalenceSurchargeRate;
    }
    /**
    * Equivalence surcharge percentage (optional).
    
    Must be coherent with `main_tax.regime_key`: a surcharge > 0 is
    only valid under regime `18`. When `regime_key` is omitted it is
    derived automatically (`18` with a surcharge > 0, `01` otherwise).
    An explicit `regime_key` that does not admit a surcharge combined
    with a surcharge > 0 is rejected with a 422
    (`SURCHARGE_REQUIRES_REGIME`), and an explicit regime `18` without
    a surcharge > 0 is rejected with a 422
    (`REGIME_REQUIRES_SURCHARGE`).
    
    *
    * @param float $equivalenceSurchargeRate
    *
    * @return self
    */
    public function setEquivalenceSurchargeRate(float $equivalenceSurchargeRate): self
    {
        $this->initialized['equivalenceSurchargeRate'] = true;
        $this->equivalenceSurchargeRate = $equivalenceSurchargeRate;
        return $this;
    }
    /**
     * IRPF withholding percentage (optional).
     * 
     * The rate must be one of `IrpfPercentage` (`INVALID_IRPF` otherwise) and one
     * the company can bear, the same check as an invoice line (see
     * `WithholdingOptions` in the tax configuration): an entity gets the rates of
     * individuals rejected with `IRPF_RATE_NOT_FOR_CORPORATE_ISSUER`, and an individual gets
     * `9.5` rejected with `IRPF_RATE_ONLY_FOR_CORPORATE_ISSUER`.
     * 
     *
     * @return float
     */
    public function getIrpfRate(): float
    {
        return $this->irpfRate;
    }
    /**
    * IRPF withholding percentage (optional).
    
    The rate must be one of `IrpfPercentage` (`INVALID_IRPF` otherwise) and one
    the company can bear, the same check as an invoice line (see
    `WithholdingOptions` in the tax configuration): an entity gets the rates of
    individuals rejected with `IRPF_RATE_NOT_FOR_CORPORATE_ISSUER`, and an individual gets
    `9.5` rejected with `IRPF_RATE_ONLY_FOR_CORPORATE_ISSUER`.
    
    *
    * @param float $irpfRate
    *
    * @return self
    */
    public function setIrpfRate(float $irpfRate): self
    {
        $this->initialized['irpfRate'] = true;
        $this->irpfRate = $irpfRate;
        return $this;
    }
    /**
     * Indicates whether the product is active
     *
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }
    /**
     * Indicates whether the product is active
     *
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
        return ['code' => ['code', 'getCode', 'setCode'], 'name' => ['name', 'getName', 'setName'], 'description' => ['description', 'getDescription', 'setDescription'], 'category' => ['category', 'getCategory', 'setCategory'], 'defaultPrice' => ['default_price', 'getDefaultPrice', 'setDefaultPrice'], 'unit' => ['unit', 'getUnit', 'setUnit'], 'mainTax' => ['main_tax', 'getMainTax', 'setMainTax'], 'equivalenceSurchargeRate' => ['equivalence_surcharge_rate', 'getEquivalenceSurchargeRate', 'setEquivalenceSurchargeRate'], 'irpfRate' => ['irpf_rate', 'getIrpfRate', 'setIrpfRate'], 'active' => ['active', 'getActive', 'setActive']];
    }
}