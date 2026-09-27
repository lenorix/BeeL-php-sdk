<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateRecurringInvoiceBadRequestException extends BadRequestException
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
        parent::__construct('A line whose `exemption_reason` requires the recipient to carry a specific alternate identifier type (today, `EXENTA_ART_25` needs `NIF_IVA`) is rejected with `error.code` `EXEMPTION_REQUIRES_RECIPIENT_ID_TYPE` when the customer referenced by `customer_id` does not carry it. No template is created — the same rejection `POST /v1/invoices` gives for the same case, brought forward to the write instead of every generated invoice bouncing at the AEAT.');
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