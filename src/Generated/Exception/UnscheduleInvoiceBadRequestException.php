<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class UnscheduleInvoiceBadRequestException extends BadRequestException
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
        parent::__construct('The invoice is not scheduled, so there is nothing to remove (`INVOICE_NOT_SCHEDULED`).
This is what a repeated call answers, since the first one already left the invoice as a
draft: treat it as a retry of a request that landed, not as a new failure. The canonical
`DELETE /v1/companies/{company_id}/invoices/{invoice_id}/schedule` is idempotent and
answers `204` in that case.
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