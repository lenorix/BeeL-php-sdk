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
     * Detailed reason for rectification (minimum 10 characters)
     *
     * @var string
     */
    protected $reason;

    /**
     * **TOTAL**: Optional (if not sent, original invoice lines are copied negated)
     * **PARTIAL**: REQUIRED (adjustment lines with positive or negative amounts)
     *
     *
     * @var list<CreateCorrectiveInvoiceRequestLinesItem>
     */
    protected $lines;

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
     * If the company has no default corrective series the request fails with
     * `422 SERIES_DEFAULT_NOT_FOUND`; a series of the wrong type fails with
     * `422 SERIES_INCOMPATIBLE_DOC_TYPE`.
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
     * - TOTAL: Completely cancels the original invoice (status → VOIDED)
     * - PARTIAL: Partially corrects the original invoice (status → RECTIFIED)
     */
    public function getRectificationType(): string
    {
        return $this->rectificationType;
    }

    /**
     * Type of rectification applied to a corrective invoice:
    - TOTAL: Completely cancels the original invoice (status → VOIDED)
    - PARTIAL: Partially corrects the original invoice (status → RECTIFIED)
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
     */
    public function setRectificationCode(string $rectificationCode): self
    {
        $this->initialized['rectificationCode'] = true;
        $this->rectificationCode = $rectificationCode;

        return $this;
    }

    /**
     * Detailed reason for rectification (minimum 10 characters)
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * Detailed reason for rectification (minimum 10 characters)
     */
    public function setReason(string $reason): self
    {
        $this->initialized['reason'] = true;
        $this->reason = $reason;

        return $this;
    }

    /**
     * **TOTAL**: Optional (if not sent, original invoice lines are copied negated)
     * **PARTIAL**: REQUIRED (adjustment lines with positive or negative amounts)
     *
     *
     * @return list<CreateCorrectiveInvoiceRequestLinesItem>
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * **TOTAL**: Optional (if not sent, original invoice lines are copied negated)
     **PARTIAL**: REQUIRED (adjustment lines with positive or negative amounts)

     *
     * @param  list<CreateCorrectiveInvoiceRequestLinesItem>  $lines
     */
    public function setLines(array $lines): self
    {
        $this->initialized['lines'] = true;
        $this->lines = $lines;

        return $this;
    }

    /**
     * Additional observations about the rectification
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * Additional observations about the rectification
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
     * If the company has no default corrective series the request fails with
     * `422 SERIES_DEFAULT_NOT_FOUND`; a series of the wrong type fails with
     * `422 SERIES_INCOMPATIBLE_DOC_TYPE`.
     */
    public function getSeriesId(): string
    {
        return $this->seriesId;
    }

    /**
     * Series for the corrective invoice. Optional: if not specified, the company's
     **default series for corrective invoices** is used — not the original invoice's
    series, which is an ordinary or simplified one and cannot hold a corrective.
    If the company has no default corrective series the request fails with
    `422 SERIES_DEFAULT_NOT_FOUND`; a series of the wrong type fails with
    `422 SERIES_INCOMPATIBLE_DOC_TYPE`.
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
     * @param  array<string, mixed>  $metadata
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
     */
    public function setOptions(InvoiceProcessingOptions $options): self
    {
        $this->initialized['options'] = true;
        $this->options = $options;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['rectificationType' => ['rectification_type', 'getRectificationType', 'setRectificationType'], 'rectificationCode' => ['rectification_code', 'getRectificationCode', 'setRectificationCode'], 'reason' => ['reason', 'getReason', 'setReason'], 'lines' => ['lines', 'getLines', 'setLines'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'seriesId' => ['series_id', 'getSeriesId', 'setSeriesId'], 'externalRef' => ['external_ref', 'getExternalRef', 'setExternalRef'], 'metadata' => ['metadata', 'getMetadata', 'setMetadata'], 'options' => ['options', 'getOptions', 'setOptions']];
    }
}
