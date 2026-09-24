<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1CompaniesCompanyIdCustomersBulkPostBody implements AdditionalPropertiesInterface
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
     * @var list<CreateCustomerRequest>
     */
    protected $customers;

    /**
     * @return list<CreateCustomerRequest>
     */
    public function getCustomers(): array
    {
        return $this->customers;
    }

    /**
     * @param  list<CreateCustomerRequest>  $customers
     */
    public function setCustomers(array $customers): self
    {
        $this->initialized['customers'] = true;
        $this->customers = $customers;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['customers' => ['customers', 'getCustomers', 'setCustomers']];
    }
}
