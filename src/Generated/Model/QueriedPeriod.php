<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class QueriedPeriod implements AdditionalPropertiesInterface
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
     * Period start date
     *
     * @var \DateTime
     */
    protected $startDate;

    /**
     * Period end date
     *
     * @var \DateTime
     */
    protected $endDate;

    /**
     * Number of days included in the period
     *
     * @var int
     */
    protected $daysIncluded;

    /**
     * Period start date
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * Period start date
     */
    public function setStartDate(\DateTime $startDate): self
    {
        $this->initialized['startDate'] = true;
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Period end date
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * Period end date
     */
    public function setEndDate(\DateTime $endDate): self
    {
        $this->initialized['endDate'] = true;
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Number of days included in the period
     */
    public function getDaysIncluded(): int
    {
        return $this->daysIncluded;
    }

    /**
     * Number of days included in the period
     */
    public function setDaysIncluded(int $daysIncluded): self
    {
        $this->initialized['daysIncluded'] = true;
        $this->daysIncluded = $daysIncluded;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['startDate' => ['start_date', 'getStartDate', 'setStartDate'], 'endDate' => ['end_date', 'getEndDate', 'setEndDate'], 'daysIncluded' => ['days_included', 'getDaysIncluded', 'setDaysIncluded']];
    }
}
