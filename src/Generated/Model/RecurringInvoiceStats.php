<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class RecurringInvoiceStats implements AdditionalPropertiesInterface
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
     * How many schedules fall in this block and what they are worth per month.
     *
     *
     * @var RecurringInvoiceStatsBlock
     */
    protected $active;

    /**
     * How many schedules fall in this block and what they are worth per month.
     *
     *
     * @var RecurringInvoiceStatsBlock
     */
    protected $stopped;

    /**
     * How many schedules fall in this block and what they are worth per month.
     */
    public function getActive(): RecurringInvoiceStatsBlock
    {
        return $this->active;
    }

    /**
     * How many schedules fall in this block and what they are worth per month.
     */
    public function setActive(RecurringInvoiceStatsBlock $active): self
    {
        $this->initialized['active'] = true;
        $this->active = $active;

        return $this;
    }

    /**
     * How many schedules fall in this block and what they are worth per month.
     */
    public function getStopped(): RecurringInvoiceStatsBlock
    {
        return $this->stopped;
    }

    /**
     * How many schedules fall in this block and what they are worth per month.
     */
    public function setStopped(RecurringInvoiceStatsBlock $stopped): self
    {
        $this->initialized['stopped'] = true;
        $this->stopped = $stopped;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['active' => ['active', 'getActive', 'setActive'], 'stopped' => ['stopped', 'getStopped', 'setStopped']];
    }
}
