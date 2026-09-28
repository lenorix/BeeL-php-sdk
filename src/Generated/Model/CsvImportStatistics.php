<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CsvImportStatistics implements AdditionalPropertiesInterface
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
     * Total records processed
     *
     * @var int
     */
    protected $totalProcessed;

    /**
     * Valid customers without warnings
     *
     * @var int
     */
    protected $successful;

    /**
     * Valid customers but with warnings
     *
     * @var int
     */
    protected $withWarnings;

    /**
     * Customers with validation errors
     *
     * @var int
     */
    protected $failed;

    /**
     * Duplicate customers (in CSV or DB)
     *
     * @var int
     */
    protected $duplicates;

    /**
     * Customers with invalid Tax IDs in AEAT
     *
     * @var int
     */
    protected $invalidNifs;

    /**
     * Success rate (successful + with_warnings) / total
     *
     * @var float
     */
    protected $successRate;

    /**
     * Total records processed
     */
    public function getTotalProcessed(): int
    {
        return $this->totalProcessed;
    }

    /**
     * Total records processed
     */
    public function setTotalProcessed(int $totalProcessed): self
    {
        $this->initialized['totalProcessed'] = true;
        $this->totalProcessed = $totalProcessed;

        return $this;
    }

    /**
     * Valid customers without warnings
     */
    public function getSuccessful(): int
    {
        return $this->successful;
    }

    /**
     * Valid customers without warnings
     */
    public function setSuccessful(int $successful): self
    {
        $this->initialized['successful'] = true;
        $this->successful = $successful;

        return $this;
    }

    /**
     * Valid customers but with warnings
     */
    public function getWithWarnings(): int
    {
        return $this->withWarnings;
    }

    /**
     * Valid customers but with warnings
     */
    public function setWithWarnings(int $withWarnings): self
    {
        $this->initialized['withWarnings'] = true;
        $this->withWarnings = $withWarnings;

        return $this;
    }

    /**
     * Customers with validation errors
     */
    public function getFailed(): int
    {
        return $this->failed;
    }

    /**
     * Customers with validation errors
     */
    public function setFailed(int $failed): self
    {
        $this->initialized['failed'] = true;
        $this->failed = $failed;

        return $this;
    }

    /**
     * Duplicate customers (in CSV or DB)
     */
    public function getDuplicates(): int
    {
        return $this->duplicates;
    }

    /**
     * Duplicate customers (in CSV or DB)
     */
    public function setDuplicates(int $duplicates): self
    {
        $this->initialized['duplicates'] = true;
        $this->duplicates = $duplicates;

        return $this;
    }

    /**
     * Customers with invalid Tax IDs in AEAT
     */
    public function getInvalidNifs(): int
    {
        return $this->invalidNifs;
    }

    /**
     * Customers with invalid Tax IDs in AEAT
     */
    public function setInvalidNifs(int $invalidNifs): self
    {
        $this->initialized['invalidNifs'] = true;
        $this->invalidNifs = $invalidNifs;

        return $this;
    }

    /**
     * Success rate (successful + with_warnings) / total
     */
    public function getSuccessRate(): float
    {
        return $this->successRate;
    }

    /**
     * Success rate (successful + with_warnings) / total
     */
    public function setSuccessRate(float $successRate): self
    {
        $this->initialized['successRate'] = true;
        $this->successRate = $successRate;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['totalProcessed' => ['total_processed', 'getTotalProcessed', 'setTotalProcessed'], 'successful' => ['successful', 'getSuccessful', 'setSuccessful'], 'withWarnings' => ['with_warnings', 'getWithWarnings', 'setWithWarnings'], 'failed' => ['failed', 'getFailed', 'setFailed'], 'duplicates' => ['duplicates', 'getDuplicates', 'setDuplicates'], 'invalidNifs' => ['invalid_nifs', 'getInvalidNifs', 'setInvalidNifs'], 'successRate' => ['success_rate', 'getSuccessRate', 'setSuccessRate']];
    }
}
