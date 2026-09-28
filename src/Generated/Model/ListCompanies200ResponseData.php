<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class ListCompanies200ResponseData implements AdditionalPropertiesInterface
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
     * @var list<CompanyData>
     */
    protected $companies;
    /**
     * @var Pagination
     */
    protected $pagination;
    /**
     * @return list<CompanyData>
     */
    public function getCompanies(): array
    {
        return $this->companies;
    }
    /**
     * @param list<CompanyData> $companies
     *
     * @return self
     */
    public function setCompanies(array $companies): self
    {
        $this->initialized['companies'] = true;
        $this->companies = $companies;
        return $this;
    }
    /**
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }
    /**
     * @param Pagination $pagination
     *
     * @return self
     */
    public function setPagination(Pagination $pagination): self
    {
        $this->initialized['pagination'] = true;
        $this->pagination = $pagination;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['companies' => ['companies', 'getCompanies', 'setCompanies'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}