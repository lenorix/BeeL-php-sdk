<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class VeriFactuRegimeKey implements AdditionalPropertiesInterface
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
     * VeriFactu regime code
     *
     * @var string
     */
    protected $code;

    /**
     * Regime key description
     *
     * @var string
     */
    protected $description;

    /**
     * VeriFactu regime code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * VeriFactu regime code
     */
    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;

        return $this;
    }

    /**
     * Regime key description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Regime key description
     */
    public function setDescription(string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['code' => ['code', 'getCode', 'setCode'], 'description' => ['description', 'getDescription', 'setDescription']];
    }
}
