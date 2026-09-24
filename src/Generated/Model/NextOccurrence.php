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
     * - SIMPLIFIED: Simplified invoice without all recipient requirements (up to 3,000€ VAT included)
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
     * - OVERDUE: Overdue invoice (not paid after due date)
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
     * @var \DateTime
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
     * Set by the user when marking the invoice as paid. Only present when status is PAID.
     * Contrast with `paid_at`, which is the system timestamp of when the status change was recorded.
     * 
     *
     * @var \DateTime
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
     * Action to perform when processing a scheduled invoice:
     * - DRAFT: Create as draft for manual review
     * - ISSUE_AND_SEND: Issue and send automatically via email
     * 
     *
     * @var string
     */
    protected $scheduledAction;
    /**
     * @var IssuerData
     */
    protected $issuer;
    /**
     * Recipient data in the invoice response.
     * Note: For simplified invoices, only legal_name may be present.
     * NIF and address are optional for SIMPLIFIED type invoices.
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
     * @var PaymentInfo
     */
    protected $paymentInfo;
    /**
     * Additional observations or notes
     *
     * @var string
     */
    protected $notes;
    /**
     * Why a `VOIDED` invoice reached that status:
     * - VOID_REQUEST: Voided directly via `POST /v1/invoices/{invoice_id}/void`. The
     *   original VeriFactu record is cancelled with the tax authority.
     * - TOTAL_CORRECTIVE: Voided as a result of issuing a TOTAL corrective invoice over
     *   it. The original VeriFactu record stays untouched; the corrective invoice is
     *   reported as a new record instead.
     * 
     * Only present on voided invoices.
     * 
     *
     * @var string
     */
    protected $voidCause;
    /**
     * Reason recorded when the invoice was voided (only for voided invoices).
     *
     * @var string
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
     * @var string
     */
    protected $rectifiedInvoiceId;
    /**
     * UUID of the source proforma this invoice was converted from
     * (only for invoices created via `convert-to-invoice`).
     * 
     *
     * @var string
     */
    protected $sourceProformaId;
    /**
     * UUID of the live (non-deleted) invoice this proforma was converted into —
     * the inverse of `source_proforma_id`, derived at read time (not persisted).
     * Only present on the detail endpoint (`GET /v1/invoices/{invoice_id}`) for a proforma
     * in `CONVERTED` status; never included in list rows.
     * 
     *
     * @var string
     */
    protected $convertedInvoiceId;
    /**
     * Reason for rectification (only for corrective invoices)
     *
     * @var string
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
     * Type of rectification applied to a corrective invoice:
     * - TOTAL: Completely cancels the original invoice (status → VOIDED)
     * - PARTIAL: Partially corrects the original invoice (status → RECTIFIED)
     * 
     *
     * @var string
     */
    protected $rectificationType;
    /**
     * Rectification codes according to VeriFactu regulations (AEAT):
     * - R1: Error founded in law and Art. 80 One, Two and Six LIVA
     * - R2: Article 80 Three LIVA (Bankruptcy proceedings)
     * - R3: Article 80 Four LIVA (Uncollectable debts)
     * - R4: Other causes
     * - R5: Simplified invoices (Art. 80 One and Two LIVA) - ONLY for simplified invoices
     * 
     *
     * @var string
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
     * @var array<string, mixed>
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
     * If null, the recipient's default email is used.
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
     *
     * @var VeriFactu
     */
    protected $verifactu;
    /**
     * @var list<InvoiceAttachment>
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
     * @var list<InvoiceSendRecord>
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
     * @var InvoiceEmailDeliveryOutcome
     */
    protected $emailDelivery;
    /**
     * @var \DateTime|null
     */
    protected $deletedAt;
    /**
     * Always `null` here: the number is drawn from the series when the invoice is
     * actually generated, and a preview draws nothing.
     * 
     *
     * @return string|null
     */
    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }
    /**
    * Always `null` here: the number is drawn from the series when the invoice is
    actually generated, and a preview draws nothing.
    
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
     * @return SeriesInfo
     */
    public function getSeries(): SeriesInfo
    {
        return $this->series;
    }
    /**
     * @param SeriesInfo $series
     *
     * @return self
     */
    public function setSeries(SeriesInfo $series): self
    {
        $this->initialized['series'] = true;
        $this->series = $series;
        return $this;
    }
    /**
     * Always `null` here, for the same reason as `invoice_number`.
     * 
     *
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }
    /**
     * Always `null` here, for the same reason as `invoice_number`.
     *
     * @param int|null $number
     *
     * @return self
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
     * - SIMPLIFIED: Simplified invoice without all recipient requirements (up to 3,000€ VAT included)
     * - PROFORMA: Commercial document (formal quote) with no fiscal validity.
     *   Never enters VeriFactu (no QR, no AEAT submission): `verifactu.enabled` is
     *   always `false`, whatever the company's regime. Requires full recipient data,
     *   like STANDARD.
     *   Cannot be corrective nor reference a rectified invoice.
     * 
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
    * - STANDARD: Standard invoice
    - CORRECTIVE: Corrects or cancels a previous invoice
    - SIMPLIFIED: Simplified invoice without all recipient requirements (up to 3,000€ VAT included)
    - PROFORMA: Commercial document (formal quote) with no fiscal validity.
     Never enters VeriFactu (no QR, no AEAT submission): `verifactu.enabled` is
     always `false`, whatever the company's regime. Requires full recipient data,
     like STANDARD.
     Cannot be corrective nor reference a rectified invoice.
    
    *
    * @param string $type
    *
    * @return self
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
     * - OVERDUE: Overdue invoice (not paid after due date)
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
     * @return string
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
    - OVERDUE: Overdue invoice (not paid after due date)
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
    
    *
    * @param string $status
    *
    * @return self
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
     * 
     *
     * @return \DateTime
     */
    public function getIssueDate(): \DateTime
    {
        return $this->issueDate;
    }
    /**
    * Invoice issue date. Always set to the current date when the invoice is created.
    If the operation occurred on a different date, use `operation_date`.
    
    *
    * @param \DateTime $issueDate
    *
    * @return self
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
     * 
     *
     * @return \DateTime|null
     */
    public function getOperationDate(): ?\DateTime
    {
        return $this->operationDate;
    }
    /**
    * Date when the operation actually occurred. Used when invoicing for a past operation.
    If null, the operation date is the same as the issue date.
    
    *
    * @param \DateTime|null $operationDate
    *
    * @return self
    */
    public function setOperationDate(?\DateTime $operationDate): self
    {
        $this->initialized['operationDate'] = true;
        $this->operationDate = $operationDate;
        return $this;
    }
    /**
     * Payment due date (must be the same as or after `issue_date`)
     *
     * @return \DateTime
     */
    public function getDueDate(): \DateTime
    {
        return $this->dueDate;
    }
    /**
     * Payment due date (must be the same as or after `issue_date`)
     *
     * @param \DateTime $dueDate
     *
     * @return self
     */
    public function setDueDate(\DateTime $dueDate): self
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
     * 
     *
     * @return \DateTime|null
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
    
    *
    * @param \DateTime|null $validUntil
    *
    * @return self
    */
    public function setValidUntil(?\DateTime $validUntil): self
    {
        $this->initialized['validUntil'] = true;
        $this->validUntil = $validUntil;
        return $this;
    }
    /**
     * Business date when the payment was received (e.g., the date on the bank statement).
     * Set by the user when marking the invoice as paid. Only present when status is PAID.
     * Contrast with `paid_at`, which is the system timestamp of when the status change was recorded.
     * 
     *
     * @return \DateTime
     */
    public function getPaymentDate(): \DateTime
    {
        return $this->paymentDate;
    }
    /**
    * Business date when the payment was received (e.g., the date on the bank statement).
    Set by the user when marking the invoice as paid. Only present when status is PAID.
    Contrast with `paid_at`, which is the system timestamp of when the status change was recorded.
    
    *
    * @param \DateTime $paymentDate
    *
    * @return self
    */
    public function setPaymentDate(\DateTime $paymentDate): self
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
     * 
     *
     * @return \DateTime|null
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
    
    *
    * @param \DateTime|null $sentAt
    *
    * @return self
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
     * 
     *
     * @return \DateTime|null
     */
    public function getPaidAt(): ?\DateTime
    {
        return $this->paidAt;
    }
    /**
    * System timestamp when the payment was recorded in the system.
    Automatically set when the invoice status changes to PAID.
    Contrast with `payment_date`, which is the business date chosen by the user.
    
    *
    * @param \DateTime|null $paidAt
    *
    * @return self
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
     * 
     *
     * @return \DateTime|null
     */
    public function getAutoEmitAfter(): ?\DateTime
    {
        return $this->autoEmitAfter;
    }
    /**
    * Date when this draft will be auto-emitted if not manually issued.
    Only present for drafts created from recurring invoices with `draft_in_advance`
    enabled.
    
    *
    * @param \DateTime|null $autoEmitAfter
    *
    * @return self
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
     * 
     *
     * @return \DateTime|null
     */
    public function getScheduledFor(): ?\DateTime
    {
        return $this->scheduledFor;
    }
    /**
    * Date when the invoice should be automatically processed.
    Only present when status is SCHEDULED.
    
    *
    * @param \DateTime|null $scheduledFor
    *
    * @return self
    */
    public function setScheduledFor(?\DateTime $scheduledFor): self
    {
        $this->initialized['scheduledFor'] = true;
        $this->scheduledFor = $scheduledFor;
        return $this;
    }
    /**
     * Action to perform when processing a scheduled invoice:
     * - DRAFT: Create as draft for manual review
     * - ISSUE_AND_SEND: Issue and send automatically via email
     * 
     *
     * @return string
     */
    public function getScheduledAction(): string
    {
        return $this->scheduledAction;
    }
    /**
    * Action to perform when processing a scheduled invoice:
    - DRAFT: Create as draft for manual review
    - ISSUE_AND_SEND: Issue and send automatically via email
    
    *
    * @param string $scheduledAction
    *
    * @return self
    */
    public function setScheduledAction(string $scheduledAction): self
    {
        $this->initialized['scheduledAction'] = true;
        $this->scheduledAction = $scheduledAction;
        return $this;
    }
    /**
     * @return IssuerData
     */
    public function getIssuer(): IssuerData
    {
        return $this->issuer;
    }
    /**
     * @param IssuerData $issuer
     *
     * @return self
     */
    public function setIssuer(IssuerData $issuer): self
    {
        $this->initialized['issuer'] = true;
        $this->issuer = $issuer;
        return $this;
    }
    /**
     * Recipient data in the invoice response.
     * Note: For simplified invoices, only legal_name may be present.
     * NIF and address are optional for SIMPLIFIED type invoices.
     * 
     *
     * @return RecipientData
     */
    public function getRecipient(): RecipientData
    {
        return $this->recipient;
    }
    /**
    * Recipient data in the invoice response.
    Note: For simplified invoices, only legal_name may be present.
    NIF and address are optional for SIMPLIFIED type invoices.
    
    *
    * @param RecipientData $recipient
    *
    * @return self
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
    * @param list<InvoiceLine> $lines
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
     * @return InvoiceTotals
     */
    public function getTotals(): InvoiceTotals
    {
        return $this->totals;
    }
    /**
     * @param InvoiceTotals $totals
     *
     * @return self
     */
    public function setTotals(InvoiceTotals $totals): self
    {
        $this->initialized['totals'] = true;
        $this->totals = $totals;
        return $this;
    }
    /**
     * @return PaymentInfo
     */
    public function getPaymentInfo(): PaymentInfo
    {
        return $this->paymentInfo;
    }
    /**
     * @param PaymentInfo $paymentInfo
     *
     * @return self
     */
    public function setPaymentInfo(PaymentInfo $paymentInfo): self
    {
        $this->initialized['paymentInfo'] = true;
        $this->paymentInfo = $paymentInfo;
        return $this;
    }
    /**
     * Additional observations or notes
     *
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }
    /**
     * Additional observations or notes
     *
     * @param string $notes
     *
     * @return self
     */
    public function setNotes(string $notes): self
    {
        $this->initialized['notes'] = true;
        $this->notes = $notes;
        return $this;
    }
    /**
     * Why a `VOIDED` invoice reached that status:
     * - VOID_REQUEST: Voided directly via `POST /v1/invoices/{invoice_id}/void`. The
     *   original VeriFactu record is cancelled with the tax authority.
     * - TOTAL_CORRECTIVE: Voided as a result of issuing a TOTAL corrective invoice over
     *   it. The original VeriFactu record stays untouched; the corrective invoice is
     *   reported as a new record instead.
     * 
     * Only present on voided invoices.
     * 
     *
     * @return string
     */
    public function getVoidCause(): string
    {
        return $this->voidCause;
    }
    /**
    * Why a `VOIDED` invoice reached that status:
    - VOID_REQUEST: Voided directly via `POST /v1/invoices/{invoice_id}/void`. The
     original VeriFactu record is cancelled with the tax authority.
    - TOTAL_CORRECTIVE: Voided as a result of issuing a TOTAL corrective invoice over
     it. The original VeriFactu record stays untouched; the corrective invoice is
     reported as a new record instead.
    
    Only present on voided invoices.
    
    *
    * @param string $voidCause
    *
    * @return self
    */
    public function setVoidCause(string $voidCause): self
    {
        $this->initialized['voidCause'] = true;
        $this->voidCause = $voidCause;
        return $this;
    }
    /**
     * Reason recorded when the invoice was voided (only for voided invoices).
     *
     * @return string
     */
    public function getVoidReason(): string
    {
        return $this->voidReason;
    }
    /**
     * Reason recorded when the invoice was voided (only for voided invoices).
     *
     * @param string $voidReason
     *
     * @return self
     */
    public function setVoidReason(string $voidReason): self
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
     * 
     *
     * @return \DateTime|null
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
    
    *
    * @param \DateTime|null $voidedAt
    *
    * @return self
    */
    public function setVoidedAt(?\DateTime $voidedAt): self
    {
        $this->initialized['voidedAt'] = true;
        $this->voidedAt = $voidedAt;
        return $this;
    }
    /**
     * UUID of the invoice being rectified (only for corrective invoices)
     *
     * @return string
     */
    public function getRectifiedInvoiceId(): string
    {
        return $this->rectifiedInvoiceId;
    }
    /**
     * UUID of the invoice being rectified (only for corrective invoices)
     *
     * @param string $rectifiedInvoiceId
     *
     * @return self
     */
    public function setRectifiedInvoiceId(string $rectifiedInvoiceId): self
    {
        $this->initialized['rectifiedInvoiceId'] = true;
        $this->rectifiedInvoiceId = $rectifiedInvoiceId;
        return $this;
    }
    /**
     * UUID of the source proforma this invoice was converted from
     * (only for invoices created via `convert-to-invoice`).
     * 
     *
     * @return string
     */
    public function getSourceProformaId(): string
    {
        return $this->sourceProformaId;
    }
    /**
    * UUID of the source proforma this invoice was converted from
    (only for invoices created via `convert-to-invoice`).
    
    *
    * @param string $sourceProformaId
    *
    * @return self
    */
    public function setSourceProformaId(string $sourceProformaId): self
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
     * 
     *
     * @return string
     */
    public function getConvertedInvoiceId(): string
    {
        return $this->convertedInvoiceId;
    }
    /**
    * UUID of the live (non-deleted) invoice this proforma was converted into —
    the inverse of `source_proforma_id`, derived at read time (not persisted).
    Only present on the detail endpoint (`GET /v1/invoices/{invoice_id}`) for a proforma
    in `CONVERTED` status; never included in list rows.
    
    *
    * @param string $convertedInvoiceId
    *
    * @return self
    */
    public function setConvertedInvoiceId(string $convertedInvoiceId): self
    {
        $this->initialized['convertedInvoiceId'] = true;
        $this->convertedInvoiceId = $convertedInvoiceId;
        return $this;
    }
    /**
     * Reason for rectification (only for corrective invoices)
     *
     * @return string
     */
    public function getRectificationReason(): string
    {
        return $this->rectificationReason;
    }
    /**
     * Reason for rectification (only for corrective invoices)
     *
     * @param string $rectificationReason
     *
     * @return self
     */
    public function setRectificationReason(string $rectificationReason): self
    {
        $this->initialized['rectificationReason'] = true;
        $this->rectificationReason = $rectificationReason;
        return $this;
    }
    /**
     * UUID of the recurring invoice that generated this invoice (if any)
     *
     * @return string|null
     */
    public function getRecurringInvoiceId(): ?string
    {
        return $this->recurringInvoiceId;
    }
    /**
     * UUID of the recurring invoice that generated this invoice (if any)
     *
     * @param string|null $recurringInvoiceId
     *
     * @return self
     */
    public function setRecurringInvoiceId(?string $recurringInvoiceId): self
    {
        $this->initialized['recurringInvoiceId'] = true;
        $this->recurringInvoiceId = $recurringInvoiceId;
        return $this;
    }
    /**
     * Name of the recurring invoice (denormalized for display)
     *
     * @return string|null
     */
    public function getRecurringInvoiceName(): ?string
    {
        return $this->recurringInvoiceName;
    }
    /**
     * Name of the recurring invoice (denormalized for display)
     *
     * @param string|null $recurringInvoiceName
     *
     * @return self
     */
    public function setRecurringInvoiceName(?string $recurringInvoiceName): self
    {
        $this->initialized['recurringInvoiceName'] = true;
        $this->recurringInvoiceName = $recurringInvoiceName;
        return $this;
    }
    /**
     * Type of rectification applied to a corrective invoice:
     * - TOTAL: Completely cancels the original invoice (status → VOIDED)
     * - PARTIAL: Partially corrects the original invoice (status → RECTIFIED)
     * 
     *
     * @return string
     */
    public function getRectificationType(): string
    {
        return $this->rectificationType;
    }
    /**
    * Type of rectification applied to a corrective invoice:
    - TOTAL: Completely cancels the original invoice (status → VOIDED)
    - PARTIAL: Partially corrects the original invoice (status → RECTIFIED)
    
    *
    * @param string $rectificationType
    *
    * @return self
    */
    public function setRectificationType(string $rectificationType): self
    {
        $this->initialized['rectificationType'] = true;
        $this->rectificationType = $rectificationType;
        return $this;
    }
    /**
     * Rectification codes according to VeriFactu regulations (AEAT):
     * - R1: Error founded in law and Art. 80 One, Two and Six LIVA
     * - R2: Article 80 Three LIVA (Bankruptcy proceedings)
     * - R3: Article 80 Four LIVA (Uncollectable debts)
     * - R4: Other causes
     * - R5: Simplified invoices (Art. 80 One and Two LIVA) - ONLY for simplified invoices
     * 
     *
     * @return string
     */
    public function getRectificationCode(): string
    {
        return $this->rectificationCode;
    }
    /**
    * Rectification codes according to VeriFactu regulations (AEAT):
    - R1: Error founded in law and Art. 80 One, Two and Six LIVA
    - R2: Article 80 Three LIVA (Bankruptcy proceedings)
    - R3: Article 80 Four LIVA (Uncollectable debts)
    - R4: Other causes
    - R5: Simplified invoices (Art. 80 One and Two LIVA) - ONLY for simplified invoices
    
    *
    * @param string $rectificationCode
    *
    * @return self
    */
    public function setRectificationCode(string $rectificationCode): self
    {
        $this->initialized['rectificationCode'] = true;
        $this->rectificationCode = $rectificationCode;
        return $this;
    }
    /**
     * Client-supplied external reference set at creation (order/cart/contract id).
     *
     * @return string|null
     */
    public function getExternalRef(): ?string
    {
        return $this->externalRef;
    }
    /**
     * Client-supplied external reference set at creation (order/cart/contract id).
     *
     * @param string|null $externalRef
     *
     * @return self
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
     * @return array<string, mixed>
     */
    public function getMetadata(): iterable
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
    * @param array<string, mixed> $metadata
    *
    * @return self
    */
    public function setMetadata(iterable $metadata): self
    {
        $this->initialized['metadata'] = true;
        $this->metadata = $metadata;
        return $this;
    }
    /**
     * Whether the invoice will be automatically sent by email after issuing.
     * Only relevant for DRAFT and SCHEDULED invoices.
     * 
     *
     * @return bool|null
     */
    public function getSendAutomatically(): ?bool
    {
        return $this->sendAutomatically;
    }
    /**
    * Whether the invoice will be automatically sent by email after issuing.
    Only relevant for DRAFT and SCHEDULED invoices.
    
    *
    * @param bool|null $sendAutomatically
    *
    * @return self
    */
    public function setSendAutomatically(?bool $sendAutomatically): self
    {
        $this->initialized['sendAutomatically'] = true;
        $this->sendAutomatically = $sendAutomatically;
        return $this;
    }
    /**
     * Email configuration used when `send_automatically` is true.
     * If null, the recipient's default email is used.
     * 
     *
     * @return InvoiceBaseEmailConfig|null
     */
    public function getEmailConfig(): ?InvoiceBaseEmailConfig
    {
        return $this->emailConfig;
    }
    /**
    * Email configuration used when `send_automatically` is true.
    If null, the recipient's default email is used.
    
    *
    * @param InvoiceBaseEmailConfig|null $emailConfig
    *
    * @return self
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
     * 
     *
     * @return string|null
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
    
    *
    * @param string|null $pdfDownloadUrl
    *
    * @return self
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
     *
     * @return VeriFactu
     */
    public function getVerifactu(): VeriFactu
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
    
    *
    * @param VeriFactu $verifactu
    *
    * @return self
    */
    public function setVerifactu(VeriFactu $verifactu): self
    {
        $this->initialized['verifactu'] = true;
        $this->verifactu = $verifactu;
        return $this;
    }
    /**
     * @return list<InvoiceAttachment>
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }
    /**
     * @param list<InvoiceAttachment> $attachments
     *
     * @return self
     */
    public function setAttachments(array $attachments): self
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
     * @return list<InvoiceSendRecord>
     */
    public function getSendingHistory(): array
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
    * @param list<InvoiceSendRecord> $sendingHistory
    *
    * @return self
    */
    public function setSendingHistory(array $sendingHistory): self
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
     * 
     *
     * @return InvoiceEmailDeliveryOutcome
     */
    public function getEmailDelivery(): InvoiceEmailDeliveryOutcome
    {
        return $this->emailDelivery;
    }
    /**
    * What became of the invoice's automatic email in the act that produced this response.
    
    Only present in the response to issuing an invoice (`POST .../invoices/{invoice_id}/issue`).
    Issuing is a fiscal act and never fails because of the email, so a send the sending
    policy refuses still answers `200` — this object is how it says so. Without it, a
    refused send and an invoice that never asked for one looked identical.
    
    *
    * @param InvoiceEmailDeliveryOutcome $emailDelivery
    *
    * @return self
    */
    public function setEmailDelivery(InvoiceEmailDeliveryOutcome $emailDelivery): self
    {
        $this->initialized['emailDelivery'] = true;
        $this->emailDelivery = $emailDelivery;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getDeletedAt(): ?\DateTime
    {
        return $this->deletedAt;
    }
    /**
     * @param \DateTime|null $deletedAt
     *
     * @return self
     */
    public function setDeletedAt(?\DateTime $deletedAt): self
    {
        $this->initialized['deletedAt'] = true;
        $this->deletedAt = $deletedAt;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['invoiceNumber' => ['invoice_number', 'getInvoiceNumber', 'setInvoiceNumber'], 'series' => ['series', 'getSeries', 'setSeries'], 'number' => ['number', 'getNumber', 'setNumber'], 'type' => ['type', 'getType', 'setType'], 'status' => ['status', 'getStatus', 'setStatus'], 'issueDate' => ['issue_date', 'getIssueDate', 'setIssueDate'], 'operationDate' => ['operation_date', 'getOperationDate', 'setOperationDate'], 'dueDate' => ['due_date', 'getDueDate', 'setDueDate'], 'validUntil' => ['valid_until', 'getValidUntil', 'setValidUntil'], 'paymentDate' => ['payment_date', 'getPaymentDate', 'setPaymentDate'], 'sentAt' => ['sent_at', 'getSentAt', 'setSentAt'], 'paidAt' => ['paid_at', 'getPaidAt', 'setPaidAt'], 'autoEmitAfter' => ['auto_emit_after', 'getAutoEmitAfter', 'setAutoEmitAfter'], 'scheduledFor' => ['scheduled_for', 'getScheduledFor', 'setScheduledFor'], 'scheduledAction' => ['scheduled_action', 'getScheduledAction', 'setScheduledAction'], 'issuer' => ['issuer', 'getIssuer', 'setIssuer'], 'recipient' => ['recipient', 'getRecipient', 'setRecipient'], 'lines' => ['lines', 'getLines', 'setLines'], 'totals' => ['totals', 'getTotals', 'setTotals'], 'paymentInfo' => ['payment_info', 'getPaymentInfo', 'setPaymentInfo'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'voidCause' => ['void_cause', 'getVoidCause', 'setVoidCause'], 'voidReason' => ['void_reason', 'getVoidReason', 'setVoidReason'], 'voidedAt' => ['voided_at', 'getVoidedAt', 'setVoidedAt'], 'rectifiedInvoiceId' => ['rectified_invoice_id', 'getRectifiedInvoiceId', 'setRectifiedInvoiceId'], 'sourceProformaId' => ['source_proforma_id', 'getSourceProformaId', 'setSourceProformaId'], 'convertedInvoiceId' => ['converted_invoice_id', 'getConvertedInvoiceId', 'setConvertedInvoiceId'], 'rectificationReason' => ['rectification_reason', 'getRectificationReason', 'setRectificationReason'], 'recurringInvoiceId' => ['recurring_invoice_id', 'getRecurringInvoiceId', 'setRecurringInvoiceId'], 'recurringInvoiceName' => ['recurring_invoice_name', 'getRecurringInvoiceName', 'setRecurringInvoiceName'], 'rectificationType' => ['rectification_type', 'getRectificationType', 'setRectificationType'], 'rectificationCode' => ['rectification_code', 'getRectificationCode', 'setRectificationCode'], 'externalRef' => ['external_ref', 'getExternalRef', 'setExternalRef'], 'metadata' => ['metadata', 'getMetadata', 'setMetadata'], 'sendAutomatically' => ['send_automatically', 'getSendAutomatically', 'setSendAutomatically'], 'emailConfig' => ['email_config', 'getEmailConfig', 'setEmailConfig'], 'pdfDownloadUrl' => ['pdf_download_url', 'getPdfDownloadUrl', 'setPdfDownloadUrl'], 'verifactu' => ['verifactu', 'getVerifactu', 'setVerifactu'], 'attachments' => ['attachments', 'getAttachments', 'setAttachments'], 'sendingHistory' => ['sending_history', 'getSendingHistory', 'setSendingHistory'], 'emailDelivery' => ['email_delivery', 'getEmailDelivery', 'setEmailDelivery'], 'deletedAt' => ['deleted_at', 'getDeletedAt', 'setDeletedAt']];
    }
}