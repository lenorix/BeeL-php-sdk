<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class InvoiceLineTemplateResponse implements AdditionalPropertiesInterface
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
    protected $id;
    /**
     * @var int|null
     */
    protected $order;
    /**
     * @var string|null
     */
    protected $description;
    /**
     * @var float|null
     */
    protected $quantity;
    /**
     * @var string|null
     */
    protected $unit;
    /**
     * Unit price of the template line. In both total-declared modes
     * (`pricing_mode` other than `UNIT_PRICE`) this value is **derived and
     * informational** (`total / quantity`, 4 decimals): re-multiplying it does not
     * reproduce the declared total on large quantities.
     * 
     *
     * @var float|null
     */
    protected $unitPrice;
    /**
     * @var string|null
     */
    protected $pricingMode;
    /**
     * Declared line total excluding taxes. Only present on lines with
     * `pricing_mode = TOTAL_EXCLUDING_TAX`. It never includes taxes nor subtracts
     * IRPF withholding.
     * 
     *
     * @var float|null
     */
    protected $totalExcludingTax;
    /**
     * Declared line total including taxes (taxable base + VAT + equivalence
     * surcharge; IRPF withholding is never subtracted). Only present on lines with
     * `pricing_mode = TOTAL_INCLUDING_TAX`. Every invoice this template generates
     * reproduces it exactly.
     * 
     *
     * @var float|null
     */
    protected $totalIncludingTax;
    /**
     * @var float|null
     */
    protected $discountPercentage;
    /**
     * @var string|null
     */
    protected $taxType;
    /**
     * @var float|null
     */
    protected $vatRate;
    /**
     * @var string|null
     */
    protected $regimeKey;
    /**
     * @var float|null
     */
    protected $equivalenceSurchargeRate;
    /**
     * @var float|null
     */
    protected $irpfRate;
    /**
     * @var string|null
     */
    protected $exemptionReason;
    /**
     * Custom exemption text. Only used when exemption_reason is OTRO.
     *
     * @var string|null
     */
    protected $exemptionReasonText;
    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    /**
     * @param string|null $id
     *
     * @return self
     */
    public function setId(?string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * @return int|null
     */
    public function getOrder(): ?int
    {
        return $this->order;
    }
    /**
     * @param int|null $order
     *
     * @return self
     */
    public function setOrder(?int $order): self
    {
        $this->initialized['order'] = true;
        $this->order = $order;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
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
     * @return float|null
     */
    public function getQuantity(): ?float
    {
        return $this->quantity;
    }
    /**
     * @param float|null $quantity
     *
     * @return self
     */
    public function setQuantity(?float $quantity): self
    {
        $this->initialized['quantity'] = true;
        $this->quantity = $quantity;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }
    /**
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
     * Unit price of the template line. In both total-declared modes
     * (`pricing_mode` other than `UNIT_PRICE`) this value is **derived and
     * informational** (`total / quantity`, 4 decimals): re-multiplying it does not
     * reproduce the declared total on large quantities.
     * 
     *
     * @return float|null
     */
    public function getUnitPrice(): ?float
    {
        return $this->unitPrice;
    }
    /**
    * Unit price of the template line. In both total-declared modes
    (`pricing_mode` other than `UNIT_PRICE`) this value is **derived and
    informational** (`total / quantity`, 4 decimals): re-multiplying it does not
    reproduce the declared total on large quantities.
    
    *
    * @param float|null $unitPrice
    *
    * @return self
    */
    public function setUnitPrice(?float $unitPrice): self
    {
        $this->initialized['unitPrice'] = true;
        $this->unitPrice = $unitPrice;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPricingMode(): ?string
    {
        return $this->pricingMode;
    }
    /**
     * @param string|null $pricingMode
     *
     * @return self
     */
    public function setPricingMode(?string $pricingMode): self
    {
        $this->initialized['pricingMode'] = true;
        $this->pricingMode = $pricingMode;
        return $this;
    }
    /**
     * Declared line total excluding taxes. Only present on lines with
     * `pricing_mode = TOTAL_EXCLUDING_TAX`. It never includes taxes nor subtracts
     * IRPF withholding.
     * 
     *
     * @return float|null
     */
    public function getTotalExcludingTax(): ?float
    {
        return $this->totalExcludingTax;
    }
    /**
    * Declared line total excluding taxes. Only present on lines with
    `pricing_mode = TOTAL_EXCLUDING_TAX`. It never includes taxes nor subtracts
    IRPF withholding.
    
    *
    * @param float|null $totalExcludingTax
    *
    * @return self
    */
    public function setTotalExcludingTax(?float $totalExcludingTax): self
    {
        $this->initialized['totalExcludingTax'] = true;
        $this->totalExcludingTax = $totalExcludingTax;
        return $this;
    }
    /**
     * Declared line total including taxes (taxable base + VAT + equivalence
     * surcharge; IRPF withholding is never subtracted). Only present on lines with
     * `pricing_mode = TOTAL_INCLUDING_TAX`. Every invoice this template generates
     * reproduces it exactly.
     * 
     *
     * @return float|null
     */
    public function getTotalIncludingTax(): ?float
    {
        return $this->totalIncludingTax;
    }
    /**
    * Declared line total including taxes (taxable base + VAT + equivalence
    surcharge; IRPF withholding is never subtracted). Only present on lines with
    `pricing_mode = TOTAL_INCLUDING_TAX`. Every invoice this template generates
    reproduces it exactly.
    
    *
    * @param float|null $totalIncludingTax
    *
    * @return self
    */
    public function setTotalIncludingTax(?float $totalIncludingTax): self
    {
        $this->initialized['totalIncludingTax'] = true;
        $this->totalIncludingTax = $totalIncludingTax;
        return $this;
    }
    /**
     * @return float|null
     */
    public function getDiscountPercentage(): ?float
    {
        return $this->discountPercentage;
    }
    /**
     * @param float|null $discountPercentage
     *
     * @return self
     */
    public function setDiscountPercentage(?float $discountPercentage): self
    {
        $this->initialized['discountPercentage'] = true;
        $this->discountPercentage = $discountPercentage;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getTaxType(): ?string
    {
        return $this->taxType;
    }
    /**
     * @param string|null $taxType
     *
     * @return self
     */
    public function setTaxType(?string $taxType): self
    {
        $this->initialized['taxType'] = true;
        $this->taxType = $taxType;
        return $this;
    }
    /**
     * @return float|null
     */
    public function getVatRate(): ?float
    {
        return $this->vatRate;
    }
    /**
     * @param float|null $vatRate
     *
     * @return self
     */
    public function setVatRate(?float $vatRate): self
    {
        $this->initialized['vatRate'] = true;
        $this->vatRate = $vatRate;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getRegimeKey(): ?string
    {
        return $this->regimeKey;
    }
    /**
     * @param string|null $regimeKey
     *
     * @return self
     */
    public function setRegimeKey(?string $regimeKey): self
    {
        $this->initialized['regimeKey'] = true;
        $this->regimeKey = $regimeKey;
        return $this;
    }
    /**
     * @return float|null
     */
    public function getEquivalenceSurchargeRate(): ?float
    {
        return $this->equivalenceSurchargeRate;
    }
    /**
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
     * @return float|null
     */
    public function getIrpfRate(): ?float
    {
        return $this->irpfRate;
    }
    /**
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
     * @return string|null
     */
    public function getExemptionReason(): ?string
    {
        return $this->exemptionReason;
    }
    /**
     * @param string|null $exemptionReason
     *
     * @return self
     */
    public function setExemptionReason(?string $exemptionReason): self
    {
        $this->initialized['exemptionReason'] = true;
        $this->exemptionReason = $exemptionReason;
        return $this;
    }
    /**
     * Custom exemption text. Only used when exemption_reason is OTRO.
     *
     * @return string|null
     */
    public function getExemptionReasonText(): ?string
    {
        return $this->exemptionReasonText;
    }
    /**
     * Custom exemption text. Only used when exemption_reason is OTRO.
     *
     * @param string|null $exemptionReasonText
     *
     * @return self
     */
    public function setExemptionReasonText(?string $exemptionReasonText): self
    {
        $this->initialized['exemptionReasonText'] = true;
        $this->exemptionReasonText = $exemptionReasonText;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'order' => ['order', 'getOrder', 'setOrder'], 'description' => ['description', 'getDescription', 'setDescription'], 'quantity' => ['quantity', 'getQuantity', 'setQuantity'], 'unit' => ['unit', 'getUnit', 'setUnit'], 'unitPrice' => ['unit_price', 'getUnitPrice', 'setUnitPrice'], 'pricingMode' => ['pricing_mode', 'getPricingMode', 'setPricingMode'], 'totalExcludingTax' => ['total_excluding_tax', 'getTotalExcludingTax', 'setTotalExcludingTax'], 'totalIncludingTax' => ['total_including_tax', 'getTotalIncludingTax', 'setTotalIncludingTax'], 'discountPercentage' => ['discount_percentage', 'getDiscountPercentage', 'setDiscountPercentage'], 'taxType' => ['tax_type', 'getTaxType', 'setTaxType'], 'vatRate' => ['vat_rate', 'getVatRate', 'setVatRate'], 'regimeKey' => ['regime_key', 'getRegimeKey', 'setRegimeKey'], 'equivalenceSurchargeRate' => ['equivalence_surcharge_rate', 'getEquivalenceSurchargeRate', 'setEquivalenceSurchargeRate'], 'irpfRate' => ['irpf_rate', 'getIrpfRate', 'setIrpfRate'], 'exemptionReason' => ['exemption_reason', 'getExemptionReason', 'setExemptionReason'], 'exemptionReasonText' => ['exemption_reason_text', 'getExemptionReasonText', 'setExemptionReasonText']];
    }
}