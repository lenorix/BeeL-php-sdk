<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CsvImportMetadata implements AdditionalPropertiesInterface
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
     * Original file name
     *
     * @var string
     */
    protected $filename;

    /**
     * File size in bytes
     *
     * @var int
     */
    protected $fileSizeBytes;

    /**
     * Total rows processed (excluding headers)
     *
     * @var int
     */
    protected $totalRows;

    /**
     * Whether it was a test processing without persistence
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
     * Original file name
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * Original file name
     */
    public function setFilename(string $filename): self
    {
        $this->initialized['filename'] = true;
        $this->filename = $filename;

        return $this;
    }

    /**
     * File size in bytes
     */
    public function getFileSizeBytes(): int
    {
        return $this->fileSizeBytes;
    }

    /**
     * File size in bytes
     */
    public function setFileSizeBytes(int $fileSizeBytes): self
    {
        $this->initialized['fileSizeBytes'] = true;
        $this->fileSizeBytes = $fileSizeBytes;

        return $this;
    }

    /**
     * Total rows processed (excluding headers)
     */
    public function getTotalRows(): int
    {
        return $this->totalRows;
    }

    /**
     * Total rows processed (excluding headers)
     */
    public function setTotalRows(int $totalRows): self
    {
        $this->initialized['totalRows'] = true;
        $this->totalRows = $totalRows;

        return $this;
    }

    /**
     * Whether it was a test processing without persistence
     */
    public function getIsDryRun(): bool
    {
        return $this->isDryRun;
    }

    /**
     * Whether it was a test processing without persistence
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

    public function definedProperties(): array
    {
        return ['filename' => ['filename', 'getFilename', 'setFilename'], 'fileSizeBytes' => ['file_size_bytes', 'getFileSizeBytes', 'setFileSizeBytes'], 'totalRows' => ['total_rows', 'getTotalRows', 'setTotalRows'], 'isDryRun' => ['is_dry_run', 'getIsDryRun', 'setIsDryRun'], 'processingTimeMs' => ['processing_time_ms', 'getProcessingTimeMs', 'setProcessingTimeMs']];
    }
}
