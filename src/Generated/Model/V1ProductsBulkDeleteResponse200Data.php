<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1ProductsBulkDeleteResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<string>|null
     */
    protected $deletedProducts;
    /**
     * @var list<V1ProductsBulkDeleteResponse200DataErrorsItem>|null
     */
    protected $errors;
    /**
     * @var V1ProductsBulkDeleteResponse200DataSummary|null
     */
    protected $summary;
    /**
     * @return list<string>|null
     */
    public function getDeletedProducts(): ?array
    {
        return $this->deletedProducts;
    }
    /**
     * @param list<string>|null $deletedProducts
     *
     * @return self
     */
    public function setDeletedProducts(?array $deletedProducts): self
    {
        $this->initialized['deletedProducts'] = true;
        $this->deletedProducts = $deletedProducts;
        return $this;
    }
    /**
     * @return list<V1ProductsBulkDeleteResponse200DataErrorsItem>|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }
    /**
     * @param list<V1ProductsBulkDeleteResponse200DataErrorsItem>|null $errors
     *
     * @return self
     */
    public function setErrors(?array $errors): self
    {
        $this->initialized['errors'] = true;
        $this->errors = $errors;
        return $this;
    }
    /**
     * @return V1ProductsBulkDeleteResponse200DataSummary|null
     */
    public function getSummary(): ?V1ProductsBulkDeleteResponse200DataSummary
    {
        return $this->summary;
    }
    /**
     * @param V1ProductsBulkDeleteResponse200DataSummary|null $summary
     *
     * @return self
     */
    public function setSummary(?V1ProductsBulkDeleteResponse200DataSummary $summary): self
    {
        $this->initialized['summary'] = true;
        $this->summary = $summary;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['deletedProducts' => ['deleted_products', 'getDeletedProducts', 'setDeletedProducts'], 'errors' => ['errors', 'getErrors', 'setErrors'], 'summary' => ['summary', 'getSummary', 'setSummary']];
    }
}