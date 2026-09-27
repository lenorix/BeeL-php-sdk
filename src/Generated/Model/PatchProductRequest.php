<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class PatchProductRequest implements AdditionalPropertiesInterface
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
     * Unique alphanumeric product code. Send `null` to clear it.
     *
     * @var string|null
     */
    protected $code;
    /**
     * Product/service name. Cannot be cleared.
     *
     * @var string
     */
    protected $name;
    /**
     * Detailed description. Send `null` to clear it.
     *
     * @var string|null
     */
    protected $description;
    /**
     * Product category. Omit to keep the current one.
     *
     * @var string
     */
    protected $category;
    /**
     * Suggested default price. Send `null` to clear it.
     *
     * @var float|null
     */
    protected $defaultPrice;
    /**
     * Unit of measure. Send `null` to clear it.
     *
     * @var string|null
     */
    protected $unit;
    /**
     * Main tax. Replaced as a whole (it is not patched field by field);
     * omit it to keep the current one. A product always carries a main
     * tax, so it cannot be cleared.
     * 
     *
     * @var PatchProductRequestMainTax
     */
    protected $mainTax;
    /**
     * Equivalence surcharge percentage. Send `null` to state that none
     * applies (equivalent to `0`).
     * 
     * The merged result must be coherent with the regime key: if this
     * PATCH does not send `main_tax.regime_key`, the stored regime is
     * adjusted automatically (`18` when the merged surcharge is > 0,
     * `01` when it is not). With an explicit `regime_key` in this PATCH,
     * an incoherent combination is rejected with a 422
     * (`SURCHARGE_REQUIRES_REGIME` / `REGIME_REQUIRES_SURCHARGE`).
     * 
     *
     * @var float|null
     */
    protected $equivalenceSurchargeRate;
    /**
     * IRPF withholding percentage. Send `null` to state that none
     * applies (equivalent to `0`).
     * 
     *
     * @var float|null
     */
    protected $irpfRate;
    /**
     * Indicates whether the product is active.
     *
     * @var bool
     */
    protected $active;
    /**
     * Unique alphanumeric product code. Send `null` to clear it.
     *
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }
    /**
     * Unique alphanumeric product code. Send `null` to clear it.
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
     * Product/service name. Cannot be cleared.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * Product/service name. Cannot be cleared.
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
     * Detailed description. Send `null` to clear it.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
     * Detailed description. Send `null` to clear it.
     *
     * @param string|null $description
     *
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;
        return $this;
    }
    /**
     * Product category. Omit to keep the current one.
     *
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }
    /**
     * Product category. Omit to keep the current one.
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
     * Suggested default price. Send `null` to clear it.
     *
     * @return float|null
     */
    public function getDefaultPrice(): ?float
    {
        return $this->defaultPrice;
    }
    /**
     * Suggested default price. Send `null` to clear it.
     *
     * @param float|null $defaultPrice
     *
     * @return self
     */
    public function setDefaultPrice(?float $defaultPrice): self
    {
        $this->initialized['defaultPrice'] = true;
        $this->defaultPrice = $defaultPrice;
        return $this;
    }
    /**
     * Unit of measure. Send `null` to clear it.
     *
     * @return string|null
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }
    /**
     * Unit of measure. Send `null` to clear it.
     *
     * @param string|null $unit
     *
     * @return self
     */
    public function setUnit(?string $unit): self
    {
        $this->initialized['unit'] = true;
        $this->unit = $unit;
        return $this;
    }
    /**
     * Main tax. Replaced as a whole (it is not patched field by field);
     * omit it to keep the current one. A product always carries a main
     * tax, so it cannot be cleared.
     * 
     *
     * @return PatchProductRequestMainTax
     */
    public function getMainTax(): PatchProductRequestMainTax
    {
        return $this->mainTax;
    }
    /**
    * Main tax. Replaced as a whole (it is not patched field by field);
    omit it to keep the current one. A product always carries a main
    tax, so it cannot be cleared.
    
    *
    * @param PatchProductRequestMainTax $mainTax
    *
    * @return self
    */
    public function setMainTax(PatchProductRequestMainTax $mainTax): self
    {
        $this->initialized['mainTax'] = true;
        $this->mainTax = $mainTax;
        return $this;
    }
    /**
     * Equivalence surcharge percentage. Send `null` to state that none
     * applies (equivalent to `0`).
     * 
     * The merged result must be coherent with the regime key: if this
     * PATCH does not send `main_tax.regime_key`, the stored regime is
     * adjusted automatically (`18` when the merged surcharge is > 0,
     * `01` when it is not). With an explicit `regime_key` in this PATCH,
     * an incoherent combination is rejected with a 422
     * (`SURCHARGE_REQUIRES_REGIME` / `REGIME_REQUIRES_SURCHARGE`).
     * 
     *
     * @return float|null
     */
    public function getEquivalenceSurchargeRate(): ?float
    {
        return $this->equivalenceSurchargeRate;
    }
    /**
    * Equivalence surcharge percentage. Send `null` to state that none
    applies (equivalent to `0`).
    
    The merged result must be coherent with the regime key: if this
    PATCH does not send `main_tax.regime_key`, the stored regime is
    adjusted automatically (`18` when the merged surcharge is > 0,
    `01` when it is not). With an explicit `regime_key` in this PATCH,
    an incoherent combination is rejected with a 422
    (`SURCHARGE_REQUIRES_REGIME` / `REGIME_REQUIRES_SURCHARGE`).
    
    *
    * @param float|null $equivalenceSurchargeRate
    *
    * @return self
    */
    public function setEquivalenceSurchargeRate(?float $equivalenceSurchargeRate): self
    {
        $this->initialized['equivalenceSurchargeRate'] = true;
        $this->equivalenceSurchargeRate = $equivalenceSurchargeRate;
        return $this;
    }
    /**
     * IRPF withholding percentage. Send `null` to state that none
     * applies (equivalent to `0`).
     * 
     *
     * @return float|null
     */
    public function getIrpfRate(): ?float
    {
        return $this->irpfRate;
    }
    /**
    * IRPF withholding percentage. Send `null` to state that none
    applies (equivalent to `0`).
    
    *
    * @param float|null $irpfRate
    *
    * @return self
    */
    public function setIrpfRate(?float $irpfRate): self
    {
        $this->initialized['irpfRate'] = true;
        $this->irpfRate = $irpfRate;
        return $this;
    }
    /**
     * Indicates whether the product is active.
     *
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }
    /**
     * Indicates whether the product is active.
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