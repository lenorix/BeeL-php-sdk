<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class ProvisionAccountBadGatewayException extends BadGatewayException
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
        parent::__construct('`EXTERNAL_SERVICE_ERROR` — the AEAT census could not be reached to validate the NIF. Only happens when the request carries a `tax_profile`; the account was not created. Nothing was
stored. It is transient; repeat
the same request later (with the same `Idempotency-Key` if you sent one). No
`Retry-After` header is sent.
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
