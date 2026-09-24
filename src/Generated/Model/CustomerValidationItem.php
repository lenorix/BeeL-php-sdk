<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CustomerValidationItem implements AdditionalPropertiesInterface
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
     * Customer index in the submitted list (0-based for bulk, 1-based for files).
     * For CSV/Excel, represents the row number in the file.
     *
     *
     * @var int
     */
    protected $index;

    /**
     * **Echo of what was submitted**, parsed and validated. Absent when the row could not be
     * parsed at all.
     *
     * It is deliberately NOT a `Customer`: the same operation also runs as a rehearsal
     * (`dry_run=true`), where nothing is written and there is no `id` nor `created_at` to
     * report. Typing it as `Customer` — which requires both — made the contract impossible to
     * honour in one of its two modes, and it was in fact honoured in neither. **The identifier
     * of what was created travels in `customer_id`**, at row level, and only when the row
     * actually created something.
     *
     *
     * @var CustomerValidationItemCustomer
     */
    protected $customer;

    /**
     * Identifier of the customer this row created. **Present only when the row actually
     * created something**: absent in a rehearsal (`dry_run=true`), absent on a row that was
     * rejected, and absent on a batch that was rejected as a whole.
     *
     * After a `201`, every row carries it, and
     * `GET /v1/companies/{company_id}/customers/{customer_id}` answers `200`.
     *
     *
     * @var string
     */
    protected $customerId;

    /**
     * Customer validation status:
     * - VALID: Completely valid customer
     * - WARNING: Valid customer but with non-critical warnings
     * - ERROR: Invalid customer, cannot be processed
     * - DUPLICATE: Duplicate customer (in batch/CSV or database)
     * - NIF_INVALID: NIF not valid according to AEAT census (VeriFactu)
     *
     *
     * @var string
     */
    protected $status;

    /**
     * List of errors found (block import)
     *
     * @var list<CustomerValidationError>
     */
    protected $errors;

    /**
     * List of warnings (do not block import)
     *
     * @var list<CustomerValidationWarning>
     */
    protected $warnings;

    /**
     * Row number in the file (CSV or Excel depending on source_type)
     *
     * @var int|null
     */
    protected $rowNumber;

    /**
     * Customer index in the submitted list (0-based for bulk, 1-based for files).
     * For CSV/Excel, represents the row number in the file.
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * Customer index in the submitted list (0-based for bulk, 1-based for files).
    For CSV/Excel, represents the row number in the file.
     */
    public function setIndex(int $index): self
    {
        $this->initialized['index'] = true;
        $this->index = $index;

        return $this;
    }

    /**
     * **Echo of what was submitted**, parsed and validated. Absent when the row could not be
     * parsed at all.
     *
     * It is deliberately NOT a `Customer`: the same operation also runs as a rehearsal
     * (`dry_run=true`), where nothing is written and there is no `id` nor `created_at` to
     * report. Typing it as `Customer` — which requires both — made the contract impossible to
     * honour in one of its two modes, and it was in fact honoured in neither. **The identifier
     * of what was created travels in `customer_id`**, at row level, and only when the row
     * actually created something.
     */
    public function getCustomer(): CustomerValidationItemCustomer
    {
        return $this->customer;
    }

    /**
     * **Echo of what was submitted**, parsed and validated. Absent when the row could not be
    parsed at all.

    It is deliberately NOT a `Customer`: the same operation also runs as a rehearsal
    (`dry_run=true`), where nothing is written and there is no `id` nor `created_at` to
    report. Typing it as `Customer` — which requires both — made the contract impossible to
    honour in one of its two modes, and it was in fact honoured in neither. **The identifier
    of what was created travels in `customer_id`**, at row level, and only when the row
    actually created something.
     */
    public function setCustomer(CustomerValidationItemCustomer $customer): self
    {
        $this->initialized['customer'] = true;
        $this->customer = $customer;

        return $this;
    }

    /**
     * Identifier of the customer this row created. **Present only when the row actually
     * created something**: absent in a rehearsal (`dry_run=true`), absent on a row that was
     * rejected, and absent on a batch that was rejected as a whole.
     *
     * After a `201`, every row carries it, and
     * `GET /v1/companies/{company_id}/customers/{customer_id}` answers `200`.
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * Identifier of the customer this row created. **Present only when the row actually
    created something**: absent in a rehearsal (`dry_run=true`), absent on a row that was
    rejected, and absent on a batch that was rejected as a whole.

    After a `201`, every row carries it, and
    `GET /v1/companies/{company_id}/customers/{customer_id}` answers `200`.
     */
    public function setCustomerId(string $customerId): self
    {
        $this->initialized['customerId'] = true;
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Customer validation status:
     * - VALID: Completely valid customer
     * - WARNING: Valid customer but with non-critical warnings
     * - ERROR: Invalid customer, cannot be processed
     * - DUPLICATE: Duplicate customer (in batch/CSV or database)
     * - NIF_INVALID: NIF not valid according to AEAT census (VeriFactu)
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Customer validation status:
    - VALID: Completely valid customer
    - WARNING: Valid customer but with non-critical warnings
    - ERROR: Invalid customer, cannot be processed
    - DUPLICATE: Duplicate customer (in batch/CSV or database)
    - NIF_INVALID: NIF not valid according to AEAT census (VeriFactu)
     */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

        return $this;
    }

    /**
     * List of errors found (block import)
     *
     * @return list<CustomerValidationError>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * List of errors found (block import)
     *
     * @param  list<CustomerValidationError>  $errors
     */
    public function setErrors(array $errors): self
    {
        $this->initialized['errors'] = true;
        $this->errors = $errors;

        return $this;
    }

    /**
     * List of warnings (do not block import)
     *
     * @return list<CustomerValidationWarning>
     */
    public function getWarnings(): array
    {
        return $this->warnings;
    }

    /**
     * List of warnings (do not block import)
     *
     * @param  list<CustomerValidationWarning>  $warnings
     */
    public function setWarnings(array $warnings): self
    {
        $this->initialized['warnings'] = true;
        $this->warnings = $warnings;

        return $this;
    }

    /**
     * Row number in the file (CSV or Excel depending on source_type)
     */
    public function getRowNumber(): ?int
    {
        return $this->rowNumber;
    }

    /**
     * Row number in the file (CSV or Excel depending on source_type)
     */
    public function setRowNumber(?int $rowNumber): self
    {
        $this->initialized['rowNumber'] = true;
        $this->rowNumber = $rowNumber;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['index' => ['index', 'getIndex', 'setIndex'], 'customer' => ['customer', 'getCustomer', 'setCustomer'], 'customerId' => ['customer_id', 'getCustomerId', 'setCustomerId'], 'status' => ['status', 'getStatus', 'setStatus'], 'errors' => ['errors', 'getErrors', 'setErrors'], 'warnings' => ['warnings', 'getWarnings', 'setWarnings'], 'rowNumber' => ['row_number', 'getRowNumber', 'setRowNumber']];
    }
}
