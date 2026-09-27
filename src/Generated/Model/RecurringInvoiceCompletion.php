<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class RecurringInvoiceCompletion implements AdditionalPropertiesInterface
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
     * `USER` — someone completed it (`PUT .../status` to `COMPLETED`).
     * `END_DATE_REACHED` — the next occurrence landed past `end_date`, so there was nothing left
     * to generate. This includes automatic generation and the common close of generating, skipping
     * and resuming.
     * `MAX_INVOICES_REACHED` — the `max_invoices` cap ran out: the last agreed invoice was
     * generated (or the cap was moved down to the number already generated). When a template
     * exhausts its cap and its `end_date` on the very same turn this is the cause reported: the
     * cap is the fact that just happened, the date is the calendar consequence that follows.
     *
     *
     * @var string
     */
    protected $reason;

    /**
     * Instant the schedule was closed.
     *
     * @var \DateTime
     */
    protected $at;

    /**
     * `USER` — someone completed it (`PUT .../status` to `COMPLETED`).
     * `END_DATE_REACHED` — the next occurrence landed past `end_date`, so there was nothing left
     * to generate. This includes automatic generation and the common close of generating, skipping
     * and resuming.
     * `MAX_INVOICES_REACHED` — the `max_invoices` cap ran out: the last agreed invoice was
     * generated (or the cap was moved down to the number already generated). When a template
     * exhausts its cap and its `end_date` on the very same turn this is the cause reported: the
     * cap is the fact that just happened, the date is the calendar consequence that follows.
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * `USER` — someone completed it (`PUT .../status` to `COMPLETED`).
    `END_DATE_REACHED` — the next occurrence landed past `end_date`, so there was nothing left
    to generate. This includes automatic generation and the common close of generating, skipping
    and resuming.
    `MAX_INVOICES_REACHED` — the `max_invoices` cap ran out: the last agreed invoice was
    generated (or the cap was moved down to the number already generated). When a template
    exhausts its cap and its `end_date` on the very same turn this is the cause reported: the
    cap is the fact that just happened, the date is the calendar consequence that follows.
     */
    public function setReason(string $reason): self
    {
        $this->initialized['reason'] = true;
        $this->reason = $reason;

        return $this;
    }

    /**
     * Instant the schedule was closed.
     */
    public function getAt(): \DateTime
    {
        return $this->at;
    }

    /**
     * Instant the schedule was closed.
     */
    public function setAt(\DateTime $at): self
    {
        $this->initialized['at'] = true;
        $this->at = $at;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['reason' => ['reason', 'getReason', 'setReason'], 'at' => ['at', 'getAt', 'setAt']];
    }
}
