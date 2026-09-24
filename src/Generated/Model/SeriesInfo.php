<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class SeriesInfo implements AdditionalPropertiesInterface
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
     * Invoice series UUID
     *
     * @var string
     */
    protected $id;

    /**
     * Alphanumeric series code
     *
     * @var string
     */
    protected $code;

    /**
     * Invoice series UUID
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Invoice series UUID
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;

        return $this;
    }

    /**
     * Alphanumeric series code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Alphanumeric series code
     */
    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'code' => ['code', 'getCode', 'setCode']];
    }
}
