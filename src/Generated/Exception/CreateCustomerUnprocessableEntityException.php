<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class CreateCustomerUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('The body parses but is not acceptable. `VALIDATION_ERROR` when a property breaks a constraint (`details` maps each offending property to a message). A Spanish NIF is also checked against the AEAT census: `NIF_NOT_IN_CENSUS` when the NIF does not exist there or, for a natural person, `legal_name` does not match the name the census holds (no `details`). For a company the census identifies the holder by its CIF alone, so the name is not verified. A NIF that is malformed answers `NIF_INVALID_FORMAT` or `NIF_INVALID_CONTROL_DIGIT`.');
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
