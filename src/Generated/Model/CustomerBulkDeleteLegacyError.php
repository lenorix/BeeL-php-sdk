<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

/**
 * @deprecated
 */
class CustomerBulkDeleteLegacyError implements AdditionalPropertiesInterface
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
     * Universally Unique Identifier (UUID v4)
     *
     * @var string
     */
    protected $customerId;

    /**
     * Why a row was not deleted.
     *
     * @var CustomerBulkDeleteError
     */
    protected $error;

    /**
     * Universally Unique Identifier (UUID v4)
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * Universally Unique Identifier (UUID v4)
     */
    public function setCustomerId(string $customerId): self
    {
        $this->initialized['customerId'] = true;
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Why a row was not deleted.
     */
    public function getError(): CustomerBulkDeleteError
    {
        return $this->error;
    }

    /**
     * Why a row was not deleted.
     */
    public function setError(CustomerBulkDeleteError $error): self
    {
        $this->initialized['error'] = true;
        $this->error = $error;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['customerId' => ['customer_id', 'getCustomerId', 'setCustomerId'], 'error' => ['error', 'getError', 'setError']];
    }
}
