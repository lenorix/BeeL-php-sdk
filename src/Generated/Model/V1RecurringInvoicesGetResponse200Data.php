<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1RecurringInvoicesGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<RecurringInvoiceResponse>
     */
    protected $recurringInvoices;

    /**
     * @var Pagination
     */
    protected $pagination;

    /**
     * @return list<RecurringInvoiceResponse>
     */
    public function getRecurringInvoices(): array
    {
        return $this->recurringInvoices;
    }

    /**
     * @param  list<RecurringInvoiceResponse>  $recurringInvoices
     */
    public function setRecurringInvoices(array $recurringInvoices): self
    {
        $this->initialized['recurringInvoices'] = true;
        $this->recurringInvoices = $recurringInvoices;

        return $this;
    }

    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    public function setPagination(Pagination $pagination): self
    {
        $this->initialized['pagination'] = true;
        $this->pagination = $pagination;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['recurringInvoices' => ['recurring_invoices', 'getRecurringInvoices', 'setRecurringInvoices'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}
