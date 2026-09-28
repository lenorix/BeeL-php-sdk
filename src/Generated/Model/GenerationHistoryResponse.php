<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class GenerationHistoryResponse implements AdditionalPropertiesInterface
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
    protected $id;
    /**
     * @var string|null
     */
    protected $type;
    /**
     * Invoice this entry generated, `null` for entries that generated none — `FAILED`, `SKIPPED`
     * and `PAUSED` never produce one. It is also `null` when the invoice is no longer reachable,
     * under the same conditions as `invoice_number`.
     * 
     *
     * @var string|null
     */
    protected $invoiceId;
    /**
     * Who triggered the generation: `MANUAL` a person did, `UNATTENDED` the nightly sweep. Absent
     * for entries that are not a generation, and for generations recorded before this was stored.
     * 
     *
     * @var string|null
     */
    protected $origin;
    /**
     * Human-readable explanation of a `FAILED` or `PAUSED` entry, already translated to the
     * caller's language. `null` when the entry carries no reason (a generation or a skip).
     * 
     * It is presentation text, not a stable code: do not branch on it. The stable fact is `type`.
     * 
     *
     * @var string|null
     */
    protected $reason;
    /**
     * User who asked to skip the slot. Only present for `SKIPPED` entries.
     * 
     *
     * @var string|null
     */
    protected $requestedBy;
    /**
     * Human-readable identity of `requested_by`: the user's name when the backend has one,
     * their email otherwise. Never the raw UUID — that stays in `requested_by`. Only present
     * for `SKIPPED` entries; `null` when there is no `requested_by` (a generation, failure or
     * pause).
     * 
     *
     * @var string|null
     */
    protected $requestedByName;
    /**
     * @var \DateTime|null
     */
    protected $generatedAt;
    /**
     * @var \DateTime|null
     */
    protected $scheduledDate;
    /**
     * Number of the invoice this entry generated, `null` when that invoice is no longer
     * reachable — it was deleted while still a draft, or it falls outside the caller's scope.
     * A draft that has not been issued yet has no number either, and reads `null` too.
     * 
     * The entry itself always survives: an occurrence that happened is not unsaid by the
     * invoice it produced disappearing.
     * 
     *
     * @var string|null
     */
    protected $invoiceNumber;
    /**
     * Total amount of the generated invoice, `null` under the same conditions as
     * `invoice_number`. Resolved on read, so it always reflects the invoice as it is now.
     * 
     *
     * @var float|null
     */
    protected $total;
    /**
     * Current status of the generated invoice, `null` under the same conditions as
     * `invoice_number`. Resolved on read and never stored on the history row: an entry
     * generated months ago reports what its invoice is TODAY, not what it was when born.
     * 
     *
     * @var string|null
     */
    protected $status;
    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    /**
     * @param string|null $id
     *
     * @return self
     */
    public function setId(?string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }
    /**
     * @param string|null $type
     *
     * @return self
     */
    public function setType(?string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
    /**
     * Invoice this entry generated, `null` for entries that generated none — `FAILED`, `SKIPPED`
     * and `PAUSED` never produce one. It is also `null` when the invoice is no longer reachable,
     * under the same conditions as `invoice_number`.
     * 
     *
     * @return string|null
     */
    public function getInvoiceId(): ?string
    {
        return $this->invoiceId;
    }
    /**
    * Invoice this entry generated, `null` for entries that generated none — `FAILED`, `SKIPPED`
    and `PAUSED` never produce one. It is also `null` when the invoice is no longer reachable,
    under the same conditions as `invoice_number`.
    
    *
    * @param string|null $invoiceId
    *
    * @return self
    */
    public function setInvoiceId(?string $invoiceId): self
    {
        $this->initialized['invoiceId'] = true;
        $this->invoiceId = $invoiceId;
        return $this;
    }
    /**
     * Who triggered the generation: `MANUAL` a person did, `UNATTENDED` the nightly sweep. Absent
     * for entries that are not a generation, and for generations recorded before this was stored.
     * 
     *
     * @return string|null
     */
    public function getOrigin(): ?string
    {
        return $this->origin;
    }
    /**
    * Who triggered the generation: `MANUAL` a person did, `UNATTENDED` the nightly sweep. Absent
    for entries that are not a generation, and for generations recorded before this was stored.
    
    *
    * @param string|null $origin
    *
    * @return self
    */
    public function setOrigin(?string $origin): self
    {
        $this->initialized['origin'] = true;
        $this->origin = $origin;
        return $this;
    }
    /**
     * Human-readable explanation of a `FAILED` or `PAUSED` entry, already translated to the
     * caller's language. `null` when the entry carries no reason (a generation or a skip).
     * 
     * It is presentation text, not a stable code: do not branch on it. The stable fact is `type`.
     * 
     *
     * @return string|null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }
    /**
    * Human-readable explanation of a `FAILED` or `PAUSED` entry, already translated to the
    caller's language. `null` when the entry carries no reason (a generation or a skip).
    
    It is presentation text, not a stable code: do not branch on it. The stable fact is `type`.
    
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
    /**
     * User who asked to skip the slot. Only present for `SKIPPED` entries.
     * 
     *
     * @return string|null
     */
    public function getRequestedBy(): ?string
    {
        return $this->requestedBy;
    }
    /**
     * User who asked to skip the slot. Only present for `SKIPPED` entries.
     *
     * @param string|null $requestedBy
     *
     * @return self
     */
    public function setRequestedBy(?string $requestedBy): self
    {
        $this->initialized['requestedBy'] = true;
        $this->requestedBy = $requestedBy;
        return $this;
    }
    /**
     * Human-readable identity of `requested_by`: the user's name when the backend has one,
     * their email otherwise. Never the raw UUID — that stays in `requested_by`. Only present
     * for `SKIPPED` entries; `null` when there is no `requested_by` (a generation, failure or
     * pause).
     * 
     *
     * @return string|null
     */
    public function getRequestedByName(): ?string
    {
        return $this->requestedByName;
    }
    /**
    * Human-readable identity of `requested_by`: the user's name when the backend has one,
    their email otherwise. Never the raw UUID — that stays in `requested_by`. Only present
    for `SKIPPED` entries; `null` when there is no `requested_by` (a generation, failure or
    pause).
    
    *
    * @param string|null $requestedByName
    *
    * @return self
    */
    public function setRequestedByName(?string $requestedByName): self
    {
        $this->initialized['requestedByName'] = true;
        $this->requestedByName = $requestedByName;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getGeneratedAt(): ?\DateTime
    {
        return $this->generatedAt;
    }
    /**
     * @param \DateTime|null $generatedAt
     *
     * @return self
     */
    public function setGeneratedAt(?\DateTime $generatedAt): self
    {
        $this->initialized['generatedAt'] = true;
        $this->generatedAt = $generatedAt;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getScheduledDate(): ?\DateTime
    {
        return $this->scheduledDate;
    }
    /**
     * @param \DateTime|null $scheduledDate
     *
     * @return self
     */
    public function setScheduledDate(?\DateTime $scheduledDate): self
    {
        $this->initialized['scheduledDate'] = true;
        $this->scheduledDate = $scheduledDate;
        return $this;
    }
    /**
     * Number of the invoice this entry generated, `null` when that invoice is no longer
     * reachable — it was deleted while still a draft, or it falls outside the caller's scope.
     * A draft that has not been issued yet has no number either, and reads `null` too.
     * 
     * The entry itself always survives: an occurrence that happened is not unsaid by the
     * invoice it produced disappearing.
     * 
     *
     * @return string|null
     */
    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }
    /**
    * Number of the invoice this entry generated, `null` when that invoice is no longer
    reachable — it was deleted while still a draft, or it falls outside the caller's scope.
    A draft that has not been issued yet has no number either, and reads `null` too.
    
    The entry itself always survives: an occurrence that happened is not unsaid by the
    invoice it produced disappearing.
    
    *
    * @param string|null $invoiceNumber
    *
    * @return self
    */
    public function setInvoiceNumber(?string $invoiceNumber): self
    {
        $this->initialized['invoiceNumber'] = true;
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }
    /**
     * Total amount of the generated invoice, `null` under the same conditions as
     * `invoice_number`. Resolved on read, so it always reflects the invoice as it is now.
     * 
     *
     * @return float|null
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }
    /**
    * Total amount of the generated invoice, `null` under the same conditions as
    `invoice_number`. Resolved on read, so it always reflects the invoice as it is now.
    
    *
    * @param float|null $total
    *
    * @return self
    */
    public function setTotal(?float $total): self
    {
        $this->initialized['total'] = true;
        $this->total = $total;
        return $this;
    }
    /**
     * Current status of the generated invoice, `null` under the same conditions as
     * `invoice_number`. Resolved on read and never stored on the history row: an entry
     * generated months ago reports what its invoice is TODAY, not what it was when born.
     * 
     *
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }
    /**
    * Current status of the generated invoice, `null` under the same conditions as
    `invoice_number`. Resolved on read and never stored on the history row: an entry
    generated months ago reports what its invoice is TODAY, not what it was when born.
    
    *
    * @param string|null $status
    *
    * @return self
    */
    public function setStatus(?string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'type' => ['type', 'getType', 'setType'], 'invoiceId' => ['invoice_id', 'getInvoiceId', 'setInvoiceId'], 'origin' => ['origin', 'getOrigin', 'setOrigin'], 'reason' => ['reason', 'getReason', 'setReason'], 'requestedBy' => ['requested_by', 'getRequestedBy', 'setRequestedBy'], 'requestedByName' => ['requested_by_name', 'getRequestedByName', 'setRequestedByName'], 'generatedAt' => ['generated_at', 'getGeneratedAt', 'setGeneratedAt'], 'scheduledDate' => ['scheduled_date', 'getScheduledDate', 'setScheduledDate'], 'invoiceNumber' => ['invoice_number', 'getInvoiceNumber', 'setInvoiceNumber'], 'total' => ['total', 'getTotal', 'setTotal'], 'status' => ['status', 'getStatus', 'setStatus']];
    }
}