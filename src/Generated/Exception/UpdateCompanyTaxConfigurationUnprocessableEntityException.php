<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class UpdateCompanyTaxConfigurationUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('`VALIDATION_ERROR` — the body parses but a value is not acceptable. `details` is a flat map from
the offending property\'s name (in the contract\'s `snake_case`, nested paths joined with a dot,
e.g. `recipient.address.postal_code`) to a message describing what is wrong with it, one entry
per property. When the rejected value is one outside an enum\'s vocabulary, `details` instead
follows `FieldDeserializationError` (`field`, `invalid_value`, `allowed_values`).
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
