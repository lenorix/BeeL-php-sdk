<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CustomerBulkDeleteStatistics implements AdditionalPropertiesInterface
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
     * Identifiers submitted.
     *
     * @var int
     */
    protected $totalProcessed;

    /**
     * Customers deleted (their identifiers are free again).
     *
     * @var int
     */
    protected $deleted;

    /**
     * Identifiers that do not exist, or that the current company/grant cannot see.
     *
     * @var int
     */
    protected $notFound;

    /**
     * Customers that have invoices and therefore cannot be deleted. Not a failure: deactivate
     * them instead.
     *
     *
     * @var int
     */
    protected $hasInvoices;

    /**
     * Rows that failed for an unexpected reason.
     *
     * @var int
     */
    protected $errors;

    /**
     * Identifiers submitted.
     */
    public function getTotalProcessed(): int
    {
        return $this->totalProcessed;
    }

    /**
     * Identifiers submitted.
     */
    public function setTotalProcessed(int $totalProcessed): self
    {
        $this->initialized['totalProcessed'] = true;
        $this->totalProcessed = $totalProcessed;

        return $this;
    }

    /**
     * Customers deleted (their identifiers are free again).
     */
    public function getDeleted(): int
    {
        return $this->deleted;
    }

    /**
     * Customers deleted (their identifiers are free again).
     */
    public function setDeleted(int $deleted): self
    {
        $this->initialized['deleted'] = true;
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Identifiers that do not exist, or that the current company/grant cannot see.
     */
    public function getNotFound(): int
    {
        return $this->notFound;
    }

    /**
     * Identifiers that do not exist, or that the current company/grant cannot see.
     */
    public function setNotFound(int $notFound): self
    {
        $this->initialized['notFound'] = true;
        $this->notFound = $notFound;

        return $this;
    }

    /**
     * Customers that have invoices and therefore cannot be deleted. Not a failure: deactivate
     * them instead.
     */
    public function getHasInvoices(): int
    {
        return $this->hasInvoices;
    }

    /**
     * Customers that have invoices and therefore cannot be deleted. Not a failure: deactivate
    them instead.
     */
    public function setHasInvoices(int $hasInvoices): self
    {
        $this->initialized['hasInvoices'] = true;
        $this->hasInvoices = $hasInvoices;

        return $this;
    }

    /**
     * Rows that failed for an unexpected reason.
     */
    public function getErrors(): int
    {
        return $this->errors;
    }

    /**
     * Rows that failed for an unexpected reason.
     */
    public function setErrors(int $errors): self
    {
        $this->initialized['errors'] = true;
        $this->errors = $errors;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['totalProcessed' => ['total_processed', 'getTotalProcessed', 'setTotalProcessed'], 'deleted' => ['deleted', 'getDeleted', 'setDeleted'], 'notFound' => ['not_found', 'getNotFound', 'setNotFound'], 'hasInvoices' => ['has_invoices', 'getHasInvoices', 'setHasInvoices'], 'errors' => ['errors', 'getErrors', 'setErrors']];
    }
}
