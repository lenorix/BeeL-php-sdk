<?php

namespace Lenorix\BeelSdk\Generated\Model;

class WebhookEventDataInvoicePdfGenerated
{
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
    protected $invoiceId;

    /**
     * Null while the document has no number yet (a proforma, a draft).
     *
     * @var string|null
     */
    protected $invoiceNumber;

    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(string $invoiceId): self
    {
        $this->initialized['invoiceId'] = true;
        $this->invoiceId = $invoiceId;

        return $this;
    }

    /**
     * Null while the document has no number yet (a proforma, a draft).
     */
    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    /**
     * Null while the document has no number yet (a proforma, a draft).
     */
    public function setInvoiceNumber(?string $invoiceNumber): self
    {
        $this->initialized['invoiceNumber'] = true;
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }
}
