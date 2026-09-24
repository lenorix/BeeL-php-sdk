<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CustomersBulkPostResponse422ErrorErrorsItem implements AdditionalPropertiesInterface
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
     * Index of the customer with error (0-based)
     *
     * @var int
     */
    protected $index;
    /**
     * @var string
     */
    protected $field;
    /**
     * @var string
     */
    protected $message;
    /**
     * Index of the customer with error (0-based)
     *
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }
    /**
     * Index of the customer with error (0-based)
     *
     * @param int $index
     *
     * @return self
     */
    public function setIndex(int $index): self
    {
        $this->initialized['index'] = true;
        $this->index = $index;
        return $this;
    }
    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }
    /**
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
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
    /**
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
    public function definedProperties(): array
    {
        return ['index' => ['index', 'getIndex', 'setIndex'], 'field' => ['field', 'getField', 'setField'], 'message' => ['message', 'getMessage', 'setMessage']];
    }
}