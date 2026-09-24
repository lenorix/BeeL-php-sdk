<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1InvoicesExportExcelPostBody implements AdditionalPropertiesInterface
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
     * List of specific invoice IDs to export.
     * If provided, filters are ignored.
     *
     *
     * @var list<string>
     */
    protected $invoiceIds;

    /**
     * Export format.
     * - **SUMMARY**: One row per invoice with totals (default)
     * - **ITEMS**: One row per invoice line item
     *
     *
     * @var string
     */
    protected $format = 'SUMMARY';

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
     * Issue date from (YYYY-MM-DD)
     *
     * @var \DateTime
     */
    protected $dateFrom;

    /**
     * Issue date to (YYYY-MM-DD)
     *
     * @var \DateTime
     */
    protected $dateTo;

    /**
     * Universally Unique Identifier (UUID v4)
     *
     * @var string
     */
    protected $customerId;

    /**
     * Filter by recipient name (partial match)
     *
     * @var string
     */
    protected $recipientName;

    /**
     * Filter by recipient NIF (partial match)
     *
     * @var string
     */
    protected $recipientNif;

    /**
     * Filter by series code
     *
     * @var string
     */
    protected $seriesCode;

    /**
     * List of specific invoice IDs to export.
     * If provided, filters are ignored.
     *
     *
     * @return list<string>
     */
    public function getInvoiceIds(): array
    {
        return $this->invoiceIds;
    }

    /**
     * List of specific invoice IDs to export.
    If provided, filters are ignored.

     *
     * @param  list<string>  $invoiceIds
     */
    public function setInvoiceIds(array $invoiceIds): self
    {
        $this->initialized['invoiceIds'] = true;
        $this->invoiceIds = $invoiceIds;

        return $this;
    }

    /**
     * Export format.
     * - **SUMMARY**: One row per invoice with totals (default)
     * - **ITEMS**: One row per invoice line item
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Export format.
    - **SUMMARY**: One row per invoice with totals (default)
    - **ITEMS**: One row per invoice line item
     */
    public function setFormat(string $format): self
    {
        $this->initialized['format'] = true;
        $this->format = $format;

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
     */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

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
     */
    public function setType(string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;

        return $this;
    }

    /**
     * Issue date from (YYYY-MM-DD)
     */
    public function getDateFrom(): \DateTime
    {
        return $this->dateFrom;
    }

    /**
     * Issue date from (YYYY-MM-DD)
     */
    public function setDateFrom(\DateTime $dateFrom): self
    {
        $this->initialized['dateFrom'] = true;
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * Issue date to (YYYY-MM-DD)
     */
    public function getDateTo(): \DateTime
    {
        return $this->dateTo;
    }

    /**
     * Issue date to (YYYY-MM-DD)
     */
    public function setDateTo(\DateTime $dateTo): self
    {
        $this->initialized['dateTo'] = true;
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * Universally Unique Identifier (UUID v4)
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * Universally Unique Identifier (UUID v4)
     */
    public function setCustomerId(string $customerId): self
    {
        $this->initialized['customerId'] = true;
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Filter by recipient name (partial match)
     */
    public function getRecipientName(): string
    {
        return $this->recipientName;
    }

    /**
     * Filter by recipient name (partial match)
     */
    public function setRecipientName(string $recipientName): self
    {
        $this->initialized['recipientName'] = true;
        $this->recipientName = $recipientName;

        return $this;
    }

    /**
     * Filter by recipient NIF (partial match)
     */
    public function getRecipientNif(): string
    {
        return $this->recipientNif;
    }

    /**
     * Filter by recipient NIF (partial match)
     */
    public function setRecipientNif(string $recipientNif): self
    {
        $this->initialized['recipientNif'] = true;
        $this->recipientNif = $recipientNif;

        return $this;
    }

    /**
     * Filter by series code
     */
    public function getSeriesCode(): string
    {
        return $this->seriesCode;
    }

    /**
     * Filter by series code
     */
    public function setSeriesCode(string $seriesCode): self
    {
        $this->initialized['seriesCode'] = true;
        $this->seriesCode = $seriesCode;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['invoiceIds' => ['invoice_ids', 'getInvoiceIds', 'setInvoiceIds'], 'format' => ['format', 'getFormat', 'setFormat'], 'status' => ['status', 'getStatus', 'setStatus'], 'type' => ['type', 'getType', 'setType'], 'dateFrom' => ['date_from', 'getDateFrom', 'setDateFrom'], 'dateTo' => ['date_to', 'getDateTo', 'setDateTo'], 'customerId' => ['customer_id', 'getCustomerId', 'setCustomerId'], 'recipientName' => ['recipient_name', 'getRecipientName', 'setRecipientName'], 'recipientNif' => ['recipient_nif', 'getRecipientNif', 'setRecipientNif'], 'seriesCode' => ['series_code', 'getSeriesCode', 'setSeriesCode']];
    }
}
