<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateCompanyInvoiceDerivationBadRequestException extends BadRequestException
{
    /**
     * @var \Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat
     */
    private $responseInvalidJsonFormat;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat $responseInvalidJsonFormat, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('Invalid JSON format — a field has a wrong type or format (e.g. invalid date, unknown enum value, malformed UUID).
The `details` object contains `field`, `invalid_value`, and optionally `expected_format` or `allowed_values`.
');
        $this->responseInvalidJsonFormat = $responseInvalidJsonFormat;
        $this->response = $response;
    }
    public function getResponseInvalidJsonFormat(): \Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat
    {
        return $this->responseInvalidJsonFormat;
    }
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}