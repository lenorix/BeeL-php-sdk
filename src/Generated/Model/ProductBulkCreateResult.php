<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ProductBulkCreateResult implements AdditionalPropertiesInterface
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
     * What the operation was, and whether it was a rehearsal.
     *
     * @var ProductBulkCreateMetadata
     */
    protected $metadata;

    /**
     * One entry per product submitted, in the order they were sent and never filtered: a
     * product that was rejected keeps its place and its `index`, so the response lines up
     * with the request.
     *
     *
     * @var list<ProductBulkCreateItem>
     */
    protected $productsCreation;

    /**
     * Counters derived by counting the entries of `products_creation`, never accumulated while
     * processing. Each row falls into exactly one of `created`, `duplicates` and `invalid`, so
     * those three add up to `total_processed`.
     *
     *
     * @var ProductBulkCreateStatistics
     */
    protected $statistics;

    /**
     * The products that were created, in submission order.
     *
     * @var list<Product>
     */
    protected $createdProducts;

    /**
     * **Deprecated.** Projection of the entries of `products_creation` that were not created,
     * in the same order. Read `products_creation`, which also reports the rows that worked and
     * whose `error.code` is stable. Its `error` field used to carry a raw i18n key
     * (`error.producto.duplicado`) and now carries the text resolved to the language of the
     * request.
     *
     *
     * @deprecated
     *
     * @var list<ProductBulkCreateLegacyError>
     */
    protected $errors;

    /**
     * **Deprecated.** Read `statistics`.
     *
     * @deprecated
     *
     * @var ProductBulkCreateResultSummary
     */
    protected $summary;

    /**
     * What the operation was, and whether it was a rehearsal.
     */
    public function getMetadata(): ProductBulkCreateMetadata
    {
        return $this->metadata;
    }

    /**
     * What the operation was, and whether it was a rehearsal.
     */
    public function setMetadata(ProductBulkCreateMetadata $metadata): self
    {
        $this->initialized['metadata'] = true;
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * One entry per product submitted, in the order they were sent and never filtered: a
     * product that was rejected keeps its place and its `index`, so the response lines up
     * with the request.
     *
     *
     * @return list<ProductBulkCreateItem>
     */
    public function getProductsCreation(): array
    {
        return $this->productsCreation;
    }

    /**
     * One entry per product submitted, in the order they were sent and never filtered: a
    product that was rejected keeps its place and its `index`, so the response lines up
    with the request.

     *
     * @param  list<ProductBulkCreateItem>  $productsCreation
     */
    public function setProductsCreation(array $productsCreation): self
    {
        $this->initialized['productsCreation'] = true;
        $this->productsCreation = $productsCreation;

        return $this;
    }

    /**
     * Counters derived by counting the entries of `products_creation`, never accumulated while
     * processing. Each row falls into exactly one of `created`, `duplicates` and `invalid`, so
     * those three add up to `total_processed`.
     */
    public function getStatistics(): ProductBulkCreateStatistics
    {
        return $this->statistics;
    }

    /**
     * Counters derived by counting the entries of `products_creation`, never accumulated while
    processing. Each row falls into exactly one of `created`, `duplicates` and `invalid`, so
    those three add up to `total_processed`.
     */
    public function setStatistics(ProductBulkCreateStatistics $statistics): self
    {
        $this->initialized['statistics'] = true;
        $this->statistics = $statistics;

        return $this;
    }

    /**
     * The products that were created, in submission order.
     *
     * @return list<Product>
     */
    public function getCreatedProducts(): array
    {
        return $this->createdProducts;
    }

    /**
     * The products that were created, in submission order.
     *
     * @param  list<Product>  $createdProducts
     */
    public function setCreatedProducts(array $createdProducts): self
    {
        $this->initialized['createdProducts'] = true;
        $this->createdProducts = $createdProducts;

        return $this;
    }

    /**
     * **Deprecated.** Projection of the entries of `products_creation` that were not created,
     * in the same order. Read `products_creation`, which also reports the rows that worked and
     * whose `error.code` is stable. Its `error` field used to carry a raw i18n key
     * (`error.producto.duplicado`) and now carries the text resolved to the language of the
     * request.
     *
     *
     * @deprecated
     *
     * @return list<ProductBulkCreateLegacyError>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * **Deprecated.** Projection of the entries of `products_creation` that were not created,
    in the same order. Read `products_creation`, which also reports the rows that worked and
    whose `error.code` is stable. Its `error` field used to carry a raw i18n key
    (`error.producto.duplicado`) and now carries the text resolved to the language of the
    request.

     *
     * @param  list<ProductBulkCreateLegacyError>  $errors
     *
     * @deprecated
     */
    public function setErrors(array $errors): self
    {
        $this->initialized['errors'] = true;
        $this->errors = $errors;

        return $this;
    }

    /**
     * **Deprecated.** Read `statistics`.
     *
     * @deprecated
     */
    public function getSummary(): ProductBulkCreateResultSummary
    {
        return $this->summary;
    }

    /**
     * **Deprecated.** Read `statistics`.
     *
     *
     * @deprecated
     */
    public function setSummary(ProductBulkCreateResultSummary $summary): self
    {
        $this->initialized['summary'] = true;
        $this->summary = $summary;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['metadata' => ['metadata', 'getMetadata', 'setMetadata'], 'productsCreation' => ['products_creation', 'getProductsCreation', 'setProductsCreation'], 'statistics' => ['statistics', 'getStatistics', 'setStatistics'], 'createdProducts' => ['created_products', 'getCreatedProducts', 'setCreatedProducts'], 'errors' => ['errors', 'getErrors', 'setErrors'], 'summary' => ['summary', 'getSummary', 'setSummary']];
    }
}
