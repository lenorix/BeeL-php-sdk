<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CreateSimplifiedExchangeRequest implements AdditionalPropertiesInterface
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
     * The simplified invoices the full invoice replaces, issued and not voided, exchanged or
     * corrected. Their lines, in this order, become the lines of the full invoice. Each one
     * appears once: a repeated id fails with `422 EXCHANGE_DUPLICATED_SIMPLIFIED`.
     *
     *
     * @var list<string>
     */
    protected $simplifiedInvoiceIds;

    /**
     * The customer the full invoice goes to, identified as a standard invoice requires: a
     * registered `customer_id` or inline data with a tax ID and address.
     *
     *
     * @var CreateSimplifiedExchangeRequestRecipient
     */
    protected $recipient;

    /**
     * Series of the full invoice. Optional: without it, the company's default series for
     * standard invoices is used.
     *
     *
     * @var string
     */
    protected $seriesId;

    /**
     * Observations printed on the full invoice.
     *
     * @var string
     */
    protected $notes;

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
     * The simplified invoices the full invoice replaces, issued and not voided, exchanged or
     * corrected. Their lines, in this order, become the lines of the full invoice. Each one
     * appears once: a repeated id fails with `422 EXCHANGE_DUPLICATED_SIMPLIFIED`.
     *
     *
     * @return list<string>
     */
    public function getSimplifiedInvoiceIds(): array
    {
        return $this->simplifiedInvoiceIds;
    }

    /**
     * The simplified invoices the full invoice replaces, issued and not voided, exchanged or
    corrected. Their lines, in this order, become the lines of the full invoice. Each one
    appears once: a repeated id fails with `422 EXCHANGE_DUPLICATED_SIMPLIFIED`.

     *
     * @param  list<string>  $simplifiedInvoiceIds
     */
    public function setSimplifiedInvoiceIds(array $simplifiedInvoiceIds): self
    {
        $this->initialized['simplifiedInvoiceIds'] = true;
        $this->simplifiedInvoiceIds = $simplifiedInvoiceIds;

        return $this;
    }

    /**
     * The customer the full invoice goes to, identified as a standard invoice requires: a
     * registered `customer_id` or inline data with a tax ID and address.
     */
    public function getRecipient(): CreateSimplifiedExchangeRequestRecipient
    {
        return $this->recipient;
    }

    /**
     * The customer the full invoice goes to, identified as a standard invoice requires: a
    registered `customer_id` or inline data with a tax ID and address.
     */
    public function setRecipient(CreateSimplifiedExchangeRequestRecipient $recipient): self
    {
        $this->initialized['recipient'] = true;
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Series of the full invoice. Optional: without it, the company's default series for
     * standard invoices is used.
     */
    public function getSeriesId(): string
    {
        return $this->seriesId;
    }

    /**
     * Series of the full invoice. Optional: without it, the company's default series for
    standard invoices is used.
     */
    public function setSeriesId(string $seriesId): self
    {
        $this->initialized['seriesId'] = true;
        $this->seriesId = $seriesId;

        return $this;
    }

    /**
     * Observations printed on the full invoice.
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * Observations printed on the full invoice.
     */
    public function setNotes(string $notes): self
    {
        $this->initialized['notes'] = true;
        $this->notes = $notes;

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
        return ['simplifiedInvoiceIds' => ['simplified_invoice_ids', 'getSimplifiedInvoiceIds', 'setSimplifiedInvoiceIds'], 'recipient' => ['recipient', 'getRecipient', 'setRecipient'], 'seriesId' => ['series_id', 'getSeriesId', 'setSeriesId'], 'notes' => ['notes', 'getNotes', 'setNotes'], 'options' => ['options', 'getOptions', 'setOptions']];
    }
}
