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
     * @var string|null
     */
    protected $reason;

    /**
     * @var \DateTime|null
     */
    protected $since;

    /**
     * What blocked the emission, using the same codes the emission error returns (the `blockers[]`
     * of a 422 `EMISSION_NOT_READY`). Only for `GENERATION_FAILURE`, and it may be absent when the
     * permanent failure was not a readiness one. Resuming is rejected while this blocker is still
     * in effect.
     *
     *
     * @var string|null
     */
    protected $blocker;

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->initialized['reason'] = true;
        $this->reason = $reason;

        return $this;
    }

    public function getSince(): ?\DateTime
    {
        return $this->since;
    }

    public function setSince(?\DateTime $since): self
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
     */
    public function getBlocker(): ?string
    {
        return $this->blocker;
    }

    /**
     * What blocked the emission, using the same codes the emission error returns (the `blockers[]`
    of a 422 `EMISSION_NOT_READY`). Only for `GENERATION_FAILURE`, and it may be absent when the
    permanent failure was not a readiness one. Resuming is rejected while this blocker is still
    in effect.
     */
    public function setBlocker(?string $blocker): self
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
