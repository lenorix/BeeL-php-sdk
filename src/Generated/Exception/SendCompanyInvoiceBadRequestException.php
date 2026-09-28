<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class SendCompanyInvoiceBadRequestException extends BadRequestException
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
        parent::__construct('The invoice cannot be sent: `INVOICE_DRAFT_NOT_SENDABLE` when it is not issued yet, a
draft or a scheduled invoice (issue it first), `INVOICE_NOT_REGISTERED_NO_PDF` when `attach_pdf` is `true` and the invoice has
no VeriFactu registration, so it has no PDF (the reason is in
`verifactu.error_message`).
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