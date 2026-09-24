<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1InvoicesBulkIssuePostBody implements AdditionalPropertiesInterface
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
     * Draft invoice IDs to issue
     *
     * @var list<string>
     */
    protected $invoiceIds;

    /**
     * Draft invoice IDs to issue
     *
     * @return list<string>
     */
    public function getInvoiceIds(): array
    {
        return $this->invoiceIds;
    }

    /**
     * Draft invoice IDs to issue
     *
     * @param  list<string>  $invoiceIds
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
