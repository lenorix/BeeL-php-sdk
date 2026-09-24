<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat;
use Psr\Http\Message\ResponseInterface;

class CreateCompanyCustomerBadRequestException extends BadRequestException
{
    /**
     * @var ResponseInvalidJsonFormat
     */
    private $responseInvalidJsonFormat;

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInvalidJsonFormat $responseInvalidJsonFormat, ResponseInterface $response)
    {
        parent::__construct('Invalid JSON format — a field has a wrong type or format (e.g. invalid date, unknown enum value, malformed UUID).
The `details` object contains `field`, `invalid_value`, and optionally `expected_format` or `allowed_values`.
');
        $this->responseInvalidJsonFormat = $responseInvalidJsonFormat;
        $this->response = $response;
    }

    public function getResponseInvalidJsonFormat(): ResponseInvalidJsonFormat
    {
        return $this->responseInvalidJsonFormat;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
