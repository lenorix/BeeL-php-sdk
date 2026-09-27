<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ManagedPaymentEvent implements AdditionalPropertiesInterface
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
     * Identifier of the payment event.
     *
     * @var string
     */
    protected $id;

    /**
     * Payment provider slug (lowercase).
     *
     * @var string
     */
    protected $provider;

    /**
     * Raw event name as the provider emitted it. Preserved verbatim so you can trace the
     * event back on the provider's side. Not filterable — filter by `event_kind`.
     *
     *
     * @var string
     */
    protected $eventType;

    /**
     * What the event is about, once `event_type` has been classified. This is the value the
     * `event_kind` filter takes, so what you read here you can ask for again.
     *
     *
     * @var string
     */
    protected $eventKind;

    /**
     * Provider-side event identifier.
     *
     * @var string
     */
    protected $externalEventId;

    /**
     * Canonical identity of the payment at the provider. On Stripe this is always the
     * PaymentIntent id (`pi_…`), so every event of the same payment carries the same value
     * and can be grouped by it. Null while the identity is not yet resolved.
     * To trace the event back to the object that delivered it, use `source_object_id`.
     *
     *
     * @var string|null
     */
    protected $externalPaymentId;

    /**
     * Provider object that delivered this event (`in_…`, `cs_…`, `ch_…`, `pi_…`). Use it to
     * open the originating invoice, checkout session or charge at the provider. It is an
     * audit trail only: it never identifies the payment — `external_payment_id` does.
     *
     *
     * @var string|null
     */
    protected $sourceObjectId;

    /**
     * ISO 4217 currency of the event. Absent on an event that moves no money — a failed
     * intent, or a provider notice we do not classify — and then `amount` is absent too.
     *
     *
     * @var string|null
     */
    protected $currency;

    /**
     * Amount the event carries. Absent whenever `currency` is: the two travel together, so
     * an amount never arrives without the currency that gives it meaning.
     *
     *
     * @var float|null
     */
    protected $amount;

    /**
     * Provider fee, when reported.
     *
     * @var float|null
     */
    protected $feeAmount;

    /**
     * Amount net of the provider fee, when reported.
     *
     * @var float|null
     */
    protected $netAmount;

    /**
     * Which product line the money came from, resolved when the event was processed. Not the
     * same as `event_kind`: that one says what happened, this one says where it came from.
     * `null` when the event does not fall in any category, or when it predates the field.
     *
     *
     * @var string|null
     */
    protected $category;

    /**
     * Whether money actually went back to the payer through the provider. Always `true` for
     * a refund. For a credit note it is `true` only when the note settles provider refunds:
     * a note credited against an unpaid invoice, or settled outside the provider, corrects
     * the same amount without moving any money. `null` when the concept does not apply, as
     * on a charge.
     *
     *
     * @var bool|null
     */
    protected $moneyReturned;

    /**
     * Payer email reported by the provider.
     *
     * @var string|null
     */
    protected $customerEmail;

    /**
     * Payer name reported by the provider.
     *
     * @var string|null
     */
    protected $customerName;

    /**
     * Processing status of a payment event.
     *
     * - RECEIVED: queued, awaiting processing
     * - PROCESSING: in flight
     * - PROCESSED: invoice was created (`invoice_id` is set)
     * - FAILED: processing failed (see failure_reason / failure_message)
     * - SKIPPED: filtered out by user rules (see skip_reason)
     * - MANUALLY_RESOLVED: operator marked it as resolved outside BeeL — terminal
     *
     *
     * @var string
     */
    protected $status;

    /**
     * Invoice generated from the event, when there is one.
     *
     * @var string|null
     */
    protected $invoiceId;

    /**
     * Number of the invoice generated from the event. `null` while that invoice is still a
     * draft — a draft has no number yet — and `null` when the event produced no invoice.
     *
     *
     * @var string|null
     */
    protected $invoiceNumber;

    /**
     * High-level cause of the failure, when the event did not complete. Same vocabulary the
     * `failure_category` filter takes.
     *
     *
     * @var string|null
     */
    protected $failureCategory;

    /**
     * Stable failure code you can branch on.
     *
     * @var string|null
     */
    protected $failureReason;

    /**
     * Readable explanation of the failure, in the language of the request.
     *
     * @var string|null
     */
    protected $failureMessage;

    /**
     * Whether the event did not complete and is still worth acting on. Events that failed
     * for reasons outside your control are excluded.
     *
     *
     * @var bool
     */
    protected $needsAction;

    /**
     * Whether a draft invoice can be generated from this event. When `false`, the draft
     * operation would be rejected.
     *
     *
     * @var bool
     */
    protected $draftAvailable;

    /**
     * Whether retrying this event would be accepted right now. Do not derive it from
     * `status`: a skipped event may still be recoverable, and a failed one with no
     * retries left is not.
     *
     *
     * @var bool
     */
    protected $retryAvailable;

    /**
     * Whether this event can be discarded — taken out of the list. When `false`, the
     * discard operation would be rejected.
     *
     * An event that is `PROCESSED` or `PROCESSING` cannot be discarded: it has (or is
     * about to have) an invoice that already went through VeriFactu, and hiding it would
     * break the audit trail. Do not derive it from `status`: read this flag.
     *
     * Already-discarded events keep the flag they would have — what applies to them is
     * restore, not discard.
     *
     *
     * @var bool
     */
    protected $discardAvailable;

    /**
     * Retries charged to the event: those that ended in an outcome attributable to it.
     * A retry that failed for a transient cause outside the event is not counted.
     *
     *
     * @var int
     */
    protected $retryCount;

    /**
     * When the event was received.
     *
     * @var \DateTime
     */
    protected $receivedAt;

    /**
     * When processing of the event finished.
     *
     * @var \DateTime|null
     */
    protected $processedAt;

    /**
     * Charge description as the provider reported it. It is what the description filters of
     * the connection match against, so it is what makes them auditable.
     *
     *
     * @var string|null
     */
    protected $description;

    /**
     * How the charge was paid, when the provider reported it. `null` means the provider
     * did not report a method for this event.
     *
     *
     * @var string|null
     */
    protected $paymentMethod;

    /**
     * Whether the event was discarded (soft-deleted) and is hidden by default.
     *
     * @var bool
     */
    protected $discarded;

    /**
     * When the event was discarded, when it is.
     *
     * @var \DateTime|null
     */
    protected $discardedAt;

    /**
     * Identifier of the payment event.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Identifier of the payment event.
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;

        return $this;
    }

    /**
     * Payment provider slug (lowercase).
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * Payment provider slug (lowercase).
     */
    public function setProvider(string $provider): self
    {
        $this->initialized['provider'] = true;
        $this->provider = $provider;

        return $this;
    }

    /**
     * Raw event name as the provider emitted it. Preserved verbatim so you can trace the
     * event back on the provider's side. Not filterable — filter by `event_kind`.
     */
    public function getEventType(): string
    {
        return $this->eventType;
    }

    /**
     * Raw event name as the provider emitted it. Preserved verbatim so you can trace the
    event back on the provider's side. Not filterable — filter by `event_kind`.
     */
    public function setEventType(string $eventType): self
    {
        $this->initialized['eventType'] = true;
        $this->eventType = $eventType;

        return $this;
    }

    /**
     * What the event is about, once `event_type` has been classified. This is the value the
     * `event_kind` filter takes, so what you read here you can ask for again.
     */
    public function getEventKind(): string
    {
        return $this->eventKind;
    }

    /**
     * What the event is about, once `event_type` has been classified. This is the value the
    `event_kind` filter takes, so what you read here you can ask for again.
     */
    public function setEventKind(string $eventKind): self
    {
        $this->initialized['eventKind'] = true;
        $this->eventKind = $eventKind;

        return $this;
    }

    /**
     * Provider-side event identifier.
     */
    public function getExternalEventId(): string
    {
        return $this->externalEventId;
    }

    /**
     * Provider-side event identifier.
     */
    public function setExternalEventId(string $externalEventId): self
    {
        $this->initialized['externalEventId'] = true;
        $this->externalEventId = $externalEventId;

        return $this;
    }

    /**
     * Canonical identity of the payment at the provider. On Stripe this is always the
     * PaymentIntent id (`pi_…`), so every event of the same payment carries the same value
     * and can be grouped by it. Null while the identity is not yet resolved.
     * To trace the event back to the object that delivered it, use `source_object_id`.
     */
    public function getExternalPaymentId(): ?string
    {
        return $this->externalPaymentId;
    }

    /**
     * Canonical identity of the payment at the provider. On Stripe this is always the
    PaymentIntent id (`pi_…`), so every event of the same payment carries the same value
    and can be grouped by it. Null while the identity is not yet resolved.
    To trace the event back to the object that delivered it, use `source_object_id`.
     */
    public function setExternalPaymentId(?string $externalPaymentId): self
    {
        $this->initialized['externalPaymentId'] = true;
        $this->externalPaymentId = $externalPaymentId;

        return $this;
    }

    /**
     * Provider object that delivered this event (`in_…`, `cs_…`, `ch_…`, `pi_…`). Use it to
     * open the originating invoice, checkout session or charge at the provider. It is an
     * audit trail only: it never identifies the payment — `external_payment_id` does.
     */
    public function getSourceObjectId(): ?string
    {
        return $this->sourceObjectId;
    }

    /**
     * Provider object that delivered this event (`in_…`, `cs_…`, `ch_…`, `pi_…`). Use it to
    open the originating invoice, checkout session or charge at the provider. It is an
    audit trail only: it never identifies the payment — `external_payment_id` does.
     */
    public function setSourceObjectId(?string $sourceObjectId): self
    {
        $this->initialized['sourceObjectId'] = true;
        $this->sourceObjectId = $sourceObjectId;

        return $this;
    }

    /**
     * ISO 4217 currency of the event. Absent on an event that moves no money — a failed
     * intent, or a provider notice we do not classify — and then `amount` is absent too.
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * ISO 4217 currency of the event. Absent on an event that moves no money — a failed
    intent, or a provider notice we do not classify — and then `amount` is absent too.
     */
    public function setCurrency(?string $currency): self
    {
        $this->initialized['currency'] = true;
        $this->currency = $currency;

        return $this;
    }

    /**
     * Amount the event carries. Absent whenever `currency` is: the two travel together, so
     * an amount never arrives without the currency that gives it meaning.
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * Amount the event carries. Absent whenever `currency` is: the two travel together, so
    an amount never arrives without the currency that gives it meaning.
     */
    public function setAmount(?float $amount): self
    {
        $this->initialized['amount'] = true;
        $this->amount = $amount;

        return $this;
    }

    /**
     * Provider fee, when reported.
     */
    public function getFeeAmount(): ?float
    {
        return $this->feeAmount;
    }

    /**
     * Provider fee, when reported.
     */
    public function setFeeAmount(?float $feeAmount): self
    {
        $this->initialized['feeAmount'] = true;
        $this->feeAmount = $feeAmount;

        return $this;
    }

    /**
     * Amount net of the provider fee, when reported.
     */
    public function getNetAmount(): ?float
    {
        return $this->netAmount;
    }

    /**
     * Amount net of the provider fee, when reported.
     */
    public function setNetAmount(?float $netAmount): self
    {
        $this->initialized['netAmount'] = true;
        $this->netAmount = $netAmount;

        return $this;
    }

    /**
     * Which product line the money came from, resolved when the event was processed. Not the
     * same as `event_kind`: that one says what happened, this one says where it came from.
     * `null` when the event does not fall in any category, or when it predates the field.
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * Which product line the money came from, resolved when the event was processed. Not the
    same as `event_kind`: that one says what happened, this one says where it came from.
    `null` when the event does not fall in any category, or when it predates the field.
     */
    public function setCategory(?string $category): self
    {
        $this->initialized['category'] = true;
        $this->category = $category;

        return $this;
    }

    /**
     * Whether money actually went back to the payer through the provider. Always `true` for
     * a refund. For a credit note it is `true` only when the note settles provider refunds:
     * a note credited against an unpaid invoice, or settled outside the provider, corrects
     * the same amount without moving any money. `null` when the concept does not apply, as
     * on a charge.
     */
    public function getMoneyReturned(): ?bool
    {
        return $this->moneyReturned;
    }

    /**
     * Whether money actually went back to the payer through the provider. Always `true` for
    a refund. For a credit note it is `true` only when the note settles provider refunds:
    a note credited against an unpaid invoice, or settled outside the provider, corrects
    the same amount without moving any money. `null` when the concept does not apply, as
    on a charge.
     */
    public function setMoneyReturned(?bool $moneyReturned): self
    {
        $this->initialized['moneyReturned'] = true;
        $this->moneyReturned = $moneyReturned;

        return $this;
    }

    /**
     * Payer email reported by the provider.
     */
    public function getCustomerEmail(): ?string
    {
        return $this->customerEmail;
    }

    /**
     * Payer email reported by the provider.
     */
    public function setCustomerEmail(?string $customerEmail): self
    {
        $this->initialized['customerEmail'] = true;
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * Payer name reported by the provider.
     */
    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    /**
     * Payer name reported by the provider.
     */
    public function setCustomerName(?string $customerName): self
    {
        $this->initialized['customerName'] = true;
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * Processing status of a payment event.
     *
     * - RECEIVED: queued, awaiting processing
     * - PROCESSING: in flight
     * - PROCESSED: invoice was created (`invoice_id` is set)
     * - FAILED: processing failed (see failure_reason / failure_message)
     * - SKIPPED: filtered out by user rules (see skip_reason)
     * - MANUALLY_RESOLVED: operator marked it as resolved outside BeeL — terminal
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Processing status of a payment event.

    - RECEIVED: queued, awaiting processing
    - PROCESSING: in flight
    - PROCESSED: invoice was created (`invoice_id` is set)
    - FAILED: processing failed (see failure_reason / failure_message)
    - SKIPPED: filtered out by user rules (see skip_reason)
    - MANUALLY_RESOLVED: operator marked it as resolved outside BeeL — terminal
     */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

        return $this;
    }

    /**
     * Invoice generated from the event, when there is one.
     */
    public function getInvoiceId(): ?string
    {
        return $this->invoiceId;
    }

    /**
     * Invoice generated from the event, when there is one.
     */
    public function setInvoiceId(?string $invoiceId): self
    {
        $this->initialized['invoiceId'] = true;
        $this->invoiceId = $invoiceId;

        return $this;
    }

    /**
     * Number of the invoice generated from the event. `null` while that invoice is still a
     * draft — a draft has no number yet — and `null` when the event produced no invoice.
     */
    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    /**
     * Number of the invoice generated from the event. `null` while that invoice is still a
    draft — a draft has no number yet — and `null` when the event produced no invoice.
     */
    public function setInvoiceNumber(?string $invoiceNumber): self
    {
        $this->initialized['invoiceNumber'] = true;
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * High-level cause of the failure, when the event did not complete. Same vocabulary the
     * `failure_category` filter takes.
     */
    public function getFailureCategory(): ?string
    {
        return $this->failureCategory;
    }

    /**
     * High-level cause of the failure, when the event did not complete. Same vocabulary the
    `failure_category` filter takes.
     */
    public function setFailureCategory(?string $failureCategory): self
    {
        $this->initialized['failureCategory'] = true;
        $this->failureCategory = $failureCategory;

        return $this;
    }

    /**
     * Stable failure code you can branch on.
     */
    public function getFailureReason(): ?string
    {
        return $this->failureReason;
    }

    /**
     * Stable failure code you can branch on.
     */
    public function setFailureReason(?string $failureReason): self
    {
        $this->initialized['failureReason'] = true;
        $this->failureReason = $failureReason;

        return $this;
    }

    /**
     * Readable explanation of the failure, in the language of the request.
     */
    public function getFailureMessage(): ?string
    {
        return $this->failureMessage;
    }

    /**
     * Readable explanation of the failure, in the language of the request.
     */
    public function setFailureMessage(?string $failureMessage): self
    {
        $this->initialized['failureMessage'] = true;
        $this->failureMessage = $failureMessage;

        return $this;
    }

    /**
     * Whether the event did not complete and is still worth acting on. Events that failed
     * for reasons outside your control are excluded.
     */
    public function getNeedsAction(): bool
    {
        return $this->needsAction;
    }

    /**
     * Whether the event did not complete and is still worth acting on. Events that failed
    for reasons outside your control are excluded.
     */
    public function setNeedsAction(bool $needsAction): self
    {
        $this->initialized['needsAction'] = true;
        $this->needsAction = $needsAction;

        return $this;
    }

    /**
     * Whether a draft invoice can be generated from this event. When `false`, the draft
     * operation would be rejected.
     */
    public function getDraftAvailable(): bool
    {
        return $this->draftAvailable;
    }

    /**
     * Whether a draft invoice can be generated from this event. When `false`, the draft
    operation would be rejected.
     */
    public function setDraftAvailable(bool $draftAvailable): self
    {
        $this->initialized['draftAvailable'] = true;
        $this->draftAvailable = $draftAvailable;

        return $this;
    }

    /**
     * Whether retrying this event would be accepted right now. Do not derive it from
     * `status`: a skipped event may still be recoverable, and a failed one with no
     * retries left is not.
     */
    public function getRetryAvailable(): bool
    {
        return $this->retryAvailable;
    }

    /**
     * Whether retrying this event would be accepted right now. Do not derive it from
    `status`: a skipped event may still be recoverable, and a failed one with no
    retries left is not.
     */
    public function setRetryAvailable(bool $retryAvailable): self
    {
        $this->initialized['retryAvailable'] = true;
        $this->retryAvailable = $retryAvailable;

        return $this;
    }

    /**
     * Whether this event can be discarded — taken out of the list. When `false`, the
     * discard operation would be rejected.
     *
     * An event that is `PROCESSED` or `PROCESSING` cannot be discarded: it has (or is
     * about to have) an invoice that already went through VeriFactu, and hiding it would
     * break the audit trail. Do not derive it from `status`: read this flag.
     *
     * Already-discarded events keep the flag they would have — what applies to them is
     * restore, not discard.
     */
    public function getDiscardAvailable(): bool
    {
        return $this->discardAvailable;
    }

    /**
     * Whether this event can be discarded — taken out of the list. When `false`, the
    discard operation would be rejected.

    An event that is `PROCESSED` or `PROCESSING` cannot be discarded: it has (or is
    about to have) an invoice that already went through VeriFactu, and hiding it would
    break the audit trail. Do not derive it from `status`: read this flag.

    Already-discarded events keep the flag they would have — what applies to them is
    restore, not discard.
     */
    public function setDiscardAvailable(bool $discardAvailable): self
    {
        $this->initialized['discardAvailable'] = true;
        $this->discardAvailable = $discardAvailable;

        return $this;
    }

    /**
     * Retries charged to the event: those that ended in an outcome attributable to it.
     * A retry that failed for a transient cause outside the event is not counted.
     */
    public function getRetryCount(): int
    {
        return $this->retryCount;
    }

    /**
     * Retries charged to the event: those that ended in an outcome attributable to it.
    A retry that failed for a transient cause outside the event is not counted.
     */
    public function setRetryCount(int $retryCount): self
    {
        $this->initialized['retryCount'] = true;
        $this->retryCount = $retryCount;

        return $this;
    }

    /**
     * When the event was received.
     */
    public function getReceivedAt(): \DateTime
    {
        return $this->receivedAt;
    }

    /**
     * When the event was received.
     */
    public function setReceivedAt(\DateTime $receivedAt): self
    {
        $this->initialized['receivedAt'] = true;
        $this->receivedAt = $receivedAt;

        return $this;
    }

    /**
     * When processing of the event finished.
     */
    public function getProcessedAt(): ?\DateTime
    {
        return $this->processedAt;
    }

    /**
     * When processing of the event finished.
     */
    public function setProcessedAt(?\DateTime $processedAt): self
    {
        $this->initialized['processedAt'] = true;
        $this->processedAt = $processedAt;

        return $this;
    }

    /**
     * Charge description as the provider reported it. It is what the description filters of
     * the connection match against, so it is what makes them auditable.
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Charge description as the provider reported it. It is what the description filters of
    the connection match against, so it is what makes them auditable.
     */
    public function setDescription(?string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;

        return $this;
    }

    /**
     * How the charge was paid, when the provider reported it. `null` means the provider
     * did not report a method for this event.
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * How the charge was paid, when the provider reported it. `null` means the provider
    did not report a method for this event.
     */
    public function setPaymentMethod(?string $paymentMethod): self
    {
        $this->initialized['paymentMethod'] = true;
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Whether the event was discarded (soft-deleted) and is hidden by default.
     */
    public function getDiscarded(): bool
    {
        return $this->discarded;
    }

    /**
     * Whether the event was discarded (soft-deleted) and is hidden by default.
     */
    public function setDiscarded(bool $discarded): self
    {
        $this->initialized['discarded'] = true;
        $this->discarded = $discarded;

        return $this;
    }

    /**
     * When the event was discarded, when it is.
     */
    public function getDiscardedAt(): ?\DateTime
    {
        return $this->discardedAt;
    }

    /**
     * When the event was discarded, when it is.
     */
    public function setDiscardedAt(?\DateTime $discardedAt): self
    {
        $this->initialized['discardedAt'] = true;
        $this->discardedAt = $discardedAt;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'provider' => ['provider', 'getProvider', 'setProvider'], 'eventType' => ['event_type', 'getEventType', 'setEventType'], 'eventKind' => ['event_kind', 'getEventKind', 'setEventKind'], 'externalEventId' => ['external_event_id', 'getExternalEventId', 'setExternalEventId'], 'externalPaymentId' => ['external_payment_id', 'getExternalPaymentId', 'setExternalPaymentId'], 'sourceObjectId' => ['source_object_id', 'getSourceObjectId', 'setSourceObjectId'], 'currency' => ['currency', 'getCurrency', 'setCurrency'], 'amount' => ['amount', 'getAmount', 'setAmount'], 'feeAmount' => ['fee_amount', 'getFeeAmount', 'setFeeAmount'], 'netAmount' => ['net_amount', 'getNetAmount', 'setNetAmount'], 'category' => ['category', 'getCategory', 'setCategory'], 'moneyReturned' => ['money_returned', 'getMoneyReturned', 'setMoneyReturned'], 'customerEmail' => ['customer_email', 'getCustomerEmail', 'setCustomerEmail'], 'customerName' => ['customer_name', 'getCustomerName', 'setCustomerName'], 'status' => ['status', 'getStatus', 'setStatus'], 'invoiceId' => ['invoice_id', 'getInvoiceId', 'setInvoiceId'], 'invoiceNumber' => ['invoice_number', 'getInvoiceNumber', 'setInvoiceNumber'], 'failureCategory' => ['failure_category', 'getFailureCategory', 'setFailureCategory'], 'failureReason' => ['failure_reason', 'getFailureReason', 'setFailureReason'], 'failureMessage' => ['failure_message', 'getFailureMessage', 'setFailureMessage'], 'needsAction' => ['needs_action', 'getNeedsAction', 'setNeedsAction'], 'draftAvailable' => ['draft_available', 'getDraftAvailable', 'setDraftAvailable'], 'retryAvailable' => ['retry_available', 'getRetryAvailable', 'setRetryAvailable'], 'discardAvailable' => ['discard_available', 'getDiscardAvailable', 'setDiscardAvailable'], 'retryCount' => ['retry_count', 'getRetryCount', 'setRetryCount'], 'receivedAt' => ['received_at', 'getReceivedAt', 'setReceivedAt'], 'processedAt' => ['processed_at', 'getProcessedAt', 'setProcessedAt'], 'description' => ['description', 'getDescription', 'setDescription'], 'paymentMethod' => ['payment_method', 'getPaymentMethod', 'setPaymentMethod'], 'discarded' => ['discarded', 'getDiscarded', 'setDiscarded'], 'discardedAt' => ['discarded_at', 'getDiscardedAt', 'setDiscardedAt']];
    }
}
