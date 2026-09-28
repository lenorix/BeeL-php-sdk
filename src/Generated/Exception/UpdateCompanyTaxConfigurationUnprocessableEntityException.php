<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class UpdateCompanyTaxConfigurationUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('`VALIDATION_ERROR` — the body parses but a value is not acceptable. `details` is a flat map from
the offending property\'s name (in the contract\'s `snake_case`, nested paths joined with a dot,
e.g. `recipient.address.postal_code`) to a message describing what is wrong with it, one entry
per property. When the rejected value is one outside an enum\'s vocabulary, `details` instead
follows `FieldDeserializationError` (`field`, `invalid_value`, `allowed_values`).
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