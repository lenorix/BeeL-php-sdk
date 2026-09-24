<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ProductBulkCreateItem implements AdditionalPropertiesInterface
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
     * Position of the product in the submitted list (0-based).
     *
     * @var int
     */
    protected $index;

    /**
     * Echo of the `code` that was submitted, so the row can be recognised without counting positions. Absent when the product carried none.
     *
     * @var string
     */
    protected $code;

    /**
     * Echo of the `name` that was submitted.
     *
     * @var string
     */
    protected $name;

    /**
     * Outcome of this row:
     * - `CREATED`: created; `product_id` carries its identifier
     * - `DUPLICATE`: a product with that code already exists
     * - `INVALID`: some field does not pass the domain's validation — a rate the law does not
     *   allow (VAT at 13%), an empty name, a negative price, an incoherent surcharge/regime
     *
     * There is no "unknown failure" value: anything the domain does not know how to report is
     * not turned into a row, it fails the request with a `500`.
     *
     *
     * @var string
     */
    protected $status;

    /**
     * Identifier of the product this row created. **Present only when the row actually created
     * something**; absent otherwise.
     *
     *
     * @var string
     */
    protected $productId;

    /**
     * Present only when the product was not created.
     *
     * @var ProductBulkCreateItemError
     */
    protected $error;

    /**
     * Position of the product in the submitted list (0-based).
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * Position of the product in the submitted list (0-based).
     */
    public function setIndex(int $index): self
    {
        $this->initialized['index'] = true;
        $this->index = $index;

        return $this;
    }

    /**
     * Echo of the `code` that was submitted, so the row can be recognised without counting positions. Absent when the product carried none.
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Echo of the `code` that was submitted, so the row can be recognised without counting positions. Absent when the product carried none.
     */
    public function setCode(string $code): self
    {
        $this->initialized['code'] = true;
        $this->code = $code;

        return $this;
    }

    /**
     * Echo of the `name` that was submitted.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Echo of the `name` that was submitted.
     */
    public function setName(string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;

        return $this;
    }

    /**
     * Outcome of this row:
     * - `CREATED`: created; `product_id` carries its identifier
     * - `DUPLICATE`: a product with that code already exists
     * - `INVALID`: some field does not pass the domain's validation — a rate the law does not
     *   allow (VAT at 13%), an empty name, a negative price, an incoherent surcharge/regime
     *
     * There is no "unknown failure" value: anything the domain does not know how to report is
     * not turned into a row, it fails the request with a `500`.
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Outcome of this row:
    - `CREATED`: created; `product_id` carries its identifier
    - `DUPLICATE`: a product with that code already exists
    - `INVALID`: some field does not pass the domain's validation — a rate the law does not
     allow (VAT at 13%), an empty name, a negative price, an incoherent surcharge/regime

    There is no "unknown failure" value: anything the domain does not know how to report is
    not turned into a row, it fails the request with a `500`.
     */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

        return $this;
    }

    /**
     * Identifier of the product this row created. **Present only when the row actually created
     * something**; absent otherwise.
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * Identifier of the product this row created. **Present only when the row actually created
    something**; absent otherwise.
     */
    public function setProductId(string $productId): self
    {
        $this->initialized['productId'] = true;
        $this->productId = $productId;

        return $this;
    }

    /**
     * Present only when the product was not created.
     */
    public function getError(): ProductBulkCreateItemError
    {
        return $this->error;
    }

    /**
     * Present only when the product was not created.
     */
    public function setError(ProductBulkCreateItemError $error): self
    {
        $this->initialized['error'] = true;
        $this->error = $error;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['index' => ['index', 'getIndex', 'setIndex'], 'code' => ['code', 'getCode', 'setCode'], 'name' => ['name', 'getName', 'setName'], 'status' => ['status', 'getStatus', 'setStatus'], 'productId' => ['product_id', 'getProductId', 'setProductId'], 'error' => ['error', 'getError', 'setError']];
    }
}
