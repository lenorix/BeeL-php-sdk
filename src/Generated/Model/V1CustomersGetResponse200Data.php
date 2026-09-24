<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1CustomersGetResponse200Data implements AdditionalPropertiesInterface
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
     * @var list<Customer>
     */
    protected $customers;

    /**
     * @var Pagination
     */
    protected $pagination;

    /**
     * @return list<Customer>
     */
    public function getCustomers(): array
    {
        return $this->customers;
    }

    /**
     * @param  list<Customer>  $customers
     */
    public function setCustomers(array $customers): self
    {
        $this->initialized['customers'] = true;
        $this->customers = $customers;

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
        return ['customers' => ['customers', 'getCustomers', 'setCustomers'], 'pagination' => ['pagination', 'getPagination', 'setPagination']];
    }
}
