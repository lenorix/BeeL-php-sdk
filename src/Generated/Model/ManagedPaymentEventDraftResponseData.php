<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ManagedPaymentEventDraftResponseData implements AdditionalPropertiesInterface
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
     * Draft invoice created from the payment event.
     *
     * @var string
     */
    protected $invoiceId;

    /**
     * Draft invoice created from the payment event.
     */
    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    /**
     * Draft invoice created from the payment event.
     */
    public function setInvoiceId(string $invoiceId): self
    {
        $this->initialized['invoiceId'] = true;
        $this->invoiceId = $invoiceId;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['invoiceId' => ['invoice_id', 'getInvoiceId', 'setInvoiceId']];
    }
}
