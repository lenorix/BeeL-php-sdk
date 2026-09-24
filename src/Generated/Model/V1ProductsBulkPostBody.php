<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1ProductsBulkPostBody implements AdditionalPropertiesInterface
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
     * @var list<CreateProductRequest>
     */
    protected $products;
    /**
     * @return list<CreateProductRequest>
     */
    public function getProducts(): array
    {
        return $this->products;
    }
    /**
     * @param list<CreateProductRequest> $products
     *
     * @return self
     */
    public function setProducts(array $products): self
    {
        $this->initialized['products'] = true;
        $this->products = $products;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['products' => ['products', 'getProducts', 'setProducts']];
    }
}