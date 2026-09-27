<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1CustomersBulkDeleteResponse200 implements AdditionalPropertiesInterface
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
     * @var bool
     */
    protected $success;
    /**
     * Report of a bulk delete of customers, in the same shape every batch operation of this API
     * uses (ADR-0011): `metadata` (what the operation was), **one entry per identifier submitted**
     * in its original position and never filtered, and `statistics` derived by counting those
     * entries.
     * 
     * **This endpoint deletes, it does not deactivate.** A deleted customer is retained internally
     * for tax record-keeping but is no longer exposed by the API, and **its identifier is released
     * for reuse** (the unique indexes only cover rows that are not deleted). Deactivating is the
     * opposite: the customer stays where it is, marked inactive, with its NIF still taken. A
     * customer that has invoices can never be deleted — it can only be deactivated — which is why
     * it gets its own row status (`HAS_INVOICES`) instead of being reported as a failure.
     * 
     * **HTTP status:** always `200` when the request was processed, even if no row could be
     * deleted. The code says whether the request was processed, not whether every row went well;
     * the split is in this report.
     * 
     *
     * @var CustomerBulkDeleteResult
     */
    protected $data;
    /**
     * @var ResponseMeta
     */
    protected $meta;
    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }
    /**
     * @param bool $success
     *
     * @return self
     */
    public function setSuccess(bool $success): self
    {
        $this->initialized['success'] = true;
        $this->success = $success;
        return $this;
    }
    /**
     * Report of a bulk delete of customers, in the same shape every batch operation of this API
     * uses (ADR-0011): `metadata` (what the operation was), **one entry per identifier submitted**
     * in its original position and never filtered, and `statistics` derived by counting those
     * entries.
     * 
     * **This endpoint deletes, it does not deactivate.** A deleted customer is retained internally
     * for tax record-keeping but is no longer exposed by the API, and **its identifier is released
     * for reuse** (the unique indexes only cover rows that are not deleted). Deactivating is the
     * opposite: the customer stays where it is, marked inactive, with its NIF still taken. A
     * customer that has invoices can never be deleted — it can only be deactivated — which is why
     * it gets its own row status (`HAS_INVOICES`) instead of being reported as a failure.
     * 
     * **HTTP status:** always `200` when the request was processed, even if no row could be
     * deleted. The code says whether the request was processed, not whether every row went well;
     * the split is in this report.
     * 
     *
     * @return CustomerBulkDeleteResult
     */
    public function getData(): CustomerBulkDeleteResult
    {
        return $this->data;
    }
    /**
    * Report of a bulk delete of customers, in the same shape every batch operation of this API
    uses (ADR-0011): `metadata` (what the operation was), **one entry per identifier submitted**
    in its original position and never filtered, and `statistics` derived by counting those
    entries.
    
    **This endpoint deletes, it does not deactivate.** A deleted customer is retained internally
    for tax record-keeping but is no longer exposed by the API, and **its identifier is released
    for reuse** (the unique indexes only cover rows that are not deleted). Deactivating is the
    opposite: the customer stays where it is, marked inactive, with its NIF still taken. A
    customer that has invoices can never be deleted — it can only be deactivated — which is why
    it gets its own row status (`HAS_INVOICES`) instead of being reported as a failure.
    
    **HTTP status:** always `200` when the request was processed, even if no row could be
    deleted. The code says whether the request was processed, not whether every row went well;
    the split is in this report.
    
    *
    * @param CustomerBulkDeleteResult $data
    *
    * @return self
    */
    public function setData(CustomerBulkDeleteResult $data): self
    {
        $this->initialized['data'] = true;
        $this->data = $data;
        return $this;
    }
    /**
     * @return ResponseMeta
     */
    public function getMeta(): ResponseMeta
    {
        return $this->meta;
    }
    /**
     * @param ResponseMeta $meta
     *
     * @return self
     */
    public function setMeta(ResponseMeta $meta): self
    {
        $this->initialized['meta'] = true;
        $this->meta = $meta;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['success' => ['success', 'getSuccess', 'setSuccess'], 'data' => ['data', 'getData', 'setData'], 'meta' => ['meta', 'getMeta', 'setMeta']];
    }
}