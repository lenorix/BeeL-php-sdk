<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateCompanyCustomerUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('The body parses but is not acceptable. `VALIDATION_ERROR` when a property breaks a constraint (`details` maps each offending property to a message). A Spanish NIF is also checked against the AEAT census: `NIF_NOT_IN_CENSUS` when the NIF does not exist there or, for a natural person, `legal_name` does not match the name the census holds (no `details`). For a company the census identifies the holder by its CIF alone, so the name is not verified. A NIF that is malformed answers `NIF_INVALID_FORMAT` or `NIF_INVALID_CONTROL_DIGIT`.');
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