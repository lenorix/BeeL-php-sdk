<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class UpdateCompanyPaymentConnectionRequestTaxInclusiveTax implements AdditionalPropertiesInterface
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
     * Tax type by territory:
     * - IVA: Iberian Peninsula and Balearic Islands (4%, 10%, 21%; 2%, 5% and 7.5% only on operations of their period)
     * - IGIC: Canary Islands (0%, 3%, 5%, 7%, 9.5%, 15%, 20%)
     * - IPSI: Ceuta and Melilla (0.5%, 1%, 2%, 4%, 8%, 10%)
     * - OTHER: Configurable 0%-100%
     * 
     * Under IVA and IPSI, 0% is not one of these rates: it is the exemption/non-subject
     * sentinel and always travels with an `exemption_reason`. IGIC's 0% is a real rate.
     * See `TaxInfo` for the full rules.
     * 
     *
     * @var string
     */
    protected $type;
    /**
     * Tax percentage
     *
     * @var float
     */
    protected $percentage;
    /**
     * @var string|null
     */
    protected $regimeKey;
    /**
     * Tax type by territory:
     * - IVA: Iberian Peninsula and Balearic Islands (4%, 10%, 21%; 2%, 5% and 7.5% only on operations of their period)
     * - IGIC: Canary Islands (0%, 3%, 5%, 7%, 9.5%, 15%, 20%)
     * - IPSI: Ceuta and Melilla (0.5%, 1%, 2%, 4%, 8%, 10%)
     * - OTHER: Configurable 0%-100%
     * 
     * Under IVA and IPSI, 0% is not one of these rates: it is the exemption/non-subject
     * sentinel and always travels with an `exemption_reason`. IGIC's 0% is a real rate.
     * See `TaxInfo` for the full rules.
     * 
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
    * Tax type by territory:
    - IVA: Iberian Peninsula and Balearic Islands (4%, 10%, 21%; 2%, 5% and 7.5% only on operations of their period)
    - IGIC: Canary Islands (0%, 3%, 5%, 7%, 9.5%, 15%, 20%)
    - IPSI: Ceuta and Melilla (0.5%, 1%, 2%, 4%, 8%, 10%)
    - OTHER: Configurable 0%-100%
    
    Under IVA and IPSI, 0% is not one of these rates: it is the exemption/non-subject
    sentinel and always travels with an `exemption_reason`. IGIC's 0% is a real rate.
    See `TaxInfo` for the full rules.
    
    *
    * @param string $type
    *
    * @return self
    */
    public function setType(string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
    /**
     * Tax percentage
     *
     * @return float
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }
    /**
     * Tax percentage
     *
     * @param float $percentage
     *
     * @return self
     */
    public function setPercentage(float $percentage): self
    {
        $this->initialized['percentage'] = true;
        $this->percentage = $percentage;
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
    public function definedProperties(): array
    {
        return ['type' => ['type', 'getType', 'setType'], 'percentage' => ['percentage', 'getPercentage', 'setPercentage'], 'regimeKey' => ['regime_key', 'getRegimeKey', 'setRegimeKey']];
    }
}