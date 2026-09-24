<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class BulkOperationResultFailuresItem implements AdditionalPropertiesInterface
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
    protected $invoiceId;

    /**
     * Reason for the failure
     *
     * @var string
     */
    protected $reason;

    /**
     * Universally Unique Identifier (UUID v4)
     */
    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    /**
     * Universally Unique Identifier (UUID v4)
     */
    public function setInvoiceId(string $invoiceId): self
    {
        $this->initialized['invoiceId'] = true;
        $this->invoiceId = $invoiceId;

        return $this;
    }

    /**
     * Reason for the failure
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * Reason for the failure
     */
    public function setReason(string $reason): self
    {
        $this->initialized['reason'] = true;
        $this->reason = $reason;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['invoiceId' => ['invoice_id', 'getInvoiceId', 'setInvoiceId'], 'reason' => ['reason', 'getReason', 'setReason']];
    }
}
