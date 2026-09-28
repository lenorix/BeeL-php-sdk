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
     * @var string
     */
    protected $id;
    /**
     * @var int
     */
    protected $order;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var float
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
     * @var float
     */
    protected $unitPrice;
    /**
     * How the line amount was entered.
     * 
     * - `UNIT_PRICE`: classic mode — the amount is derived from `unit_price`
     *   (`quantity × unit_price × (1 − discount / 100)`).
     * - `TOTAL_EXCLUDING_TAX`: total-declared mode — `total_excluding_tax` is the exact
     *   taxable base and `unit_price` is derived and informational
     *   (`total / quantity`, 4 decimals).
     * - `TOTAL_INCLUDING_TAX`: tax-inclusive total-declared mode —
     *   `total_including_tax` is what the customer paid (taxable base + VAT +
     *   equivalence surcharge) and the engine works the breakdown backwards so the
     *   rounded amounts add up to the declared total exactly.
     * 
     * In both total-declared modes re-multiplying the derived `unit_price` does NOT
     * reproduce the declared total on large quantities (1.00 € ÷ 300 units → 0.0033 ×
     * 300 = 0.99), which is precisely why the declared total is the source of truth.
     * 
     *
     * @var string
     */
    protected $pricingMode;
    /**
     * Declared line total excluding taxes. Only present on lines with
     * `pricing_mode = TOTAL_EXCLUDING_TAX`. It never includes taxes nor subtracts
     * IRPF withholding.
     * 
     *
     * @var float
     */
    protected $totalExcludingTax;
    /**
     * Declared line total including taxes (taxable base + VAT + equivalence
     * surcharge; IRPF withholding is never subtracted). Only present on lines with
     * `pricing_mode = TOTAL_INCLUDING_TAX`. Every invoice this template generates
     * reproduces it exactly.
     * 
     *
     * @var float
     */
    protected $totalIncludingTax;
    /**
     * @var float|null
     */
    protected $discountPercentage;
    /**
     * @var string
     */
    protected $taxType;
    /**
     * @var float
     */
    protected $vatRate;
    /**
     * @var string
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
     * Tax exemption reason code per the Spanish VAT Law (Ley 37/1992, LIVA), with the
     * VeriFactu code each one is reported as.
     * 
     * - `EXENTA_ART_20`: exempt, art. 20 (domestic operations such as medical, educational,
     *   cultural and financial services, or housing rentals). E1.
     * - `EXENTA_ART_21`: exempt, art. 21 (exports of goods). E2.
     * - `EXENTA_ART_22`: exempt, art. 22 (operations treated as exports). E3.
     * - `EXENTA_ART_24`: exempt, art. 24 (free zones, warehouses and customs regimes). E4.
     * - `EXENTA_ART_25`: exempt, art. 25 (intra-community supplies of goods). E5.
     * - `EXENTA_ART_26`: exempt, art. 26 (intra-community acquisitions of goods). It exempts the
     *   buyer's acquisition, not a supply the seller invoices, so an invoice line that carries it
     *   is rejected with `EXEMPTION_NOT_FOR_ISSUED_INVOICE`; a supply to another Member State is
     *   `EXENTA_ART_25`.
     * - `NO_SUJETA_ART_7_9`: not subject under art. 7 (such as the transfer of a business as
     *   a going concern, art. 7.1º). N1.
     * - `NO_SUJETA_LOCALIZACION`: not subject by the place-of-supply rules (intra-community
     *   or non-EU services, arts. 69 and 70). N2.
     * - `ISP_ART_84_2_A` … `ISP_ART_84_2_F`: reverse charge (the invoice states «inversión del
     *   sujeto pasivo»), art. 84.Uno.2.º letters a) (supplier not established in Spain), b) (unwrought
     *   or semi-finished gold), c) (scrap, waste and recovery materials, plastic, paper, cardboard, glass and textile waste, and semi-finished non-ferrous metal products), d) (greenhouse gas emission
     *   allowances), e) (certain real estate supplies: in insolvency proceedings, with the exemption
     *   waived, or enforcing a security) and f) (construction or renovation works). S2.
     * - `ISP_ART_84_2_G`: reverse charge of letter g) (silver, platinum, palladium, mobile phones,
     *   consoles, laptops and tablets). The law requires these supplies to be invoiced in a special
     *   series, so an invoice line that carries it is rejected with
     *   `REVERSE_CHARGE_CASE_NOT_SUPPORTED`.
     * - `EXENTA_ART_140`: investment gold exemption, art. 140 bis (usually with `regime_key`
     *   `04`). E6.
     * - `REGIMEN_ART_129` (agriculture,
     *   livestock and fishing, arts. 124 to 134 bis), `REGIMEN_ART_135` (second-hand goods,
     *   art and antiques), `REGIMEN_ART_141` (travel agencies), `REGIMEN_ART_154` (equivalence
     *   surcharge) and `REGIMEN_ART_163_DECIES` (cash basis, arts. 163 decies to 163
     *   sexiesdecies): operations of special regimes, which VeriFactu identifies by the regime
     *   key rather than by an exemption code. An
     *   invoice line that carries one is rejected with `EXEMPTION_REGIME_NOT_SUPPORTED_IN_VERIFACTU`;
     *   declare the regime with `regime_key` instead.
     * - `OTRO`: any other provision. Requires the text in `exemption_reason_text`. E6.
     * 
     *
     * @var string
     */
    protected $exemptionReason;
    /**
     * Custom exemption text. Only used when exemption_reason is OTRO.
     *
     * @var string|null
     */
    protected $exemptionReasonText;
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
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }
    /**
     * @param int $order
     *
     * @return self
     */
    public function setOrder(int $order): self
    {
        $this->initialized['order'] = true;
        $this->order = $order;
        return $this;
    }
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
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
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }
    /**
     * @param float $quantity
     *
     * @return self
     */
    public function setQuantity(float $quantity): self
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
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }
    /**
    * Unit price of the template line. In both total-declared modes
    (`pricing_mode` other than `UNIT_PRICE`) this value is **derived and
    informational** (`total / quantity`, 4 decimals): re-multiplying it does not
    reproduce the declared total on large quantities.
    
    *
    * @param float $unitPrice
    *
    * @return self
    */
    public function setUnitPrice(float $unitPrice): self
    {
        $this->initialized['unitPrice'] = true;
        $this->unitPrice = $unitPrice;
        return $this;
    }
    /**
     * How the line amount was entered.
     * 
     * - `UNIT_PRICE`: classic mode — the amount is derived from `unit_price`
     *   (`quantity × unit_price × (1 − discount / 100)`).
     * - `TOTAL_EXCLUDING_TAX`: total-declared mode — `total_excluding_tax` is the exact
     *   taxable base and `unit_price` is derived and informational
     *   (`total / quantity`, 4 decimals).
     * - `TOTAL_INCLUDING_TAX`: tax-inclusive total-declared mode —
     *   `total_including_tax` is what the customer paid (taxable base + VAT +
     *   equivalence surcharge) and the engine works the breakdown backwards so the
     *   rounded amounts add up to the declared total exactly.
     * 
     * In both total-declared modes re-multiplying the derived `unit_price` does NOT
     * reproduce the declared total on large quantities (1.00 € ÷ 300 units → 0.0033 ×
     * 300 = 0.99), which is precisely why the declared total is the source of truth.
     * 
     *
     * @return string
     */
    public function getPricingMode(): string
    {
        return $this->pricingMode;
    }
    /**
    * How the line amount was entered.
    
    - `UNIT_PRICE`: classic mode — the amount is derived from `unit_price`
     (`quantity × unit_price × (1 − discount / 100)`).
    - `TOTAL_EXCLUDING_TAX`: total-declared mode — `total_excluding_tax` is the exact
     taxable base and `unit_price` is derived and informational
     (`total / quantity`, 4 decimals).
    - `TOTAL_INCLUDING_TAX`: tax-inclusive total-declared mode —
     `total_including_tax` is what the customer paid (taxable base + VAT +
     equivalence surcharge) and the engine works the breakdown backwards so the
     rounded amounts add up to the declared total exactly.
    
    In both total-declared modes re-multiplying the derived `unit_price` does NOT
    reproduce the declared total on large quantities (1.00 € ÷ 300 units → 0.0033 ×
    300 = 0.99), which is precisely why the declared total is the source of truth.
    
    *
    * @param string $pricingMode
    *
    * @return self
    */
    public function setPricingMode(string $pricingMode): self
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
     * @return float
     */
    public function getTotalExcludingTax(): float
    {
        return $this->totalExcludingTax;
    }
    /**
    * Declared line total excluding taxes. Only present on lines with
    `pricing_mode = TOTAL_EXCLUDING_TAX`. It never includes taxes nor subtracts
    IRPF withholding.
    
    *
    * @param float $totalExcludingTax
    *
    * @return self
    */
    public function setTotalExcludingTax(float $totalExcludingTax): self
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
     * @return float
     */
    public function getTotalIncludingTax(): float
    {
        return $this->totalIncludingTax;
    }
    /**
    * Declared line total including taxes (taxable base + VAT + equivalence
    surcharge; IRPF withholding is never subtracted). Only present on lines with
    `pricing_mode = TOTAL_INCLUDING_TAX`. Every invoice this template generates
    reproduces it exactly.
    
    *
    * @param float $totalIncludingTax
    *
    * @return self
    */
    public function setTotalIncludingTax(float $totalIncludingTax): self
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
     * @return string
     */
    public function getTaxType(): string
    {
        return $this->taxType;
    }
    /**
     * @param string $taxType
     *
     * @return self
     */
    public function setTaxType(string $taxType): self
    {
        $this->initialized['taxType'] = true;
        $this->taxType = $taxType;
        return $this;
    }
    /**
     * @return float
     */
    public function getVatRate(): float
    {
        return $this->vatRate;
    }
    /**
     * @param float $vatRate
     *
     * @return self
     */
    public function setVatRate(float $vatRate): self
    {
        $this->initialized['vatRate'] = true;
        $this->vatRate = $vatRate;
        return $this;
    }
    /**
     * @return string
     */
    public function getRegimeKey(): string
    {
        return $this->regimeKey;
    }
    /**
     * @param string $regimeKey
     *
     * @return self
     */
    public function setRegimeKey(string $regimeKey): self
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
     * Tax exemption reason code per the Spanish VAT Law (Ley 37/1992, LIVA), with the
     * VeriFactu code each one is reported as.
     * 
     * - `EXENTA_ART_20`: exempt, art. 20 (domestic operations such as medical, educational,
     *   cultural and financial services, or housing rentals). E1.
     * - `EXENTA_ART_21`: exempt, art. 21 (exports of goods). E2.
     * - `EXENTA_ART_22`: exempt, art. 22 (operations treated as exports). E3.
     * - `EXENTA_ART_24`: exempt, art. 24 (free zones, warehouses and customs regimes). E4.
     * - `EXENTA_ART_25`: exempt, art. 25 (intra-community supplies of goods). E5.
     * - `EXENTA_ART_26`: exempt, art. 26 (intra-community acquisitions of goods). It exempts the
     *   buyer's acquisition, not a supply the seller invoices, so an invoice line that carries it
     *   is rejected with `EXEMPTION_NOT_FOR_ISSUED_INVOICE`; a supply to another Member State is
     *   `EXENTA_ART_25`.
     * - `NO_SUJETA_ART_7_9`: not subject under art. 7 (such as the transfer of a business as
     *   a going concern, art. 7.1º). N1.
     * - `NO_SUJETA_LOCALIZACION`: not subject by the place-of-supply rules (intra-community
     *   or non-EU services, arts. 69 and 70). N2.
     * - `ISP_ART_84_2_A` … `ISP_ART_84_2_F`: reverse charge (the invoice states «inversión del
     *   sujeto pasivo»), art. 84.Uno.2.º letters a) (supplier not established in Spain), b) (unwrought
     *   or semi-finished gold), c) (scrap, waste and recovery materials, plastic, paper, cardboard, glass and textile waste, and semi-finished non-ferrous metal products), d) (greenhouse gas emission
     *   allowances), e) (certain real estate supplies: in insolvency proceedings, with the exemption
     *   waived, or enforcing a security) and f) (construction or renovation works). S2.
     * - `ISP_ART_84_2_G`: reverse charge of letter g) (silver, platinum, palladium, mobile phones,
     *   consoles, laptops and tablets). The law requires these supplies to be invoiced in a special
     *   series, so an invoice line that carries it is rejected with
     *   `REVERSE_CHARGE_CASE_NOT_SUPPORTED`.
     * - `EXENTA_ART_140`: investment gold exemption, art. 140 bis (usually with `regime_key`
     *   `04`). E6.
     * - `REGIMEN_ART_129` (agriculture,
     *   livestock and fishing, arts. 124 to 134 bis), `REGIMEN_ART_135` (second-hand goods,
     *   art and antiques), `REGIMEN_ART_141` (travel agencies), `REGIMEN_ART_154` (equivalence
     *   surcharge) and `REGIMEN_ART_163_DECIES` (cash basis, arts. 163 decies to 163
     *   sexiesdecies): operations of special regimes, which VeriFactu identifies by the regime
     *   key rather than by an exemption code. An
     *   invoice line that carries one is rejected with `EXEMPTION_REGIME_NOT_SUPPORTED_IN_VERIFACTU`;
     *   declare the regime with `regime_key` instead.
     * - `OTRO`: any other provision. Requires the text in `exemption_reason_text`. E6.
     * 
     *
     * @return string
     */
    public function getExemptionReason(): string
    {
        return $this->exemptionReason;
    }
    /**
    * Tax exemption reason code per the Spanish VAT Law (Ley 37/1992, LIVA), with the
    VeriFactu code each one is reported as.
    
    - `EXENTA_ART_20`: exempt, art. 20 (domestic operations such as medical, educational,
     cultural and financial services, or housing rentals). E1.
    - `EXENTA_ART_21`: exempt, art. 21 (exports of goods). E2.
    - `EXENTA_ART_22`: exempt, art. 22 (operations treated as exports). E3.
    - `EXENTA_ART_24`: exempt, art. 24 (free zones, warehouses and customs regimes). E4.
    - `EXENTA_ART_25`: exempt, art. 25 (intra-community supplies of goods). E5.
    - `EXENTA_ART_26`: exempt, art. 26 (intra-community acquisitions of goods). It exempts the
     buyer's acquisition, not a supply the seller invoices, so an invoice line that carries it
     is rejected with `EXEMPTION_NOT_FOR_ISSUED_INVOICE`; a supply to another Member State is
     `EXENTA_ART_25`.
    - `NO_SUJETA_ART_7_9`: not subject under art. 7 (such as the transfer of a business as
     a going concern, art. 7.1º). N1.
    - `NO_SUJETA_LOCALIZACION`: not subject by the place-of-supply rules (intra-community
     or non-EU services, arts. 69 and 70). N2.
    - `ISP_ART_84_2_A` … `ISP_ART_84_2_F`: reverse charge (the invoice states «inversión del
     sujeto pasivo»), art. 84.Uno.2.º letters a) (supplier not established in Spain), b) (unwrought
     or semi-finished gold), c) (scrap, waste and recovery materials, plastic, paper, cardboard, glass and textile waste, and semi-finished non-ferrous metal products), d) (greenhouse gas emission
     allowances), e) (certain real estate supplies: in insolvency proceedings, with the exemption
     waived, or enforcing a security) and f) (construction or renovation works). S2.
    - `ISP_ART_84_2_G`: reverse charge of letter g) (silver, platinum, palladium, mobile phones,
     consoles, laptops and tablets). The law requires these supplies to be invoiced in a special
     series, so an invoice line that carries it is rejected with
     `REVERSE_CHARGE_CASE_NOT_SUPPORTED`.
    - `EXENTA_ART_140`: investment gold exemption, art. 140 bis (usually with `regime_key`
     `04`). E6.
    - `REGIMEN_ART_129` (agriculture,
     livestock and fishing, arts. 124 to 134 bis), `REGIMEN_ART_135` (second-hand goods,
     art and antiques), `REGIMEN_ART_141` (travel agencies), `REGIMEN_ART_154` (equivalence
     surcharge) and `REGIMEN_ART_163_DECIES` (cash basis, arts. 163 decies to 163
     sexiesdecies): operations of special regimes, which VeriFactu identifies by the regime
     key rather than by an exemption code. An
     invoice line that carries one is rejected with `EXEMPTION_REGIME_NOT_SUPPORTED_IN_VERIFACTU`;
     declare the regime with `regime_key` instead.
    - `OTRO`: any other provision. Requires the text in `exemption_reason_text`. E6.
    
    *
    * @param string $exemptionReason
    *
    * @return self
    */
    public function setExemptionReason(string $exemptionReason): self
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