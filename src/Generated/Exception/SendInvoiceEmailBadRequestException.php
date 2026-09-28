<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class SendInvoiceEmailBadRequestException extends BadRequestException
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
        parent::__construct('The invoice cannot be sent: `INVOICE_DRAFT_NOT_SENDABLE` when it is not issued yet, a
draft or a scheduled invoice (issue it first), `INVOICE_NOT_REGISTERED_NO_PDF` when `attach_pdf` is `true` and the invoice has
no VeriFactu registration, so it has no PDF (the reason is in
`verifactu.error_message`).
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
