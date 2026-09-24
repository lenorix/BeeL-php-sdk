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
     */
    public function getRow(): int
    {
        return $this->row;
    }

    /**
     * Row number with error (1-based, excluding header)
     */
    public function setRow(int $row): self
    {
        $this->initialized['row'] = true;
        $this->row = $row;

        return $this;
    }

    /**
     * Field name with error
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * Field name with error
     */
    public function setField(string $field): self
    {
        $this->initialized['field'] = true;
        $this->field = $field;

        return $this;
    }

    /**
     * Value that caused the error
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Value that caused the error
     */
    public function setValue(string $value): self
    {
        $this->initialized['value'] = true;
        $this->value = $value;

        return $this;
    }

    /**
     * Detailed error message
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * Detailed error message
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
