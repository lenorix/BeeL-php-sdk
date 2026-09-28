<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CsvValidationError implements AdditionalPropertiesInterface
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
     * Row number with error (1-based, excluding header)
     *
     * @var int
     */
    protected $row;
    /**
     * Field name with error
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
     * Detailed error message
     *
     * @var string
     */
    protected $error;
    /**
     * Row number with error (1-based, excluding header)
     *
     * @return int
     */
    public function getRow(): int
    {
        return $this->row;
    }
    /**
     * Row number with error (1-based, excluding header)
     *
     * @param int $row
     *
     * @return self
     */
    public function setRow(int $row): self
    {
        $this->initialized['row'] = true;
        $this->row = $row;
        return $this;
    }
    /**
     * Field name with error
     *
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }
    /**
     * Field name with error
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
     * Detailed error message
     *
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }
    /**
     * Detailed error message
     *
     * @param string $error
     *
     * @return self
     */
    public function setError(string $error): self
    {
        $this->initialized['error'] = true;
        $this->error = $error;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['row' => ['row', 'getRow', 'setRow'], 'field' => ['field', 'getField', 'setField'], 'value' => ['value', 'getValue', 'setValue'], 'error' => ['error', 'getError', 'setError']];
    }
}