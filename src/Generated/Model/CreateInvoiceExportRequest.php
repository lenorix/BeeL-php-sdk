<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CreateInvoiceExportRequest implements AdditionalPropertiesInterface
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
     * - **SUMMARY**: one row per invoice with aggregated totals.
     * - **ITEMS**: one row per invoice line.
     *
     *
     * @var string
     */
    protected $format = 'SUMMARY';

    /**
     * Specific invoices to export. When present, `filters` is ignored.
     *
     * @var list<string>
     */
    protected $invoiceIds;

    /**
     * Selection criteria used when `invoice_ids` is not supplied. Max 50000 invoices: a wider match is rejected with `422 EXPORT_LIMIT_EXCEEDED`, never truncated.
     *
     * @var InvoiceExportFilters
     */
    protected $filters;

    /**
     * - **SUMMARY**: one row per invoice with aggregated totals.
     * - **ITEMS**: one row per invoice line.
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * - **SUMMARY**: one row per invoice with aggregated totals.
    - **ITEMS**: one row per invoice line.
     */
    public function setFormat(string $format): self
    {
        $this->initialized['format'] = true;
        $this->format = $format;

        return $this;
    }

    /**
     * Specific invoices to export. When present, `filters` is ignored.
     *
     * @return list<string>
     */
    public function getInvoiceIds(): array
    {
        return $this->invoiceIds;
    }

    /**
     * Specific invoices to export. When present, `filters` is ignored.
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
     * Selection criteria used when `invoice_ids` is not supplied. Max 50000 invoices: a wider match is rejected with `422 EXPORT_LIMIT_EXCEEDED`, never truncated.
     */
    public function getFilters(): InvoiceExportFilters
    {
        return $this->filters;
    }

    /**
     * Selection criteria used when `invoice_ids` is not supplied. Max 50000 invoices: a wider match is rejected with `422 EXPORT_LIMIT_EXCEEDED`, never truncated.
     */
    public function setFilters(InvoiceExportFilters $filters): self
    {
        $this->initialized['filters'] = true;
        $this->filters = $filters;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['format' => ['format', 'getFormat', 'setFormat'], 'invoiceIds' => ['invoice_ids', 'getInvoiceIds', 'setInvoiceIds'], 'filters' => ['filters', 'getFilters', 'setFilters']];
    }
}
