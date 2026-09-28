<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CreateInvoicePdfArchiveRequest implements AdditionalPropertiesInterface
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
     * Invoices whose PDFs go into the archive.
     *
     * @var list<string>
     */
    protected $invoiceIds;
    /**
     * Invoices whose PDFs go into the archive.
     *
     * @return list<string>
     */
    public function getInvoiceIds(): array
    {
        return $this->invoiceIds;
    }
    /**
     * Invoices whose PDFs go into the archive.
     *
     * @param list<string> $invoiceIds
     *
     * @return self
     */
    public function setInvoiceIds(array $invoiceIds): self
    {
        $this->initialized['invoiceIds'] = true;
        $this->invoiceIds = $invoiceIds;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['invoiceIds' => ['invoice_ids', 'getInvoiceIds', 'setInvoiceIds']];
    }
}