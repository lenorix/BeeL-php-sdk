<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class PaymentEventCounts implements AdditionalPropertiesInterface
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
     * Events of the connection that are not discarded — the size of the list you get when
     * you filter by nothing.
     * 
     *
     * @var int
     */
    protected $total;
    /**
     * Events you discarded. They are not part of `total`; ask for them with
     * `include_discarded=true`.
     * 
     *
     * @var int
     */
    protected $discarded;
    /**
     * Events that are waiting for you to do something — the same set you get with
     * `needs_action=true`. Counts only events that are not discarded, so it is part of
     * `total`.
     * 
     * **Deprecated. Retires on 11 December 2026.** Filter with `needs_action=true` and read
     * `pagination.total_items` instead. See the [migration guide](https://docs.beel.es/changelog/payments-cleanup).
     * 
     *
     * @deprecated
     *
     * @var int
     */
    protected $needsAction;
    /**
     * Events that were skipped on purpose and need nothing from you (duplicates, your own
     * filters, event types that are not invoiced). Counts only events that are not
     * discarded, so it is part of `total`.
     * 
     * **Deprecated. Retires on 11 December 2026.** The closest surviving figure is
     * `by_status.SKIPPED`. See the [migration guide](https://docs.beel.es/changelog/payments-cleanup).
     * 
     *
     * @deprecated
     *
     * @var int
     */
    protected $ignored;
    /**
     * Number of events per processing status.
     *
     * @var array<string, int>
     */
    protected $byStatus;
    /**
     * Number of events per failure reason, among those that did not complete. Events that
     * completed do not appear here.
     * 
     * **Deprecated. Retires on 11 December 2026.** Use `failure_reasons`, which carries the
     * same counts plus the reason written out for a person. See the
     * [migration guide](https://docs.beel.es/changelog/payments-cleanup).
     * 
     *
     * @deprecated
     *
     * @var array<string, int>
     */
    protected $byFailureReason;
    /**
     * Number of events per failure reason, among those that did not complete, with the
     * reason already written out in the language of the request. Events that completed do
     * not appear here. Replaces the deprecated `by_failure_reason`.
     * 
     *
     * @var list<PaymentEventFailureReasonCount>
     */
    protected $failureReasons;
    /**
     * Events of the connection that are not discarded — the size of the list you get when
     * you filter by nothing.
     * 
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
    /**
    * Events of the connection that are not discarded — the size of the list you get when
    you filter by nothing.
    
    *
    * @param int $total
    *
    * @return self
    */
    public function setTotal(int $total): self
    {
        $this->initialized['total'] = true;
        $this->total = $total;
        return $this;
    }
    /**
     * Events you discarded. They are not part of `total`; ask for them with
     * `include_discarded=true`.
     * 
     *
     * @return int
     */
    public function getDiscarded(): int
    {
        return $this->discarded;
    }
    /**
    * Events you discarded. They are not part of `total`; ask for them with
    `include_discarded=true`.
    
    *
    * @param int $discarded
    *
    * @return self
    */
    public function setDiscarded(int $discarded): self
    {
        $this->initialized['discarded'] = true;
        $this->discarded = $discarded;
        return $this;
    }
    /**
     * Events that are waiting for you to do something — the same set you get with
     * `needs_action=true`. Counts only events that are not discarded, so it is part of
     * `total`.
     * 
     * **Deprecated. Retires on 11 December 2026.** Filter with `needs_action=true` and read
     * `pagination.total_items` instead. See the [migration guide](https://docs.beel.es/changelog/payments-cleanup).
     * 
     *
     * @deprecated
     *
     * @return int
     */
    public function getNeedsAction(): int
    {
        return $this->needsAction;
    }
    /**
    * Events that are waiting for you to do something — the same set you get with
    `needs_action=true`. Counts only events that are not discarded, so it is part of
    `total`.
    
    **Deprecated. Retires on 11 December 2026.** Filter with `needs_action=true` and read
    `pagination.total_items` instead. See the [migration guide](https://docs.beel.es/changelog/payments-cleanup).
    
    *
    * @param int $needsAction
    *
    * @deprecated
    *
    * @return self
    */
    public function setNeedsAction(int $needsAction): self
    {
        $this->initialized['needsAction'] = true;
        $this->needsAction = $needsAction;
        return $this;
    }
    /**
     * Events that were skipped on purpose and need nothing from you (duplicates, your own
     * filters, event types that are not invoiced). Counts only events that are not
     * discarded, so it is part of `total`.
     * 
     * **Deprecated. Retires on 11 December 2026.** The closest surviving figure is
     * `by_status.SKIPPED`. See the [migration guide](https://docs.beel.es/changelog/payments-cleanup).
     * 
     *
     * @deprecated
     *
     * @return int
     */
    public function getIgnored(): int
    {
        return $this->ignored;
    }
    /**
    * Events that were skipped on purpose and need nothing from you (duplicates, your own
    filters, event types that are not invoiced). Counts only events that are not
    discarded, so it is part of `total`.
    
    **Deprecated. Retires on 11 December 2026.** The closest surviving figure is
    `by_status.SKIPPED`. See the [migration guide](https://docs.beel.es/changelog/payments-cleanup).
    
    *
    * @param int $ignored
    *
    * @deprecated
    *
    * @return self
    */
    public function setIgnored(int $ignored): self
    {
        $this->initialized['ignored'] = true;
        $this->ignored = $ignored;
        return $this;
    }
    /**
     * Number of events per processing status.
     *
     * @return array<string, int>
     */
    public function getByStatus(): iterable
    {
        return $this->byStatus;
    }
    /**
     * Number of events per processing status.
     *
     * @param array<string, int> $byStatus
     *
     * @return self
     */
    public function setByStatus(iterable $byStatus): self
    {
        $this->initialized['byStatus'] = true;
        $this->byStatus = $byStatus;
        return $this;
    }
    /**
     * Number of events per failure reason, among those that did not complete. Events that
     * completed do not appear here.
     * 
     * **Deprecated. Retires on 11 December 2026.** Use `failure_reasons`, which carries the
     * same counts plus the reason written out for a person. See the
     * [migration guide](https://docs.beel.es/changelog/payments-cleanup).
     * 
     *
     * @deprecated
     *
     * @return array<string, int>
     */
    public function getByFailureReason(): iterable
    {
        return $this->byFailureReason;
    }
    /**
    * Number of events per failure reason, among those that did not complete. Events that
    completed do not appear here.
    
    **Deprecated. Retires on 11 December 2026.** Use `failure_reasons`, which carries the
    same counts plus the reason written out for a person. See the
    [migration guide](https://docs.beel.es/changelog/payments-cleanup).
    
    *
    * @param array<string, int> $byFailureReason
    *
    * @deprecated
    *
    * @return self
    */
    public function setByFailureReason(iterable $byFailureReason): self
    {
        $this->initialized['byFailureReason'] = true;
        $this->byFailureReason = $byFailureReason;
        return $this;
    }
    /**
     * Number of events per failure reason, among those that did not complete, with the
     * reason already written out in the language of the request. Events that completed do
     * not appear here. Replaces the deprecated `by_failure_reason`.
     * 
     *
     * @return list<PaymentEventFailureReasonCount>
     */
    public function getFailureReasons(): array
    {
        return $this->failureReasons;
    }
    /**
    * Number of events per failure reason, among those that did not complete, with the
    reason already written out in the language of the request. Events that completed do
    not appear here. Replaces the deprecated `by_failure_reason`.
    
    *
    * @param list<PaymentEventFailureReasonCount> $failureReasons
    *
    * @return self
    */
    public function setFailureReasons(array $failureReasons): self
    {
        $this->initialized['failureReasons'] = true;
        $this->failureReasons = $failureReasons;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['total' => ['total', 'getTotal', 'setTotal'], 'discarded' => ['discarded', 'getDiscarded', 'setDiscarded'], 'needsAction' => ['needs_action', 'getNeedsAction', 'setNeedsAction'], 'ignored' => ['ignored', 'getIgnored', 'setIgnored'], 'byStatus' => ['by_status', 'getByStatus', 'setByStatus'], 'byFailureReason' => ['by_failure_reason', 'getByFailureReason', 'setByFailureReason'], 'failureReasons' => ['failure_reasons', 'getFailureReasons', 'setFailureReasons']];
    }
}