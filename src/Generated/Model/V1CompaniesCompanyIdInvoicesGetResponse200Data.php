<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CompaniesCompanyIdInvoicesGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<Invoice>
     */
    protected $invoices;
    /**
     * @var Pagination
     */
    protected $pagination;
    /**
     * @return list<Invoice>
     */
    public function getInvoices(): array
    {
        return $this->invoices;
    }
    /**
     * @param list<Invoice> $invoices
     *
     * @return self
     */
    public function setInvoices(array $invoices): self
    {
        $this->initialized['invoices'] = true;
        $this->invoices = $invoices;
        return $this;
    }
    /**
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }
    /**
     * @param Pagination $pagination
     *
     * @return self
     */
    public function setPagination(Pagination $pagination): self
    {
        $this->initialized['pagination'] = true;
        $this->pagination = $pagination;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['invoices' => ['invoices', 'getInvoices', 'setInvoices'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}