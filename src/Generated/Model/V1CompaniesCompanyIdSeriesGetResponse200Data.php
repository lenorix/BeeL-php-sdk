<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CompaniesCompanyIdSeriesGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<InvoiceSeries>
     */
    protected $series;
    /**
     * Totals of the requested page. Present ONLY when the request sent
     * `page` and/or `limit`; omitted for the historical full list.
     * 
     *
     * @var V1CompaniesCompanyIdSeriesGetResponse200DataPagination
     */
    protected $pagination;
    /**
     * @return list<InvoiceSeries>
     */
    public function getSeries(): array
    {
        return $this->series;
    }
    /**
     * @param list<InvoiceSeries> $series
     *
     * @return self
     */
    public function setSeries(array $series): self
    {
        $this->initialized['series'] = true;
        $this->series = $series;
        return $this;
    }
    /**
     * Totals of the requested page. Present ONLY when the request sent
     * `page` and/or `limit`; omitted for the historical full list.
     * 
     *
     * @return V1CompaniesCompanyIdSeriesGetResponse200DataPagination
     */
    public function getPagination(): V1CompaniesCompanyIdSeriesGetResponse200DataPagination
    {
        return $this->pagination;
    }
    /**
    * Totals of the requested page. Present ONLY when the request sent
    `page` and/or `limit`; omitted for the historical full list.
    
    *
    * @param V1CompaniesCompanyIdSeriesGetResponse200DataPagination $pagination
    *
    * @return self
    */
    public function setPagination(V1CompaniesCompanyIdSeriesGetResponse200DataPagination $pagination): self
    {
        $this->initialized['pagination'] = true;
        $this->pagination = $pagination;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['series' => ['series', 'getSeries', 'setSeries'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}