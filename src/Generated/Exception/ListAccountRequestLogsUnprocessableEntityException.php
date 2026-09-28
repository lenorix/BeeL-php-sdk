<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class ListAccountRequestLogsUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('The query was understood and refused. `error.code` is `REQUEST_LOG_INVALID_CURSOR` when `cursor` is not a cursor this API issued, or `VALIDATION_ERROR` when another query parameter falls outside its declared range. Send the `cursor` exactly as returned by the previous page; a hand-built or truncated value is never accepted.');
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