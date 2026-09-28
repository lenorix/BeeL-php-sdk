<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class ListCompanyStats200ResponseData implements AdditionalPropertiesInterface
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
     * @var list<CompanyStatsData>
     */
    protected $stats;
    /**
     * @var Pagination
     */
    protected $pagination;
    /**
     * @return list<CompanyStatsData>
     */
    public function getStats(): array
    {
        return $this->stats;
    }
    /**
     * @param list<CompanyStatsData> $stats
     *
     * @return self
     */
    public function setStats(array $stats): self
    {
        $this->initialized['stats'] = true;
        $this->stats = $stats;
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
        return ['stats' => ['stats', 'getStats', 'setStats'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}