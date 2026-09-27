<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class AlternativeIdentifier implements AdditionalPropertiesInterface
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
     * - **NIF_IVA**: VAT-ID (intra-community EU) — *not allowed when `country_code = ES`*
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
     * @var string
     */
    protected $number;

    /**
     * ISO 3166-1 alpha-2 country code. Constrains the allowed `type` values;
     * see the VeriFactu rules on the parent schema.
     *
     *
     * @var string
     */
    protected $countryCode;

    /**
     * Identifier type. Use descriptive names:
     * - **NIF_IVA**: VAT-ID (intra-community EU) — *not allowed when `country_code = ES`*
     * - **PASSPORT**: Passport — *allowed for any country*
     * - **COUNTRY_ID**: Country of residence ID — *not allowed when `country_code = ES`*
     * - **RESIDENCE_CERTIFICATE**: Residence certificate — *not allowed when `country_code = ES`*
     * - **OTHER_DOCUMENT**: Other supporting document — *not allowed when `country_code = ES`*
     * - **NOT_REGISTERED**: Not registered in AEAT — *requires `country_code = ES`*
     *
     * **⚠️ DEPRECATED numeric codes** (will be removed in v2):
     * 02, 03, 04, 05, 06, 07 — use the descriptive names above instead.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Identifier type. Use descriptive names:
    - **NIF_IVA**: VAT-ID (intra-community EU) — *not allowed when `country_code = ES`*
    - **PASSPORT**: Passport — *allowed for any country*
    - **COUNTRY_ID**: Country of residence ID — *not allowed when `country_code = ES`*
    - **RESIDENCE_CERTIFICATE**: Residence certificate — *not allowed when `country_code = ES`*
    - **OTHER_DOCUMENT**: Other supporting document — *not allowed when `country_code = ES`*
    - **NOT_REGISTERED**: Not registered in AEAT — *requires `country_code = ES`*

     **⚠️ DEPRECATED numeric codes** (will be removed in v2):
    02, 03, 04, 05, 06, 07 — use the descriptive names above instead.
     */
    public function setType(string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;

        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->initialized['number'] = true;
        $this->number = $number;

        return $this;
    }

    /**
     * ISO 3166-1 alpha-2 country code. Constrains the allowed `type` values;
     * see the VeriFactu rules on the parent schema.
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * ISO 3166-1 alpha-2 country code. Constrains the allowed `type` values;
    see the VeriFactu rules on the parent schema.
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
