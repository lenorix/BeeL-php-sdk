<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateCompanyInvoiceBadRequestException extends BadRequestException
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
        parent::__construct('One of:
- `INVALID_JSON_FORMAT`: the body is not valid JSON, or a property has the wrong type or
  format. `details` follows `FieldDeserializationError`: `field`, `invalid_value` and, where
  there is one, `expected_format`.
- `SIMPLIFIED_INVOICE_EXCEEDS_LEGAL_LIMIT`: a `SIMPLIFIED` invoice whose total, VAT
  included, is above 3,000€. The same answer when the invoice is created and when an edit
  takes it over the cap, whether the edit changes the lines or changes `type` to
  `SIMPLIFIED`. Issue a `STANDARD` invoice with the customer identified instead.
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