<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class RecurringInvoiceResponse implements AdditionalPropertiesInterface
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
    protected $name;

    /**
     * Billing cadence of the template: every 1, 3 or 12 months. The day it falls on is
     * `day_of_month`, the same anchor for all three. Set it when you create the template;
     * a template created without it is `MONTHLY`.
     *
     * The cadence governs the step from the first invoice onwards, not where that first one
     * lands: the first occurrence is the first `day_of_month` on or after `start_date`, found
     * one month at a time. A yearly template starting 15 February with `day_of_month` 10 first
     * invoices on 10 March, then every 10 March after that.
     *
     *
     * @var string
     */
    protected $frequency;

    /**
     * Day of the month the invoices are issued, as it was requested: this is the anchor of
     * the schedule, not the day the last invoice happened to land on. A month that does not
     * have that day falls back to its last day, so `next_generation` can show a different
     * day than this one — a template on `31` generates on 28 February (29 in a leap year)
     * and on 30 April.
     *
     * The adjustment never sticks and the schedule does not drift: every generation is
     * recalculated from this value, never from the date it was adjusted to
     * (31 Jan → 28 Feb → 31 Mar).
     *
     *
     * @var int
     */
    protected $dayOfMonth;

    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime|null
     */
    protected $endDate;

    /**
     * Date the next invoice is generated — the one this template is actually going to honour.
     * `null`, always present and never omitted, when there is none.
     *
     * There is none in two cases, and only in those two:
     *
     * - the template is `COMPLETED`: the date left on it is the one that ran past its end and
     *   triggered the closure, not a generation still to come;
     * - the template is `PAUSED` and its date is strictly in the past: resuming does not go
     *   back to it — it reschedules from today onwards, so that date will never be invoiced.
     *
     * An `ACTIVE` template always carries its date, **including a date already in the past**:
     * that is the occurrence about to be generated, and it is your only notice that
     * an invoice is on its way.
     *
     * A `PAUSED` template whose date is still ahead — today counts as ahead — carries it too:
     * it is exactly the date resuming would keep.
     *
     * The stored schedule is never rewritten by any of this. `next_generation` is what gets
     * published, not what gets kept: resuming a long-paused template still reschedules from
     * its own anchor, as it always did.
     *
     *
     * @var \DateTime|null
     */
    protected $nextGeneration;

    /**
     * Whether this template prepares a draft for review before emitting. The review window is
     * fixed at 5 days: `true` creates the draft 5 days ahead, `false` goes straight to the
     * emission. Either way the invoice is emitted on the scheduled `day_of_month` — what
     * changes is only whether there is a draft to look at first.
     *
     *
     * @var bool
     */
    protected $draftInAdvance;

    /**
     * @var string
     */
    protected $status;

    /**
     * Why this schedule is paused. Present while `status` is `PAUSED`; absent otherwise, and also
     * absent for schedules paused before this was recorded.
     *
     * `PAUSED` covers three facts that are not interchangeable: someone paused it, a plan downgrade
     * paused it, or an unattended generation failed with something waiting will not fix. A transient
     * failure (network, timeout, tax authority downtime) does NOT pause the schedule — the next run
     * retries it.
     *
     *
     * @var RecurringInvoicePause|null
     */
    protected $pause;

    /**
     * Why this schedule ended. Present while `status` is `COMPLETED`; absent otherwise, and also
     * absent for schedules completed before this was recorded — that cause is not known and is not
     * invented.
     *
     * `COMPLETED` covers facts that are not interchangeable: the owner ended it, the calendar ran
     * out, or the agreed number of invoices did. It stays a **single** terminal status and `status` keeps its three values: no business rule
     * branches on the cause, and a new status value would break every exhaustive `switch`. New causes
     * land in `reason`, so treat it as an open set.
     *
     *
     * @var RecurringInvoiceCompletion|null
     */
    protected $completion;

    /**
     * @var string
     */
    protected $seriesId;

    /**
     * @var string
     */
    protected $seriesCode;

    /**
     * @var string
     */
    protected $invoiceType;

    /**
     * @var string|null
     */
    protected $customerId;

    /**
     * @var string|null
     */
    protected $recipientFiscalName;

    /**
     * Spanish Tax ID of the recipient. Mutually exclusive with `recipient_alternative_id`:
     * a recipient is identified by exactly one of the two, never both, and `null` when the
     * other one carries the identifier (or when there is no recipient identified at all).
     *
     *
     * @var string|null
     */
    protected $recipientNif;

    /**
     * @var RecurringInvoiceResponseRecipientAlternativeId
     */
    protected $recipientAlternativeId;

    /**
     * @var list<InvoiceLineTemplateResponse>
     */
    protected $lines;

    /**
     * What the customer will be asked to transfer on the next invoice this template
     * generates: taxable base + VAT + equivalence surcharge − IRPF withholding +
     * disbursements (`suplidos`). It is NOT the taxable base and NOT the total with VAT:
     * the withholding is already subtracted.
     *
     * The same number the next occurrence publishes as `total_to_pay`, to the cent: both
     * come from the template's own lines through the same line pipeline the real generation
     * uses. It is computed on the fly and stored nowhere, so it always reflects the lines
     * the template carries right now — and it is not sortable or filterable for that reason.
     *
     * `null` when the template's lines cannot be priced (no lines, or lines the engine
     * rejects). The rest of the template is still returned.
     *
     *
     * @var float|null
     */
    protected $amount;

    /**
     * @var string|null
     */
    protected $paymentMethod;

    /**
     * Full IBAN of the template's own payment method, mirrored from what was sent when it
     * was set. `null` when the template has no payment method.
     *
     *
     * @var string|null
     */
    protected $paymentIban;

    /**
     * SWIFT/BIC code of the template's own payment method. `null` when the template has no
     * payment method, or when it has one without a SWIFT code.
     *
     *
     * @var string|null
     */
    protected $paymentSwift;

    /**
     * Payment term, in days, of the template's own payment method. `null` when the template
     * has no payment method, or when it has one without a declared term.
     *
     *
     * @var int|null
     */
    protected $paymentTermDays;

    /**
     * @var string|null
     */
    protected $notes;

    /**
     * @var bool
     */
    protected $sendAutomatically;

    /**
     * @var RecurringEmailConfigResponse|null
     */
    protected $emailConfiguration;

    /**
     * @var int
     */
    protected $generatedInvoices;

    /**
     * Total number of invoices agreed for this template, or absent when the recurrence is not
     * capped by number. It is the TOTAL agreed, not what is left: "remaining" is
     * `max_invoices - generated_invoices`, a derived reading with no field of its own — two
     * counters of the same fact drift, and the day they do nobody knows which one is true.
     *
     * What counts against it are invoices GENERATED, not calendar turns: a skip does not spend
     * cap because it produces no invoice, and a `generate now` does because it produces a real
     * fiscal invoice. When the last one is generated the template is closed in the act, with
     * `completion.reason = MAX_INVOICES_REACHED`.
     *
     *
     * @var int|null
     */
    protected $maxInvoices;

    /**
     * @var \DateTime|null
     */
    protected $lastGeneratedAt;

    /**
     * @var string|null
     */
    protected $sourceInvoiceId;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;

        return $this;
    }

    /**
     * Billing cadence of the template: every 1, 3 or 12 months. The day it falls on is
     * `day_of_month`, the same anchor for all three. Set it when you create the template;
     * a template created without it is `MONTHLY`.
     *
     * The cadence governs the step from the first invoice onwards, not where that first one
     * lands: the first occurrence is the first `day_of_month` on or after `start_date`, found
     * one month at a time. A yearly template starting 15 February with `day_of_month` 10 first
     * invoices on 10 March, then every 10 March after that.
     */
    public function getFrequency(): string
    {
        return $this->frequency;
    }

    /**
     * Billing cadence of the template: every 1, 3 or 12 months. The day it falls on is
    `day_of_month`, the same anchor for all three. Set it when you create the template;
    a template created without it is `MONTHLY`.

    The cadence governs the step from the first invoice onwards, not where that first one
    lands: the first occurrence is the first `day_of_month` on or after `start_date`, found
    one month at a time. A yearly template starting 15 February with `day_of_month` 10 first
    invoices on 10 March, then every 10 March after that.
     */
    public function setFrequency(string $frequency): self
    {
        $this->initialized['frequency'] = true;
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Day of the month the invoices are issued, as it was requested: this is the anchor of
     * the schedule, not the day the last invoice happened to land on. A month that does not
     * have that day falls back to its last day, so `next_generation` can show a different
     * day than this one — a template on `31` generates on 28 February (29 in a leap year)
     * and on 30 April.
     *
     * The adjustment never sticks and the schedule does not drift: every generation is
     * recalculated from this value, never from the date it was adjusted to
     * (31 Jan → 28 Feb → 31 Mar).
     */
    public function getDayOfMonth(): int
    {
        return $this->dayOfMonth;
    }

    /**
     * Day of the month the invoices are issued, as it was requested: this is the anchor of
    the schedule, not the day the last invoice happened to land on. A month that does not
    have that day falls back to its last day, so `next_generation` can show a different
    day than this one — a template on `31` generates on 28 February (29 in a leap year)
    and on 30 April.

    The adjustment never sticks and the schedule does not drift: every generation is
    recalculated from this value, never from the date it was adjusted to
    (31 Jan → 28 Feb → 31 Mar).
     */
    public function setDayOfMonth(int $dayOfMonth): self
    {
        $this->initialized['dayOfMonth'] = true;
        $this->dayOfMonth = $dayOfMonth;

        return $this;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate): self
    {
        $this->initialized['startDate'] = true;
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): self
    {
        $this->initialized['endDate'] = true;
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Date the next invoice is generated — the one this template is actually going to honour.
     * `null`, always present and never omitted, when there is none.
     *
     * There is none in two cases, and only in those two:
     *
     * - the template is `COMPLETED`: the date left on it is the one that ran past its end and
     *   triggered the closure, not a generation still to come;
     * - the template is `PAUSED` and its date is strictly in the past: resuming does not go
     *   back to it — it reschedules from today onwards, so that date will never be invoiced.
     *
     * An `ACTIVE` template always carries its date, **including a date already in the past**:
     * that is the occurrence about to be generated, and it is your only notice that
     * an invoice is on its way.
     *
     * A `PAUSED` template whose date is still ahead — today counts as ahead — carries it too:
     * it is exactly the date resuming would keep.
     *
     * The stored schedule is never rewritten by any of this. `next_generation` is what gets
     * published, not what gets kept: resuming a long-paused template still reschedules from
     * its own anchor, as it always did.
     */
    public function getNextGeneration(): ?\DateTime
    {
        return $this->nextGeneration;
    }

    /**
     * Date the next invoice is generated — the one this template is actually going to honour.
    `null`, always present and never omitted, when there is none.

    There is none in two cases, and only in those two:

    - the template is `COMPLETED`: the date left on it is the one that ran past its end and
     triggered the closure, not a generation still to come;
    - the template is `PAUSED` and its date is strictly in the past: resuming does not go
     back to it — it reschedules from today onwards, so that date will never be invoiced.

    An `ACTIVE` template always carries its date, **including a date already in the past**:
    that is the occurrence about to be generated, and it is your only notice that
    an invoice is on its way.

    A `PAUSED` template whose date is still ahead — today counts as ahead — carries it too:
    it is exactly the date resuming would keep.

    The stored schedule is never rewritten by any of this. `next_generation` is what gets
    published, not what gets kept: resuming a long-paused template still reschedules from
    its own anchor, as it always did.
     */
    public function setNextGeneration(?\DateTime $nextGeneration): self
    {
        $this->initialized['nextGeneration'] = true;
        $this->nextGeneration = $nextGeneration;

        return $this;
    }

    /**
     * Whether this template prepares a draft for review before emitting. The review window is
     * fixed at 5 days: `true` creates the draft 5 days ahead, `false` goes straight to the
     * emission. Either way the invoice is emitted on the scheduled `day_of_month` — what
     * changes is only whether there is a draft to look at first.
     */
    public function getDraftInAdvance(): bool
    {
        return $this->draftInAdvance;
    }

    /**
     * Whether this template prepares a draft for review before emitting. The review window is
    fixed at 5 days: `true` creates the draft 5 days ahead, `false` goes straight to the
    emission. Either way the invoice is emitted on the scheduled `day_of_month` — what
    changes is only whether there is a draft to look at first.
     */
    public function setDraftInAdvance(bool $draftInAdvance): self
    {
        $this->initialized['draftInAdvance'] = true;
        $this->draftInAdvance = $draftInAdvance;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

        return $this;
    }

    /**
     * Why this schedule is paused. Present while `status` is `PAUSED`; absent otherwise, and also
     * absent for schedules paused before this was recorded.
     *
     * `PAUSED` covers three facts that are not interchangeable: someone paused it, a plan downgrade
     * paused it, or an unattended generation failed with something waiting will not fix. A transient
     * failure (network, timeout, tax authority downtime) does NOT pause the schedule — the next run
     * retries it.
     */
    public function getPause(): ?RecurringInvoicePause
    {
        return $this->pause;
    }

    /**
     * Why this schedule is paused. Present while `status` is `PAUSED`; absent otherwise, and also
    absent for schedules paused before this was recorded.

    `PAUSED` covers three facts that are not interchangeable: someone paused it, a plan downgrade
    paused it, or an unattended generation failed with something waiting will not fix. A transient
    failure (network, timeout, tax authority downtime) does NOT pause the schedule — the next run
    retries it.
     */
    public function setPause(?RecurringInvoicePause $pause): self
    {
        $this->initialized['pause'] = true;
        $this->pause = $pause;

        return $this;
    }

    /**
     * Why this schedule ended. Present while `status` is `COMPLETED`; absent otherwise, and also
     * absent for schedules completed before this was recorded — that cause is not known and is not
     * invented.
     *
     * `COMPLETED` covers facts that are not interchangeable: the owner ended it, the calendar ran
     * out, or the agreed number of invoices did. It stays a **single** terminal status and `status` keeps its three values: no business rule
     * branches on the cause, and a new status value would break every exhaustive `switch`. New causes
     * land in `reason`, so treat it as an open set.
     */
    public function getCompletion(): ?RecurringInvoiceCompletion
    {
        return $this->completion;
    }

    /**
     * Why this schedule ended. Present while `status` is `COMPLETED`; absent otherwise, and also
    absent for schedules completed before this was recorded — that cause is not known and is not
    invented.

    `COMPLETED` covers facts that are not interchangeable: the owner ended it, the calendar ran
    out, or the agreed number of invoices did. It stays a **single** terminal status and `status` keeps its three values: no business rule
    branches on the cause, and a new status value would break every exhaustive `switch`. New causes
    land in `reason`, so treat it as an open set.
     */
    public function setCompletion(?RecurringInvoiceCompletion $completion): self
    {
        $this->initialized['completion'] = true;
        $this->completion = $completion;

        return $this;
    }

    public function getSeriesId(): string
    {
        return $this->seriesId;
    }

    public function setSeriesId(string $seriesId): self
    {
        $this->initialized['seriesId'] = true;
        $this->seriesId = $seriesId;

        return $this;
    }

    public function getSeriesCode(): string
    {
        return $this->seriesCode;
    }

    public function setSeriesCode(string $seriesCode): self
    {
        $this->initialized['seriesCode'] = true;
        $this->seriesCode = $seriesCode;

        return $this;
    }

    public function getInvoiceType(): string
    {
        return $this->invoiceType;
    }

    public function setInvoiceType(string $invoiceType): self
    {
        $this->initialized['invoiceType'] = true;
        $this->invoiceType = $invoiceType;

        return $this;
    }

    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    public function setCustomerId(?string $customerId): self
    {
        $this->initialized['customerId'] = true;
        $this->customerId = $customerId;

        return $this;
    }

    public function getRecipientFiscalName(): ?string
    {
        return $this->recipientFiscalName;
    }

    public function setRecipientFiscalName(?string $recipientFiscalName): self
    {
        $this->initialized['recipientFiscalName'] = true;
        $this->recipientFiscalName = $recipientFiscalName;

        return $this;
    }

    /**
     * Spanish Tax ID of the recipient. Mutually exclusive with `recipient_alternative_id`:
     * a recipient is identified by exactly one of the two, never both, and `null` when the
     * other one carries the identifier (or when there is no recipient identified at all).
     */
    public function getRecipientNif(): ?string
    {
        return $this->recipientNif;
    }

    /**
     * Spanish Tax ID of the recipient. Mutually exclusive with `recipient_alternative_id`:
    a recipient is identified by exactly one of the two, never both, and `null` when the
    other one carries the identifier (or when there is no recipient identified at all).
     */
    public function setRecipientNif(?string $recipientNif): self
    {
        $this->initialized['recipientNif'] = true;
        $this->recipientNif = $recipientNif;

        return $this;
    }

    public function getRecipientAlternativeId(): RecurringInvoiceResponseRecipientAlternativeId
    {
        return $this->recipientAlternativeId;
    }

    public function setRecipientAlternativeId(RecurringInvoiceResponseRecipientAlternativeId $recipientAlternativeId): self
    {
        $this->initialized['recipientAlternativeId'] = true;
        $this->recipientAlternativeId = $recipientAlternativeId;

        return $this;
    }

    /**
     * @return list<InvoiceLineTemplateResponse>
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * @param  list<InvoiceLineTemplateResponse>  $lines
     */
    public function setLines(array $lines): self
    {
        $this->initialized['lines'] = true;
        $this->lines = $lines;

        return $this;
    }

    /**
     * What the customer will be asked to transfer on the next invoice this template
     * generates: taxable base + VAT + equivalence surcharge − IRPF withholding +
     * disbursements (`suplidos`). It is NOT the taxable base and NOT the total with VAT:
     * the withholding is already subtracted.
     *
     * The same number the next occurrence publishes as `total_to_pay`, to the cent: both
     * come from the template's own lines through the same line pipeline the real generation
     * uses. It is computed on the fly and stored nowhere, so it always reflects the lines
     * the template carries right now — and it is not sortable or filterable for that reason.
     *
     * `null` when the template's lines cannot be priced (no lines, or lines the engine
     * rejects). The rest of the template is still returned.
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * What the customer will be asked to transfer on the next invoice this template
    generates: taxable base + VAT + equivalence surcharge − IRPF withholding +
    disbursements (`suplidos`). It is NOT the taxable base and NOT the total with VAT:
    the withholding is already subtracted.

    The same number the next occurrence publishes as `total_to_pay`, to the cent: both
    come from the template's own lines through the same line pipeline the real generation
    uses. It is computed on the fly and stored nowhere, so it always reflects the lines
    the template carries right now — and it is not sortable or filterable for that reason.

    `null` when the template's lines cannot be priced (no lines, or lines the engine
    rejects). The rest of the template is still returned.
     */
    public function setAmount(?float $amount): self
    {
        $this->initialized['amount'] = true;
        $this->amount = $amount;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?string $paymentMethod): self
    {
        $this->initialized['paymentMethod'] = true;
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Full IBAN of the template's own payment method, mirrored from what was sent when it
     * was set. `null` when the template has no payment method.
     */
    public function getPaymentIban(): ?string
    {
        return $this->paymentIban;
    }

    /**
     * Full IBAN of the template's own payment method, mirrored from what was sent when it
    was set. `null` when the template has no payment method.
     */
    public function setPaymentIban(?string $paymentIban): self
    {
        $this->initialized['paymentIban'] = true;
        $this->paymentIban = $paymentIban;

        return $this;
    }

    /**
     * SWIFT/BIC code of the template's own payment method. `null` when the template has no
     * payment method, or when it has one without a SWIFT code.
     */
    public function getPaymentSwift(): ?string
    {
        return $this->paymentSwift;
    }

    /**
     * SWIFT/BIC code of the template's own payment method. `null` when the template has no
    payment method, or when it has one without a SWIFT code.
     */
    public function setPaymentSwift(?string $paymentSwift): self
    {
        $this->initialized['paymentSwift'] = true;
        $this->paymentSwift = $paymentSwift;

        return $this;
    }

    /**
     * Payment term, in days, of the template's own payment method. `null` when the template
     * has no payment method, or when it has one without a declared term.
     */
    public function getPaymentTermDays(): ?int
    {
        return $this->paymentTermDays;
    }

    /**
     * Payment term, in days, of the template's own payment method. `null` when the template
    has no payment method, or when it has one without a declared term.
     */
    public function setPaymentTermDays(?int $paymentTermDays): self
    {
        $this->initialized['paymentTermDays'] = true;
        $this->paymentTermDays = $paymentTermDays;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->initialized['notes'] = true;
        $this->notes = $notes;

        return $this;
    }

    public function getSendAutomatically(): bool
    {
        return $this->sendAutomatically;
    }

    public function setSendAutomatically(bool $sendAutomatically): self
    {
        $this->initialized['sendAutomatically'] = true;
        $this->sendAutomatically = $sendAutomatically;

        return $this;
    }

    public function getEmailConfiguration(): ?RecurringEmailConfigResponse
    {
        return $this->emailConfiguration;
    }

    public function setEmailConfiguration(?RecurringEmailConfigResponse $emailConfiguration): self
    {
        $this->initialized['emailConfiguration'] = true;
        $this->emailConfiguration = $emailConfiguration;

        return $this;
    }

    public function getGeneratedInvoices(): int
    {
        return $this->generatedInvoices;
    }

    public function setGeneratedInvoices(int $generatedInvoices): self
    {
        $this->initialized['generatedInvoices'] = true;
        $this->generatedInvoices = $generatedInvoices;

        return $this;
    }

    /**
     * Total number of invoices agreed for this template, or absent when the recurrence is not
     * capped by number. It is the TOTAL agreed, not what is left: "remaining" is
     * `max_invoices - generated_invoices`, a derived reading with no field of its own — two
     * counters of the same fact drift, and the day they do nobody knows which one is true.
     *
     * What counts against it are invoices GENERATED, not calendar turns: a skip does not spend
     * cap because it produces no invoice, and a `generate now` does because it produces a real
     * fiscal invoice. When the last one is generated the template is closed in the act, with
     * `completion.reason = MAX_INVOICES_REACHED`.
     */
    public function getMaxInvoices(): ?int
    {
        return $this->maxInvoices;
    }

    /**
     * Total number of invoices agreed for this template, or absent when the recurrence is not
    capped by number. It is the TOTAL agreed, not what is left: "remaining" is
    `max_invoices - generated_invoices`, a derived reading with no field of its own — two
    counters of the same fact drift, and the day they do nobody knows which one is true.

    What counts against it are invoices GENERATED, not calendar turns: a skip does not spend
    cap because it produces no invoice, and a `generate now` does because it produces a real
    fiscal invoice. When the last one is generated the template is closed in the act, with
    `completion.reason = MAX_INVOICES_REACHED`.
     */
    public function setMaxInvoices(?int $maxInvoices): self
    {
        $this->initialized['maxInvoices'] = true;
        $this->maxInvoices = $maxInvoices;

        return $this;
    }

    public function getLastGeneratedAt(): ?\DateTime
    {
        return $this->lastGeneratedAt;
    }

    public function setLastGeneratedAt(?\DateTime $lastGeneratedAt): self
    {
        $this->initialized['lastGeneratedAt'] = true;
        $this->lastGeneratedAt = $lastGeneratedAt;

        return $this;
    }

    public function getSourceInvoiceId(): ?string
    {
        return $this->sourceInvoiceId;
    }

    public function setSourceInvoiceId(?string $sourceInvoiceId): self
    {
        $this->initialized['sourceInvoiceId'] = true;
        $this->sourceInvoiceId = $sourceInvoiceId;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->initialized['createdAt'] = true;
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->initialized['updatedAt'] = true;
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'name' => ['name', 'getName', 'setName'], 'frequency' => ['frequency', 'getFrequency', 'setFrequency'], 'dayOfMonth' => ['day_of_month', 'getDayOfMonth', 'setDayOfMonth'], 'startDate' => ['start_date', 'getStartDate', 'setStartDate'], 'endDate' => ['end_date', 'getEndDate', 'setEndDate'], 'nextGeneration' => ['next_generation', 'getNextGeneration', 'setNextGeneration'], 'draftInAdvance' => ['draft_in_advance', 'getDraftInAdvance', 'setDraftInAdvance'], 'status' => ['status', 'getStatus', 'setStatus'], 'pause' => ['pause', 'getPause', 'setPause'], 'completion' => ['completion', 'getCompletion', 'setCompletion'], 'seriesId' => ['series_id', 'getSeriesId', 'setSeriesId'], 'seriesCode' => ['series_code', 'getSeriesCode', 'setSeriesCode'], 'invoiceType' => ['invoice_type', 'getInvoiceType', 'setInvoiceType'], 'customerId' => ['customer_id', 'getCustomerId', 'setCustomerId'], 'recipientFiscalName' => ['recipient_fiscal_name', 'getRecipientFiscalName', 'setRecipientFiscalName'], 'recipientNif' => ['recipient_nif', 'getRecipientNif', 'setRecipientNif'], 'recipientAlternativeId' => ['recipient_alternative_id', 'getRecipientAlternativeId', 'setRecipientAlternativeId'], 'lines' => ['lines', 'getLines', 'setLines'], 'amount' => ['amount', 'getAmount', 'setAmount'], 'paymentMethod' => ['payment_method', 'getPaymentMethod', 'setPaymentMethod'], 'paymentIban' => ['payment_iban', 'getPaymentIban', 'setPaymentIban'], 'paymentSwift' => ['payment_swift', 'getPaymentSwift', 'setPaymentSwift'], 'paymentTermDays' => ['payment_term_days', 'getPaymentTermDays', 'setPaymentTermDays'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'sendAutomatically' => ['send_automatically', 'getSendAutomatically', 'setSendAutomatically'], 'emailConfiguration' => ['email_configuration', 'getEmailConfiguration', 'setEmailConfiguration'], 'generatedInvoices' => ['generated_invoices', 'getGeneratedInvoices', 'setGeneratedInvoices'], 'maxInvoices' => ['max_invoices', 'getMaxInvoices', 'setMaxInvoices'], 'lastGeneratedAt' => ['last_generated_at', 'getLastGeneratedAt', 'setLastGeneratedAt'], 'sourceInvoiceId' => ['source_invoice_id', 'getSourceInvoiceId', 'setSourceInvoiceId'], 'createdAt' => ['created_at', 'getCreatedAt', 'setCreatedAt'], 'updatedAt' => ['updated_at', 'getUpdatedAt', 'setUpdatedAt']];
    }
}
