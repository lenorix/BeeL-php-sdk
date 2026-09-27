<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class TaxTypesCatalog implements AdditionalPropertiesInterface
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
     * @var list<TaxRegime>
     */
    protected $taxRegimes;
    /**
     * @var list<IrpfType>
     */
    protected $irpfTypes;
    /**
     * @var list<EquivalenceSurcharge>
     */
    protected $equivalenceSurcharges;
    /**
     * @var list<ExemptionReasonCatalogEntry>
     */
    protected $exemptionReasons;
    /**
     * @return list<TaxRegime>
     */
    public function getTaxRegimes(): array
    {
        return $this->taxRegimes;
    }
    /**
     * @param list<TaxRegime> $taxRegimes
     *
     * @return self
     */
    public function setTaxRegimes(array $taxRegimes): self
    {
        $this->initialized['taxRegimes'] = true;
        $this->taxRegimes = $taxRegimes;
        return $this;
    }
    /**
     * @return list<IrpfType>
     */
    public function getIrpfTypes(): array
    {
        return $this->irpfTypes;
    }
    /**
     * @param list<IrpfType> $irpfTypes
     *
     * @return self
     */
    public function setIrpfTypes(array $irpfTypes): self
    {
        $this->initialized['irpfTypes'] = true;
        $this->irpfTypes = $irpfTypes;
        return $this;
    }
    /**
     * @return list<EquivalenceSurcharge>
     */
    public function getEquivalenceSurcharges(): array
    {
        return $this->equivalenceSurcharges;
    }
    /**
     * @param list<EquivalenceSurcharge> $equivalenceSurcharges
     *
     * @return self
     */
    public function setEquivalenceSurcharges(array $equivalenceSurcharges): self
    {
        $this->initialized['equivalenceSurcharges'] = true;
        $this->equivalenceSurcharges = $equivalenceSurcharges;
        return $this;
    }
    /**
     * @return list<ExemptionReasonCatalogEntry>
     */
    public function getExemptionReasons(): array
    {
        return $this->exemptionReasons;
    }
    /**
     * @param list<ExemptionReasonCatalogEntry> $exemptionReasons
     *
     * @return self
     */
    public function setExemptionReasons(array $exemptionReasons): self
    {
        $this->initialized['exemptionReasons'] = true;
        $this->exemptionReasons = $exemptionReasons;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['taxRegimes' => ['tax_regimes', 'getTaxRegimes', 'setTaxRegimes'], 'irpfTypes' => ['irpf_types', 'getIrpfTypes', 'setIrpfTypes'], 'equivalenceSurcharges' => ['equivalence_surcharges', 'getEquivalenceSurcharges', 'setEquivalenceSurcharges'], 'exemptionReasons' => ['exemption_reasons', 'getExemptionReasons', 'setExemptionReasons']];
    }
}