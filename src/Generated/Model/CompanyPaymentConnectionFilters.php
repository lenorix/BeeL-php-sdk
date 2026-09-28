<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CompanyPaymentConnectionFilters implements AdditionalPropertiesInterface
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
     * Charges below this amount are skipped.
     *
     * @var float|null
     */
    protected $minAmount;

    /**
     * Charges above this amount are skipped.
     *
     * @var float|null
     */
    protected $maxAmount;

    /**
     * When true, only charges from customers already mapped to a BeeL customer are invoiced.
     *
     *
     * @var bool|null
     */
    protected $onlyMappedCustomers;

    /**
     * Provider-side customer ids (e.g. Stripe `cus_...`) allowed through. When set, no other
     * customer is invoiced.
     *
     *
     * @var list<string>|null
     */
    protected $allowedCustomerIds;

    /**
     * Regular expressions matched against the charge description. A charge matching any of
     * them is skipped.
     *
     *
     * @var list<string>|null
     */
    protected $excludedDescriptionPatterns;

    /**
     * Regular expressions matched against the charge description. A charge must match at
     * least one of them to be invoiced.
     *
     *
     * @var list<string>|null
     */
    protected $requiredDescriptionPatterns;

    /**
     * Charge categories opted out of auto-invoicing. An empty list, or the field left out,
     * leaves every category active.
     *
     *
     * @var list<string>|null
     */
    protected $disabledCategories;

    /**
     * Charges below this amount are skipped.
     */
    public function getMinAmount(): ?float
    {
        return $this->minAmount;
    }

    /**
     * Charges below this amount are skipped.
     */
    public function setMinAmount(?float $minAmount): self
    {
        $this->initialized['minAmount'] = true;
        $this->minAmount = $minAmount;

        return $this;
    }

    /**
     * Charges above this amount are skipped.
     */
    public function getMaxAmount(): ?float
    {
        return $this->maxAmount;
    }

    /**
     * Charges above this amount are skipped.
     */
    public function setMaxAmount(?float $maxAmount): self
    {
        $this->initialized['maxAmount'] = true;
        $this->maxAmount = $maxAmount;

        return $this;
    }

    /**
     * When true, only charges from customers already mapped to a BeeL customer are invoiced.
     */
    public function getOnlyMappedCustomers(): ?bool
    {
        return $this->onlyMappedCustomers;
    }

    /**
     * When true, only charges from customers already mapped to a BeeL customer are invoiced.
     */
    public function setOnlyMappedCustomers(?bool $onlyMappedCustomers): self
    {
        $this->initialized['onlyMappedCustomers'] = true;
        $this->onlyMappedCustomers = $onlyMappedCustomers;

        return $this;
    }

    /**
     * Provider-side customer ids (e.g. Stripe `cus_...`) allowed through. When set, no other
     * customer is invoiced.
     *
     *
     * @return list<string>|null
     */
    public function getAllowedCustomerIds(): ?array
    {
        return $this->allowedCustomerIds;
    }

    /**
     * Provider-side customer ids (e.g. Stripe `cus_...`) allowed through. When set, no other
    customer is invoiced.

     *
     * @param  list<string>|null  $allowedCustomerIds
     */
    public function setAllowedCustomerIds(?array $allowedCustomerIds): self
    {
        $this->initialized['allowedCustomerIds'] = true;
        $this->allowedCustomerIds = $allowedCustomerIds;

        return $this;
    }

    /**
     * Regular expressions matched against the charge description. A charge matching any of
     * them is skipped.
     *
     *
     * @return list<string>|null
     */
    public function getExcludedDescriptionPatterns(): ?array
    {
        return $this->excludedDescriptionPatterns;
    }

    /**
     * Regular expressions matched against the charge description. A charge matching any of
    them is skipped.

     *
     * @param  list<string>|null  $excludedDescriptionPatterns
     */
    public function setExcludedDescriptionPatterns(?array $excludedDescriptionPatterns): self
    {
        $this->initialized['excludedDescriptionPatterns'] = true;
        $this->excludedDescriptionPatterns = $excludedDescriptionPatterns;

        return $this;
    }

    /**
     * Regular expressions matched against the charge description. A charge must match at
     * least one of them to be invoiced.
     *
     *
     * @return list<string>|null
     */
    public function getRequiredDescriptionPatterns(): ?array
    {
        return $this->requiredDescriptionPatterns;
    }

    /**
     * Regular expressions matched against the charge description. A charge must match at
    least one of them to be invoiced.

     *
     * @param  list<string>|null  $requiredDescriptionPatterns
     */
    public function setRequiredDescriptionPatterns(?array $requiredDescriptionPatterns): self
    {
        $this->initialized['requiredDescriptionPatterns'] = true;
        $this->requiredDescriptionPatterns = $requiredDescriptionPatterns;

        return $this;
    }

    /**
     * Charge categories opted out of auto-invoicing. An empty list, or the field left out,
     * leaves every category active.
     *
     *
     * @return list<string>|null
     */
    public function getDisabledCategories(): ?array
    {
        return $this->disabledCategories;
    }

    /**
     * Charge categories opted out of auto-invoicing. An empty list, or the field left out,
    leaves every category active.

     *
     * @param  list<string>|null  $disabledCategories
     */
    public function setDisabledCategories(?array $disabledCategories): self
    {
        $this->initialized['disabledCategories'] = true;
        $this->disabledCategories = $disabledCategories;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['minAmount' => ['min_amount', 'getMinAmount', 'setMinAmount'], 'maxAmount' => ['max_amount', 'getMaxAmount', 'setMaxAmount'], 'onlyMappedCustomers' => ['only_mapped_customers', 'getOnlyMappedCustomers', 'setOnlyMappedCustomers'], 'allowedCustomerIds' => ['allowed_customer_ids', 'getAllowedCustomerIds', 'setAllowedCustomerIds'], 'excludedDescriptionPatterns' => ['excluded_description_patterns', 'getExcludedDescriptionPatterns', 'setExcludedDescriptionPatterns'], 'requiredDescriptionPatterns' => ['required_description_patterns', 'getRequiredDescriptionPatterns', 'setRequiredDescriptionPatterns'], 'disabledCategories' => ['disabled_categories', 'getDisabledCategories', 'setDisabledCategories']];
    }
}
