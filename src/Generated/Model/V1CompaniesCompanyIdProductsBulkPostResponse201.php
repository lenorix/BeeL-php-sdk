<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1CompaniesCompanyIdProductsBulkPostResponse201 implements AdditionalPropertiesInterface
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
     * Report of a bulk creation of products, in the same shape every batch operation of this API
     * uses (ADR-0011): `metadata` (what the operation was), **one entry per product submitted** in
     * its original position and never filtered, and `statistics` derived by counting those
     * entries.
     *
     * **Atomicity: partial.** Valid products are created; the rest are reported row by row and the
     * batch is not rolled back. (Creating customers in bulk is all-or-nothing instead — that is a
     * deliberate choice per resource, not an inconsistency.)
     *
     * **HTTP status:** always `201` when the request was processed, even if not a single product
     * could be created. The code says whether the request was processed, not whether every row
     * went well.
     *
     *
     * @var ProductBulkCreateResult
     */
    protected $data;

    /**
     * @var ResponseMeta
     */
    protected $meta;

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): self
    {
        $this->initialized['success'] = true;
        $this->success = $success;

        return $this;
    }

    /**
     * Report of a bulk creation of products, in the same shape every batch operation of this API
     * uses (ADR-0011): `metadata` (what the operation was), **one entry per product submitted** in
     * its original position and never filtered, and `statistics` derived by counting those
     * entries.
     *
     * **Atomicity: partial.** Valid products are created; the rest are reported row by row and the
     * batch is not rolled back. (Creating customers in bulk is all-or-nothing instead — that is a
     * deliberate choice per resource, not an inconsistency.)
     *
     * **HTTP status:** always `201` when the request was processed, even if not a single product
     * could be created. The code says whether the request was processed, not whether every row
     * went well.
     */
    public function getData(): ProductBulkCreateResult
    {
        return $this->data;
    }

    /**
     * Report of a bulk creation of products, in the same shape every batch operation of this API
    uses (ADR-0011): `metadata` (what the operation was), **one entry per product submitted** in
    its original position and never filtered, and `statistics` derived by counting those
    entries.

     **Atomicity: partial.** Valid products are created; the rest are reported row by row and the
    batch is not rolled back. (Creating customers in bulk is all-or-nothing instead — that is a
    deliberate choice per resource, not an inconsistency.)

     **HTTP status:** always `201` when the request was processed, even if not a single product
    could be created. The code says whether the request was processed, not whether every row
    went well.
     */
    public function setData(ProductBulkCreateResult $data): self
    {
        $this->initialized['data'] = true;
        $this->data = $data;

        return $this;
    }

    public function getMeta(): ResponseMeta
    {
        return $this->meta;
    }

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
