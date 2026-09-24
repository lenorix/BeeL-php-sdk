<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class ActivateCompanyByIdForbiddenException extends ForbiddenException
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
        parent::__construct('`ACTIVE_COMPANY_NOT_ACCESSIBLE` — your account does not own or manage this NIF, or does not hold write access over it. A NIF that does not exist answers exactly the same. `NOT_BILLING_OWNER` — switching a NIF on in Live requires being the billing subject of the account. `BILLING_MANAGED_BY_PROVIDER` — the account\'s billing is run by its provider, so the switch has to be requested from them; retrying will not help.');
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
