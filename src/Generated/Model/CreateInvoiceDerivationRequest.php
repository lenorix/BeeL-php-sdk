<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CreateInvoiceDerivationRequest implements AdditionalPropertiesInterface
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
     * Invoice this one is derived from. It must belong to the company in the path; an
     * invoice you cannot reach is reported the same way as one that does not exist.
     *
     *
     * @var string
     */
    protected $fromInvoiceId;

    /**
     * How to derive the new invoice from `from_invoice_id`.
     *
     * - **DUPLICATE**: copy an existing invoice into a fresh draft. The source invoice is not
     *   modified.
     *
     * Turning a proforma into an invoice is **not** a derivation mode: it is a fiscal act that
     * numbers a document and moves the source proforma to a terminal status, so it keeps its own
     * dedicated operation.
     *
     *
     * @var string
     */
    protected $mode;

    /**
     * Series for the new draft. Defaults to the series of the source invoice.
     *
     * @var string
     */
    protected $seriesId;

    /**
     * Observations for the new draft. Defaults to those of the source invoice.
     *
     * @var string
     */
    protected $notes;

    /**
     * Invoice this one is derived from. It must belong to the company in the path; an
     * invoice you cannot reach is reported the same way as one that does not exist.
     */
    public function getFromInvoiceId(): string
    {
        return $this->fromInvoiceId;
    }

    /**
     * Invoice this one is derived from. It must belong to the company in the path; an
    invoice you cannot reach is reported the same way as one that does not exist.
     */
    public function setFromInvoiceId(string $fromInvoiceId): self
    {
        $this->initialized['fromInvoiceId'] = true;
        $this->fromInvoiceId = $fromInvoiceId;

        return $this;
    }

    /**
     * How to derive the new invoice from `from_invoice_id`.
     *
     * - **DUPLICATE**: copy an existing invoice into a fresh draft. The source invoice is not
     *   modified.
     *
     * Turning a proforma into an invoice is **not** a derivation mode: it is a fiscal act that
     * numbers a document and moves the source proforma to a terminal status, so it keeps its own
     * dedicated operation.
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * How to derive the new invoice from `from_invoice_id`.

    - **DUPLICATE**: copy an existing invoice into a fresh draft. The source invoice is not
     modified.

    Turning a proforma into an invoice is **not** a derivation mode: it is a fiscal act that
    numbers a document and moves the source proforma to a terminal status, so it keeps its own
    dedicated operation.
     */
    public function setMode(string $mode): self
    {
        $this->initialized['mode'] = true;
        $this->mode = $mode;

        return $this;
    }

    /**
     * Series for the new draft. Defaults to the series of the source invoice.
     */
    public function getSeriesId(): string
    {
        return $this->seriesId;
    }

    /**
     * Series for the new draft. Defaults to the series of the source invoice.
     */
    public function setSeriesId(string $seriesId): self
    {
        $this->initialized['seriesId'] = true;
        $this->seriesId = $seriesId;

        return $this;
    }

    /**
     * Observations for the new draft. Defaults to those of the source invoice.
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * Observations for the new draft. Defaults to those of the source invoice.
     */
    public function setNotes(string $notes): self
    {
        $this->initialized['notes'] = true;
        $this->notes = $notes;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['fromInvoiceId' => ['from_invoice_id', 'getFromInvoiceId', 'setFromInvoiceId'], 'mode' => ['mode', 'getMode', 'setMode'], 'seriesId' => ['series_id', 'getSeriesId', 'setSeriesId'], 'notes' => ['notes', 'getNotes', 'setNotes']];
    }
}
