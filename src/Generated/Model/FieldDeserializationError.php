<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class FieldDeserializationError implements AdditionalPropertiesInterface
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
     * JSON field name that caused the error (matches the API contract name)
     *
     * @var string
     */
    protected $field;
    /**
     * The value that was rejected
     *
     * @var string
     */
    protected $invalidValue;
    /**
     * Expected format hint (e.g. YYYY-MM-DD for dates)
     *
     * @var string|null
     */
    protected $expectedFormat;
    /**
     * Comma-separated list of allowed values (for enum fields)
     *
     * @var string|null
     */
    protected $allowedValues;
    /**
     * JSON field name that caused the error (matches the API contract name)
     *
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }
    /**
     * JSON field name that caused the error (matches the API contract name)
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
     * The value that was rejected
     *
     * @return string
     */
    public function getInvalidValue(): string
    {
        return $this->invalidValue;
    }
    /**
     * The value that was rejected
     *
     * @param string $invalidValue
     *
     * @return self
     */
    public function setInvalidValue(string $invalidValue): self
    {
        $this->initialized['invalidValue'] = true;
        $this->invalidValue = $invalidValue;
        return $this;
    }
    /**
     * Expected format hint (e.g. YYYY-MM-DD for dates)
     *
     * @return string|null
     */
    public function getExpectedFormat(): ?string
    {
        return $this->expectedFormat;
    }
    /**
     * Expected format hint (e.g. YYYY-MM-DD for dates)
     *
     * @param string|null $expectedFormat
     *
     * @return self
     */
    public function setExpectedFormat(?string $expectedFormat): self
    {
        $this->initialized['expectedFormat'] = true;
        $this->expectedFormat = $expectedFormat;
        return $this;
    }
    /**
     * Comma-separated list of allowed values (for enum fields)
     *
     * @return string|null
     */
    public function getAllowedValues(): ?string
    {
        return $this->allowedValues;
    }
    /**
     * Comma-separated list of allowed values (for enum fields)
     *
     * @param string|null $allowedValues
     *
     * @return self
     */
    public function setAllowedValues(?string $allowedValues): self
    {
        $this->initialized['allowedValues'] = true;
        $this->allowedValues = $allowedValues;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['field' => ['field', 'getField', 'setField'], 'invalidValue' => ['invalid_value', 'getInvalidValue', 'setInvalidValue'], 'expectedFormat' => ['expected_format', 'getExpectedFormat', 'setExpectedFormat'], 'allowedValues' => ['allowed_values', 'getAllowedValues', 'setAllowedValues']];
    }
}