<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class SetRecurringInvoiceStatusRequest implements AdditionalPropertiesInterface
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
     * Target status. `PAUSED` stops automatic generation keeping the schedule; `ACTIVE`
     * resumes it and keeps the scheduled next generation date whenever that date has not fallen
     * due yet (including today), rescheduling only a date left in the past to the first
     * occurrence after today; `COMPLETED` ends the schedule for good — valid from both `ACTIVE`
     * and `PAUSED`.
     * 
     * `COMPLETED` is terminal: once there, `ACTIVE` and `PAUSED` are rejected with
     * `RECURRING_STATE_TRANSITION_INVALID`. Ending also disarms the auto-emission timer of any
     * draft this schedule had seeded; those drafts stay alive as regular drafts.
     * 
     *
     * @var string
     */
    protected $status;
    /**
     * Target status. `PAUSED` stops automatic generation keeping the schedule; `ACTIVE`
     * resumes it and keeps the scheduled next generation date whenever that date has not fallen
     * due yet (including today), rescheduling only a date left in the past to the first
     * occurrence after today; `COMPLETED` ends the schedule for good — valid from both `ACTIVE`
     * and `PAUSED`.
     * 
     * `COMPLETED` is terminal: once there, `ACTIVE` and `PAUSED` are rejected with
     * `RECURRING_STATE_TRANSITION_INVALID`. Ending also disarms the auto-emission timer of any
     * draft this schedule had seeded; those drafts stay alive as regular drafts.
     * 
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
    /**
    * Target status. `PAUSED` stops automatic generation keeping the schedule; `ACTIVE`
    resumes it and keeps the scheduled next generation date whenever that date has not fallen
    due yet (including today), rescheduling only a date left in the past to the first
    occurrence after today; `COMPLETED` ends the schedule for good — valid from both `ACTIVE`
    and `PAUSED`.
    
    `COMPLETED` is terminal: once there, `ACTIVE` and `PAUSED` are rejected with
    `RECURRING_STATE_TRANSITION_INVALID`. Ending also disarms the auto-emission timer of any
    draft this schedule had seeded; those drafts stay alive as regular drafts.
    
    *
    * @param string $status
    *
    * @return self
    */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['status' => ['status', 'getStatus', 'setStatus']];
    }
}