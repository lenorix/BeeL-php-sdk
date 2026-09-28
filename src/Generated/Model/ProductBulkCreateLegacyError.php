<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
/**
 * @deprecated
 */
class ProductBulkCreateLegacyError implements AdditionalPropertiesInterface
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
     * @var int|null
     */
    protected $index;
    /**
     * @var string|null
     */
    protected $code;
    /**
     * @var string|null
     */
    protected $name;
    /**
     * Text resolved to the language of the request. Read `products_creation[].error.code` to branch on.
     *
     * @var string|null
     */
    protected $error;
    /**
     * @return int|null
     */
    public function getIndex(): ?int
    {
        return $this->index;
    }
    /**
     * @param int|null $index
     *
     * @return self
     */
    public function setIndex(?int $index): self
    {
        $this->initialized['index'] = true;
        $this->index = $index;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }
    /**
     * @param string|null $code
     *
     * @return self
     */
    public function setCode(?string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * @param string|null $name
     *
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * Text resolved to the language of the request. Read `products_creation[].error.code` to branch on.
     *
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }
    /**
     * Text resolved to the language of the request. Read `products_creation[].error.code` to branch on.
     *
     * @param string|null $error
     *
     * @return self
     */
    public function setError(?string $error): self
    {
        $this->initialized['error'] = true;
        $this->error = $error;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['index' => ['index', 'getIndex', 'setIndex'], 'code' => ['code', 'getCode', 'setCode'], 'name' => ['name', 'getName', 'setName'], 'error' => ['error', 'getError', 'setError']];
    }
}