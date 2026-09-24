<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CustomerBulkDeleteResult implements AdditionalPropertiesInterface
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
     * What the operation was, and whether it was a rehearsal.
     *
     * @var CustomerBulkDeleteMetadata
     */
    protected $metadata;

    /**
     * One entry per identifier submitted, in the order they were sent and never filtered: a
     * customer that was not deleted keeps its place and its `index`, so the response lines up
     * with the request.
     *
     *
     * @var list<CustomerBulkDeleteItem>
     */
    protected $customersDeletion;

    /**
     * Counters derived by counting the entries of `customers_deletion`, never accumulated while
     * processing. Each row falls into exactly one of `deleted`, `not_found`, `has_invoices` and
     * `errors`, so those four add up to `total_processed`.
     *
     *
     * @var CustomerBulkDeleteStatistics
     */
    protected $statistics;

    /**
     * IDs of the customers that were deleted.
     *
     * @var list<string>
     */
    protected $deletedIds;

    /**
     * **Deprecated alias of `deleted_ids`** — identical content. The name was wrong: this
     * operation deletes (freeing the identifier), it does not deactivate (which keeps it
     * taken). Read `deleted_ids`. It will be removed no earlier than the `Sunset` date
     * announced for the deprecated flat routes.
     *
     *
     * @deprecated
     *
     * @var list<string>
     */
    protected $deactivatedIds;

    /**
     * **Deprecated.** Same as `statistics.total_processed`.
     *
     * @deprecated
     *
     * @var int
     */
    protected $total;

    /**
     * **Deprecated.** Same as `statistics.deleted`.
     *
     * @deprecated
     *
     * @var int
     */
    protected $successful;

    /**
     * **Deprecated.** Number of submitted identifiers that were NOT deleted, for whatever
     * reason. It lumps together a customer that does not exist and one that has invoices and
     * never can be deleted — which is exactly why the per-row `status` exists. Read
     * `statistics`.
     *
     *
     * @deprecated
     *
     * @var int
     */
    protected $failed;

    /**
     * **Deprecated.** Projection of the entries of `customers_deletion` that were not deleted,
     * in the same order. Read `customers_deletion`, which also reports the rows that worked.
     *
     *
     * @deprecated
     *
     * @var list<CustomerBulkDeleteLegacyError>
     */
    protected $errors;

    /**
     * What the operation was, and whether it was a rehearsal.
     */
    public function getMetadata(): CustomerBulkDeleteMetadata
    {
        return $this->metadata;
    }

    /**
     * What the operation was, and whether it was a rehearsal.
     */
    public function setMetadata(CustomerBulkDeleteMetadata $metadata): self
    {
        $this->initialized['metadata'] = true;
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * One entry per identifier submitted, in the order they were sent and never filtered: a
     * customer that was not deleted keeps its place and its `index`, so the response lines up
     * with the request.
     *
     *
     * @return list<CustomerBulkDeleteItem>
     */
    public function getCustomersDeletion(): array
    {
        return $this->customersDeletion;
    }

    /**
     * One entry per identifier submitted, in the order they were sent and never filtered: a
    customer that was not deleted keeps its place and its `index`, so the response lines up
    with the request.

     *
     * @param  list<CustomerBulkDeleteItem>  $customersDeletion
     */
    public function setCustomersDeletion(array $customersDeletion): self
    {
        $this->initialized['customersDeletion'] = true;
        $this->customersDeletion = $customersDeletion;

        return $this;
    }

    /**
     * Counters derived by counting the entries of `customers_deletion`, never accumulated while
     * processing. Each row falls into exactly one of `deleted`, `not_found`, `has_invoices` and
     * `errors`, so those four add up to `total_processed`.
     */
    public function getStatistics(): CustomerBulkDeleteStatistics
    {
        return $this->statistics;
    }

    /**
     * Counters derived by counting the entries of `customers_deletion`, never accumulated while
    processing. Each row falls into exactly one of `deleted`, `not_found`, `has_invoices` and
    `errors`, so those four add up to `total_processed`.
     */
    public function setStatistics(CustomerBulkDeleteStatistics $statistics): self
    {
        $this->initialized['statistics'] = true;
        $this->statistics = $statistics;

        return $this;
    }

    /**
     * IDs of the customers that were deleted.
     *
     * @return list<string>
     */
    public function getDeletedIds(): array
    {
        return $this->deletedIds;
    }

    /**
     * IDs of the customers that were deleted.
     *
     * @param  list<string>  $deletedIds
     */
    public function setDeletedIds(array $deletedIds): self
    {
        $this->initialized['deletedIds'] = true;
        $this->deletedIds = $deletedIds;

        return $this;
    }

    /**
     * **Deprecated alias of `deleted_ids`** — identical content. The name was wrong: this
     * operation deletes (freeing the identifier), it does not deactivate (which keeps it
     * taken). Read `deleted_ids`. It will be removed no earlier than the `Sunset` date
     * announced for the deprecated flat routes.
     *
     *
     * @deprecated
     *
     * @return list<string>
     */
    public function getDeactivatedIds(): array
    {
        return $this->deactivatedIds;
    }

    /**
     * **Deprecated alias of `deleted_ids`** — identical content. The name was wrong: this
    operation deletes (freeing the identifier), it does not deactivate (which keeps it
    taken). Read `deleted_ids`. It will be removed no earlier than the `Sunset` date
    announced for the deprecated flat routes.

     *
     * @param  list<string>  $deactivatedIds
     *
     * @deprecated
     */
    public function setDeactivatedIds(array $deactivatedIds): self
    {
        $this->initialized['deactivatedIds'] = true;
        $this->deactivatedIds = $deactivatedIds;

        return $this;
    }

    /**
     * **Deprecated.** Same as `statistics.total_processed`.
     *
     * @deprecated
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * **Deprecated.** Same as `statistics.total_processed`.
     *
     *
     * @deprecated
     */
    public function setTotal(int $total): self
    {
        $this->initialized['total'] = true;
        $this->total = $total;

        return $this;
    }

    /**
     * **Deprecated.** Same as `statistics.deleted`.
     *
     * @deprecated
     */
    public function getSuccessful(): int
    {
        return $this->successful;
    }

    /**
     * **Deprecated.** Same as `statistics.deleted`.
     *
     *
     * @deprecated
     */
    public function setSuccessful(int $successful): self
    {
        $this->initialized['successful'] = true;
        $this->successful = $successful;

        return $this;
    }

    /**
     * **Deprecated.** Number of submitted identifiers that were NOT deleted, for whatever
     * reason. It lumps together a customer that does not exist and one that has invoices and
     * never can be deleted — which is exactly why the per-row `status` exists. Read
     * `statistics`.
     *
     *
     * @deprecated
     */
    public function getFailed(): int
    {
        return $this->failed;
    }

    /**
     * **Deprecated.** Number of submitted identifiers that were NOT deleted, for whatever
    reason. It lumps together a customer that does not exist and one that has invoices and
    never can be deleted — which is exactly why the per-row `status` exists. Read
    `statistics`.

     *
     *
     * @deprecated
     */
    public function setFailed(int $failed): self
    {
        $this->initialized['failed'] = true;
        $this->failed = $failed;

        return $this;
    }

    /**
     * **Deprecated.** Projection of the entries of `customers_deletion` that were not deleted,
     * in the same order. Read `customers_deletion`, which also reports the rows that worked.
     *
     *
     * @deprecated
     *
     * @return list<CustomerBulkDeleteLegacyError>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * **Deprecated.** Projection of the entries of `customers_deletion` that were not deleted,
    in the same order. Read `customers_deletion`, which also reports the rows that worked.

     *
     * @param  list<CustomerBulkDeleteLegacyError>  $errors
     *
     * @deprecated
     */
    public function setErrors(array $errors): self
    {
        $this->initialized['errors'] = true;
        $this->errors = $errors;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['metadata' => ['metadata', 'getMetadata', 'setMetadata'], 'customersDeletion' => ['customers_deletion', 'getCustomersDeletion', 'setCustomersDeletion'], 'statistics' => ['statistics', 'getStatistics', 'setStatistics'], 'deletedIds' => ['deleted_ids', 'getDeletedIds', 'setDeletedIds'], 'deactivatedIds' => ['deactivated_ids', 'getDeactivatedIds', 'setDeactivatedIds'], 'total' => ['total', 'getTotal', 'setTotal'], 'successful' => ['successful', 'getSuccessful', 'setSuccessful'], 'failed' => ['failed', 'getFailed', 'setFailed'], 'errors' => ['errors', 'getErrors', 'setErrors']];
    }
}
