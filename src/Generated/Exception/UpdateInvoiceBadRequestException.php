<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class UpdateInvoiceBadRequestException extends BadRequestException
{
    /**
     * @var ErrorResponse
     */
    private $errorResponse;

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ErrorResponse $errorResponse, ResponseInterface $response)
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

    public function getErrorResponse(): ErrorResponse
    {
        return $this->errorResponse;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
