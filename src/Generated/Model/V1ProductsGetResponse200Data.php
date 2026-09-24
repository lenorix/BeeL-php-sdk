<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1ProductsGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<Product>
     */
    protected $products;

    /**
     * @var Pagination
     */
    protected $pagination;

    /**
     * @return list<Product>
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param  list<Product>  $products
     */
    public function setProducts(array $products): self
    {
        $this->initialized['products'] = true;
        $this->products = $products;

        return $this;
    }

    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    public function setPagination(Pagination $pagination): self
    {
        $this->initialized['pagination'] = true;
        $this->pagination = $pagination;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['products' => ['products', 'getProducts', 'setProducts'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}
