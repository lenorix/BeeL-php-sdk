<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class PreviewAccountImportUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('`TOO_MANY_RECORDS` — a file carries more rows than its limit. The whole file is rejected and no row is reported: an import of this weight is answered synchronously, so the cap is what keeps the request from timing out half-done.

`MISSING_REQUIRED_FIELD` naming `customers_file` — `options.apply_customers_to_own_company` was sent without the customers file it applies. Ignoring the option instead would answer `201` to a request that did none of what it asked for.');
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