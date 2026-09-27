<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CsvImportResult implements AdditionalPropertiesInterface
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
     * Total records processed from CSV
     *
     * @var int
     */
    protected $totalProcessed;
    /**
     * Number of customers successfully created
     *
     * @var int
     */
    protected $successful;
    /**
     * Number of records that failed
     *
     * @var int
     */
    protected $failed;
    /**
     * Number of records skipped as duplicates (same Tax ID)
     *
     * @var int
     */
    protected $duplicatesSkipped;
    /**
     * List of successfully created customers
     *
     * @var list<Customer>
     */
    protected $createdCustomers;
    /**
     * Error details by row
     *
     * @var list<CsvValidationError>
     */
    protected $errors;
    /**
     * Non-critical warnings (missing optional fields)
     *
     * @var list<string>
     */
    protected $warnings;
    /**
     * Total records processed from CSV
     *
     * @return int
     */
    public function getTotalProcessed(): int
    {
        return $this->totalProcessed;
    }
    /**
     * Total records processed from CSV
     *
     * @param int $totalProcessed
     *
     * @return self
     */
    public function setTotalProcessed(int $totalProcessed): self
    {
        $this->initialized['totalProcessed'] = true;
        $this->totalProcessed = $totalProcessed;
        return $this;
    }
    /**
     * Number of customers successfully created
     *
     * @return int
     */
    public function getSuccessful(): int
    {
        return $this->successful;
    }
    /**
     * Number of customers successfully created
     *
     * @param int $successful
     *
     * @return self
     */
    public function setSuccessful(int $successful): self
    {
        $this->initialized['successful'] = true;
        $this->successful = $successful;
        return $this;
    }
    /**
     * Number of records that failed
     *
     * @return int
     */
    public function getFailed(): int
    {
        return $this->failed;
    }
    /**
     * Number of records that failed
     *
     * @param int $failed
     *
     * @return self
     */
    public function setFailed(int $failed): self
    {
        $this->initialized['failed'] = true;
        $this->failed = $failed;
        return $this;
    }
    /**
     * Number of records skipped as duplicates (same Tax ID)
     *
     * @return int
     */
    public function getDuplicatesSkipped(): int
    {
        return $this->duplicatesSkipped;
    }
    /**
     * Number of records skipped as duplicates (same Tax ID)
     *
     * @param int $duplicatesSkipped
     *
     * @return self
     */
    public function setDuplicatesSkipped(int $duplicatesSkipped): self
    {
        $this->initialized['duplicatesSkipped'] = true;
        $this->duplicatesSkipped = $duplicatesSkipped;
        return $this;
    }
    /**
     * List of successfully created customers
     *
     * @return list<Customer>
     */
    public function getCreatedCustomers(): array
    {
        return $this->createdCustomers;
    }
    /**
     * List of successfully created customers
     *
     * @param list<Customer> $createdCustomers
     *
     * @return self
     */
    public function setCreatedCustomers(array $createdCustomers): self
    {
        $this->initialized['createdCustomers'] = true;
        $this->createdCustomers = $createdCustomers;
        return $this;
    }
    /**
     * Error details by row
     *
     * @return list<CsvValidationError>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
    /**
     * Error details by row
     *
     * @param list<CsvValidationError> $errors
     *
     * @return self
     */
    public function setErrors(array $errors): self
    {
        $this->initialized['errors'] = true;
        $this->errors = $errors;
        return $this;
    }
    /**
     * Non-critical warnings (missing optional fields)
     *
     * @return list<string>
     */
    public function getWarnings(): array
    {
        return $this->warnings;
    }
    /**
     * Non-critical warnings (missing optional fields)
     *
     * @param list<string> $warnings
     *
     * @return self
     */
    public function setWarnings(array $warnings): self
    {
        $this->initialized['warnings'] = true;
        $this->warnings = $warnings;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['totalProcessed' => ['total_processed', 'getTotalProcessed', 'setTotalProcessed'], 'successful' => ['successful', 'getSuccessful', 'setSuccessful'], 'failed' => ['failed', 'getFailed', 'setFailed'], 'duplicatesSkipped' => ['duplicates_skipped', 'getDuplicatesSkipped', 'setDuplicatesSkipped'], 'createdCustomers' => ['created_customers', 'getCreatedCustomers', 'setCreatedCustomers'], 'errors' => ['errors', 'getErrors', 'setErrors'], 'warnings' => ['warnings', 'getWarnings', 'setWarnings']];
    }
}