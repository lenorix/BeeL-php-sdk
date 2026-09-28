<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CustomerValidationUnifiedResult implements AdditionalPropertiesInterface
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
     * Metadata about the validation operation.
     * Compatible with bulk JSON, CSV import and Holded Excel import.
     * 
     *
     * @var CustomerValidationMetadata
     */
    protected $metadata;
    /**
     * List of processed customers with their validation status
     *
     * @var list<CustomerValidationItem>
     */
    protected $customersValidation;
    /**
     * Aggregated validation statistics.
     * Compatible with all source types (bulk JSON, CSV and Holded Excel).
     * 
     * Every field except `imported` counts rows of the submitted file/payload, classified by
     * outcome: each row falls into exactly one of `valid`, `with_warnings`, `with_errors`,
     * `duplicates` and `invalid_nifs`, so those five add up to `total_processed`.
     * `imported` is the only field that counts writes to the database, so it is the field to
     * read to know whether an import worked.
     * 
     *
     * @var CustomerValidationStatistics
     */
    protected $statistics;
    /**
     * Metadata about the validation operation.
     * Compatible with bulk JSON, CSV import and Holded Excel import.
     * 
     *
     * @return CustomerValidationMetadata
     */
    public function getMetadata(): CustomerValidationMetadata
    {
        return $this->metadata;
    }
    /**
    * Metadata about the validation operation.
    Compatible with bulk JSON, CSV import and Holded Excel import.
    
    *
    * @param CustomerValidationMetadata $metadata
    *
    * @return self
    */
    public function setMetadata(CustomerValidationMetadata $metadata): self
    {
        $this->initialized['metadata'] = true;
        $this->metadata = $metadata;
        return $this;
    }
    /**
     * List of processed customers with their validation status
     *
     * @return list<CustomerValidationItem>
     */
    public function getCustomersValidation(): array
    {
        return $this->customersValidation;
    }
    /**
     * List of processed customers with their validation status
     *
     * @param list<CustomerValidationItem> $customersValidation
     *
     * @return self
     */
    public function setCustomersValidation(array $customersValidation): self
    {
        $this->initialized['customersValidation'] = true;
        $this->customersValidation = $customersValidation;
        return $this;
    }
    /**
     * Aggregated validation statistics.
     * Compatible with all source types (bulk JSON, CSV and Holded Excel).
     * 
     * Every field except `imported` counts rows of the submitted file/payload, classified by
     * outcome: each row falls into exactly one of `valid`, `with_warnings`, `with_errors`,
     * `duplicates` and `invalid_nifs`, so those five add up to `total_processed`.
     * `imported` is the only field that counts writes to the database, so it is the field to
     * read to know whether an import worked.
     * 
     *
     * @return CustomerValidationStatistics
     */
    public function getStatistics(): CustomerValidationStatistics
    {
        return $this->statistics;
    }
    /**
    * Aggregated validation statistics.
    Compatible with all source types (bulk JSON, CSV and Holded Excel).
    
    Every field except `imported` counts rows of the submitted file/payload, classified by
    outcome: each row falls into exactly one of `valid`, `with_warnings`, `with_errors`,
    `duplicates` and `invalid_nifs`, so those five add up to `total_processed`.
    `imported` is the only field that counts writes to the database, so it is the field to
    read to know whether an import worked.
    
    *
    * @param CustomerValidationStatistics $statistics
    *
    * @return self
    */
    public function setStatistics(CustomerValidationStatistics $statistics): self
    {
        $this->initialized['statistics'] = true;
        $this->statistics = $statistics;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['metadata' => ['metadata', 'getMetadata', 'setMetadata'], 'customersValidation' => ['customers_validation', 'getCustomersValidation', 'setCustomersValidation'], 'statistics' => ['statistics', 'getStatistics', 'setStatistics']];
    }
}