<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CustomerValidationWarning implements AdditionalPropertiesInterface
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
     * Field with warning
     *
     * @var string
     */
    protected $field;

    /**
     * Warning message
     *
     * @var string
     */
    protected $message;

    /**
     * Field with warning
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * Field with warning
     */
    public function setField(string $field): self
    {
        $this->initialized['field'] = true;
        $this->field = $field;

        return $this;
    }

    /**
     * Warning message
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Warning message
     */
    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['field' => ['field', 'getField', 'setField'], 'message' => ['message', 'getMessage', 'setMessage']];
    }
}
