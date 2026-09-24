<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class InvoiceEmailDeliveryOutcome implements AdditionalPropertiesInterface
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
     * - `SENT` — the email was authorised and accepted for delivery. Delivery itself is
     *   asynchronous; follow it in `sending_history`.
     * - `REJECTED` — the sending policy refused it. Nothing was queued and nothing will be
     *   retried; the refusal is recorded in the delivery ledger.
     * - `NOT_REQUESTED` — the invoice does not send automatically.
     * 
     *
     * @var string
     */
    protected $status;
    /**
     * Translation key explaining a `REJECTED` outcome, deliberately generic. Null for the
     * other statuses.
     * 
     *
     * @var string|null
     */
    protected $reason;
    /**
     * - `SENT` — the email was authorised and accepted for delivery. Delivery itself is
     *   asynchronous; follow it in `sending_history`.
     * - `REJECTED` — the sending policy refused it. Nothing was queued and nothing will be
     *   retried; the refusal is recorded in the delivery ledger.
     * - `NOT_REQUESTED` — the invoice does not send automatically.
     * 
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
    /**
    * - `SENT` — the email was authorised and accepted for delivery. Delivery itself is
     asynchronous; follow it in `sending_history`.
    - `REJECTED` — the sending policy refused it. Nothing was queued and nothing will be
     retried; the refusal is recorded in the delivery ledger.
    - `NOT_REQUESTED` — the invoice does not send automatically.
    
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
    /**
     * Translation key explaining a `REJECTED` outcome, deliberately generic. Null for the
     * other statuses.
     * 
     *
     * @return string|null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }
    /**
    * Translation key explaining a `REJECTED` outcome, deliberately generic. Null for the
    other statuses.
    
    *
    * @param string|null $reason
    *
    * @return self
    */
    public function setReason(?string $reason): self
    {
        $this->initialized['reason'] = true;
        $this->reason = $reason;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['status' => ['status', 'getStatus', 'setStatus'], 'reason' => ['reason', 'getReason', 'setReason']];
    }
}