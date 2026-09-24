<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CsvCustomerPreview implements AdditionalPropertiesInterface
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
     * Row number in CSV (starting from 1)
     *
     * @var int
     */
    protected $rowNumber;
    /**
     * Parsed customer (null if there are critical parsing errors)
     *
     * @var array<string, mixed>|null
     */
    protected $customer;
    /**
     * Validation status of the parsed customer:
     * - VALID: Valid customer, ready to import
     * - WARNING: Valid customer but with non-critical warnings
     * - ERROR: Invalid customer, cannot be processed
     * - DUPLICATE: Duplicate customer (in CSV or database)
     * - NIF_INVALID: Tax ID not valid according to AEAT registry (VeriFactu)
     * 
     *
     * @var string
     */
    protected $status;
    /**
     * List of validation errors for this customer
     *
     * @var list<CsvValidationError>
     */
    protected $errors;
    /**
     * List of warnings (customer processable but with observations)
     *
     * @var list<string>
     */
    protected $warnings;
    /**
     * Row number in CSV (starting from 1)
     *
     * @return int
     */
    public function getRowNumber(): int
    {
        return $this->rowNumber;
    }
    /**
     * Row number in CSV (starting from 1)
     *
     * @param int $rowNumber
     *
     * @return self
     */
    public function setRowNumber(int $rowNumber): self
    {
        $this->initialized['rowNumber'] = true;
        $this->rowNumber = $rowNumber;
        return $this;
    }
    /**
     * Parsed customer (null if there are critical parsing errors)
     *
     * @return array<string, mixed>|null
     */
    public function getCustomer(): ?iterable
    {
        return $this->customer;
    }
    /**
     * Parsed customer (null if there are critical parsing errors)
     *
     * @param array<string, mixed>|null $customer
     *
     * @return self
     */
    public function setCustomer(?iterable $customer): self
    {
        $this->initialized['customer'] = true;
        $this->customer = $customer;
        return $this;
    }
    /**
     * Validation status of the parsed customer:
     * - VALID: Valid customer, ready to import
     * - WARNING: Valid customer but with non-critical warnings
     * - ERROR: Invalid customer, cannot be processed
     * - DUPLICATE: Duplicate customer (in CSV or database)
     * - NIF_INVALID: Tax ID not valid according to AEAT registry (VeriFactu)
     * 
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
    /**
    * Validation status of the parsed customer:
    - VALID: Valid customer, ready to import
    - WARNING: Valid customer but with non-critical warnings
    - ERROR: Invalid customer, cannot be processed
    - DUPLICATE: Duplicate customer (in CSV or database)
    - NIF_INVALID: Tax ID not valid according to AEAT registry (VeriFactu)
    
    *
    * @param string $status
    *
    * @return self
    */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;
        return $this;
    }
    /**
     * List of validation errors for this customer
     *
     * @return list<CsvValidationError>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
    /**
     * List of validation errors for this customer
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
     * List of warnings (customer processable but with observations)
     *
     * @return list<string>
     */
    public function getWarnings(): array
    {
        return $this->warnings;
    }
    /**
     * List of warnings (customer processable but with observations)
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
        return ['rowNumber' => ['row_number', 'getRowNumber', 'setRowNumber'], 'customer' => ['customer', 'getCustomer', 'setCustomer'], 'status' => ['status', 'getStatus', 'setStatus'], 'errors' => ['errors', 'getErrors', 'setErrors'], 'warnings' => ['warnings', 'getWarnings', 'setWarnings']];
    }
}