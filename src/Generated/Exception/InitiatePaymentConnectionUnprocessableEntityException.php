<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class InitiatePaymentConnectionUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation or business rule error. One code is specific to this operation:

- `PROVIDER_NOT_SUPPORTED` — `provider` is not one BeeL connects to (today, only
  `stripe`). Nothing is opened.
- `VALIDATION_ERROR` — the generic validation failure, with the offending field in
  `error.details`.
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