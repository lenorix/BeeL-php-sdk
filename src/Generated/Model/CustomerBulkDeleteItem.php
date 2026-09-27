<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CustomerBulkDeleteItem implements AdditionalPropertiesInterface
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
     * Position of the identifier in the submitted list (0-based).
     *
     * @var int
     */
    protected $index;

    /**
     * The identifier that was submitted.
     *
     * @var string
     */
    protected $customerId;

    /**
     * Outcome of this row, in the vocabulary of deleting (deleting validates nothing
     * beforehand, so it does not speak of `VALID`):
     * - `DELETED`: deleted; its identifier is free to be used again
     * - `NOT_FOUND`: no such customer, or the current company/grant cannot see it
     * - `HAS_INVOICES`: it has invoices, so it cannot be deleted — **deactivate it instead**
     *   (`PATCH` with `active: false`). This is a business rule, not a failure: retrying the
     *   delete will never work
     * - `ERROR`: an unexpected failure while processing this row
     *
     *
     * @var string
     */
    protected $status;

    /**
     * Present only when the customer was not deleted.
     *
     * @var CustomerBulkDeleteItemError
     */
    protected $error;

    /**
     * Position of the identifier in the submitted list (0-based).
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * Position of the identifier in the submitted list (0-based).
     */
    public function setIndex(int $index): self
    {
        $this->initialized['index'] = true;
        $this->index = $index;

        return $this;
    }

    /**
     * The identifier that was submitted.
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * The identifier that was submitted.
     */
    public function setCustomerId(string $customerId): self
    {
        $this->initialized['customerId'] = true;
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Outcome of this row, in the vocabulary of deleting (deleting validates nothing
     * beforehand, so it does not speak of `VALID`):
     * - `DELETED`: deleted; its identifier is free to be used again
     * - `NOT_FOUND`: no such customer, or the current company/grant cannot see it
     * - `HAS_INVOICES`: it has invoices, so it cannot be deleted — **deactivate it instead**
     *   (`PATCH` with `active: false`). This is a business rule, not a failure: retrying the
     *   delete will never work
     * - `ERROR`: an unexpected failure while processing this row
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Outcome of this row, in the vocabulary of deleting (deleting validates nothing
    beforehand, so it does not speak of `VALID`):
    - `DELETED`: deleted; its identifier is free to be used again
    - `NOT_FOUND`: no such customer, or the current company/grant cannot see it
    - `HAS_INVOICES`: it has invoices, so it cannot be deleted — **deactivate it instead**
     (`PATCH` with `active: false`). This is a business rule, not a failure: retrying the
     delete will never work
    - `ERROR`: an unexpected failure while processing this row
     */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

        return $this;
    }

    /**
     * Present only when the customer was not deleted.
     */
    public function getError(): CustomerBulkDeleteItemError
    {
        return $this->error;
    }

    /**
     * Present only when the customer was not deleted.
     */
    public function setError(CustomerBulkDeleteItemError $error): self
    {
        $this->initialized['error'] = true;
        $this->error = $error;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['index' => ['index', 'getIndex', 'setIndex'], 'customerId' => ['customer_id', 'getCustomerId', 'setCustomerId'], 'status' => ['status', 'getStatus', 'setStatus'], 'error' => ['error', 'getError', 'setError']];
    }
}
