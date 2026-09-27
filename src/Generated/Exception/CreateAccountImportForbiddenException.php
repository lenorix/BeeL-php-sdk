<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class CreateAccountImportForbiddenException extends ForbiddenException
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
        parent::__construct('`FEATURE_NOT_AVAILABLE` — your account does not hold the managed-accounts capability. A credential without the `accounts:write` scope answers the same way.

With `options.apply_customers_to_own_company` there are two more, both decided before the files are read: `ACTIVE_COMPANY_REQUIRED`, when your account holds several NIFs and none is in focus — the option writes on your own company and this endpoint never picks one for you — and `INSUFFICIENT_SCOPE`, when the API key lacks `customers:write`.');
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
