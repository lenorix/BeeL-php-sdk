<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateInvoiceConflictException extends ConflictException
{
    /**
     * @var \Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    private $errorResponse;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\Lenorix\BeelSdk\Generated\Model\ErrorResponse $errorResponse, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('Conflict. One of:
- Idempotency key already processed, or duplicate invoice number.
- `INVOICE_DUPLICATE_EXTERNAL_REFERENCE`: a live invoice with the same
  `external_ref` already exists. Fetch it via
  `GET /v1/invoices?external_ref=...`. Deleting it lets you recreate.
');
        $this->errorResponse = $errorResponse;
        $this->response = $response;
    }
    public function getErrorResponse(): \Lenorix\BeelSdk\Generated\Model\ErrorResponse
    {
        return $this->errorResponse;
    }
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}