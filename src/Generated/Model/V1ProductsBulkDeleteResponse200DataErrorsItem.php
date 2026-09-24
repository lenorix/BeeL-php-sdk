<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1ProductsBulkDeleteResponse200DataErrorsItem implements AdditionalPropertiesInterface
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
     * @var string
     */
    protected $productId;

    /**
     * @var string
     */
    protected $error;

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): self
    {
        $this->initialized['productId'] = true;
        $this->productId = $productId;

        return $this;
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function setError(string $error): self
    {
        $this->initialized['error'] = true;
        $this->error = $error;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['productId' => ['product_id', 'getProductId', 'setProductId'], 'error' => ['error', 'getError', 'setError']];
    }
}
