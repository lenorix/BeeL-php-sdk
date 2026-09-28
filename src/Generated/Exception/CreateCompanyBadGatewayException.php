<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateCompanyBadGatewayException extends BadGatewayException
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
        parent::__construct('`EXTERNAL_SERVICE_ERROR` — the AEAT census could not be reached to validate the NIF. The company was not created. Nothing was
stored. It is transient; repeat
the same request later (with the same `Idempotency-Key` if you sent one). No
`Retry-After` header is sent.
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