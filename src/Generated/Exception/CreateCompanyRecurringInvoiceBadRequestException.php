<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class CreateCompanyRecurringInvoiceBadRequestException extends BadRequestException
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
        parent::__construct('A line whose `exemption_reason` requires the recipient to carry a specific alternate identifier type (today, `EXENTA_ART_25` needs `NIF_IVA`) is rejected with `error.code` `EXEMPTION_REQUIRES_RECIPIENT_ID_TYPE` when the customer referenced by `customer_id` does not carry it. No template is created — the same rejection `POST /v1/companies/{company_id}/invoices` gives for the same case, brought forward to the write instead of every generated invoice bouncing at the AEAT.');
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
