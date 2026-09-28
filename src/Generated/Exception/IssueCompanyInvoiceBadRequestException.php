<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class IssueCompanyInvoiceBadRequestException extends BadRequestException
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
        parent::__construct('Cannot issue invoice (invalid status or incomplete data).

`SERIES_NUMBER_COLLISION`: the number the series would assign is already used by another
invoice of the same company, in this series or in another one. Nothing is issued and no
number is consumed, but retrying gives the same result: the series needs review, so
contact support.
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