<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class GetAccountUsageNotFoundException extends NotFoundException
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
        parent::__construct('`PROVISIONING_ACCOUNT_NOT_ACCESSIBLE` — the `account_id` is not your own account. Unlike `GET /v1/accounts/{account_id}`, which answers this case with `403`, this operation answers `404`; both carry the same `error.code`, so branch on it rather than on the status.');
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