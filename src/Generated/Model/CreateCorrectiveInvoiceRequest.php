<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CreateCorrectiveInvoiceRequest implements AdditionalPropertiesInterface
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
     * Type of rectification applied to a corrective invoice:
     * - TOTAL: Rectifies everything still invoiced on the original, its live correctives included (status → VOIDED)
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
     * - R5: Corrective of a simplified invoice - ONLY for simplified invoices
     * 
     *
     * @var string
     */
    protected $rectificationCode;
    /**
     * Detailed reason for rectification (minimum 10 characters)
     *
     * @var string
     */
    protected $reason;
    /**
     * **TOTAL**: not accepted. A `TOTAL` corrective rectifies what is still invoiced on the
     * original —its lines and those of its live correctives, negated— and a request with
     * `lines` fails with `422 RECTIFICATIVA_TOTAL_CON_LINEAS`.
     * **PARTIAL**: required. The adjustment lines, with positive or negative amounts; they
     * may not take the base of any rate below zero (`422 CORRECTIVE_EXCEEDS_INVOICED_AMOUNT`).
     * 
     *
     * @var list<CreateCorrectiveInvoiceRequestLinesItem>
     */
    protected $lines;
    /**
     * When the circumstance that causes the rectification took place, if it is one of article
     * 80 of the VAT Act (Ley 37/1992): a discount granted after the sale, an operation cancelled
     * or a price changed after it took place, the customer's insolvency, a bad debt. Optional.
     * 
     * A corrective must be issued within four years from when the tax accrued or, for those
     * causes, from when the circumstance took place (RD 1619/2012, art. 15.3). Without this
     * date the four years count from the original's operation date (its `operation_date`, or
     * its `issue_date` when it has none), the stricter of the two. Past the deadline the request
     * fails with `422 CORRECTIVE_OUT_OF_TIME`.
     * 
     * Only for `R1`, `R2`, `R3` and `R5`: `R4` covers causes other than article 80, and sending
     * it with `R4` fails with `422 CORRECTIVE_CIRCUMSTANCE_DATE_NOT_APPLICABLE`. It must lie
     * between the original's operation date and today
     * (`422 CORRECTIVE_CIRCUMSTANCE_DATE_OUT_OF_RANGE`).
     * 
     *
     * @var \DateTime
     */
    protected $circumstanceDate;
    /**
     * Declares that the recipient acted as a business or professional in the operation being
     * rectified. Optional, and it only matters for a bad-debt corrective (`R3`) on an
     * operation whose taxable base is 50 € or less: the law allows that reduction only when
     * the recipient acted as a business or professional, and the invoice does not say so
     * (Ley 37/1992, art. 80.Cuatro.A.3.ª). Without it, that `R3` fails with
     * `422 CORRECTIVE_BAD_DEBT_BASE_TOO_LOW`.
     * 
     *
     * @var bool
     */
    protected $recipientIsBusiness;
    /**
     * Additional observations about the rectification
     *
     * @var string
     */
    protected $notes;
    /**
     * Series for the corrective invoice. Optional: if not specified, the company's
     * **default series for corrective invoices** is used — not the original invoice's
     * series, which is an ordinary or simplified one and cannot hold a corrective.
     * If the company has no default corrective series, one is created on first use; a
     * series of the wrong type fails with `422 SERIES_INCOMPATIBLE_DOC_TYPE`.
     * 
     *
     * @var string
     */
    protected $seriesId;
    /**
     * Client-supplied identifier from an external system (order, cart, contract…).
     * Stored as-is, echoed back on read, and filterable via GET /v1/invoices?external_ref=.
     * Optional. Enforced UNIQUE per issuer for live standard/simplified invoices:
     * creating a second invoice with the same reference returns 409
     * (INVOICE_DUPLICATE_EXTERNAL_REFERENCE); deleting the existing one lets you recreate.
     * Corrective invoices are exempt from that uniqueness: a corrective carries the same
     * order reference as the invoice it corrects, so both can coexist.
     * This is a business key, NOT the Idempotency-Key (which guards request retries).
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
     * Only to correct the recipient's data. A corrective invoice carries the recipient of the
     * invoice it corrects, with that invoice's data, except when the invoice recorded that same
     * recipient with a wrong name, tax ID or address: then send the corrected recipient here,
     * with `rectification_type` `PARTIAL`, `rectification_code` `R4` and no `lines`. That
     * corrective leaves the amounts unchanged and the original `RECTIFIED`.
     * 
     * - When the original went to a registered customer, send that same `customer_id`, with
     *   its data already fixed; another customer fails with
     *   `422 CORRECTIVE_RECIPIENT_IS_ANOTHER_PERSON` — an invoice issued to another person is
     *   corrected in full (`TOTAL`) and issued again to the right customer.
     * - The same name, tax ID and address as recorded fail with
     *   `422 CORRECTIVE_RECIPIENT_UNCHANGED`.
     * - A `recipient` in any other corrective fails with
     *   `422 CORRECTIVE_RECIPIENT_NOT_ACCEPTED`, and nothing is created.
     * 
     *
     * @var CreateCorrectiveInvoiceRequestRecipient
     */
    protected $recipient;
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
     * Type of rectification applied to a corrective invoice:
     * - TOTAL: Rectifies everything still invoiced on the original, its live correctives included (status → VOIDED)
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
    - TOTAL: Rectifies everything still invoiced on the original, its live correctives included (status → VOIDED)
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
     * - R5: Corrective of a simplified invoice - ONLY for simplified invoices
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
    - R5: Corrective of a simplified invoice - ONLY for simplified invoices
    
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
     * Detailed reason for rectification (minimum 10 characters)
     *
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }
    /**
     * Detailed reason for rectification (minimum 10 characters)
     *
     * @param string $reason
     *
     * @return self
     */
    public function setReason(string $reason): self
    {
        $this->initialized['reason'] = true;
        $this->reason = $reason;
        return $this;
    }
    /**
     * **TOTAL**: not accepted. A `TOTAL` corrective rectifies what is still invoiced on the
     * original —its lines and those of its live correctives, negated— and a request with
     * `lines` fails with `422 RECTIFICATIVA_TOTAL_CON_LINEAS`.
     * **PARTIAL**: required. The adjustment lines, with positive or negative amounts; they
     * may not take the base of any rate below zero (`422 CORRECTIVE_EXCEEDS_INVOICED_AMOUNT`).
     * 
     *
     * @return list<CreateCorrectiveInvoiceRequestLinesItem>
     */
    public function getLines(): array
    {
        return $this->lines;
    }
    /**
    * **TOTAL**: not accepted. A `TOTAL` corrective rectifies what is still invoiced on the
    original —its lines and those of its live correctives, negated— and a request with
    `lines` fails with `422 RECTIFICATIVA_TOTAL_CON_LINEAS`.
    **PARTIAL**: required. The adjustment lines, with positive or negative amounts; they
    may not take the base of any rate below zero (`422 CORRECTIVE_EXCEEDS_INVOICED_AMOUNT`).
    
    *
    * @param list<CreateCorrectiveInvoiceRequestLinesItem> $lines
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
     * When the circumstance that causes the rectification took place, if it is one of article
     * 80 of the VAT Act (Ley 37/1992): a discount granted after the sale, an operation cancelled
     * or a price changed after it took place, the customer's insolvency, a bad debt. Optional.
     * 
     * A corrective must be issued within four years from when the tax accrued or, for those
     * causes, from when the circumstance took place (RD 1619/2012, art. 15.3). Without this
     * date the four years count from the original's operation date (its `operation_date`, or
     * its `issue_date` when it has none), the stricter of the two. Past the deadline the request
     * fails with `422 CORRECTIVE_OUT_OF_TIME`.
     * 
     * Only for `R1`, `R2`, `R3` and `R5`: `R4` covers causes other than article 80, and sending
     * it with `R4` fails with `422 CORRECTIVE_CIRCUMSTANCE_DATE_NOT_APPLICABLE`. It must lie
     * between the original's operation date and today
     * (`422 CORRECTIVE_CIRCUMSTANCE_DATE_OUT_OF_RANGE`).
     * 
     *
     * @return \DateTime
     */
    public function getCircumstanceDate(): \DateTime
    {
        return $this->circumstanceDate;
    }
    /**
    * When the circumstance that causes the rectification took place, if it is one of article
    80 of the VAT Act (Ley 37/1992): a discount granted after the sale, an operation cancelled
    or a price changed after it took place, the customer's insolvency, a bad debt. Optional.
    
    A corrective must be issued within four years from when the tax accrued or, for those
    causes, from when the circumstance took place (RD 1619/2012, art. 15.3). Without this
    date the four years count from the original's operation date (its `operation_date`, or
    its `issue_date` when it has none), the stricter of the two. Past the deadline the request
    fails with `422 CORRECTIVE_OUT_OF_TIME`.
    
    Only for `R1`, `R2`, `R3` and `R5`: `R4` covers causes other than article 80, and sending
    it with `R4` fails with `422 CORRECTIVE_CIRCUMSTANCE_DATE_NOT_APPLICABLE`. It must lie
    between the original's operation date and today
    (`422 CORRECTIVE_CIRCUMSTANCE_DATE_OUT_OF_RANGE`).
    
    *
    * @param \DateTime $circumstanceDate
    *
    * @return self
    */
    public function setCircumstanceDate(\DateTime $circumstanceDate): self
    {
        $this->initialized['circumstanceDate'] = true;
        $this->circumstanceDate = $circumstanceDate;
        return $this;
    }
    /**
     * Declares that the recipient acted as a business or professional in the operation being
     * rectified. Optional, and it only matters for a bad-debt corrective (`R3`) on an
     * operation whose taxable base is 50 € or less: the law allows that reduction only when
     * the recipient acted as a business or professional, and the invoice does not say so
     * (Ley 37/1992, art. 80.Cuatro.A.3.ª). Without it, that `R3` fails with
     * `422 CORRECTIVE_BAD_DEBT_BASE_TOO_LOW`.
     * 
     *
     * @return bool
     */
    public function getRecipientIsBusiness(): bool
    {
        return $this->recipientIsBusiness;
    }
    /**
    * Declares that the recipient acted as a business or professional in the operation being
    rectified. Optional, and it only matters for a bad-debt corrective (`R3`) on an
    operation whose taxable base is 50 € or less: the law allows that reduction only when
    the recipient acted as a business or professional, and the invoice does not say so
    (Ley 37/1992, art. 80.Cuatro.A.3.ª). Without it, that `R3` fails with
    `422 CORRECTIVE_BAD_DEBT_BASE_TOO_LOW`.
    
    *
    * @param bool $recipientIsBusiness
    *
    * @return self
    */
    public function setRecipientIsBusiness(bool $recipientIsBusiness): self
    {
        $this->initialized['recipientIsBusiness'] = true;
        $this->recipientIsBusiness = $recipientIsBusiness;
        return $this;
    }
    /**
     * Additional observations about the rectification
     *
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }
    /**
     * Additional observations about the rectification
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
     * Series for the corrective invoice. Optional: if not specified, the company's
     * **default series for corrective invoices** is used — not the original invoice's
     * series, which is an ordinary or simplified one and cannot hold a corrective.
     * If the company has no default corrective series, one is created on first use; a
     * series of the wrong type fails with `422 SERIES_INCOMPATIBLE_DOC_TYPE`.
     * 
     *
     * @return string
     */
    public function getSeriesId(): string
    {
        return $this->seriesId;
    }
    /**
    * Series for the corrective invoice. Optional: if not specified, the company's
    **default series for corrective invoices** is used — not the original invoice's
    series, which is an ordinary or simplified one and cannot hold a corrective.
    If the company has no default corrective series, one is created on first use; a
    series of the wrong type fails with `422 SERIES_INCOMPATIBLE_DOC_TYPE`.
    
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
     * Client-supplied identifier from an external system (order, cart, contract…).
     * Stored as-is, echoed back on read, and filterable via GET /v1/invoices?external_ref=.
     * Optional. Enforced UNIQUE per issuer for live standard/simplified invoices:
     * creating a second invoice with the same reference returns 409
     * (INVOICE_DUPLICATE_EXTERNAL_REFERENCE); deleting the existing one lets you recreate.
     * Corrective invoices are exempt from that uniqueness: a corrective carries the same
     * order reference as the invoice it corrects, so both can coexist.
     * This is a business key, NOT the Idempotency-Key (which guards request retries).
     * 
     *
     * @return string
     */
    public function getExternalRef(): string
    {
        return $this->externalRef;
    }
    /**
    * Client-supplied identifier from an external system (order, cart, contract…).
    Stored as-is, echoed back on read, and filterable via GET /v1/invoices?external_ref=.
    Optional. Enforced UNIQUE per issuer for live standard/simplified invoices:
    creating a second invoice with the same reference returns 409
    (INVOICE_DUPLICATE_EXTERNAL_REFERENCE); deleting the existing one lets you recreate.
    Corrective invoices are exempt from that uniqueness: a corrective carries the same
    order reference as the invoice it corrects, so both can coexist.
    This is a business key, NOT the Idempotency-Key (which guards request retries).
    
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
     * Only to correct the recipient's data. A corrective invoice carries the recipient of the
     * invoice it corrects, with that invoice's data, except when the invoice recorded that same
     * recipient with a wrong name, tax ID or address: then send the corrected recipient here,
     * with `rectification_type` `PARTIAL`, `rectification_code` `R4` and no `lines`. That
     * corrective leaves the amounts unchanged and the original `RECTIFIED`.
     * 
     * - When the original went to a registered customer, send that same `customer_id`, with
     *   its data already fixed; another customer fails with
     *   `422 CORRECTIVE_RECIPIENT_IS_ANOTHER_PERSON` — an invoice issued to another person is
     *   corrected in full (`TOTAL`) and issued again to the right customer.
     * - The same name, tax ID and address as recorded fail with
     *   `422 CORRECTIVE_RECIPIENT_UNCHANGED`.
     * - A `recipient` in any other corrective fails with
     *   `422 CORRECTIVE_RECIPIENT_NOT_ACCEPTED`, and nothing is created.
     * 
     *
     * @return CreateCorrectiveInvoiceRequestRecipient
     */
    public function getRecipient(): CreateCorrectiveInvoiceRequestRecipient
    {
        return $this->recipient;
    }
    /**
    * Only to correct the recipient's data. A corrective invoice carries the recipient of the
    invoice it corrects, with that invoice's data, except when the invoice recorded that same
    recipient with a wrong name, tax ID or address: then send the corrected recipient here,
    with `rectification_type` `PARTIAL`, `rectification_code` `R4` and no `lines`. That
    corrective leaves the amounts unchanged and the original `RECTIFIED`.
    
    - When the original went to a registered customer, send that same `customer_id`, with
     its data already fixed; another customer fails with
     `422 CORRECTIVE_RECIPIENT_IS_ANOTHER_PERSON` — an invoice issued to another person is
     corrected in full (`TOTAL`) and issued again to the right customer.
    - The same name, tax ID and address as recorded fail with
     `422 CORRECTIVE_RECIPIENT_UNCHANGED`.
    - A `recipient` in any other corrective fails with
     `422 CORRECTIVE_RECIPIENT_NOT_ACCEPTED`, and nothing is created.
    
    *
    * @param CreateCorrectiveInvoiceRequestRecipient $recipient
    *
    * @return self
    */
    public function setRecipient(CreateCorrectiveInvoiceRequestRecipient $recipient): self
    {
        $this->initialized['recipient'] = true;
        $this->recipient = $recipient;
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
        return ['rectificationType' => ['rectification_type', 'getRectificationType', 'setRectificationType'], 'rectificationCode' => ['rectification_code', 'getRectificationCode', 'setRectificationCode'], 'reason' => ['reason', 'getReason', 'setReason'], 'lines' => ['lines', 'getLines', 'setLines'], 'circumstanceDate' => ['circumstance_date', 'getCircumstanceDate', 'setCircumstanceDate'], 'recipientIsBusiness' => ['recipient_is_business', 'getRecipientIsBusiness', 'setRecipientIsBusiness'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'seriesId' => ['series_id', 'getSeriesId', 'setSeriesId'], 'externalRef' => ['external_ref', 'getExternalRef', 'setExternalRef'], 'metadata' => ['metadata', 'getMetadata', 'setMetadata'], 'recipient' => ['recipient', 'getRecipient', 'setRecipient'], 'options' => ['options', 'getOptions', 'setOptions']];
    }
}