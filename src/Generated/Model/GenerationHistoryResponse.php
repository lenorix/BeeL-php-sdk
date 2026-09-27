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
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $invoiceId;

    /**
     * @var \DateTime
     */
    protected $generatedAt;

    /**
     * @var \DateTime
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

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;

        return $this;
    }

    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(string $invoiceId): self
    {
        $this->initialized['invoiceId'] = true;
        $this->invoiceId = $invoiceId;

        return $this;
    }

    public function getGeneratedAt(): \DateTime
    {
        return $this->generatedAt;
    }

    public function setGeneratedAt(\DateTime $generatedAt): self
    {
        $this->initialized['generatedAt'] = true;
        $this->generatedAt = $generatedAt;

        return $this;
    }

    public function getScheduledDate(): \DateTime
    {
        return $this->scheduledDate;
    }

    public function setScheduledDate(\DateTime $scheduledDate): self
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
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }

    /**
     * Total amount of the generated invoice, `null` under the same conditions as
    `invoice_number`. Resolved on read, so it always reflects the invoice as it is now.
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
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Current status of the generated invoice, `null` under the same conditions as
    `invoice_number`. Resolved on read and never stored on the history row: an entry
    generated months ago reports what its invoice is TODAY, not what it was when born.
     */
    public function setStatus(?string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'invoiceId' => ['invoice_id', 'getInvoiceId', 'setInvoiceId'], 'generatedAt' => ['generated_at', 'getGeneratedAt', 'setGeneratedAt'], 'scheduledDate' => ['scheduled_date', 'getScheduledDate', 'setScheduledDate'], 'invoiceNumber' => ['invoice_number', 'getInvoiceNumber', 'setInvoiceNumber'], 'total' => ['total', 'getTotal', 'setTotal'], 'status' => ['status', 'getStatus', 'setStatus']];
    }
}
