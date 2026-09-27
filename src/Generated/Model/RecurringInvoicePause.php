<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class RecurringInvoicePause implements AdditionalPropertiesInterface
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
     * Who stopped the schedule. `USER` a person did, from the API or the dashboard; `DOWNGRADE` the
     * account lost the recurring-invoices feature; `GENERATION_FAILURE` an unattended run failed with
     * something waiting will not fix — that one carries a `blocker`.
     * 
     *
     * @var string
     */
    protected $reason;
    /**
     * @var \DateTime
     */
    protected $since;
    /**
     * What blocked the emission, using the same codes the emission error returns (the `blockers[]`
     * of a 422 `EMISSION_NOT_READY`). Only for `GENERATION_FAILURE`, and it may be absent when the
     * permanent failure was not a readiness one. Resuming is rejected while this blocker is still
     * in effect.
     * 
     *
     * @var string
     */
    protected $blocker;
    /**
     * Who stopped the schedule. `USER` a person did, from the API or the dashboard; `DOWNGRADE` the
     * account lost the recurring-invoices feature; `GENERATION_FAILURE` an unattended run failed with
     * something waiting will not fix — that one carries a `blocker`.
     * 
     *
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }
    /**
    * Who stopped the schedule. `USER` a person did, from the API or the dashboard; `DOWNGRADE` the
    account lost the recurring-invoices feature; `GENERATION_FAILURE` an unattended run failed with
    something waiting will not fix — that one carries a `blocker`.
    
    *
    * @param string $reason
    *
    * @return self
    */
    public function setReason(string $reason): self
    {
        $this->initialized['reason'] = true;
        $this->reason = $reason;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getSince(): \DateTime
    {
        return $this->since;
    }
    /**
     * @param \DateTime $since
     *
     * @return self
     */
    public function setSince(\DateTime $since): self
    {
        $this->initialized['since'] = true;
        $this->since = $since;
        return $this;
    }
    /**
     * What blocked the emission, using the same codes the emission error returns (the `blockers[]`
     * of a 422 `EMISSION_NOT_READY`). Only for `GENERATION_FAILURE`, and it may be absent when the
     * permanent failure was not a readiness one. Resuming is rejected while this blocker is still
     * in effect.
     * 
     *
     * @return string
     */
    public function getBlocker(): string
    {
        return $this->blocker;
    }
    /**
    * What blocked the emission, using the same codes the emission error returns (the `blockers[]`
    of a 422 `EMISSION_NOT_READY`). Only for `GENERATION_FAILURE`, and it may be absent when the
    permanent failure was not a readiness one. Resuming is rejected while this blocker is still
    in effect.
    
    *
    * @param string $blocker
    *
    * @return self
    */
    public function setBlocker(string $blocker): self
    {
        $this->initialized['blocker'] = true;
        $this->blocker = $blocker;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['reason' => ['reason', 'getReason', 'setReason'], 'since' => ['since', 'getSince', 'setSince'], 'blocker' => ['blocker', 'getBlocker', 'setBlocker']];
    }
}