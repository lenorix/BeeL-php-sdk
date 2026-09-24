<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CsvImportPreviewResult implements AdditionalPropertiesInterface
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
     * Metadata about the processed CSV file
     *
     * @var CsvImportMetadata
     */
    protected $metadata;

    /**
     * Complete list of parsed customers with their validation status
     *
     * @var list<CsvCustomerPreview>
     */
    protected $customersPreview;

    /**
     * Calculated statistics from CSV processing
     *
     * @var CsvImportStatistics
     */
    protected $statistics;

    /**
     * Metadata about the processed CSV file
     */
    public function getMetadata(): CsvImportMetadata
    {
        return $this->metadata;
    }

    /**
     * Metadata about the processed CSV file
     */
    public function setMetadata(CsvImportMetadata $metadata): self
    {
        $this->initialized['metadata'] = true;
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Complete list of parsed customers with their validation status
     *
     * @return list<CsvCustomerPreview>
     */
    public function getCustomersPreview(): array
    {
        return $this->customersPreview;
    }

    /**
     * Complete list of parsed customers with their validation status
     *
     * @param  list<CsvCustomerPreview>  $customersPreview
     */
    public function setCustomersPreview(array $customersPreview): self
    {
        $this->initialized['customersPreview'] = true;
        $this->customersPreview = $customersPreview;

        return $this;
    }

    /**
     * Calculated statistics from CSV processing
     */
    public function getStatistics(): CsvImportStatistics
    {
        return $this->statistics;
    }

    /**
     * Calculated statistics from CSV processing
     */
    public function setStatistics(CsvImportStatistics $statistics): self
    {
        $this->initialized['statistics'] = true;
        $this->statistics = $statistics;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['metadata' => ['metadata', 'getMetadata', 'setMetadata'], 'customersPreview' => ['customers_preview', 'getCustomersPreview', 'setCustomersPreview'], 'statistics' => ['statistics', 'getStatistics', 'setStatistics']];
    }
}
