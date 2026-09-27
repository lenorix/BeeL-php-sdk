<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CustomerValidationMetadata implements AdditionalPropertiesInterface
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
     * Total number of customers submitted
     *
     * @var int
     */
    protected $totalCustomers;

    /**
     * Whether it was validation (true) or import (false)
     *
     * @var bool
     */
    protected $isDryRun;

    /**
     * Processing time in milliseconds
     *
     * @var int
     */
    protected $processingTimeMs;

    /**
     * Data source type:
     * - BULK_JSON: Data sent as JSON to bulk endpoint
     * - CSV_IMPORT: Data parsed from CSV file
     * - HOLDED_EXCEL: Data parsed from Holded Excel file
     *
     *
     * @var string
     */
    protected $sourceType;

    /**
     * File name (CSV or Excel depending on source_type)
     *
     * @var string|null
     */
    protected $filename;

    /**
     * File size in bytes
     *
     * @var int|null
     */
    protected $fileSizeBytes;

    /**
     * Total file rows excluding headers
     *
     * @var int|null
     */
    protected $totalRows;

    /**
     * Total number of customers submitted
     */
    public function getTotalCustomers(): int
    {
        return $this->totalCustomers;
    }

    /**
     * Total number of customers submitted
     */
    public function setTotalCustomers(int $totalCustomers): self
    {
        $this->initialized['totalCustomers'] = true;
        $this->totalCustomers = $totalCustomers;

        return $this;
    }

    /**
     * Whether it was validation (true) or import (false)
     */
    public function getIsDryRun(): bool
    {
        return $this->isDryRun;
    }

    /**
     * Whether it was validation (true) or import (false)
     */
    public function setIsDryRun(bool $isDryRun): self
    {
        $this->initialized['isDryRun'] = true;
        $this->isDryRun = $isDryRun;

        return $this;
    }

    /**
     * Processing time in milliseconds
     */
    public function getProcessingTimeMs(): int
    {
        return $this->processingTimeMs;
    }

    /**
     * Processing time in milliseconds
     */
    public function setProcessingTimeMs(int $processingTimeMs): self
    {
        $this->initialized['processingTimeMs'] = true;
        $this->processingTimeMs = $processingTimeMs;

        return $this;
    }

    /**
     * Data source type:
     * - BULK_JSON: Data sent as JSON to bulk endpoint
     * - CSV_IMPORT: Data parsed from CSV file
     * - HOLDED_EXCEL: Data parsed from Holded Excel file
     */
    public function getSourceType(): string
    {
        return $this->sourceType;
    }

    /**
     * Data source type:
    - BULK_JSON: Data sent as JSON to bulk endpoint
    - CSV_IMPORT: Data parsed from CSV file
    - HOLDED_EXCEL: Data parsed from Holded Excel file
     */
    public function setSourceType(string $sourceType): self
    {
        $this->initialized['sourceType'] = true;
        $this->sourceType = $sourceType;

        return $this;
    }

    /**
     * File name (CSV or Excel depending on source_type)
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * File name (CSV or Excel depending on source_type)
     */
    public function setFilename(?string $filename): self
    {
        $this->initialized['filename'] = true;
        $this->filename = $filename;

        return $this;
    }

    /**
     * File size in bytes
     */
    public function getFileSizeBytes(): ?int
    {
        return $this->fileSizeBytes;
    }

    /**
     * File size in bytes
     */
    public function setFileSizeBytes(?int $fileSizeBytes): self
    {
        $this->initialized['fileSizeBytes'] = true;
        $this->fileSizeBytes = $fileSizeBytes;

        return $this;
    }

    /**
     * Total file rows excluding headers
     */
    public function getTotalRows(): ?int
    {
        return $this->totalRows;
    }

    /**
     * Total file rows excluding headers
     */
    public function setTotalRows(?int $totalRows): self
    {
        $this->initialized['totalRows'] = true;
        $this->totalRows = $totalRows;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['totalCustomers' => ['total_customers', 'getTotalCustomers', 'setTotalCustomers'], 'isDryRun' => ['is_dry_run', 'getIsDryRun', 'setIsDryRun'], 'processingTimeMs' => ['processing_time_ms', 'getProcessingTimeMs', 'setProcessingTimeMs'], 'sourceType' => ['source_type', 'getSourceType', 'setSourceType'], 'filename' => ['filename', 'getFilename', 'setFilename'], 'fileSizeBytes' => ['file_size_bytes', 'getFileSizeBytes', 'setFileSizeBytes'], 'totalRows' => ['total_rows', 'getTotalRows', 'setTotalRows']];
    }
}
