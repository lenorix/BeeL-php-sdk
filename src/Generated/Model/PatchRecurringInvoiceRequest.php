<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class PatchRecurringInvoiceRequest implements AdditionalPropertiesInterface
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
     * Template name. Cannot be cleared.
     *
     * @var string
     */
    protected $name;
    /**
     * Generation cadence: every 1, 3 or 12 months. Omitted, the current one is kept — it is
     * never reset to `MONTHLY`.
     * 
     * **Changing it reschedules the template.** The next generation is recalculated on the new
     * grid — the `day_of_month` dates anchored at `start_date`, one every cadence — so it can
     * land months later than the one you saw before the call. **If the template has already
     * issued invoices, the landing respects that**: it is never a period that was already
     * billed, and never before today either — the first point of the new grid strictly after
     * the last invoiced one. It also **discards a pending skip**: the skipped period only
     * existed as a point of the old grid, and that grid is gone. Send the same cadence and
     * nothing is rescheduled.
     * 
     *
     * @var string
     */
    protected $frequency;
    /**
     * Day of the month the invoices are issued. Moves the next generation immediately, on an
     * `ACTIVE` template and on a `PAUSED` one alike: the response to this very call already
     * carries the new `next_generation`. On a paused template the new day rules from the edit,
     * not from the day you resume — resuming keeps the date this call left, so editing the day
     * of a paused schedule is never ignored for a round.
     * 
     * A month that does not have that day falls back to its last day: a template on `31`
     * issues on 28 February (29 in a leap year) and on 30 April. So `31` is how you ask for
     * the last day of the month it generates in — there is no separate flag for it, and the
     * accepted range stays 1–31.
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
     * First issue date. Only **changeable** while the template has not generated any invoice
     * yet: once it has issued, a *different* date is rejected with a 422
     * `RECURRING_START_DATE_NOT_EDITABLE`. Sending the value it already has is a no-op and
     * succeeds, so a read-modify-write cycle never has to strip the field out of the body.
     * 
     * A past date is accepted and stored as sent, but it never anchors generation in the
     * past: `next_generation` becomes the next date of the template's own calendar that is
     * still ahead — the grid of `day_of_month` dates anchored at `start_date`, one every
     * `frequency` — which on a quarterly or yearly template can be months from now.
     * 
     *
     * @var \DateTime
     */
    protected $startDate;
    /**
     * Whether the template prepares a draft for review before emitting. The window is fixed at
     * 5 days and both options emit on the scheduled day. Omitted, the current value is kept.
     * 
     *
     * @var bool
     */
    protected $draftInAdvance;
    /**
     * **Deprecated.** Superseded by `draft_in_advance`. Any value greater than `0` means the
     * same as `draft_in_advance: true`, and `0` the same as `false`. When both are sent,
     * `draft_in_advance` wins. It will be removed in a future version.
     * 
     *
     * @deprecated
     *
     * @var int
     */
    protected $previewDays;
    /**
     * Date the recurrence stops. Send `null` to make it open-ended.
     *
     * @var \DateTime|null
     */
    protected $endDate;
    /**
     * Total number of invoices this template will generate before ending on its own, between
     * 2 and 600. Send `null` to stop capping the recurrence by number.
     * 
     * Editing it MOVES THE GOAL, it does not add turns: above the invoices already generated the
     * template stays active; exactly equal ends it in this very call (with
     * `completion.reason = MAX_INVOICES_REACHED`); below it the call is rejected — issued invoices
     * are fiscal facts, and someone typing a lower number is asking to stop now, which is what
     * ending the recurrence is for.
     * 
     * A recurrence ends in ONE way, and the conflict is judged on the RESULTING state, not on the
     * body: sending `max_invoices` to a template that already has an `end_date` is rejected with
     * `RECURRING_END_MODE_CONFLICT` even though the body only mentions one of them. Switching mode
     * is a single call that says both things — the new field with a value and the old one as
     * `null`. Nothing is cleared silently.
     * 
     *
     * @var int|null
     */
    protected $maxInvoices;
    /**
     * Series the generated invoices are numbered in. Cannot be cleared.
     *
     * @var string
     */
    protected $seriesId;
    /**
     * Recipient of the generated invoices. Send `null` to leave the template without
     * a recipient; omit it to keep the current one.
     * 
     *
     * @var string|null
     */
    protected $customerId;
    /**
     * Template lines, replaced as a whole (they are not patched line by line). Omit
     * them to keep the current ones — a template with no lines invoices nothing, so
     * an empty array is rejected.
     * 
     *
     * @var list<RecurringLineRequest>|null
     */
    protected $lines;
    /**
     * Payment method. Replaced as a whole together with `payment_iban`,
     * `payment_swift` and `payment_term_days`: send them in the same request or they
     * are dropped. Send `null` to state that no payment method applies.
     * 
     * `payment_iban`, `payment_swift` and `payment_term_days` are detail of this
     * method, not standalone fields: sending any of them without a `payment_method`
     * that is present, non-null and different from `NONE` is rejected with `422`
     * (`PAYMENT_DETAILS_REQUIRE_METHOD`).
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
     * Notes printed on the generated invoices. Send `null` to clear them.
     *
     * @var string|null
     */
    protected $notes;
    /**
     * @var bool
     */
    protected $sendAutomatically;
    /**
     * Email delivery settings, replaced as a whole. Send `null` to stop sending the
     * generated invoices by email.
     * 
     *
     * @var PatchRecurringInvoiceRequestEmailConfiguration|null
     */
    protected $emailConfiguration;
    /**
     * Template name. Cannot be cleared.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * Template name. Cannot be cleared.
     *
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
     * Generation cadence: every 1, 3 or 12 months. Omitted, the current one is kept — it is
     * never reset to `MONTHLY`.
     * 
     * **Changing it reschedules the template.** The next generation is recalculated on the new
     * grid — the `day_of_month` dates anchored at `start_date`, one every cadence — so it can
     * land months later than the one you saw before the call. **If the template has already
     * issued invoices, the landing respects that**: it is never a period that was already
     * billed, and never before today either — the first point of the new grid strictly after
     * the last invoiced one. It also **discards a pending skip**: the skipped period only
     * existed as a point of the old grid, and that grid is gone. Send the same cadence and
     * nothing is rescheduled.
     * 
     *
     * @return string
     */
    public function getFrequency(): string
    {
        return $this->frequency;
    }
    /**
    * Generation cadence: every 1, 3 or 12 months. Omitted, the current one is kept — it is
    never reset to `MONTHLY`.
    
    **Changing it reschedules the template.** The next generation is recalculated on the new
    grid — the `day_of_month` dates anchored at `start_date`, one every cadence — so it can
    land months later than the one you saw before the call. **If the template has already
    issued invoices, the landing respects that**: it is never a period that was already
    billed, and never before today either — the first point of the new grid strictly after
    the last invoiced one. It also **discards a pending skip**: the skipped period only
    existed as a point of the old grid, and that grid is gone. Send the same cadence and
    nothing is rescheduled.
    
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
     * Day of the month the invoices are issued. Moves the next generation immediately, on an
     * `ACTIVE` template and on a `PAUSED` one alike: the response to this very call already
     * carries the new `next_generation`. On a paused template the new day rules from the edit,
     * not from the day you resume — resuming keeps the date this call left, so editing the day
     * of a paused schedule is never ignored for a round.
     * 
     * A month that does not have that day falls back to its last day: a template on `31`
     * issues on 28 February (29 in a leap year) and on 30 April. So `31` is how you ask for
     * the last day of the month it generates in — there is no separate flag for it, and the
     * accepted range stays 1–31.
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
    * Day of the month the invoices are issued. Moves the next generation immediately, on an
    `ACTIVE` template and on a `PAUSED` one alike: the response to this very call already
    carries the new `next_generation`. On a paused template the new day rules from the edit,
    not from the day you resume — resuming keeps the date this call left, so editing the day
    of a paused schedule is never ignored for a round.
    
    A month that does not have that day falls back to its last day: a template on `31`
    issues on 28 February (29 in a leap year) and on 30 April. So `31` is how you ask for
    the last day of the month it generates in — there is no separate flag for it, and the
    accepted range stays 1–31.
    
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
     * First issue date. Only **changeable** while the template has not generated any invoice
     * yet: once it has issued, a *different* date is rejected with a 422
     * `RECURRING_START_DATE_NOT_EDITABLE`. Sending the value it already has is a no-op and
     * succeeds, so a read-modify-write cycle never has to strip the field out of the body.
     * 
     * A past date is accepted and stored as sent, but it never anchors generation in the
     * past: `next_generation` becomes the next date of the template's own calendar that is
     * still ahead — the grid of `day_of_month` dates anchored at `start_date`, one every
     * `frequency` — which on a quarterly or yearly template can be months from now.
     * 
     *
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }
    /**
    * First issue date. Only **changeable** while the template has not generated any invoice
    yet: once it has issued, a *different* date is rejected with a 422
    `RECURRING_START_DATE_NOT_EDITABLE`. Sending the value it already has is a no-op and
    succeeds, so a read-modify-write cycle never has to strip the field out of the body.
    
    A past date is accepted and stored as sent, but it never anchors generation in the
    past: `next_generation` becomes the next date of the template's own calendar that is
    still ahead — the grid of `day_of_month` dates anchored at `start_date`, one every
    `frequency` — which on a quarterly or yearly template can be months from now.
    
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
     * 5 days and both options emit on the scheduled day. Omitted, the current value is kept.
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
    5 days and both options emit on the scheduled day. Omitted, the current value is kept.
    
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
     * **Deprecated.** Superseded by `draft_in_advance`. Any value greater than `0` means the
     * same as `draft_in_advance: true`, and `0` the same as `false`. When both are sent,
     * `draft_in_advance` wins. It will be removed in a future version.
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
    * **Deprecated.** Superseded by `draft_in_advance`. Any value greater than `0` means the
    same as `draft_in_advance: true`, and `0` the same as `false`. When both are sent,
    `draft_in_advance` wins. It will be removed in a future version.
    
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
     * Date the recurrence stops. Send `null` to make it open-ended.
     *
     * @return \DateTime|null
     */
    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }
    /**
     * Date the recurrence stops. Send `null` to make it open-ended.
     *
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
     * Total number of invoices this template will generate before ending on its own, between
     * 2 and 600. Send `null` to stop capping the recurrence by number.
     * 
     * Editing it MOVES THE GOAL, it does not add turns: above the invoices already generated the
     * template stays active; exactly equal ends it in this very call (with
     * `completion.reason = MAX_INVOICES_REACHED`); below it the call is rejected — issued invoices
     * are fiscal facts, and someone typing a lower number is asking to stop now, which is what
     * ending the recurrence is for.
     * 
     * A recurrence ends in ONE way, and the conflict is judged on the RESULTING state, not on the
     * body: sending `max_invoices` to a template that already has an `end_date` is rejected with
     * `RECURRING_END_MODE_CONFLICT` even though the body only mentions one of them. Switching mode
     * is a single call that says both things — the new field with a value and the old one as
     * `null`. Nothing is cleared silently.
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
    2 and 600. Send `null` to stop capping the recurrence by number.
    
    Editing it MOVES THE GOAL, it does not add turns: above the invoices already generated the
    template stays active; exactly equal ends it in this very call (with
    `completion.reason = MAX_INVOICES_REACHED`); below it the call is rejected — issued invoices
    are fiscal facts, and someone typing a lower number is asking to stop now, which is what
    ending the recurrence is for.
    
    A recurrence ends in ONE way, and the conflict is judged on the RESULTING state, not on the
    body: sending `max_invoices` to a template that already has an `end_date` is rejected with
    `RECURRING_END_MODE_CONFLICT` even though the body only mentions one of them. Switching mode
    is a single call that says both things — the new field with a value and the old one as
    `null`. Nothing is cleared silently.
    
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
     * Series the generated invoices are numbered in. Cannot be cleared.
     *
     * @return string
     */
    public function getSeriesId(): string
    {
        return $this->seriesId;
    }
    /**
     * Series the generated invoices are numbered in. Cannot be cleared.
     *
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
     * Recipient of the generated invoices. Send `null` to leave the template without
     * a recipient; omit it to keep the current one.
     * 
     *
     * @return string|null
     */
    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }
    /**
    * Recipient of the generated invoices. Send `null` to leave the template without
    a recipient; omit it to keep the current one.
    
    *
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
     * Template lines, replaced as a whole (they are not patched line by line). Omit
     * them to keep the current ones — a template with no lines invoices nothing, so
     * an empty array is rejected.
     * 
     *
     * @return list<RecurringLineRequest>|null
     */
    public function getLines(): ?array
    {
        return $this->lines;
    }
    /**
    * Template lines, replaced as a whole (they are not patched line by line). Omit
    them to keep the current ones — a template with no lines invoices nothing, so
    an empty array is rejected.
    
    *
    * @param list<RecurringLineRequest>|null $lines
    *
    * @return self
    */
    public function setLines(?array $lines): self
    {
        $this->initialized['lines'] = true;
        $this->lines = $lines;
        return $this;
    }
    /**
     * Payment method. Replaced as a whole together with `payment_iban`,
     * `payment_swift` and `payment_term_days`: send them in the same request or they
     * are dropped. Send `null` to state that no payment method applies.
     * 
     * `payment_iban`, `payment_swift` and `payment_term_days` are detail of this
     * method, not standalone fields: sending any of them without a `payment_method`
     * that is present, non-null and different from `NONE` is rejected with `422`
     * (`PAYMENT_DETAILS_REQUIRE_METHOD`).
     * 
     *
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }
    /**
    * Payment method. Replaced as a whole together with `payment_iban`,
    `payment_swift` and `payment_term_days`: send them in the same request or they
    are dropped. Send `null` to state that no payment method applies.
    
    `payment_iban`, `payment_swift` and `payment_term_days` are detail of this
    method, not standalone fields: sending any of them without a `payment_method`
    that is present, non-null and different from `NONE` is rejected with `422`
    (`PAYMENT_DETAILS_REQUIRE_METHOD`).
    
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
     * Notes printed on the generated invoices. Send `null` to clear them.
     *
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }
    /**
     * Notes printed on the generated invoices. Send `null` to clear them.
     *
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
     * Email delivery settings, replaced as a whole. Send `null` to stop sending the
     * generated invoices by email.
     * 
     *
     * @return PatchRecurringInvoiceRequestEmailConfiguration|null
     */
    public function getEmailConfiguration(): ?PatchRecurringInvoiceRequestEmailConfiguration
    {
        return $this->emailConfiguration;
    }
    /**
    * Email delivery settings, replaced as a whole. Send `null` to stop sending the
    generated invoices by email.
    
    *
    * @param PatchRecurringInvoiceRequestEmailConfiguration|null $emailConfiguration
    *
    * @return self
    */
    public function setEmailConfiguration(?PatchRecurringInvoiceRequestEmailConfiguration $emailConfiguration): self
    {
        $this->initialized['emailConfiguration'] = true;
        $this->emailConfiguration = $emailConfiguration;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['name' => ['name', 'getName', 'setName'], 'frequency' => ['frequency', 'getFrequency', 'setFrequency'], 'dayOfMonth' => ['day_of_month', 'getDayOfMonth', 'setDayOfMonth'], 'startDate' => ['start_date', 'getStartDate', 'setStartDate'], 'draftInAdvance' => ['draft_in_advance', 'getDraftInAdvance', 'setDraftInAdvance'], 'previewDays' => ['preview_days', 'getPreviewDays', 'setPreviewDays'], 'endDate' => ['end_date', 'getEndDate', 'setEndDate'], 'maxInvoices' => ['max_invoices', 'getMaxInvoices', 'setMaxInvoices'], 'seriesId' => ['series_id', 'getSeriesId', 'setSeriesId'], 'customerId' => ['customer_id', 'getCustomerId', 'setCustomerId'], 'lines' => ['lines', 'getLines', 'setLines'], 'paymentMethod' => ['payment_method', 'getPaymentMethod', 'setPaymentMethod'], 'paymentIban' => ['payment_iban', 'getPaymentIban', 'setPaymentIban'], 'paymentSwift' => ['payment_swift', 'getPaymentSwift', 'setPaymentSwift'], 'paymentTermDays' => ['payment_term_days', 'getPaymentTermDays', 'setPaymentTermDays'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'sendAutomatically' => ['send_automatically', 'getSendAutomatically', 'setSendAutomatically'], 'emailConfiguration' => ['email_configuration', 'getEmailConfiguration', 'setEmailConfiguration']];
    }
}