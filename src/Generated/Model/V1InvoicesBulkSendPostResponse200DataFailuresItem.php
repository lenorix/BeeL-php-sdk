<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1InvoicesBulkSendPostResponse200DataFailuresItem implements AdditionalPropertiesInterface
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
     * @var string
     */
    protected $errorCode;
    /**
     * @var string
     */
    protected $errorMessage;
    /**
     * Universally Unique Identifier (UUID v4)
     *
     * @return string
     */
    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }
    /**
     * Universally Unique Identifier (UUID v4)
     *
     * @param string $invoiceId
     *
     * @return self
     */
    public function setInvoiceId(string $invoiceId): self
    {
        $this->initialized['invoiceId'] = true;
        $this->invoiceId = $invoiceId;
        return $this;
    }
    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
    /**
     * @param string $errorCode
     *
     * @return self
     */
    public function setErrorCode(string $errorCode): self
    {
        $this->initialized['errorCode'] = true;
        $this->errorCode = $errorCode;
        return $this;
    }
    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
    /**
     * @param string $errorMessage
     *
     * @return self
     */
    public function setErrorMessage(string $errorMessage): self
    {
        $this->initialized['errorMessage'] = true;
        $this->errorMessage = $errorMessage;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['invoiceId' => ['invoice_id', 'getInvoiceId', 'setInvoiceId'], 'errorCode' => ['error_code', 'getErrorCode', 'setErrorCode'], 'errorMessage' => ['error_message', 'getErrorMessage', 'setErrorMessage']];
    }
}