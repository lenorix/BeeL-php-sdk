<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CreateRecurringInvoiceDerivationRequest implements AdditionalPropertiesInterface
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
     * Invoice the template is derived from. It must belong to the company in the path; an
     * invoice you cannot reach is reported the same way as one that does not exist.
     * 
     *
     * @var string
     */
    protected $fromInvoiceId;
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
     * without the review draft. Same field, same meaning and same default as when you create a
     * template from scratch: deriving from an invoice does not give it a second semantics.
     * 
     *
     * @var bool
     */
    protected $draftInAdvance;
    /**
     * @var \DateTime|null
     */
    protected $endDate;
    /**
     * @var bool
     */
    protected $sendAutomatically = false;
    /**
     * @var RecurringEmailConfigRequest|null
     */
    protected $emailConfiguration;
    /**
     * Invoice the template is derived from. It must belong to the company in the path; an
     * invoice you cannot reach is reported the same way as one that does not exist.
     * 
     *
     * @return string
     */
    public function getFromInvoiceId(): string
    {
        return $this->fromInvoiceId;
    }
    /**
    * Invoice the template is derived from. It must belong to the company in the path; an
    invoice you cannot reach is reported the same way as one that does not exist.
    
    *
    * @param string $fromInvoiceId
    *
    * @return self
    */
    public function setFromInvoiceId(string $fromInvoiceId): self
    {
        $this->initialized['fromInvoiceId'] = true;
        $this->fromInvoiceId = $fromInvoiceId;
        return $this;
    }
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
     * without the review draft. Same field, same meaning and same default as when you create a
     * template from scratch: deriving from an invoice does not give it a second semantics.
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
    without the review draft. Same field, same meaning and same default as when you create a
    template from scratch: deriving from an invoice does not give it a second semantics.
    
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
        return ['fromInvoiceId' => ['from_invoice_id', 'getFromInvoiceId', 'setFromInvoiceId'], 'name' => ['name', 'getName', 'setName'], 'frequency' => ['frequency', 'getFrequency', 'setFrequency'], 'dayOfMonth' => ['day_of_month', 'getDayOfMonth', 'setDayOfMonth'], 'startDate' => ['start_date', 'getStartDate', 'setStartDate'], 'draftInAdvance' => ['draft_in_advance', 'getDraftInAdvance', 'setDraftInAdvance'], 'endDate' => ['end_date', 'getEndDate', 'setEndDate'], 'sendAutomatically' => ['send_automatically', 'getSendAutomatically', 'setSendAutomatically'], 'emailConfiguration' => ['email_configuration', 'getEmailConfiguration', 'setEmailConfiguration']];
    }
}