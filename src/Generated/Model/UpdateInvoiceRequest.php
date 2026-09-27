<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class UpdateInvoiceRequest implements AdditionalPropertiesInterface
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
     * New invoice type. Allowed transitions: `STANDARD` ↔ `SIMPLIFIED`.
     * Transitions to/from `CORRECTIVE` are rejected (corrective invoices have a
     * dedicated `POST /v1/invoices/{invoice_id}/corrective` endpoint).
     * Transitions to/from `PROFORMA` are rejected too — a proforma is converted
     * into an invoice via its dedicated conversion flow, never by editing its type.
     * 
     *
     * @var string
     */
    protected $type;
    /**
     * Series ID. If provided, changes the invoice series (only for DRAFT invoices).
     * The invoice number will be reassigned from the new series when issued.
     * 
     *
     * @var string
     */
    protected $seriesId;
    /**
     * Date when the operation occurred. **Must be today or a past date.**
     * Set to null to clear (operation date = issue date).
     * If not provided, keeps the existing value.
     * 
     *
     * @var \DateTime|null
     */
    protected $operationDate;
    /**
     * New due date. Must be the same as or after `issue_date`.
     * Set to null to clear the due date. If not provided, keeps the existing value.
     * 
     *
     * @var \DateTime|null
     */
    protected $dueDate;
    /**
     * Offer validity date. Only rendered on PROFORMA invoices; on any other
     * invoice type the field is inert. Purely informational.
     * Set to null to clear it. If not provided, keeps the existing value.
     * 
     *
     * @var \DateTime|null
     */
    protected $validUntil;
    /**
     * Replaces the recipient when present. Provide `customer_id` to switch to a
     * registered client, or inline `legal_name`/`nif`/`address` for an ad-hoc receptor.
     * Omit to keep the current recipient.
     * 
     *
     * @var UpdateInvoiceRequestRecipient
     */
    protected $recipient;
    /**
     * @var list<UpdateInvoiceRequestLinesItem>
     */
    protected $lines;
    /**
     * Replaces the payment information when present (sets method/IBAN/SWIFT/term days).
     * Omit to keep the current payment info.
     * 
     *
     * @var UpdateInvoiceRequestPaymentInfo
     */
    protected $paymentInfo;
    /**
     * @var string
     */
    protected $notes;
    /**
     * Processing options for the draft. Fields are optional and follow partial update
     * semantics: omitted fields preserve the existing value.
     * 
     *
     * @var UpdateInvoiceRequestOptions
     */
    protected $options;
    /**
     * New invoice type. Allowed transitions: `STANDARD` ↔ `SIMPLIFIED`.
     * Transitions to/from `CORRECTIVE` are rejected (corrective invoices have a
     * dedicated `POST /v1/invoices/{invoice_id}/corrective` endpoint).
     * Transitions to/from `PROFORMA` are rejected too — a proforma is converted
     * into an invoice via its dedicated conversion flow, never by editing its type.
     * 
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
    * New invoice type. Allowed transitions: `STANDARD` ↔ `SIMPLIFIED`.
    Transitions to/from `CORRECTIVE` are rejected (corrective invoices have a
    dedicated `POST /v1/invoices/{invoice_id}/corrective` endpoint).
    Transitions to/from `PROFORMA` are rejected too — a proforma is converted
    into an invoice via its dedicated conversion flow, never by editing its type.
    
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
     * Series ID. If provided, changes the invoice series (only for DRAFT invoices).
     * The invoice number will be reassigned from the new series when issued.
     * 
     *
     * @return string
     */
    public function getSeriesId(): string
    {
        return $this->seriesId;
    }
    /**
    * Series ID. If provided, changes the invoice series (only for DRAFT invoices).
    The invoice number will be reassigned from the new series when issued.
    
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
     * Date when the operation occurred. **Must be today or a past date.**
     * Set to null to clear (operation date = issue date).
     * If not provided, keeps the existing value.
     * 
     *
     * @return \DateTime|null
     */
    public function getOperationDate(): ?\DateTime
    {
        return $this->operationDate;
    }
    /**
    * Date when the operation occurred. **Must be today or a past date.**
    Set to null to clear (operation date = issue date).
    If not provided, keeps the existing value.
    
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
     * New due date. Must be the same as or after `issue_date`.
     * Set to null to clear the due date. If not provided, keeps the existing value.
     * 
     *
     * @return \DateTime|null
     */
    public function getDueDate(): ?\DateTime
    {
        return $this->dueDate;
    }
    /**
    * New due date. Must be the same as or after `issue_date`.
    Set to null to clear the due date. If not provided, keeps the existing value.
    
    *
    * @param \DateTime|null $dueDate
    *
    * @return self
    */
    public function setDueDate(?\DateTime $dueDate): self
    {
        $this->initialized['dueDate'] = true;
        $this->dueDate = $dueDate;
        return $this;
    }
    /**
     * Offer validity date. Only rendered on PROFORMA invoices; on any other
     * invoice type the field is inert. Purely informational.
     * Set to null to clear it. If not provided, keeps the existing value.
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
    invoice type the field is inert. Purely informational.
    Set to null to clear it. If not provided, keeps the existing value.
    
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
     * Replaces the recipient when present. Provide `customer_id` to switch to a
     * registered client, or inline `legal_name`/`nif`/`address` for an ad-hoc receptor.
     * Omit to keep the current recipient.
     * 
     *
     * @return UpdateInvoiceRequestRecipient
     */
    public function getRecipient(): UpdateInvoiceRequestRecipient
    {
        return $this->recipient;
    }
    /**
    * Replaces the recipient when present. Provide `customer_id` to switch to a
    registered client, or inline `legal_name`/`nif`/`address` for an ad-hoc receptor.
    Omit to keep the current recipient.
    
    *
    * @param UpdateInvoiceRequestRecipient $recipient
    *
    * @return self
    */
    public function setRecipient(UpdateInvoiceRequestRecipient $recipient): self
    {
        $this->initialized['recipient'] = true;
        $this->recipient = $recipient;
        return $this;
    }
    /**
     * @return list<UpdateInvoiceRequestLinesItem>
     */
    public function getLines(): array
    {
        return $this->lines;
    }
    /**
     * @param list<UpdateInvoiceRequestLinesItem> $lines
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
     * Replaces the payment information when present (sets method/IBAN/SWIFT/term days).
     * Omit to keep the current payment info.
     * 
     *
     * @return UpdateInvoiceRequestPaymentInfo
     */
    public function getPaymentInfo(): UpdateInvoiceRequestPaymentInfo
    {
        return $this->paymentInfo;
    }
    /**
    * Replaces the payment information when present (sets method/IBAN/SWIFT/term days).
    Omit to keep the current payment info.
    
    *
    * @param UpdateInvoiceRequestPaymentInfo $paymentInfo
    *
    * @return self
    */
    public function setPaymentInfo(UpdateInvoiceRequestPaymentInfo $paymentInfo): self
    {
        $this->initialized['paymentInfo'] = true;
        $this->paymentInfo = $paymentInfo;
        return $this;
    }
    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }
    /**
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
     * Processing options for the draft. Fields are optional and follow partial update
     * semantics: omitted fields preserve the existing value.
     * 
     *
     * @return UpdateInvoiceRequestOptions
     */
    public function getOptions(): UpdateInvoiceRequestOptions
    {
        return $this->options;
    }
    /**
    * Processing options for the draft. Fields are optional and follow partial update
    semantics: omitted fields preserve the existing value.
    
    *
    * @param UpdateInvoiceRequestOptions $options
    *
    * @return self
    */
    public function setOptions(UpdateInvoiceRequestOptions $options): self
    {
        $this->initialized['options'] = true;
        $this->options = $options;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['type' => ['type', 'getType', 'setType'], 'seriesId' => ['series_id', 'getSeriesId', 'setSeriesId'], 'operationDate' => ['operation_date', 'getOperationDate', 'setOperationDate'], 'dueDate' => ['due_date', 'getDueDate', 'setDueDate'], 'validUntil' => ['valid_until', 'getValidUntil', 'setValidUntil'], 'recipient' => ['recipient', 'getRecipient', 'setRecipient'], 'lines' => ['lines', 'getLines', 'setLines'], 'paymentInfo' => ['payment_info', 'getPaymentInfo', 'setPaymentInfo'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'options' => ['options', 'getOptions', 'setOptions']];
    }
}