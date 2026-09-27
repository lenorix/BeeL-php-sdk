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
     * - IVA: Iberian Peninsula and Balearic Islands (4%, 5%, 10%, 21%)
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
     * Regime key according to VeriFactu regulations. Omitted, `01` (general regime) applies:
     * - 01: General regime operation
     * - 02: Export
     * - 03: Used goods, art, antiques
     * - 04: Investment gold
     * - 05: Travel agencies
     * - 06: Group of entities
     * - 07: Cash basis
     * - 08: IPSI/IVA/IGIC operations
     * - 09: Mediating agencies
     * - 10: Third-party collections
     * - 11: Local rental
     * - 14: VAT pending in certifications
     * - 15: VAT pending successive tract
     * - 17: OSS and IOSS
     * - 18: Equivalence surcharge
     * - 19: REAGYP
     * - 20: Simplified regime
     * 
     * **One exception to "a key you send is the key you get":** when the line ends up
     * carrying an equivalence surcharge — whether you sent `equivalence_surcharge_rate`
     * or it was inherited from the company's tax configuration — a `01` is rewritten to
     * `18`, because a surcharge under the general regime is fiscally incoherent. Send
     * `equivalence_surcharge_rate: 0` explicitly to keep `01`. See
     * `equivalence_surcharge_rate` in the invoice line for the full rules.
     * 
     *
     * @var string
     */
    protected $regimeKey;
    /**
     * Tax type by territory:
     * - IVA: Iberian Peninsula and Balearic Islands (4%, 5%, 10%, 21%)
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
    - IVA: Iberian Peninsula and Balearic Islands (4%, 5%, 10%, 21%)
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
     * Regime key according to VeriFactu regulations. Omitted, `01` (general regime) applies:
     * - 01: General regime operation
     * - 02: Export
     * - 03: Used goods, art, antiques
     * - 04: Investment gold
     * - 05: Travel agencies
     * - 06: Group of entities
     * - 07: Cash basis
     * - 08: IPSI/IVA/IGIC operations
     * - 09: Mediating agencies
     * - 10: Third-party collections
     * - 11: Local rental
     * - 14: VAT pending in certifications
     * - 15: VAT pending successive tract
     * - 17: OSS and IOSS
     * - 18: Equivalence surcharge
     * - 19: REAGYP
     * - 20: Simplified regime
     * 
     * **One exception to "a key you send is the key you get":** when the line ends up
     * carrying an equivalence surcharge — whether you sent `equivalence_surcharge_rate`
     * or it was inherited from the company's tax configuration — a `01` is rewritten to
     * `18`, because a surcharge under the general regime is fiscally incoherent. Send
     * `equivalence_surcharge_rate: 0` explicitly to keep `01`. See
     * `equivalence_surcharge_rate` in the invoice line for the full rules.
     * 
     *
     * @return string
     */
    public function getRegimeKey(): string
    {
        return $this->regimeKey;
    }
    /**
    * Regime key according to VeriFactu regulations. Omitted, `01` (general regime) applies:
    - 01: General regime operation
    - 02: Export
    - 03: Used goods, art, antiques
    - 04: Investment gold
    - 05: Travel agencies
    - 06: Group of entities
    - 07: Cash basis
    - 08: IPSI/IVA/IGIC operations
    - 09: Mediating agencies
    - 10: Third-party collections
    - 11: Local rental
    - 14: VAT pending in certifications
    - 15: VAT pending successive tract
    - 17: OSS and IOSS
    - 18: Equivalence surcharge
    - 19: REAGYP
    - 20: Simplified regime
    
    **One exception to "a key you send is the key you get":** when the line ends up
    carrying an equivalence surcharge — whether you sent `equivalence_surcharge_rate`
    or it was inherited from the company's tax configuration — a `01` is rewritten to
    `18`, because a surcharge under the general regime is fiscally incoherent. Send
    `equivalence_surcharge_rate: 0` explicitly to keep `01`. See
    `equivalence_surcharge_rate` in the invoice line for the full rules.
    
    *
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
    public function definedProperties(): array
    {
        return ['type' => ['type', 'getType', 'setType'], 'percentage' => ['percentage', 'getPercentage', 'setPercentage'], 'regimeKey' => ['regime_key', 'getRegimeKey', 'setRegimeKey']];
    }
}