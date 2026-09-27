<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CustomerValidationError implements AdditionalPropertiesInterface
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
     * Field that failed validation
     *
     * @var string
     */
    protected $field;
    /**
     * Value that caused the error
     *
     * @var string
     */
    protected $value;
    /**
     * Human-readable text, already resolved to the language of the request. It is never a raw
     * i18n key — a key neither reads nor is stable against a rename.
     * 
     *
     * @var string
     */
    protected $message;
    /**
     * Stable, uppercase, never translated — this is what an integration compares. It is the
     * SAME code the single `POST /v1/companies/{company_id}/customers` answers with, so the
     * single and the bulk route never disagree about the same customer
     * (`CUSTOMER_IDENTIFIER_REQUIRED`, `NIF_INVALID_FORMAT`, …).
     * 
     * Absent on the rows rejected by validation rules that still only produce prose: known
     * debt, and preferable to inventing a code that would then have to change.
     * 
     *
     * @var string
     */
    protected $code;
    /**
     * Field that failed validation
     *
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }
    /**
     * Field that failed validation
     *
     * @param string $field
     *
     * @return self
     */
    public function setField(string $field): self
    {
        $this->initialized['field'] = true;
        $this->field = $field;
        return $this;
    }
    /**
     * Value that caused the error
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
    /**
     * Value that caused the error
     *
     * @param string $value
     *
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->initialized['value'] = true;
        $this->value = $value;
        return $this;
    }
    /**
     * Human-readable text, already resolved to the language of the request. It is never a raw
     * i18n key — a key neither reads nor is stable against a rename.
     * 
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
    /**
    * Human-readable text, already resolved to the language of the request. It is never a raw
    i18n key — a key neither reads nor is stable against a rename.
    
    *
    * @param string $message
    *
    * @return self
    */
    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;
        return $this;
    }
    /**
     * Stable, uppercase, never translated — this is what an integration compares. It is the
     * SAME code the single `POST /v1/companies/{company_id}/customers` answers with, so the
     * single and the bulk route never disagree about the same customer
     * (`CUSTOMER_IDENTIFIER_REQUIRED`, `NIF_INVALID_FORMAT`, …).
     * 
     * Absent on the rows rejected by validation rules that still only produce prose: known
     * debt, and preferable to inventing a code that would then have to change.
     * 
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
    /**
    * Stable, uppercase, never translated — this is what an integration compares. It is the
    SAME code the single `POST /v1/companies/{company_id}/customers` answers with, so the
    single and the bulk route never disagree about the same customer
    (`CUSTOMER_IDENTIFIER_REQUIRED`, `NIF_INVALID_FORMAT`, …).
    
    Absent on the rows rejected by validation rules that still only produce prose: known
    debt, and preferable to inventing a code that would then have to change.
    
    *
    * @param string $code
    *
    * @return self
    */
    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['field' => ['field', 'getField', 'setField'], 'value' => ['value', 'getValue', 'setValue'], 'message' => ['message', 'getMessage', 'setMessage'], 'code' => ['code', 'getCode', 'setCode']];
    }
}