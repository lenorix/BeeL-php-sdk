<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CompaniesCompanyIdProductsBulkDeleteResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<string>
     */
    protected $deletedProducts;
    /**
     * @var list<V1CompaniesCompanyIdProductsBulkDeleteResponse200DataErrorsItem>
     */
    protected $errors;
    /**
     * @var V1CompaniesCompanyIdProductsBulkDeleteResponse200DataSummary
     */
    protected $summary;
    /**
     * @return list<string>
     */
    public function getDeletedProducts(): array
    {
        return $this->deletedProducts;
    }
    /**
     * @param list<string> $deletedProducts
     *
     * @return self
     */
    public function setDeletedProducts(array $deletedProducts): self
    {
        $this->initialized['deletedProducts'] = true;
        $this->deletedProducts = $deletedProducts;
        return $this;
    }
    /**
     * @return list<V1CompaniesCompanyIdProductsBulkDeleteResponse200DataErrorsItem>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
    /**
     * @param list<V1CompaniesCompanyIdProductsBulkDeleteResponse200DataErrorsItem> $errors
     *
     * @return self
     */
    public function setErrors(array $errors): self
    {
        $this->initialized['errors'] = true;
        $this->errors = $errors;
        return $this;
    }
    /**
     * @return V1CompaniesCompanyIdProductsBulkDeleteResponse200DataSummary
     */
    public function getSummary(): V1CompaniesCompanyIdProductsBulkDeleteResponse200DataSummary
    {
        return $this->summary;
    }
    /**
     * @param V1CompaniesCompanyIdProductsBulkDeleteResponse200DataSummary $summary
     *
     * @return self
     */
    public function setSummary(V1CompaniesCompanyIdProductsBulkDeleteResponse200DataSummary $summary): self
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