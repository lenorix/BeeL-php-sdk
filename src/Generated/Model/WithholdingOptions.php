<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class WithholdingOptions implements AdditionalPropertiesInterface
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
     * The rates this company can use, in ascending order.
     *
     * @var list<float>
     */
    protected $allowedIrpfRates;
    /**
     * One of `allowed_irpf_rates`.
     * 
     * The rate to preselect for this company, or `null` when it depends on facts the NIF
     * does not show and the user has to choose.
     * 
     *
     * @var float|null
     */
    protected $suggestedIrpfRate;
    /**
     * The rates this company can use, in ascending order.
     *
     * @return list<float>
     */
    public function getAllowedIrpfRates(): array
    {
        return $this->allowedIrpfRates;
    }
    /**
     * The rates this company can use, in ascending order.
     *
     * @param list<float> $allowedIrpfRates
     *
     * @return self
     */
    public function setAllowedIrpfRates(array $allowedIrpfRates): self
    {
        $this->initialized['allowedIrpfRates'] = true;
        $this->allowedIrpfRates = $allowedIrpfRates;
        return $this;
    }
    /**
     * One of `allowed_irpf_rates`.
     * 
     * The rate to preselect for this company, or `null` when it depends on facts the NIF
     * does not show and the user has to choose.
     * 
     *
     * @return float|null
     */
    public function getSuggestedIrpfRate(): ?float
    {
        return $this->suggestedIrpfRate;
    }
    /**
    * One of `allowed_irpf_rates`.
    
    The rate to preselect for this company, or `null` when it depends on facts the NIF
    does not show and the user has to choose.
    
    *
    * @param float|null $suggestedIrpfRate
    *
    * @return self
    */
    public function setSuggestedIrpfRate(?float $suggestedIrpfRate): self
    {
        $this->initialized['suggestedIrpfRate'] = true;
        $this->suggestedIrpfRate = $suggestedIrpfRate;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['allowedIrpfRates' => ['allowed_irpf_rates', 'getAllowedIrpfRates', 'setAllowedIrpfRates'], 'suggestedIrpfRate' => ['suggested_irpf_rate', 'getSuggestedIrpfRate', 'setSuggestedIrpfRate']];
    }
}