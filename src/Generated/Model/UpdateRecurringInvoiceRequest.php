<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class UpdateRecurringInvoiceRequest implements AdditionalPropertiesInterface
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
     * Once the template has issued, only a *different* date is rejected with a 422
     * `RECURRING_START_DATE_NOT_EDITABLE`. Resending the value it already has is a no-op,
     * so this request can keep sending the template complete, as it asks above.
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
     * Total number of invoices this template will generate before ending on its own, between
     * 2 and 600. Like `end_date`, it is **cleared when you leave it out**: this is a replacement.
     *
     * A recurrence ends in ONE way: open-ended, on `end_date`, or after `max_invoices`. Sending
     * both with a value is rejected with `RECURRING_END_MODE_CONFLICT`. The range is not enforced
     * by this schema on purpose, so the rejection carries its own code and its own message: below
     * 2 you do not want a recurrence but a scheduled invoice (`PUT /v1/companies/{company_id}/invoices/{invoice_id}/schedule`).
     *
     * Lowering it below the invoices already generated is rejected: issued invoices are fiscal
     * facts and are not undone by moving the cap. Setting it exactly to the number already
     * generated is accepted and ends the template in that same call.
     *
     *
     * @var int|null
     */
    protected $maxInvoices;

    /**
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
     * Template lines, replaced as a whole. Omit them (or send `null`) to keep the
     * current ones — a template with no lines invoices nothing, so an empty array is
     * rejected.
     *
     *
     * @var list<RecurringLineRequest>|null
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
    protected $sendAutomatically;

    /**
     * @var RecurringEmailConfigRequest|null
     */
    protected $emailConfiguration;

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
     * Once the template has issued, only a *different* date is rejected with a 422
     * `RECURRING_START_DATE_NOT_EDITABLE`. Resending the value it already has is a no-op,
     * so this request can keep sending the template complete, as it asks above.
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

    Once the template has issued, only a *different* date is rejected with a 422
    `RECURRING_START_DATE_NOT_EDITABLE`. Resending the value it already has is a no-op,
    so this request can keep sending the template complete, as it asks above.
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
     */
    public function getDraftInAdvance(): bool
    {
        return $this->draftInAdvance;
    }

    /**
     * Whether the template prepares a draft for review before emitting. The window is fixed at
    5 days and both options emit on the scheduled day. Omitted, the current value is kept.
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
     *
     * @deprecated
     */
    public function setPreviewDays(int $previewDays): self
    {
        $this->initialized['previewDays'] = true;
        $this->previewDays = $previewDays;

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
     * Total number of invoices this template will generate before ending on its own, between
     * 2 and 600. Like `end_date`, it is **cleared when you leave it out**: this is a replacement.
     *
     * A recurrence ends in ONE way: open-ended, on `end_date`, or after `max_invoices`. Sending
     * both with a value is rejected with `RECURRING_END_MODE_CONFLICT`. The range is not enforced
     * by this schema on purpose, so the rejection carries its own code and its own message: below
     * 2 you do not want a recurrence but a scheduled invoice (`PUT /v1/companies/{company_id}/invoices/{invoice_id}/schedule`).
     *
     * Lowering it below the invoices already generated is rejected: issued invoices are fiscal
     * facts and are not undone by moving the cap. Setting it exactly to the number already
     * generated is accepted and ends the template in that same call.
     */
    public function getMaxInvoices(): ?int
    {
        return $this->maxInvoices;
    }

    /**
     * Total number of invoices this template will generate before ending on its own, between
    2 and 600. Like `end_date`, it is **cleared when you leave it out**: this is a replacement.

    A recurrence ends in ONE way: open-ended, on `end_date`, or after `max_invoices`. Sending
    both with a value is rejected with `RECURRING_END_MODE_CONFLICT`. The range is not enforced
    by this schema on purpose, so the rejection carries its own code and its own message: below
    2 you do not want a recurrence but a scheduled invoice (`PUT /v1/companies/{company_id}/invoices/{invoice_id}/schedule`).

    Lowering it below the invoices already generated is rejected: issued invoices are fiscal
    facts and are not undone by moving the cap. Setting it exactly to the number already
    generated is accepted and ends the template in that same call.
     */
    public function setMaxInvoices(?int $maxInvoices): self
    {
        $this->initialized['maxInvoices'] = true;
        $this->maxInvoices = $maxInvoices;

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

    /**
     * Recipient of the generated invoices. Send `null` to leave the template without
     * a recipient; omit it to keep the current one.
     */
    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    /**
     * Recipient of the generated invoices. Send `null` to leave the template without
    a recipient; omit it to keep the current one.
     */
    public function setCustomerId(?string $customerId): self
    {
        $this->initialized['customerId'] = true;
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Template lines, replaced as a whole. Omit them (or send `null`) to keep the
     * current ones — a template with no lines invoices nothing, so an empty array is
     * rejected.
     *
     *
     * @return list<RecurringLineRequest>|null
     */
    public function getLines(): ?array
    {
        return $this->lines;
    }

    /**
     * Template lines, replaced as a whole. Omit them (or send `null`) to keep the
    current ones — a template with no lines invoices nothing, so an empty array is
    rejected.

     *
     * @param  list<RecurringLineRequest>|null  $lines
     */
    public function setLines(?array $lines): self
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
     */
    public function setPaymentMethod(?string $paymentMethod): self
    {
        $this->initialized['paymentMethod'] = true;
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getPaymentIban(): ?string
    {
        return $this->paymentIban;
    }

    public function setPaymentIban(?string $paymentIban): self
    {
        $this->initialized['paymentIban'] = true;
        $this->paymentIban = $paymentIban;

        return $this;
    }

    public function getPaymentSwift(): ?string
    {
        return $this->paymentSwift;
    }

    public function setPaymentSwift(?string $paymentSwift): self
    {
        $this->initialized['paymentSwift'] = true;
        $this->paymentSwift = $paymentSwift;

        return $this;
    }

    public function getPaymentTermDays(): ?int
    {
        return $this->paymentTermDays;
    }

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

    public function getEmailConfiguration(): ?RecurringEmailConfigRequest
    {
        return $this->emailConfiguration;
    }

    public function setEmailConfiguration(?RecurringEmailConfigRequest $emailConfiguration): self
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
