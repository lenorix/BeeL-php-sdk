<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class CreateAccountImportUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('`TOO_MANY_RECORDS` — a file carries more rows than its limit. The whole file is rejected and no row is reported: an import of this weight is answered synchronously, so the cap is what keeps the request from timing out half-done.

`MISSING_REQUIRED_FIELD` naming `customers_file` — `options.apply_customers_to_own_company` was sent without the customers file it applies. Ignoring the option instead would answer `201` to a request that did none of what it asked for.');
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
