<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CreateInvoiceRequest implements AdditionalPropertiesInterface
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
     * Invoice type to create. `CORRECTIVE` is **not** accepted here: a corrective
     * invoice is always created from the invoice it corrects, via
     * `POST /v1/companies/{company_id}/invoices/{invoice_id}/corrective`, which is
     * where its rectification type and VeriFactu code (R1–R5) are declared.
     * 
     *
     * @var string
     */
    protected $type;
    /**
     * Invoicing series ID (if not specified, uses default)
     *
     * @var string
     */
    protected $seriesId;
    /**
     * Date when the operation actually occurred. Optional.
     * 
     * Use when invoicing for a past operation (e.g., services delivered last month
     * but invoiced this month). **Must be today or a past date.**
     * 
     * If omitted, the operation date is assumed to be the same as the issue date (today).
     * 
     * The `issue_date` is always set automatically to today per Spanish anti-fraud law
     * (Ley Antifraude / VeriFactu). To issue an invoice on a future date, create a
     * draft and use `POST /v1/invoices/{invoice_id}/schedule`.
     * 
     *
     * @var \DateTime
     */
    protected $operationDate;
    /**
     * Payment due date. If not specified, calculated according to payment method.
     * **Must be the same as or after the issue date (today).**
     * 
     *
     * @var \DateTime
     */
    protected $dueDate;
    /**
     * Offer validity date. Only rendered on PROFORMA invoices; on any other
     * invoice type the field is inert (accepted and stored, but never shown on
     * the document). Optional and purely informational — nothing is triggered
     * automatically when it passes. Not to be confused with `due_date` (payment
     * due date).
     * 
     *
     * @var \DateTime
     */
    protected $validUntil;
    /**
     * Invoice recipient. All fields are optional at schema level, but for an
     * ad-hoc recipient (no customer_id) on non-SIMPLIFIED invoices the API
     * requires legal_name, address and nif (or alternative_id); omitting the
     * address returns 422 RECIPIENT_ADDRESS_REQUIRED.
     * 
     *
     * @var Recipient
     */
    protected $recipient;
    /**
     * @var list<CreateInvoiceRequestLinesItem>
     */
    protected $lines;
    /**
     * @var PaymentInfo
     */
    protected $paymentInfo;
    /**
     * @var string
     */
    protected $notes;
    /**
     * This field was previously named `external_reference`. The old name is still accepted as
     * an alias for backwards compatibility and will be withdrawn in a future major version —
     * send `external_ref`.
     * 
     *
     * @var string
     */
    protected $externalRef;
    /**
     * Your own key/value pairs to cross-reference this invoice with records in
     * your system (order ids, tenants, internal codes). Namespace them to avoid
     * clashing with the system keys BeeL adds on payment-generated invoices.
     * 
     *
     * @var array<string, mixed>
     */
    protected $metadata;
    /**
     * Controls how the invoice is processed after creation.
     * All fields default to `false` if not specified.
     * 
     * VeriFactu is **not** an option here: whether an invoice is registered with AEAT is a
     * fact of the tax identity (NIF x environment), resolved at issue time against the
     * company's regime. See `verifactu.enabled` in the invoice response for what was applied.
     * 
     * **Common combinations:**
     * - Draft (default): omit `options` or set all to `false`
     * - Issue immediately: `{ issue_directly: true }`
     * - Issue + wait for PDF: `{ issue_directly: true, wait_for_pdf: true }`
     * - Issue + send email: `{ issue_directly: true, send_automatically: true }`
     * - Full automation: `{ issue_directly: true, wait_for_pdf: true, send_automatically: true, email_config: { ... } }`
     * 
     *
     * @var InvoiceProcessingOptions
     */
    protected $options;
    /**
     * Invoice type to create. `CORRECTIVE` is **not** accepted here: a corrective
     * invoice is always created from the invoice it corrects, via
     * `POST /v1/companies/{company_id}/invoices/{invoice_id}/corrective`, which is
     * where its rectification type and VeriFactu code (R1–R5) are declared.
     * 
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    /**
    * Invoice type to create. `CORRECTIVE` is **not** accepted here: a corrective
    invoice is always created from the invoice it corrects, via
    `POST /v1/companies/{company_id}/invoices/{invoice_id}/corrective`, which is
    where its rectification type and VeriFactu code (R1–R5) are declared.
    
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
     * Invoicing series ID (if not specified, uses default)
     *
     * @return string
     */
    public function getSeriesId(): string
    {
        return $this->seriesId;
    }
    /**
     * Invoicing series ID (if not specified, uses default)
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
     * Date when the operation actually occurred. Optional.
     * 
     * Use when invoicing for a past operation (e.g., services delivered last month
     * but invoiced this month). **Must be today or a past date.**
     * 
     * If omitted, the operation date is assumed to be the same as the issue date (today).
     * 
     * The `issue_date` is always set automatically to today per Spanish anti-fraud law
     * (Ley Antifraude / VeriFactu). To issue an invoice on a future date, create a
     * draft and use `POST /v1/invoices/{invoice_id}/schedule`.
     * 
     *
     * @return \DateTime
     */
    public function getOperationDate(): \DateTime
    {
        return $this->operationDate;
    }
    /**
    * Date when the operation actually occurred. Optional.
    
    Use when invoicing for a past operation (e.g., services delivered last month
    but invoiced this month). **Must be today or a past date.**
    
    If omitted, the operation date is assumed to be the same as the issue date (today).
    
    The `issue_date` is always set automatically to today per Spanish anti-fraud law
    (Ley Antifraude / VeriFactu). To issue an invoice on a future date, create a
    draft and use `POST /v1/invoices/{invoice_id}/schedule`.
    
    *
    * @param \DateTime $operationDate
    *
    * @return self
    */
    public function setOperationDate(\DateTime $operationDate): self
    {
        $this->initialized['operationDate'] = true;
        $this->operationDate = $operationDate;
        return $this;
    }
    /**
     * Payment due date. If not specified, calculated according to payment method.
     * **Must be the same as or after the issue date (today).**
     * 
     *
     * @return \DateTime
     */
    public function getDueDate(): \DateTime
    {
        return $this->dueDate;
    }
    /**
    * Payment due date. If not specified, calculated according to payment method.
    **Must be the same as or after the issue date (today).**
    
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
     * the document). Optional and purely informational — nothing is triggered
     * automatically when it passes. Not to be confused with `due_date` (payment
     * due date).
     * 
     *
     * @return \DateTime
     */
    public function getValidUntil(): \DateTime
    {
        return $this->validUntil;
    }
    /**
    * Offer validity date. Only rendered on PROFORMA invoices; on any other
    invoice type the field is inert (accepted and stored, but never shown on
    the document). Optional and purely informational — nothing is triggered
    automatically when it passes. Not to be confused with `due_date` (payment
    due date).
    
    *
    * @param \DateTime $validUntil
    *
    * @return self
    */
    public function setValidUntil(\DateTime $validUntil): self
    {
        $this->initialized['validUntil'] = true;
        $this->validUntil = $validUntil;
        return $this;
    }
    /**
     * Invoice recipient. All fields are optional at schema level, but for an
     * ad-hoc recipient (no customer_id) on non-SIMPLIFIED invoices the API
     * requires legal_name, address and nif (or alternative_id); omitting the
     * address returns 422 RECIPIENT_ADDRESS_REQUIRED.
     * 
     *
     * @return Recipient
     */
    public function getRecipient(): Recipient
    {
        return $this->recipient;
    }
    /**
    * Invoice recipient. All fields are optional at schema level, but for an
    ad-hoc recipient (no customer_id) on non-SIMPLIFIED invoices the API
    requires legal_name, address and nif (or alternative_id); omitting the
    address returns 422 RECIPIENT_ADDRESS_REQUIRED.
    
    *
    * @param Recipient $recipient
    *
    * @return self
    */
    public function setRecipient(Recipient $recipient): self
    {
        $this->initialized['recipient'] = true;
        $this->recipient = $recipient;
        return $this;
    }
    /**
     * @return list<CreateInvoiceRequestLinesItem>
     */
    public function getLines(): array
    {
        return $this->lines;
    }
    /**
     * @param list<CreateInvoiceRequestLinesItem> $lines
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
     * This field was previously named `external_reference`. The old name is still accepted as
     * an alias for backwards compatibility and will be withdrawn in a future major version —
     * send `external_ref`.
     * 
     *
     * @return string
     */
    public function getExternalRef(): string
    {
        return $this->externalRef;
    }
    /**
    * This field was previously named `external_reference`. The old name is still accepted as
    an alias for backwards compatibility and will be withdrawn in a future major version —
    send `external_ref`.
    
    *
    * @param string $externalRef
    *
    * @return self
    */
    public function setExternalRef(string $externalRef): self
    {
        $this->initialized['externalRef'] = true;
        $this->externalRef = $externalRef;
        return $this;
    }
    /**
     * Your own key/value pairs to cross-reference this invoice with records in
     * your system (order ids, tenants, internal codes). Namespace them to avoid
     * clashing with the system keys BeeL adds on payment-generated invoices.
     * 
     *
     * @return array<string, mixed>
     */
    public function getMetadata(): iterable
    {
        return $this->metadata;
    }
    /**
    * Your own key/value pairs to cross-reference this invoice with records in
    your system (order ids, tenants, internal codes). Namespace them to avoid
    clashing with the system keys BeeL adds on payment-generated invoices.
    
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
     * Controls how the invoice is processed after creation.
     * All fields default to `false` if not specified.
     * 
     * VeriFactu is **not** an option here: whether an invoice is registered with AEAT is a
     * fact of the tax identity (NIF x environment), resolved at issue time against the
     * company's regime. See `verifactu.enabled` in the invoice response for what was applied.
     * 
     * **Common combinations:**
     * - Draft (default): omit `options` or set all to `false`
     * - Issue immediately: `{ issue_directly: true }`
     * - Issue + wait for PDF: `{ issue_directly: true, wait_for_pdf: true }`
     * - Issue + send email: `{ issue_directly: true, send_automatically: true }`
     * - Full automation: `{ issue_directly: true, wait_for_pdf: true, send_automatically: true, email_config: { ... } }`
     * 
     *
     * @return InvoiceProcessingOptions
     */
    public function getOptions(): InvoiceProcessingOptions
    {
        return $this->options;
    }
    /**
    * Controls how the invoice is processed after creation.
    All fields default to `false` if not specified.
    
    VeriFactu is **not** an option here: whether an invoice is registered with AEAT is a
    fact of the tax identity (NIF x environment), resolved at issue time against the
    company's regime. See `verifactu.enabled` in the invoice response for what was applied.
    
    **Common combinations:**
    - Draft (default): omit `options` or set all to `false`
    - Issue immediately: `{ issue_directly: true }`
    - Issue + wait for PDF: `{ issue_directly: true, wait_for_pdf: true }`
    - Issue + send email: `{ issue_directly: true, send_automatically: true }`
    - Full automation: `{ issue_directly: true, wait_for_pdf: true, send_automatically: true, email_config: { ... } }`
    
    *
    * @param InvoiceProcessingOptions $options
    *
    * @return self
    */
    public function setOptions(InvoiceProcessingOptions $options): self
    {
        $this->initialized['options'] = true;
        $this->options = $options;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['type' => ['type', 'getType', 'setType'], 'seriesId' => ['series_id', 'getSeriesId', 'setSeriesId'], 'operationDate' => ['operation_date', 'getOperationDate', 'setOperationDate'], 'dueDate' => ['due_date', 'getDueDate', 'setDueDate'], 'validUntil' => ['valid_until', 'getValidUntil', 'setValidUntil'], 'recipient' => ['recipient', 'getRecipient', 'setRecipient'], 'lines' => ['lines', 'getLines', 'setLines'], 'paymentInfo' => ['payment_info', 'getPaymentInfo', 'setPaymentInfo'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'externalRef' => ['external_ref', 'getExternalRef', 'setExternalRef'], 'metadata' => ['metadata', 'getMetadata', 'setMetadata'], 'options' => ['options', 'getOptions', 'setOptions']];
    }
}