<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class PatchCustomerRequestAlternativeId implements AdditionalPropertiesInterface
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
     * Identifier type. Use descriptive names:
     * - **NIF_IVA**: EU VAT number (intra-community) — *only for an EU member state other than Spain, with that country's VAT number structure*
     * - **PASSPORT**: Passport — *allowed for any country*
     * - **COUNTRY_ID**: Country of residence ID — *not allowed when `country_code = ES`*
     * - **RESIDENCE_CERTIFICATE**: Residence certificate — *not allowed when `country_code = ES`*
     * - **OTHER_DOCUMENT**: Other supporting document — *not allowed when `country_code = ES`*
     * - **NOT_REGISTERED**: Not registered in AEAT — *requires `country_code = ES`*
     * 
     * **⚠️ DEPRECATED numeric codes** (will be removed in v2):
     * 02, 03, 04, 05, 06, 07 — use the descriptive names above instead.
     * 
     *
     * @var string
     */
    protected $type;
    /**
     * Identifier number. For `NIF_IVA`, the full EU VAT number with its country prefix
     * (e.g. `FR40303265045`); see the VeriFactu rules on the parent schema.
     * 
     *
     * @var string
     */
    protected $number;
    /**
     * ISO 3166-1 alpha-2 code of the country that issued the document. Required except for
     * `PASSPORT` and `NOT_REGISTERED`, where omitting it means `ES`. Constrains the allowed
     * `type` values; see the VeriFactu rules on the parent schema.
     * 
     *
     * @var string
     */
    protected $countryCode;
    /**
     * Identifier type. Use descriptive names:
     * - **NIF_IVA**: EU VAT number (intra-community) — *only for an EU member state other than Spain, with that country's VAT number structure*
     * - **PASSPORT**: Passport — *allowed for any country*
     * - **COUNTRY_ID**: Country of residence ID — *not allowed when `country_code = ES`*
     * - **RESIDENCE_CERTIFICATE**: Residence certificate — *not allowed when `country_code = ES`*
     * - **OTHER_DOCUMENT**: Other supporting document — *not allowed when `country_code = ES`*
     * - **NOT_REGISTERED**: Not registered in AEAT — *requires `country_code = ES`*
     * 
     * **⚠️ DEPRECATED numeric codes** (will be removed in v2):
     * 02, 03, 04, 05, 06, 07 — use the descriptive names above instead.
     * 
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
    * Identifier type. Use descriptive names:
    - **NIF_IVA**: EU VAT number (intra-community) — *only for an EU member state other than Spain, with that country's VAT number structure*
    - **PASSPORT**: Passport — *allowed for any country*
    - **COUNTRY_ID**: Country of residence ID — *not allowed when `country_code = ES`*
    - **RESIDENCE_CERTIFICATE**: Residence certificate — *not allowed when `country_code = ES`*
    - **OTHER_DOCUMENT**: Other supporting document — *not allowed when `country_code = ES`*
    - **NOT_REGISTERED**: Not registered in AEAT — *requires `country_code = ES`*
    
    **⚠️ DEPRECATED numeric codes** (will be removed in v2):
    02, 03, 04, 05, 06, 07 — use the descriptive names above instead.
    
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
     * Identifier number. For `NIF_IVA`, the full EU VAT number with its country prefix
     * (e.g. `FR40303265045`); see the VeriFactu rules on the parent schema.
     * 
     *
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }
    /**
    * Identifier number. For `NIF_IVA`, the full EU VAT number with its country prefix
    (e.g. `FR40303265045`); see the VeriFactu rules on the parent schema.
    
    *
    * @param string $number
    *
    * @return self
    */
    public function setNumber(string $number): self
    {
        $this->initialized['number'] = true;
        $this->number = $number;
        return $this;
    }
    /**
     * ISO 3166-1 alpha-2 code of the country that issued the document. Required except for
     * `PASSPORT` and `NOT_REGISTERED`, where omitting it means `ES`. Constrains the allowed
     * `type` values; see the VeriFactu rules on the parent schema.
     * 
     *
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
    /**
    * ISO 3166-1 alpha-2 code of the country that issued the document. Required except for
    `PASSPORT` and `NOT_REGISTERED`, where omitting it means `ES`. Constrains the allowed
    `type` values; see the VeriFactu rules on the parent schema.
    
    *
    * @param string $countryCode
    *
    * @return self
    */
    public function setCountryCode(string $countryCode): self
    {
        $this->initialized['countryCode'] = true;
        $this->countryCode = $countryCode;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['type' => ['type', 'getType', 'setType'], 'number' => ['number', 'getNumber', 'setNumber'], 'countryCode' => ['country_code', 'getCountryCode', 'setCountryCode']];
    }
}