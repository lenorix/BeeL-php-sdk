<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class GetCompanyInvoicePdfBadRequestException extends BadRequestException
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
        parent::__construct('`INVOICE_NOT_ISSUED_NO_PDF` — the invoice is a draft: it has no fiscal PDF and no emission is generating one. Issue it, or use `…/pdf/preview`. `INVOICE_NOT_REGISTERED_NO_PDF` — the invoice is not registered with the AEAT, so there is no QR code to print and no PDF: its registration was rejected before reaching the AEAT, or it was voided without being registered. Answered immediately.');
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
