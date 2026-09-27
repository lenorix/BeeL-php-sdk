<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CreateRecurringInvoiceRequest implements AdditionalPropertiesInterface
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
    protected $name;
    /**
     * Generation cadence: every 1, 3 or 12 months. Omitted, `MONTHLY` applies.
     * 
     * It governs the step from the first invoice onwards, not where that first one lands: the
     * first occurrence is the first `day_of_month` on or after `start_date`, found one month at
     * a time whatever the cadence. A yearly template starting 15 February with `day_of_month`
     * 10 first invoices on 10 March, then every 10 March after that — it does not wait a year.
     * 
     *
     * @var string
     */
    protected $frequency;
    /**
     * Day of the month the invoices are issued. A month that does not have that day falls
     * back to its last day: a template on `31` issues on 28 February (29 in a leap year)
     * and on 30 April. So `31` is how you ask for the last day of the month it generates
     * in — there is no separate flag for it, and the accepted range stays 1–31.
     * 
     * The adjustment does not stick and the schedule does not drift: every generation is
     * recalculated from the `day_of_month` you sent, never from the date it was adjusted
     * to (31 Jan → 28 Feb → 31 Mar).
     * 
     *
     * @var int
     */
    protected $dayOfMonth;
    /**
     * Date the subscription started. A past date is accepted and stored as sent — useful
     * when migrating subscriptions from another system — but it never anchors generation
     * in the past. `next_generation` becomes the next date of the template's own calendar
     * that is still ahead: the grid of `day_of_month` dates anchored at `start_date`, one
     * every `frequency`. On a quarterly or yearly template that can be months from now, not
     * this month. Invoices are never back-dated, so the missed periods are not generated.
     * 
     *
     * @var \DateTime
     */
    protected $startDate;
    /**
     * Whether the template prepares a draft for review before emitting. The window is fixed at
     * 5 days and both options emit on the scheduled day. Omitted, the template is created
     * without the review draft.
     * 
     *
     * @var bool
     */
    protected $draftInAdvance;
    /**
     * **Deprecated.** Superseded by `draft_in_advance`, because the review window is no longer
     * a number you pick: it is fixed at 5 days. Still accepted so nothing breaks — any value
     * greater than `0` means the same as `draft_in_advance: true`, and `0` the same as `false`.
     * When both are sent, `draft_in_advance` wins. It will be removed in a future version.
     * 
     *
     * @deprecated
     *
     * @var int
     */
    protected $previewDays;
    /**
     * @var \DateTime|null
     */
    protected $endDate;
    /**
     * @var string
     */
    protected $seriesId;
    /**
     * @var string
     */
    protected $invoiceType;
    /**
     * Total number of invoices this template will generate before ending on its own, between
     * 2 and 600. Leave it out (or send `null`) for a recurrence that is not capped by number.
     * 
     * A recurrence ends in ONE way: open-ended, on `end_date`, or after `max_invoices`. Sending
     * both `end_date` and `max_invoices` with a value is rejected with `RECURRING_END_MODE_CONFLICT`,
     * and so is a `max_invoices` that lands on a template that already has an `end_date`: the
     * conflict is judged on the RESULTING state, not on the body. To switch modes, say both things
     * in the same call — the new field with a value and the old one as `null`. Nothing is cleared
     * silently.
     * 
     * The cap counts invoices GENERATED, not calendar turns: a skip does not spend it. The range
     * is not enforced by this schema on purpose, so the rejection carries its own code and its own
     * message: below 2 you do not want a recurrence but a scheduled invoice
     * (`PUT /v1/companies/{company_id}/invoices/{invoice_id}/schedule`), which also issues it on an exact date.
     * 
     *
     * @var int|null
     */
    protected $maxInvoices;
    /**
     * @var string|null
     */
    protected $customerId;
    /**
     * @var list<RecurringLineRequest>
     */
    protected $lines;
    /**
     * Payment method. `payment_iban`, `payment_swift` and `payment_term_days` are
     * detail of this method, not standalone fields: sending any of them without a
     * `payment_method` that is present, non-null and different from `NONE` is
     * rejected with `422` (`PAYMENT_DETAILS_REQUIRE_METHOD`).
     * 
     *
     * @var string|null
     */
    protected $paymentMethod;
    /**
     * @var string|null
     */
    protected $paymentIban;
    /**
     * @var string|null
     */
    protected $paymentSwift;
    /**
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
    protected $sendAutomatically = false;
    /**
     * @var RecurringEmailConfigRequest|null
     */
    protected $emailConfiguration;
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * Generation cadence: every 1, 3 or 12 months. Omitted, `MONTHLY` applies.
     * 
     * It governs the step from the first invoice onwards, not where that first one lands: the
     * first occurrence is the first `day_of_month` on or after `start_date`, found one month at
     * a time whatever the cadence. A yearly template starting 15 February with `day_of_month`
     * 10 first invoices on 10 March, then every 10 March after that — it does not wait a year.
     * 
     *
     * @return string
     */
    public function getFrequency(): string
    {
        return $this->frequency;
    }
    /**
    * Generation cadence: every 1, 3 or 12 months. Omitted, `MONTHLY` applies.
    
    It governs the step from the first invoice onwards, not where that first one lands: the
    first occurrence is the first `day_of_month` on or after `start_date`, found one month at
    a time whatever the cadence. A yearly template starting 15 February with `day_of_month`
    10 first invoices on 10 March, then every 10 March after that — it does not wait a year.
    
    *
    * @param string $frequency
    *
    * @return self
    */
    public function setFrequency(string $frequency): self
    {
        $this->initialized['frequency'] = true;
        $this->frequency = $frequency;
        return $this;
    }
    /**
     * Day of the month the invoices are issued. A month that does not have that day falls
     * back to its last day: a template on `31` issues on 28 February (29 in a leap year)
     * and on 30 April. So `31` is how you ask for the last day of the month it generates
     * in — there is no separate flag for it, and the accepted range stays 1–31.
     * 
     * The adjustment does not stick and the schedule does not drift: every generation is
     * recalculated from the `day_of_month` you sent, never from the date it was adjusted
     * to (31 Jan → 28 Feb → 31 Mar).
     * 
     *
     * @return int
     */
    public function getDayOfMonth(): int
    {
        return $this->dayOfMonth;
    }
    /**
    * Day of the month the invoices are issued. A month that does not have that day falls
    back to its last day: a template on `31` issues on 28 February (29 in a leap year)
    and on 30 April. So `31` is how you ask for the last day of the month it generates
    in — there is no separate flag for it, and the accepted range stays 1–31.
    
    The adjustment does not stick and the schedule does not drift: every generation is
    recalculated from the `day_of_month` you sent, never from the date it was adjusted
    to (31 Jan → 28 Feb → 31 Mar).
    
    *
    * @param int $dayOfMonth
    *
    * @return self
    */
    public function setDayOfMonth(int $dayOfMonth): self
    {
        $this->initialized['dayOfMonth'] = true;
        $this->dayOfMonth = $dayOfMonth;
        return $this;
    }
    /**
     * Date the subscription started. A past date is accepted and stored as sent — useful
     * when migrating subscriptions from another system — but it never anchors generation
     * in the past. `next_generation` becomes the next date of the template's own calendar
     * that is still ahead: the grid of `day_of_month` dates anchored at `start_date`, one
     * every `frequency`. On a quarterly or yearly template that can be months from now, not
     * this month. Invoices are never back-dated, so the missed periods are not generated.
     * 
     *
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }
    /**
    * Date the subscription started. A past date is accepted and stored as sent — useful
    when migrating subscriptions from another system — but it never anchors generation
    in the past. `next_generation` becomes the next date of the template's own calendar
    that is still ahead: the grid of `day_of_month` dates anchored at `start_date`, one
    every `frequency`. On a quarterly or yearly template that can be months from now, not
    this month. Invoices are never back-dated, so the missed periods are not generated.
    
    *
    * @param \DateTime $startDate
    *
    * @return self
    */
    public function setStartDate(\DateTime $startDate): self
    {
        $this->initialized['startDate'] = true;
        $this->startDate = $startDate;
        return $this;
    }
    /**
     * Whether the template prepares a draft for review before emitting. The window is fixed at
     * 5 days and both options emit on the scheduled day. Omitted, the template is created
     * without the review draft.
     * 
     *
     * @return bool
     */
    public function getDraftInAdvance(): bool
    {
        return $this->draftInAdvance;
    }
    /**
    * Whether the template prepares a draft for review before emitting. The window is fixed at
    5 days and both options emit on the scheduled day. Omitted, the template is created
    without the review draft.
    
    *
    * @param bool $draftInAdvance
    *
    * @return self
    */
    public function setDraftInAdvance(bool $draftInAdvance): self
    {
        $this->initialized['draftInAdvance'] = true;
        $this->draftInAdvance = $draftInAdvance;
        return $this;
    }
    /**
     * **Deprecated.** Superseded by `draft_in_advance`, because the review window is no longer
     * a number you pick: it is fixed at 5 days. Still accepted so nothing breaks — any value
     * greater than `0` means the same as `draft_in_advance: true`, and `0` the same as `false`.
     * When both are sent, `draft_in_advance` wins. It will be removed in a future version.
     * 
     *
     * @deprecated
     *
     * @return int
     */
    public function getPreviewDays(): int
    {
        return $this->previewDays;
    }
    /**
    * **Deprecated.** Superseded by `draft_in_advance`, because the review window is no longer
    a number you pick: it is fixed at 5 days. Still accepted so nothing breaks — any value
    greater than `0` means the same as `draft_in_advance: true`, and `0` the same as `false`.
    When both are sent, `draft_in_advance` wins. It will be removed in a future version.
    
    *
    * @param int $previewDays
    *
    * @deprecated
    *
    * @return self
    */
    public function setPreviewDays(int $previewDays): self
    {
        $this->initialized['previewDays'] = true;
        $this->previewDays = $previewDays;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }
    /**
     * @param \DateTime|null $endDate
     *
     * @return self
     */
    public function setEndDate(?\DateTime $endDate): self
    {
        $this->initialized['endDate'] = true;
        $this->endDate = $endDate;
        return $this;
    }
    /**
     * @return string
     */
    public function getSeriesId(): string
    {
        return $this->seriesId;
    }
    /**
     * @param string $seriesId
     *
     * @return self
     */
    public function setSeriesId(string $seriesId): self
    {
        $this->initialized['seriesId'] = true;
        $this->seriesId = $seriesId;
        return $this;
    }
    /**
     * @return string
     */
    public function getInvoiceType(): string
    {
        return $this->invoiceType;
    }
    /**
     * @param string $invoiceType
     *
     * @return self
     */
    public function setInvoiceType(string $invoiceType): self
    {
        $this->initialized['invoiceType'] = true;
        $this->invoiceType = $invoiceType;
        return $this;
    }
    /**
     * Total number of invoices this template will generate before ending on its own, between
     * 2 and 600. Leave it out (or send `null`) for a recurrence that is not capped by number.
     * 
     * A recurrence ends in ONE way: open-ended, on `end_date`, or after `max_invoices`. Sending
     * both `end_date` and `max_invoices` with a value is rejected with `RECURRING_END_MODE_CONFLICT`,
     * and so is a `max_invoices` that lands on a template that already has an `end_date`: the
     * conflict is judged on the RESULTING state, not on the body. To switch modes, say both things
     * in the same call — the new field with a value and the old one as `null`. Nothing is cleared
     * silently.
     * 
     * The cap counts invoices GENERATED, not calendar turns: a skip does not spend it. The range
     * is not enforced by this schema on purpose, so the rejection carries its own code and its own
     * message: below 2 you do not want a recurrence but a scheduled invoice
     * (`PUT /v1/companies/{company_id}/invoices/{invoice_id}/schedule`), which also issues it on an exact date.
     * 
     *
     * @return int|null
     */
    public function getMaxInvoices(): ?int
    {
        return $this->maxInvoices;
    }
    /**
    * Total number of invoices this template will generate before ending on its own, between
    2 and 600. Leave it out (or send `null`) for a recurrence that is not capped by number.
    
    A recurrence ends in ONE way: open-ended, on `end_date`, or after `max_invoices`. Sending
    both `end_date` and `max_invoices` with a value is rejected with `RECURRING_END_MODE_CONFLICT`,
    and so is a `max_invoices` that lands on a template that already has an `end_date`: the
    conflict is judged on the RESULTING state, not on the body. To switch modes, say both things
    in the same call — the new field with a value and the old one as `null`. Nothing is cleared
    silently.
    
    The cap counts invoices GENERATED, not calendar turns: a skip does not spend it. The range
    is not enforced by this schema on purpose, so the rejection carries its own code and its own
    message: below 2 you do not want a recurrence but a scheduled invoice
    (`PUT /v1/companies/{company_id}/invoices/{invoice_id}/schedule`), which also issues it on an exact date.
    
    *
    * @param int|null $maxInvoices
    *
    * @return self
    */
    public function setMaxInvoices(?int $maxInvoices): self
    {
        $this->initialized['maxInvoices'] = true;
        $this->maxInvoices = $maxInvoices;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }
    /**
     * @param string|null $customerId
     *
     * @return self
     */
    public function setCustomerId(?string $customerId): self
    {
        $this->initialized['customerId'] = true;
        $this->customerId = $customerId;
        return $this;
    }
    /**
     * @return list<RecurringLineRequest>
     */
    public function getLines(): array
    {
        return $this->lines;
    }
    /**
     * @param list<RecurringLineRequest> $lines
     *
     * @return self
     */
    public function setLines(array $lines): self
    {
        $this->initialized['lines'] = true;
        $this->lines = $lines;
        return $this;
    }
    /**
     * Payment method. `payment_iban`, `payment_swift` and `payment_term_days` are
     * detail of this method, not standalone fields: sending any of them without a
     * `payment_method` that is present, non-null and different from `NONE` is
     * rejected with `422` (`PAYMENT_DETAILS_REQUIRE_METHOD`).
     * 
     *
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }
    /**
    * Payment method. `payment_iban`, `payment_swift` and `payment_term_days` are
    detail of this method, not standalone fields: sending any of them without a
    `payment_method` that is present, non-null and different from `NONE` is
    rejected with `422` (`PAYMENT_DETAILS_REQUIRE_METHOD`).
    
    *
    * @param string|null $paymentMethod
    *
    * @return self
    */
    public function setPaymentMethod(?string $paymentMethod): self
    {
        $this->initialized['paymentMethod'] = true;
        $this->paymentMethod = $paymentMethod;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPaymentIban(): ?string
    {
        return $this->paymentIban;
    }
    /**
     * @param string|null $paymentIban
     *
     * @return self
     */
    public function setPaymentIban(?string $paymentIban): self
    {
        $this->initialized['paymentIban'] = true;
        $this->paymentIban = $paymentIban;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getPaymentSwift(): ?string
    {
        return $this->paymentSwift;
    }
    /**
     * @param string|null $paymentSwift
     *
     * @return self
     */
    public function setPaymentSwift(?string $paymentSwift): self
    {
        $this->initialized['paymentSwift'] = true;
        $this->paymentSwift = $paymentSwift;
        return $this;
    }
    /**
     * @return int|null
     */
    public function getPaymentTermDays(): ?int
    {
        return $this->paymentTermDays;
    }
    /**
     * @param int|null $paymentTermDays
     *
     * @return self
     */
    public function setPaymentTermDays(?int $paymentTermDays): self
    {
        $this->initialized['paymentTermDays'] = true;
        $this->paymentTermDays = $paymentTermDays;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }
    /**
     * @param string|null $notes
     *
     * @return self
     */
    public function setNotes(?string $notes): self
    {
        $this->initialized['notes'] = true;
        $this->notes = $notes;
        return $this;
    }
    /**
     * @return bool
     */
    public function getSendAutomatically(): bool
    {
        return $this->sendAutomatically;
    }
    /**
     * @param bool $sendAutomatically
     *
     * @return self
     */
    public function setSendAutomatically(bool $sendAutomatically): self
    {
        $this->initialized['sendAutomatically'] = true;
        $this->sendAutomatically = $sendAutomatically;
        return $this;
    }
    /**
     * @return RecurringEmailConfigRequest|null
     */
    public function getEmailConfiguration(): ?RecurringEmailConfigRequest
    {
        return $this->emailConfiguration;
    }
    /**
     * @param RecurringEmailConfigRequest|null $emailConfiguration
     *
     * @return self
     */
    public function setEmailConfiguration(?RecurringEmailConfigRequest $emailConfiguration): self
    {
        $this->initialized['emailConfiguration'] = true;
        $this->emailConfiguration = $emailConfiguration;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['name' => ['name', 'getName', 'setName'], 'frequency' => ['frequency', 'getFrequency', 'setFrequency'], 'dayOfMonth' => ['day_of_month', 'getDayOfMonth', 'setDayOfMonth'], 'startDate' => ['start_date', 'getStartDate', 'setStartDate'], 'draftInAdvance' => ['draft_in_advance', 'getDraftInAdvance', 'setDraftInAdvance'], 'previewDays' => ['preview_days', 'getPreviewDays', 'setPreviewDays'], 'endDate' => ['end_date', 'getEndDate', 'setEndDate'], 'seriesId' => ['series_id', 'getSeriesId', 'setSeriesId'], 'invoiceType' => ['invoice_type', 'getInvoiceType', 'setInvoiceType'], 'maxInvoices' => ['max_invoices', 'getMaxInvoices', 'setMaxInvoices'], 'customerId' => ['customer_id', 'getCustomerId', 'setCustomerId'], 'lines' => ['lines', 'getLines', 'setLines'], 'paymentMethod' => ['payment_method', 'getPaymentMethod', 'setPaymentMethod'], 'paymentIban' => ['payment_iban', 'getPaymentIban', 'setPaymentIban'], 'paymentSwift' => ['payment_swift', 'getPaymentSwift', 'setPaymentSwift'], 'paymentTermDays' => ['payment_term_days', 'getPaymentTermDays', 'setPaymentTermDays'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'sendAutomatically' => ['send_automatically', 'getSendAutomatically', 'setSendAutomatically'], 'emailConfiguration' => ['email_configuration', 'getEmailConfiguration', 'setEmailConfiguration']];
    }
}