<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class Product implements AdditionalPropertiesInterface
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
     * Unique UUID of the product/service
     *
     * @var string
     */
    protected $id;

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
     * Detailed product/service description (optional)
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
    protected $mainTax;

    /**
     * Equivalence surcharge percentage (optional)
     *
     * @var float
     */
    protected $equivalenceSurchargeRate;

    /**
     * IRPF withholding percentage (optional)
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
     * Creation date and time
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * Last update date and time
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Unique UUID of the product/service
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Unique UUID of the product/service
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;

        return $this;
    }

    /**
     * Unique alphanumeric product code (optional)
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Unique alphanumeric product code (optional)
     */
    public function setCode(?string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;

        return $this;
    }

    /**
     * Product/service name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Product/service name
     */
    public function setName(string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;

        return $this;
    }

    /**
     * Detailed product/service description (optional)
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Detailed product/service description (optional)
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
     */
    public function setCategory(string $category): self
    {
        $this->initialized['category'] = true;
        $this->category = $category;

        return $this;
    }

    /**
     * Suggested default price (optional)
     */
    public function getDefaultPrice(): float
    {
        return $this->defaultPrice;
    }

    /**
     * Suggested default price (optional)
     */
    public function setDefaultPrice(float $defaultPrice): self
    {
        $this->initialized['defaultPrice'] = true;
        $this->defaultPrice = $defaultPrice;

        return $this;
    }

    /**
     * Unit of measure (optional)
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * Unit of measure (optional)
     */
    public function setUnit(string $unit): self
    {
        $this->initialized['unit'] = true;
        $this->unit = $unit;

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
     */
    public function getMainTax(): TaxInfo
    {
        return $this->mainTax;
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
     */
    public function setMainTax(TaxInfo $mainTax): self
    {
        $this->initialized['mainTax'] = true;
        $this->mainTax = $mainTax;

        return $this;
    }

    /**
     * Equivalence surcharge percentage (optional)
     */
    public function getEquivalenceSurchargeRate(): float
    {
        return $this->equivalenceSurchargeRate;
    }

    /**
     * Equivalence surcharge percentage (optional)
     */
    public function setEquivalenceSurchargeRate(float $equivalenceSurchargeRate): self
    {
        $this->initialized['equivalenceSurchargeRate'] = true;
        $this->equivalenceSurchargeRate = $equivalenceSurchargeRate;

        return $this;
    }

    /**
     * IRPF withholding percentage (optional)
     */
    public function getIrpfRate(): float
    {
        return $this->irpfRate;
    }

    /**
     * IRPF withholding percentage (optional)
     */
    public function setIrpfRate(float $irpfRate): self
    {
        $this->initialized['irpfRate'] = true;
        $this->irpfRate = $irpfRate;

        return $this;
    }

    /**
     * Indicates whether the product is active
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Indicates whether the product is active
     */
    public function setActive(bool $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;

        return $this;
    }

    /**
     * Creation date and time
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * Creation date and time
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->initialized['createdAt'] = true;
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Last update date and time
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Last update date and time
     */
    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->initialized['updatedAt'] = true;
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'code' => ['code', 'getCode', 'setCode'], 'name' => ['name', 'getName', 'setName'], 'description' => ['description', 'getDescription', 'setDescription'], 'category' => ['category', 'getCategory', 'setCategory'], 'defaultPrice' => ['default_price', 'getDefaultPrice', 'setDefaultPrice'], 'unit' => ['unit', 'getUnit', 'setUnit'], 'mainTax' => ['main_tax', 'getMainTax', 'setMainTax'], 'equivalenceSurchargeRate' => ['equivalence_surcharge_rate', 'getEquivalenceSurchargeRate', 'setEquivalenceSurchargeRate'], 'irpfRate' => ['irpf_rate', 'getIrpfRate', 'setIrpfRate'], 'active' => ['active', 'getActive', 'setActive'], 'createdAt' => ['created_at', 'getCreatedAt', 'setCreatedAt'], 'updatedAt' => ['updated_at', 'getUpdatedAt', 'setUpdatedAt']];
    }
}
