<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CompaniesCompanyIdSeriesDefaultsPutResponse200Data implements AdditionalPropertiesInterface
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
    public function definedProperties(): array
    {
        return ['series' => ['series', 'getSeries', 'setSeries']];
    }
}