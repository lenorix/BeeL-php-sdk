<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class NextOccurrence implements AdditionalPropertiesInterface
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
     * Always `null` here: the number is drawn from the series when the invoice is
     * actually generated, and a preview draws nothing.
     *
     *
     * @var string|null
     */
    protected $invoiceNumber;

    /**
     * @var SeriesInfo
     */
    protected $series;

    /**
     * Always `null` here, for the same reason as `invoice_number`.
     *
     *
     * @var int|null
     */
    protected $number;

    /**
     * - STANDARD: Standard invoice
     * - CORRECTIVE: Corrects or cancels a previous invoice
     * - SIMPLIFIED: Simplified invoice (ticket), for a recipient that is not identified. BeeL.
     *   requires a STANDARD invoice when the recipient is identified, at any amount: a
     *   SIMPLIFIED invoice whose recipient carries an `nif` or `alternative_id` is rejected
     *   with `SIMPLIFIED_INVOICE_FORBIDS_IDENTIFIED_RECIPIENT`. The only amount BeeL
     *   enforces is a cap of 3,000€ VAT included (`SIMPLIFIED_INVOICE_EXCEEDS_LEGAL_LIMIT`). The
     *   general limit of RD 1619/2012 is 400€ (art. 4.1.a); up to 3,000€ applies only to the
     *   activities listed in art. 4.2. BeeL does not check which activity the issuer carries
     *   out.
     * - PROFORMA: Commercial document (formal quote) with no fiscal validity.
     *   Never enters VeriFactu (no QR, no AEAT submission): `verifactu.enabled` is
     *   always `false`, whatever the company's regime. Requires full recipient data,
     *   like STANDARD.
     *   Cannot be corrective nor reference a rectified invoice.
     *
     *
     * @var string
     */
    protected $type;

    /**
     * - SCHEDULED: Scheduled invoice to be issued automatically on a future date
     * - DRAFT: Draft invoice not sent yet (modifiable)
     * - ISSUED: Finalized invoice with definitive number but not sent
     * - SENT: Invoice sent to customer
     * - PAID: Invoice paid
     * - OVERDUE: Reserved. No operation sets this status and it is not computed from `due_date`;
     *   an unpaid invoice past its due date keeps its status (`ISSUED` or `SENT`). Compare
     *   `due_date` with today to find overdue invoices.
     * - RECTIFIED: Partially corrected invoice (one or more PARTIAL corrective invoices)
     * - VOIDED: Cancelled invoice. Reached either through a direct void request or
     *   through a TOTAL corrective invoice; `void_cause` tells the two apart.
     * - CONVERTED: Proforma converted into an invoice (terminal; the proforma survives
     *   as the record of the accepted quote, linked to the created invoice)
     * - ACTIVE: Active proforma. The single working state of a proforma (non-fiscal
     *   document): born numbered (PRO-...) and editable, never reaching the fiscal
     *   statuses. It transitions to CONVERTED when turned into an invoice, or to VOIDED
     *   when the offer is rejected/withdrawn (POST /v1/invoices/{invoice_id}/void).
     * - EXPIRED: Proforma whose offer validity (`valid_until`) has passed. Derived on read
     *   and never stored; the proforma stays convertible and editable.
     *
     *
     * @var string
     */
    protected $status;

    /**
     * Invoice issue date. Always set to the current date when the invoice is created.
     * If the operation occurred on a different date, use `operation_date`.
     *
     *
     * @var \DateTime
     */
    protected $issueDate;

    /**
     * Date when the operation actually occurred. Used when invoicing for a past operation.
     * If null, the operation date is the same as the issue date.
     *
     *
     * @var \DateTime|null
     */
    protected $operationDate;

    /**
     * Payment due date (must be the same as or after `issue_date`)
     *
     * @var \DateTime|null
     */
    protected $dueDate;

    /**
     * Offer validity date. Only rendered on PROFORMA invoices; on any other
     * invoice type the field is inert (accepted and stored, but never shown on
     * the document). Purely informational — nothing is triggered automatically
     * when it passes. Not to be confused with `due_date`, the payment due date.
     *
     *
     * @var \DateTime|null
     */
    protected $validUntil;

    /**
     * Business date when the payment was received (e.g., the date on the bank statement).
     * Set by the user when marking the invoice as paid. An invoice issued already paid gets its
     * `issue_date`: one whose `total_to_pay` is 0, or one issued from a payment already
     * confirmed by a payment integration. Only present when status is PAID.
     * Contrast with `paid_at`, which is the system timestamp of when the status change was recorded.
     *
     *
     * @var \DateTime|null
     */
    protected $paymentDate;

    /**
     * Moment the email provider ACCEPTED the invoice email — **not** the moment
     * it reached the recipient's mailbox. Present when status is SENT or later.
     *
     * What happened afterwards (delivered, bounced, opened) is not a single
     * timestamp: it lives in `sending_history`, one record per email with its
     * own status and timestamp. On a resend, `sent_at` moves to the latest
     * accepted send while `sending_history` keeps every one of them.
     *
     *
     * @var \DateTime|null
     */
    protected $sentAt;

    /**
     * System timestamp when the payment was recorded in the system.
     * Automatically set when the invoice status changes to PAID.
     * Contrast with `payment_date`, which is the business date chosen by the user.
     *
     *
     * @var \DateTime|null
     */
    protected $paidAt;

    /**
     * Date when this draft will be auto-emitted if not manually issued.
     * Only present for drafts created from recurring invoices with `draft_in_advance`
     * enabled.
     *
     *
     * @var \DateTime|null
     */
    protected $autoEmitAfter;

    /**
     * Date when the invoice should be automatically processed.
     * Only present when status is SCHEDULED.
     *
     *
     * @var \DateTime|null
     */
    protected $scheduledFor;

    /**
     * @var string|null
     */
    protected $scheduledAction;

    /**
     * @var IssuerData
     */
    protected $issuer;

    /**
     * Recipient data as stored on the invoice. Only `legal_name` is always present; the other
     * fields appear when the invoice stores them.
     *
     *
     * @var RecipientData
     */
    protected $recipient;

    /**
     * Invoice lines. Can be empty: drafts may not have lines yet, and a
     * handful of legacy imported invoices were recorded without them.
     * Creating an invoice still requires at least one line.
     *
     *
     * @var list<InvoiceLine>
     */
    protected $lines;

    /**
     * @var InvoiceTotals
     */
    protected $totals;

    /**
     * @var PaymentInfo|null
     */
    protected $paymentInfo;

    /**
     * Additional observations or notes
     *
     * @var string|null
     */
    protected $notes;

    /**
     * Only on a full invoice issued in exchange for simplified invoices: the simplified
     * invoices it replaces, each now `VOIDED` with `void_cause` `EXCHANGED`. With VeriFactu,
     * the invoice is recorded as `F3` identifying them.
     *
     *
     * @var list<string>|null
     */
    protected $replacedInvoiceIds;

    /**
     * @var string|null
     */
    protected $voidCause;

    /**
     * Reason recorded when the invoice was voided (only for voided invoices).
     *
     * @var string|null
     */
    protected $voidReason;

    /**
     * System timestamp when the invoice was voided. Automatically set at the moment the
     * void takes place and never supplied by the caller — a void cannot be dated, so the
     * deprecated `void_date` field of the void request has no effect on it.
     *
     * Invoices voided before this field existed carry the day they were voided on with a
     * time of `00:00Z`, because only the day was retained for them.
     *
     *
     * @var \DateTime|null
     */
    protected $voidedAt;

    /**
     * UUID of the invoice being rectified (only for corrective invoices)
     *
     * @var string|null
     */
    protected $rectifiedInvoiceId;

    /**
     * UUID of the source proforma this invoice was converted from
     * (only for invoices created via `convert-to-invoice`).
     *
     *
     * @var string|null
     */
    protected $sourceProformaId;

    /**
     * UUID of the live (non-deleted) invoice this proforma was converted into —
     * the inverse of `source_proforma_id`, derived at read time (not persisted).
     * Only present on the detail endpoint (`GET /v1/invoices/{invoice_id}`) for a proforma
     * in `CONVERTED` status; never included in list rows.
     *
     *
     * @var string|null
     */
    protected $convertedInvoiceId;

    /**
     * Reason for rectification (only for corrective invoices)
     *
     * @var string|null
     */
    protected $rectificationReason;

    /**
     * UUID of the recurring invoice that generated this invoice (if any)
     *
     * @var string|null
     */
    protected $recurringInvoiceId;

    /**
     * Name of the recurring invoice (denormalized for display)
     *
     * @var string|null
     */
    protected $recurringInvoiceName;

    /**
     * @var string|null
     */
    protected $rectificationType;

    /**
     * @var string|null
     */
    protected $rectificationCode;

    /**
     * Client-supplied external reference set at creation (order/cart/contract id).
     *
     * @var string|null
     */
    protected $externalRef;

    /**
     * Additional metadata in key-value format. Invoices auto-generated from a
     * connected payment platform carry system keys you can filter on:
     * - external_customer_id: Payment-platform customer (e.g. Stripe `cus_…`), present when the payment carried a customer (absent on flows with no customer, e.g. Terminal / payment links without customer collection)
     * - external_payment_id: Canonical payment reference. On Stripe this is always the PaymentIntent id (`pi_…`); the Charge, Stripe Invoice and Checkout Session ids are never used here, so every event of the same payment carries the same value.
     * - payment_intent_id: Stripe PaymentIntent id, when the payment has one
     * - charge_id: Stripe Charge id, when the payment has one
     * - payment_provider: Origin platform (e.g. STRIPE_CONNECT)
     * Plus any keys you set yourself on manually-created invoices (order ids, tenants, …).
     * See the "Filtering by metadata" guide for the full list and query rules.
     *
     *
     * @var array<string, mixed>|null
     */
    protected $metadata;

    /**
     * Whether the invoice will be automatically sent by email after issuing.
     * Only relevant for DRAFT and SCHEDULED invoices.
     *
     *
     * @var bool|null
     */
    protected $sendAutomatically;

    /**
     * Email configuration used when `send_automatically` is true.
     * If it names no recipients, the email goes to the customer's `billing_emails`, or to
     * the customer's `email` when there are none.
     *
     *
     * @var InvoiceBaseEmailConfig|null
     */
    protected $emailConfig;

    /**
     * Relative URL of the endpoint that returns the PDF download link. Relative to the
     * API base URL (e.g., https://app.beel.es/api). Note it is a link to a link: calling
     * it returns a pre-signed URL that expires in five minutes.
     *
     * Null while there is no PDF to link to: they are produced asynchronously after
     * issuing, so poll until the field appears. It is also null on a handful of very old
     * invoices that have no downloadable PDF at all.
     *
     *
     * @var string|null
     */
    protected $pdfDownloadUrl;

    /**
     * **Record of what was applied to this invoice** — not a per-invoice preference.
     *
     * Whether an invoice is registered with the AEAT is a fact of the *taxpayer*: if the issuing
     * tax ID is under the VeriFactu regime in that environment, every one of its invoices is
     * registered; if it is not, none is. That is resolved once, at issue time, against the state
     * of the account at that instant, and what this block reports is the outcome — the receipt of
     * an irreversible decision. It cannot be requested, overridden or changed per invoice.
     *
     * Present on every invoice, whatever its status. **Absent on a proforma**: a proforma is not a
     * fiscal document and is never registered, so there is no outcome to report — read
     * `verifactu` as "not applicable" when the key is missing or carries no value.
     *
     *
     * @var VeriFactu|null
     */
    protected $verifactu;

    /**
     * Files attached to the invoice, reserved for per-invoice attachments.
     *
     * To send the supporting invoices of a SUPLIDO consolidation, use
     * `options.attach_source_invoices` when issuing: they travel as a ZIP attached to
     * the outgoing email, and appear on the email delivery record rather than here.
     *
     *
     * @var list<InvoiceAttachment>|null
     */
    protected $attachments;

    /**
     * Emails through which this invoice was sent, oldest first. Resending
     * appends a record, it never replaces the previous one, and a batch send
     * (one email with several invoices) is recorded in every invoice it carried.
     *
     * Only populated in single-invoice responses (`GET /v1/invoices/{invoice_id}` and
     * the lifecycle endpoints); the list endpoint omits it.
     *
     *
     * @var list<InvoiceSendRecord>|null
     */
    protected $sendingHistory;

    /**
     * What became of the invoice's automatic email in the act that produced this response.
     *
     * Only present in the response to issuing an invoice (`POST .../invoices/{invoice_id}/issue`).
     * Issuing is a fiscal act and never fails because of the email, so a send the sending
     * policy refuses still answers `200` — this object is how it says so. Without it, a
     * refused send and an invoice that never asked for one looked identical.
     *
     *
     * @var InvoiceEmailDeliveryOutcome|null
     */
    protected $emailDelivery;

    /**
     * @var \DateTime|null
     */
    protected $deletedAt;

    /**
     * Always `null` here: the number is drawn from the series when the invoice is
     * actually generated, and a preview draws nothing.
     */
    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    /**
     * Always `null` here: the number is drawn from the series when the invoice is
    actually generated, and a preview draws nothing.
     */
    public function setInvoiceNumber(?string $invoiceNumber): self
    {
        $this->initialized['invoiceNumber'] = true;
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    public function getSeries(): SeriesInfo
    {
        return $this->series;
    }

    public function setSeries(SeriesInfo $series): self
    {
        $this->initialized['series'] = true;
        $this->series = $series;

        return $this;
    }

    /**
     * Always `null` here, for the same reason as `invoice_number`.
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * Always `null` here, for the same reason as `invoice_number`.
     */
    public function setNumber(?int $number): self
    {
        $this->initialized['number'] = true;
        $this->number = $number;

        return $this;
    }

    /**
     * - STANDARD: Standard invoice
     * - CORRECTIVE: Corrects or cancels a previous invoice
     * - SIMPLIFIED: Simplified invoice (ticket), for a recipient that is not identified. BeeL.
     *   requires a STANDARD invoice when the recipient is identified, at any amount: a
     *   SIMPLIFIED invoice whose recipient carries an `nif` or `alternative_id` is rejected
     *   with `SIMPLIFIED_INVOICE_FORBIDS_IDENTIFIED_RECIPIENT`. The only amount BeeL
     *   enforces is a cap of 3,000€ VAT included (`SIMPLIFIED_INVOICE_EXCEEDS_LEGAL_LIMIT`). The
     *   general limit of RD 1619/2012 is 400€ (art. 4.1.a); up to 3,000€ applies only to the
     *   activities listed in art. 4.2. BeeL does not check which activity the issuer carries
     *   out.
     * - PROFORMA: Commercial document (formal quote) with no fiscal validity.
     *   Never enters VeriFactu (no QR, no AEAT submission): `verifactu.enabled` is
     *   always `false`, whatever the company's regime. Requires full recipient data,
     *   like STANDARD.
     *   Cannot be corrective nor reference a rectified invoice.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * - STANDARD: Standard invoice
    - CORRECTIVE: Corrects or cancels a previous invoice
    - SIMPLIFIED: Simplified invoice (ticket), for a recipient that is not identified. BeeL.
     requires a STANDARD invoice when the recipient is identified, at any amount: a
     SIMPLIFIED invoice whose recipient carries an `nif` or `alternative_id` is rejected
     with `SIMPLIFIED_INVOICE_FORBIDS_IDENTIFIED_RECIPIENT`. The only amount BeeL
     enforces is a cap of 3,000€ VAT included (`SIMPLIFIED_INVOICE_EXCEEDS_LEGAL_LIMIT`). The
     general limit of RD 1619/2012 is 400€ (art. 4.1.a); up to 3,000€ applies only to the
     activities listed in art. 4.2. BeeL does not check which activity the issuer carries
     out.
    - PROFORMA: Commercial document (formal quote) with no fiscal validity.
     Never enters VeriFactu (no QR, no AEAT submission): `verifactu.enabled` is
     always `false`, whatever the company's regime. Requires full recipient data,
     like STANDARD.
     Cannot be corrective nor reference a rectified invoice.
     */
    public function setType(string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;

        return $this;
    }

    /**
     * - SCHEDULED: Scheduled invoice to be issued automatically on a future date
     * - DRAFT: Draft invoice not sent yet (modifiable)
     * - ISSUED: Finalized invoice with definitive number but not sent
     * - SENT: Invoice sent to customer
     * - PAID: Invoice paid
     * - OVERDUE: Reserved. No operation sets this status and it is not computed from `due_date`;
     *   an unpaid invoice past its due date keeps its status (`ISSUED` or `SENT`). Compare
     *   `due_date` with today to find overdue invoices.
     * - RECTIFIED: Partially corrected invoice (one or more PARTIAL corrective invoices)
     * - VOIDED: Cancelled invoice. Reached either through a direct void request or
     *   through a TOTAL corrective invoice; `void_cause` tells the two apart.
     * - CONVERTED: Proforma converted into an invoice (terminal; the proforma survives
     *   as the record of the accepted quote, linked to the created invoice)
     * - ACTIVE: Active proforma. The single working state of a proforma (non-fiscal
     *   document): born numbered (PRO-...) and editable, never reaching the fiscal
     *   statuses. It transitions to CONVERTED when turned into an invoice, or to VOIDED
     *   when the offer is rejected/withdrawn (POST /v1/invoices/{invoice_id}/void).
     * - EXPIRED: Proforma whose offer validity (`valid_until`) has passed. Derived on read
     *   and never stored; the proforma stays convertible and editable.
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * - SCHEDULED: Scheduled invoice to be issued automatically on a future date
    - DRAFT: Draft invoice not sent yet (modifiable)
    - ISSUED: Finalized invoice with definitive number but not sent
    - SENT: Invoice sent to customer
    - PAID: Invoice paid
    - OVERDUE: Reserved. No operation sets this status and it is not computed from `due_date`;
     an unpaid invoice past its due date keeps its status (`ISSUED` or `SENT`). Compare
     `due_date` with today to find overdue invoices.
    - RECTIFIED: Partially corrected invoice (one or more PARTIAL corrective invoices)
    - VOIDED: Cancelled invoice. Reached either through a direct void request or
     through a TOTAL corrective invoice; `void_cause` tells the two apart.
    - CONVERTED: Proforma converted into an invoice (terminal; the proforma survives
     as the record of the accepted quote, linked to the created invoice)
    - ACTIVE: Active proforma. The single working state of a proforma (non-fiscal
     document): born numbered (PRO-...) and editable, never reaching the fiscal
     statuses. It transitions to CONVERTED when turned into an invoice, or to VOIDED
     when the offer is rejected/withdrawn (POST /v1/invoices/{invoice_id}/void).
    - EXPIRED: Proforma whose offer validity (`valid_until`) has passed. Derived on read
     and never stored; the proforma stays convertible and editable.
     */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

        return $this;
    }

    /**
     * Invoice issue date. Always set to the current date when the invoice is created.
     * If the operation occurred on a different date, use `operation_date`.
     */
    public function getIssueDate(): \DateTime
    {
        return $this->issueDate;
    }

    /**
     * Invoice issue date. Always set to the current date when the invoice is created.
    If the operation occurred on a different date, use `operation_date`.
     */
    public function setIssueDate(\DateTime $issueDate): self
    {
        $this->initialized['issueDate'] = true;
        $this->issueDate = $issueDate;

        return $this;
    }

    /**
     * Date when the operation actually occurred. Used when invoicing for a past operation.
     * If null, the operation date is the same as the issue date.
     */
    public function getOperationDate(): ?\DateTime
    {
        return $this->operationDate;
    }

    /**
     * Date when the operation actually occurred. Used when invoicing for a past operation.
    If null, the operation date is the same as the issue date.
     */
    public function setOperationDate(?\DateTime $operationDate): self
    {
        $this->initialized['operationDate'] = true;
        $this->operationDate = $operationDate;

        return $this;
    }

    /**
     * Payment due date (must be the same as or after `issue_date`)
     */
    public function getDueDate(): ?\DateTime
    {
        return $this->dueDate;
    }

    /**
     * Payment due date (must be the same as or after `issue_date`)
     */
    public function setDueDate(?\DateTime $dueDate): self
    {
        $this->initialized['dueDate'] = true;
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Offer validity date. Only rendered on PROFORMA invoices; on any other
     * invoice type the field is inert (accepted and stored, but never shown on
     * the document). Purely informational — nothing is triggered automatically
     * when it passes. Not to be confused with `due_date`, the payment due date.
     */
    public function getValidUntil(): ?\DateTime
    {
        return $this->validUntil;
    }

    /**
     * Offer validity date. Only rendered on PROFORMA invoices; on any other
    invoice type the field is inert (accepted and stored, but never shown on
    the document). Purely informational — nothing is triggered automatically
    when it passes. Not to be confused with `due_date`, the payment due date.
     */
    public function setValidUntil(?\DateTime $validUntil): self
    {
        $this->initialized['validUntil'] = true;
        $this->validUntil = $validUntil;

        return $this;
    }

    /**
     * Business date when the payment was received (e.g., the date on the bank statement).
     * Set by the user when marking the invoice as paid. An invoice issued already paid gets its
     * `issue_date`: one whose `total_to_pay` is 0, or one issued from a payment already
     * confirmed by a payment integration. Only present when status is PAID.
     * Contrast with `paid_at`, which is the system timestamp of when the status change was recorded.
     */
    public function getPaymentDate(): ?\DateTime
    {
        return $this->paymentDate;
    }

    /**
     * Business date when the payment was received (e.g., the date on the bank statement).
    Set by the user when marking the invoice as paid. An invoice issued already paid gets its
    `issue_date`: one whose `total_to_pay` is 0, or one issued from a payment already
    confirmed by a payment integration. Only present when status is PAID.
    Contrast with `paid_at`, which is the system timestamp of when the status change was recorded.
     */
    public function setPaymentDate(?\DateTime $paymentDate): self
    {
        $this->initialized['paymentDate'] = true;
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /**
     * Moment the email provider ACCEPTED the invoice email — **not** the moment
     * it reached the recipient's mailbox. Present when status is SENT or later.
     *
     * What happened afterwards (delivered, bounced, opened) is not a single
     * timestamp: it lives in `sending_history`, one record per email with its
     * own status and timestamp. On a resend, `sent_at` moves to the latest
     * accepted send while `sending_history` keeps every one of them.
     */
    public function getSentAt(): ?\DateTime
    {
        return $this->sentAt;
    }

    /**
     * Moment the email provider ACCEPTED the invoice email — **not** the moment
    it reached the recipient's mailbox. Present when status is SENT or later.

    What happened afterwards (delivered, bounced, opened) is not a single
    timestamp: it lives in `sending_history`, one record per email with its
    own status and timestamp. On a resend, `sent_at` moves to the latest
    accepted send while `sending_history` keeps every one of them.
     */
    public function setSentAt(?\DateTime $sentAt): self
    {
        $this->initialized['sentAt'] = true;
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * System timestamp when the payment was recorded in the system.
     * Automatically set when the invoice status changes to PAID.
     * Contrast with `payment_date`, which is the business date chosen by the user.
     */
    public function getPaidAt(): ?\DateTime
    {
        return $this->paidAt;
    }

    /**
     * System timestamp when the payment was recorded in the system.
    Automatically set when the invoice status changes to PAID.
    Contrast with `payment_date`, which is the business date chosen by the user.
     */
    public function setPaidAt(?\DateTime $paidAt): self
    {
        $this->initialized['paidAt'] = true;
        $this->paidAt = $paidAt;

        return $this;
    }

    /**
     * Date when this draft will be auto-emitted if not manually issued.
     * Only present for drafts created from recurring invoices with `draft_in_advance`
     * enabled.
     */
    public function getAutoEmitAfter(): ?\DateTime
    {
        return $this->autoEmitAfter;
    }

    /**
     * Date when this draft will be auto-emitted if not manually issued.
    Only present for drafts created from recurring invoices with `draft_in_advance`
    enabled.
     */
    public function setAutoEmitAfter(?\DateTime $autoEmitAfter): self
    {
        $this->initialized['autoEmitAfter'] = true;
        $this->autoEmitAfter = $autoEmitAfter;

        return $this;
    }

    /**
     * Date when the invoice should be automatically processed.
     * Only present when status is SCHEDULED.
     */
    public function getScheduledFor(): ?\DateTime
    {
        return $this->scheduledFor;
    }

    /**
     * Date when the invoice should be automatically processed.
    Only present when status is SCHEDULED.
     */
    public function setScheduledFor(?\DateTime $scheduledFor): self
    {
        $this->initialized['scheduledFor'] = true;
        $this->scheduledFor = $scheduledFor;

        return $this;
    }

    public function getScheduledAction(): ?string
    {
        return $this->scheduledAction;
    }

    public function setScheduledAction(?string $scheduledAction): self
    {
        $this->initialized['scheduledAction'] = true;
        $this->scheduledAction = $scheduledAction;

        return $this;
    }

    public function getIssuer(): IssuerData
    {
        return $this->issuer;
    }

    public function setIssuer(IssuerData $issuer): self
    {
        $this->initialized['issuer'] = true;
        $this->issuer = $issuer;

        return $this;
    }

    /**
     * Recipient data as stored on the invoice. Only `legal_name` is always present; the other
     * fields appear when the invoice stores them.
     */
    public function getRecipient(): RecipientData
    {
        return $this->recipient;
    }

    /**
     * Recipient data as stored on the invoice. Only `legal_name` is always present; the other
    fields appear when the invoice stores them.
     */
    public function setRecipient(RecipientData $recipient): self
    {
        $this->initialized['recipient'] = true;
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Invoice lines. Can be empty: drafts may not have lines yet, and a
     * handful of legacy imported invoices were recorded without them.
     * Creating an invoice still requires at least one line.
     *
     *
     * @return list<InvoiceLine>
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * Invoice lines. Can be empty: drafts may not have lines yet, and a
    handful of legacy imported invoices were recorded without them.
    Creating an invoice still requires at least one line.

     *
     * @param  list<InvoiceLine>  $lines
     */
    public function setLines(array $lines): self
    {
        $this->initialized['lines'] = true;
        $this->lines = $lines;

        return $this;
    }

    public function getTotals(): InvoiceTotals
    {
        return $this->totals;
    }

    public function setTotals(InvoiceTotals $totals): self
    {
        $this->initialized['totals'] = true;
        $this->totals = $totals;

        return $this;
    }

    public function getPaymentInfo(): ?PaymentInfo
    {
        return $this->paymentInfo;
    }

    public function setPaymentInfo(?PaymentInfo $paymentInfo): self
    {
        $this->initialized['paymentInfo'] = true;
        $this->paymentInfo = $paymentInfo;

        return $this;
    }

    /**
     * Additional observations or notes
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * Additional observations or notes
     */
    public function setNotes(?string $notes): self
    {
        $this->initialized['notes'] = true;
        $this->notes = $notes;

        return $this;
    }

    /**
     * Only on a full invoice issued in exchange for simplified invoices: the simplified
     * invoices it replaces, each now `VOIDED` with `void_cause` `EXCHANGED`. With VeriFactu,
     * the invoice is recorded as `F3` identifying them.
     *
     *
     * @return list<string>|null
     */
    public function getReplacedInvoiceIds(): ?array
    {
        return $this->replacedInvoiceIds;
    }

    /**
     * Only on a full invoice issued in exchange for simplified invoices: the simplified
    invoices it replaces, each now `VOIDED` with `void_cause` `EXCHANGED`. With VeriFactu,
    the invoice is recorded as `F3` identifying them.

     *
     * @param  list<string>|null  $replacedInvoiceIds
     */
    public function setReplacedInvoiceIds(?array $replacedInvoiceIds): self
    {
        $this->initialized['replacedInvoiceIds'] = true;
        $this->replacedInvoiceIds = $replacedInvoiceIds;

        return $this;
    }

    public function getVoidCause(): ?string
    {
        return $this->voidCause;
    }

    public function setVoidCause(?string $voidCause): self
    {
        $this->initialized['voidCause'] = true;
        $this->voidCause = $voidCause;

        return $this;
    }

    /**
     * Reason recorded when the invoice was voided (only for voided invoices).
     */
    public function getVoidReason(): ?string
    {
        return $this->voidReason;
    }

    /**
     * Reason recorded when the invoice was voided (only for voided invoices).
     */
    public function setVoidReason(?string $voidReason): self
    {
        $this->initialized['voidReason'] = true;
        $this->voidReason = $voidReason;

        return $this;
    }

    /**
     * System timestamp when the invoice was voided. Automatically set at the moment the
     * void takes place and never supplied by the caller — a void cannot be dated, so the
     * deprecated `void_date` field of the void request has no effect on it.
     *
     * Invoices voided before this field existed carry the day they were voided on with a
     * time of `00:00Z`, because only the day was retained for them.
     */
    public function getVoidedAt(): ?\DateTime
    {
        return $this->voidedAt;
    }

    /**
     * System timestamp when the invoice was voided. Automatically set at the moment the
    void takes place and never supplied by the caller — a void cannot be dated, so the
    deprecated `void_date` field of the void request has no effect on it.

    Invoices voided before this field existed carry the day they were voided on with a
    time of `00:00Z`, because only the day was retained for them.
     */
    public function setVoidedAt(?\DateTime $voidedAt): self
    {
        $this->initialized['voidedAt'] = true;
        $this->voidedAt = $voidedAt;

        return $this;
    }

    /**
     * UUID of the invoice being rectified (only for corrective invoices)
     */
    public function getRectifiedInvoiceId(): ?string
    {
        return $this->rectifiedInvoiceId;
    }

    /**
     * UUID of the invoice being rectified (only for corrective invoices)
     */
    public function setRectifiedInvoiceId(?string $rectifiedInvoiceId): self
    {
        $this->initialized['rectifiedInvoiceId'] = true;
        $this->rectifiedInvoiceId = $rectifiedInvoiceId;

        return $this;
    }

    /**
     * UUID of the source proforma this invoice was converted from
     * (only for invoices created via `convert-to-invoice`).
     */
    public function getSourceProformaId(): ?string
    {
        return $this->sourceProformaId;
    }

    /**
     * UUID of the source proforma this invoice was converted from
    (only for invoices created via `convert-to-invoice`).
     */
    public function setSourceProformaId(?string $sourceProformaId): self
    {
        $this->initialized['sourceProformaId'] = true;
        $this->sourceProformaId = $sourceProformaId;

        return $this;
    }

    /**
     * UUID of the live (non-deleted) invoice this proforma was converted into —
     * the inverse of `source_proforma_id`, derived at read time (not persisted).
     * Only present on the detail endpoint (`GET /v1/invoices/{invoice_id}`) for a proforma
     * in `CONVERTED` status; never included in list rows.
     */
    public function getConvertedInvoiceId(): ?string
    {
        return $this->convertedInvoiceId;
    }

    /**
     * UUID of the live (non-deleted) invoice this proforma was converted into —
    the inverse of `source_proforma_id`, derived at read time (not persisted).
    Only present on the detail endpoint (`GET /v1/invoices/{invoice_id}`) for a proforma
    in `CONVERTED` status; never included in list rows.
     */
    public function setConvertedInvoiceId(?string $convertedInvoiceId): self
    {
        $this->initialized['convertedInvoiceId'] = true;
        $this->convertedInvoiceId = $convertedInvoiceId;

        return $this;
    }

    /**
     * Reason for rectification (only for corrective invoices)
     */
    public function getRectificationReason(): ?string
    {
        return $this->rectificationReason;
    }

    /**
     * Reason for rectification (only for corrective invoices)
     */
    public function setRectificationReason(?string $rectificationReason): self
    {
        $this->initialized['rectificationReason'] = true;
        $this->rectificationReason = $rectificationReason;

        return $this;
    }

    /**
     * UUID of the recurring invoice that generated this invoice (if any)
     */
    public function getRecurringInvoiceId(): ?string
    {
        return $this->recurringInvoiceId;
    }

    /**
     * UUID of the recurring invoice that generated this invoice (if any)
     */
    public function setRecurringInvoiceId(?string $recurringInvoiceId): self
    {
        $this->initialized['recurringInvoiceId'] = true;
        $this->recurringInvoiceId = $recurringInvoiceId;

        return $this;
    }

    /**
     * Name of the recurring invoice (denormalized for display)
     */
    public function getRecurringInvoiceName(): ?string
    {
        return $this->recurringInvoiceName;
    }

    /**
     * Name of the recurring invoice (denormalized for display)
     */
    public function setRecurringInvoiceName(?string $recurringInvoiceName): self
    {
        $this->initialized['recurringInvoiceName'] = true;
        $this->recurringInvoiceName = $recurringInvoiceName;

        return $this;
    }

    public function getRectificationType(): ?string
    {
        return $this->rectificationType;
    }

    public function setRectificationType(?string $rectificationType): self
    {
        $this->initialized['rectificationType'] = true;
        $this->rectificationType = $rectificationType;

        return $this;
    }

    public function getRectificationCode(): ?string
    {
        return $this->rectificationCode;
    }

    public function setRectificationCode(?string $rectificationCode): self
    {
        $this->initialized['rectificationCode'] = true;
        $this->rectificationCode = $rectificationCode;

        return $this;
    }

    /**
     * Client-supplied external reference set at creation (order/cart/contract id).
     */
    public function getExternalRef(): ?string
    {
        return $this->externalRef;
    }

    /**
     * Client-supplied external reference set at creation (order/cart/contract id).
     */
    public function setExternalRef(?string $externalRef): self
    {
        $this->initialized['externalRef'] = true;
        $this->externalRef = $externalRef;

        return $this;
    }

    /**
     * Additional metadata in key-value format. Invoices auto-generated from a
     * connected payment platform carry system keys you can filter on:
     * - external_customer_id: Payment-platform customer (e.g. Stripe `cus_…`), present when the payment carried a customer (absent on flows with no customer, e.g. Terminal / payment links without customer collection)
     * - external_payment_id: Canonical payment reference. On Stripe this is always the PaymentIntent id (`pi_…`); the Charge, Stripe Invoice and Checkout Session ids are never used here, so every event of the same payment carries the same value.
     * - payment_intent_id: Stripe PaymentIntent id, when the payment has one
     * - charge_id: Stripe Charge id, when the payment has one
     * - payment_provider: Origin platform (e.g. STRIPE_CONNECT)
     * Plus any keys you set yourself on manually-created invoices (order ids, tenants, …).
     * See the "Filtering by metadata" guide for the full list and query rules.
     *
     *
     * @return array<string, mixed>|null
     */
    public function getMetadata(): ?iterable
    {
        return $this->metadata;
    }

    /**
     * Additional metadata in key-value format. Invoices auto-generated from a
    connected payment platform carry system keys you can filter on:
    - external_customer_id: Payment-platform customer (e.g. Stripe `cus_…`), present when the payment carried a customer (absent on flows with no customer, e.g. Terminal / payment links without customer collection)
    - external_payment_id: Canonical payment reference. On Stripe this is always the PaymentIntent id (`pi_…`); the Charge, Stripe Invoice and Checkout Session ids are never used here, so every event of the same payment carries the same value.
    - payment_intent_id: Stripe PaymentIntent id, when the payment has one
    - charge_id: Stripe Charge id, when the payment has one
    - payment_provider: Origin platform (e.g. STRIPE_CONNECT)
    Plus any keys you set yourself on manually-created invoices (order ids, tenants, …).
    See the "Filtering by metadata" guide for the full list and query rules.

     *
     * @param  array<string, mixed>|null  $metadata
     */
    public function setMetadata(?iterable $metadata): self
    {
        $this->initialized['metadata'] = true;
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Whether the invoice will be automatically sent by email after issuing.
     * Only relevant for DRAFT and SCHEDULED invoices.
     */
    public function getSendAutomatically(): ?bool
    {
        return $this->sendAutomatically;
    }

    /**
     * Whether the invoice will be automatically sent by email after issuing.
    Only relevant for DRAFT and SCHEDULED invoices.
     */
    public function setSendAutomatically(?bool $sendAutomatically): self
    {
        $this->initialized['sendAutomatically'] = true;
        $this->sendAutomatically = $sendAutomatically;

        return $this;
    }

    /**
     * Email configuration used when `send_automatically` is true.
     * If it names no recipients, the email goes to the customer's `billing_emails`, or to
     * the customer's `email` when there are none.
     */
    public function getEmailConfig(): ?InvoiceBaseEmailConfig
    {
        return $this->emailConfig;
    }

    /**
     * Email configuration used when `send_automatically` is true.
    If it names no recipients, the email goes to the customer's `billing_emails`, or to
    the customer's `email` when there are none.
     */
    public function setEmailConfig(?InvoiceBaseEmailConfig $emailConfig): self
    {
        $this->initialized['emailConfig'] = true;
        $this->emailConfig = $emailConfig;

        return $this;
    }

    /**
     * Relative URL of the endpoint that returns the PDF download link. Relative to the
     * API base URL (e.g., https://app.beel.es/api). Note it is a link to a link: calling
     * it returns a pre-signed URL that expires in five minutes.
     *
     * Null while there is no PDF to link to: they are produced asynchronously after
     * issuing, so poll until the field appears. It is also null on a handful of very old
     * invoices that have no downloadable PDF at all.
     */
    public function getPdfDownloadUrl(): ?string
    {
        return $this->pdfDownloadUrl;
    }

    /**
     * Relative URL of the endpoint that returns the PDF download link. Relative to the
    API base URL (e.g., https://app.beel.es/api). Note it is a link to a link: calling
    it returns a pre-signed URL that expires in five minutes.

    Null while there is no PDF to link to: they are produced asynchronously after
    issuing, so poll until the field appears. It is also null on a handful of very old
    invoices that have no downloadable PDF at all.
     */
    public function setPdfDownloadUrl(?string $pdfDownloadUrl): self
    {
        $this->initialized['pdfDownloadUrl'] = true;
        $this->pdfDownloadUrl = $pdfDownloadUrl;

        return $this;
    }

    /**
     * **Record of what was applied to this invoice** — not a per-invoice preference.
     *
     * Whether an invoice is registered with the AEAT is a fact of the *taxpayer*: if the issuing
     * tax ID is under the VeriFactu regime in that environment, every one of its invoices is
     * registered; if it is not, none is. That is resolved once, at issue time, against the state
     * of the account at that instant, and what this block reports is the outcome — the receipt of
     * an irreversible decision. It cannot be requested, overridden or changed per invoice.
     *
     * Present on every invoice, whatever its status. **Absent on a proforma**: a proforma is not a
     * fiscal document and is never registered, so there is no outcome to report — read
     * `verifactu` as "not applicable" when the key is missing or carries no value.
     */
    public function getVerifactu(): ?VeriFactu
    {
        return $this->verifactu;
    }

    /**
     * **Record of what was applied to this invoice** — not a per-invoice preference.

    Whether an invoice is registered with the AEAT is a fact of the *taxpayer*: if the issuing
    tax ID is under the VeriFactu regime in that environment, every one of its invoices is
    registered; if it is not, none is. That is resolved once, at issue time, against the state
    of the account at that instant, and what this block reports is the outcome — the receipt of
    an irreversible decision. It cannot be requested, overridden or changed per invoice.

    Present on every invoice, whatever its status. **Absent on a proforma**: a proforma is not a
    fiscal document and is never registered, so there is no outcome to report — read
    `verifactu` as "not applicable" when the key is missing or carries no value.
     */
    public function setVerifactu(?VeriFactu $verifactu): self
    {
        $this->initialized['verifactu'] = true;
        $this->verifactu = $verifactu;

        return $this;
    }

    /**
     * Files attached to the invoice, reserved for per-invoice attachments.
     *
     * To send the supporting invoices of a SUPLIDO consolidation, use
     * `options.attach_source_invoices` when issuing: they travel as a ZIP attached to
     * the outgoing email, and appear on the email delivery record rather than here.
     *
     *
     * @return list<InvoiceAttachment>|null
     */
    public function getAttachments(): ?array
    {
        return $this->attachments;
    }

    /**
     * Files attached to the invoice, reserved for per-invoice attachments.

    To send the supporting invoices of a SUPLIDO consolidation, use
    `options.attach_source_invoices` when issuing: they travel as a ZIP attached to
    the outgoing email, and appear on the email delivery record rather than here.

     *
     * @param  list<InvoiceAttachment>|null  $attachments
     */
    public function setAttachments(?array $attachments): self
    {
        $this->initialized['attachments'] = true;
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * Emails through which this invoice was sent, oldest first. Resending
     * appends a record, it never replaces the previous one, and a batch send
     * (one email with several invoices) is recorded in every invoice it carried.
     *
     * Only populated in single-invoice responses (`GET /v1/invoices/{invoice_id}` and
     * the lifecycle endpoints); the list endpoint omits it.
     *
     *
     * @return list<InvoiceSendRecord>|null
     */
    public function getSendingHistory(): ?array
    {
        return $this->sendingHistory;
    }

    /**
     * Emails through which this invoice was sent, oldest first. Resending
    appends a record, it never replaces the previous one, and a batch send
    (one email with several invoices) is recorded in every invoice it carried.

    Only populated in single-invoice responses (`GET /v1/invoices/{invoice_id}` and
    the lifecycle endpoints); the list endpoint omits it.

     *
     * @param  list<InvoiceSendRecord>|null  $sendingHistory
     */
    public function setSendingHistory(?array $sendingHistory): self
    {
        $this->initialized['sendingHistory'] = true;
        $this->sendingHistory = $sendingHistory;

        return $this;
    }

    /**
     * What became of the invoice's automatic email in the act that produced this response.
     *
     * Only present in the response to issuing an invoice (`POST .../invoices/{invoice_id}/issue`).
     * Issuing is a fiscal act and never fails because of the email, so a send the sending
     * policy refuses still answers `200` — this object is how it says so. Without it, a
     * refused send and an invoice that never asked for one looked identical.
     */
    public function getEmailDelivery(): ?InvoiceEmailDeliveryOutcome
    {
        return $this->emailDelivery;
    }

    /**
     * What became of the invoice's automatic email in the act that produced this response.

    Only present in the response to issuing an invoice (`POST .../invoices/{invoice_id}/issue`).
    Issuing is a fiscal act and never fails because of the email, so a send the sending
    policy refuses still answers `200` — this object is how it says so. Without it, a
    refused send and an invoice that never asked for one looked identical.
     */
    public function setEmailDelivery(?InvoiceEmailDeliveryOutcome $emailDelivery): self
    {
        $this->initialized['emailDelivery'] = true;
        $this->emailDelivery = $emailDelivery;

        return $this;
    }

    public function getDeletedAt(): ?\DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTime $deletedAt): self
    {
        $this->initialized['deletedAt'] = true;
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['invoiceNumber' => ['invoice_number', 'getInvoiceNumber', 'setInvoiceNumber'], 'series' => ['series', 'getSeries', 'setSeries'], 'number' => ['number', 'getNumber', 'setNumber'], 'type' => ['type', 'getType', 'setType'], 'status' => ['status', 'getStatus', 'setStatus'], 'issueDate' => ['issue_date', 'getIssueDate', 'setIssueDate'], 'operationDate' => ['operation_date', 'getOperationDate', 'setOperationDate'], 'dueDate' => ['due_date', 'getDueDate', 'setDueDate'], 'validUntil' => ['valid_until', 'getValidUntil', 'setValidUntil'], 'paymentDate' => ['payment_date', 'getPaymentDate', 'setPaymentDate'], 'sentAt' => ['sent_at', 'getSentAt', 'setSentAt'], 'paidAt' => ['paid_at', 'getPaidAt', 'setPaidAt'], 'autoEmitAfter' => ['auto_emit_after', 'getAutoEmitAfter', 'setAutoEmitAfter'], 'scheduledFor' => ['scheduled_for', 'getScheduledFor', 'setScheduledFor'], 'scheduledAction' => ['scheduled_action', 'getScheduledAction', 'setScheduledAction'], 'issuer' => ['issuer', 'getIssuer', 'setIssuer'], 'recipient' => ['recipient', 'getRecipient', 'setRecipient'], 'lines' => ['lines', 'getLines', 'setLines'], 'totals' => ['totals', 'getTotals', 'setTotals'], 'paymentInfo' => ['payment_info', 'getPaymentInfo', 'setPaymentInfo'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'replacedInvoiceIds' => ['replaced_invoice_ids', 'getReplacedInvoiceIds', 'setReplacedInvoiceIds'], 'voidCause' => ['void_cause', 'getVoidCause', 'setVoidCause'], 'voidReason' => ['void_reason', 'getVoidReason', 'setVoidReason'], 'voidedAt' => ['voided_at', 'getVoidedAt', 'setVoidedAt'], 'rectifiedInvoiceId' => ['rectified_invoice_id', 'getRectifiedInvoiceId', 'setRectifiedInvoiceId'], 'sourceProformaId' => ['source_proforma_id', 'getSourceProformaId', 'setSourceProformaId'], 'convertedInvoiceId' => ['converted_invoice_id', 'getConvertedInvoiceId', 'setConvertedInvoiceId'], 'rectificationReason' => ['rectification_reason', 'getRectificationReason', 'setRectificationReason'], 'recurringInvoiceId' => ['recurring_invoice_id', 'getRecurringInvoiceId', 'setRecurringInvoiceId'], 'recurringInvoiceName' => ['recurring_invoice_name', 'getRecurringInvoiceName', 'setRecurringInvoiceName'], 'rectificationType' => ['rectification_type', 'getRectificationType', 'setRectificationType'], 'rectificationCode' => ['rectification_code', 'getRectificationCode', 'setRectificationCode'], 'externalRef' => ['external_ref', 'getExternalRef', 'setExternalRef'], 'metadata' => ['metadata', 'getMetadata', 'setMetadata'], 'sendAutomatically' => ['send_automatically', 'getSendAutomatically', 'setSendAutomatically'], 'emailConfig' => ['email_config', 'getEmailConfig', 'setEmailConfig'], 'pdfDownloadUrl' => ['pdf_download_url', 'getPdfDownloadUrl', 'setPdfDownloadUrl'], 'verifactu' => ['verifactu', 'getVerifactu', 'setVerifactu'], 'attachments' => ['attachments', 'getAttachments', 'setAttachments'], 'sendingHistory' => ['sending_history', 'getSendingHistory', 'setSendingHistory'], 'emailDelivery' => ['email_delivery', 'getEmailDelivery', 'setEmailDelivery'], 'deletedAt' => ['deleted_at', 'getDeletedAt', 'setDeletedAt']];
    }
}
