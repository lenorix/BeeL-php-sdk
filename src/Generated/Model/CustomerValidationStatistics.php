<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CustomerValidationStatistics implements AdditionalPropertiesInterface
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
     * Total customers processed
     *
     * @var int
     */
    protected $totalProcessed;

    /**
     * Completely valid customers (no warnings or errors)
     *
     * @var int
     */
    protected $valid;

    /**
     * Valid customers but with warnings
     *
     * @var int
     */
    protected $withWarnings;

    /**
     * Customers with errors (not importable)
     *
     * @var int
     */
    protected $withErrors;

    /**
     * Customers with duplicate NIFs
     *
     * @var int
     */
    protected $duplicates;

    /**
     * Customers with NIFs not valid in AEAT
     *
     * @var int
     */
    protected $invalidNifs;

    /**
     * Customers actually created in the database by this request.
     * Always `0` when `is_dry_run=true` (a preview writes nothing). On a real import it is
     * the number of rows that reached the database — normally `importable`, and lower when a
     * row was rejected on write (it is then reported under `duplicates` or `with_errors`).
     *
     *
     * @var int
     */
    protected $imported;

    /**
     * Success rate (valid + with_warnings) / total_processed
     *
     * @var float
     */
    protected $successRate;

    /**
     * Total customers that can be imported (valid + with_warnings)
     *
     * @var int
     */
    protected $importable;

    /**
     * Total customers that CANNOT be imported (with_errors + duplicates + invalid_nifs)
     *
     * @var int
     */
    protected $notImportable;

    /**
     * Total customers processed
     */
    public function getTotalProcessed(): int
    {
        return $this->totalProcessed;
    }

    /**
     * Total customers processed
     */
    public function setTotalProcessed(int $totalProcessed): self
    {
        $this->initialized['totalProcessed'] = true;
        $this->totalProcessed = $totalProcessed;

        return $this;
    }

    /**
     * Completely valid customers (no warnings or errors)
     */
    public function getValid(): int
    {
        return $this->valid;
    }

    /**
     * Completely valid customers (no warnings or errors)
     */
    public function setValid(int $valid): self
    {
        $this->initialized['valid'] = true;
        $this->valid = $valid;

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
     * Customers with errors (not importable)
     */
    public function getWithErrors(): int
    {
        return $this->withErrors;
    }

    /**
     * Customers with errors (not importable)
     */
    public function setWithErrors(int $withErrors): self
    {
        $this->initialized['withErrors'] = true;
        $this->withErrors = $withErrors;

        return $this;
    }

    /**
     * Customers with duplicate NIFs
     */
    public function getDuplicates(): int
    {
        return $this->duplicates;
    }

    /**
     * Customers with duplicate NIFs
     */
    public function setDuplicates(int $duplicates): self
    {
        $this->initialized['duplicates'] = true;
        $this->duplicates = $duplicates;

        return $this;
    }

    /**
     * Customers with NIFs not valid in AEAT
     */
    public function getInvalidNifs(): int
    {
        return $this->invalidNifs;
    }

    /**
     * Customers with NIFs not valid in AEAT
     */
    public function setInvalidNifs(int $invalidNifs): self
    {
        $this->initialized['invalidNifs'] = true;
        $this->invalidNifs = $invalidNifs;

        return $this;
    }

    /**
     * Customers actually created in the database by this request.
     * Always `0` when `is_dry_run=true` (a preview writes nothing). On a real import it is
     * the number of rows that reached the database — normally `importable`, and lower when a
     * row was rejected on write (it is then reported under `duplicates` or `with_errors`).
     */
    public function getImported(): int
    {
        return $this->imported;
    }

    /**
     * Customers actually created in the database by this request.
    Always `0` when `is_dry_run=true` (a preview writes nothing). On a real import it is
    the number of rows that reached the database — normally `importable`, and lower when a
    row was rejected on write (it is then reported under `duplicates` or `with_errors`).
     */
    public function setImported(int $imported): self
    {
        $this->initialized['imported'] = true;
        $this->imported = $imported;

        return $this;
    }

    /**
     * Success rate (valid + with_warnings) / total_processed
     */
    public function getSuccessRate(): float
    {
        return $this->successRate;
    }

    /**
     * Success rate (valid + with_warnings) / total_processed
     */
    public function setSuccessRate(float $successRate): self
    {
        $this->initialized['successRate'] = true;
        $this->successRate = $successRate;

        return $this;
    }

    /**
     * Total customers that can be imported (valid + with_warnings)
     */
    public function getImportable(): int
    {
        return $this->importable;
    }

    /**
     * Total customers that can be imported (valid + with_warnings)
     */
    public function setImportable(int $importable): self
    {
        $this->initialized['importable'] = true;
        $this->importable = $importable;

        return $this;
    }

    /**
     * Total customers that CANNOT be imported (with_errors + duplicates + invalid_nifs)
     */
    public function getNotImportable(): int
    {
        return $this->notImportable;
    }

    /**
     * Total customers that CANNOT be imported (with_errors + duplicates + invalid_nifs)
     */
    public function setNotImportable(int $notImportable): self
    {
        $this->initialized['notImportable'] = true;
        $this->notImportable = $notImportable;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['totalProcessed' => ['total_processed', 'getTotalProcessed', 'setTotalProcessed'], 'valid' => ['valid', 'getValid', 'setValid'], 'withWarnings' => ['with_warnings', 'getWithWarnings', 'setWithWarnings'], 'withErrors' => ['with_errors', 'getWithErrors', 'setWithErrors'], 'duplicates' => ['duplicates', 'getDuplicates', 'setDuplicates'], 'invalidNifs' => ['invalid_nifs', 'getInvalidNifs', 'setInvalidNifs'], 'imported' => ['imported', 'getImported', 'setImported'], 'successRate' => ['success_rate', 'getSuccessRate', 'setSuccessRate'], 'importable' => ['importable', 'getImportable', 'setImportable'], 'notImportable' => ['not_importable', 'getNotImportable', 'setNotImportable']];
    }
}
