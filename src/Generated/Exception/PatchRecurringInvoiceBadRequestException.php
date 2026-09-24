<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class PatchRecurringInvoiceBadRequestException extends BadRequestException
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
        parent::__construct('The update is judged on the resulting template, not only on the fields the request touches: if a line ends up with an `exemption_reason` that requires the recipient to carry a specific alternate identifier type (today, `EXENTA_ART_25` needs `NIF_IVA`) — whether `customer_id` changed in this same request or the line did — and the customer does not carry it, the update is rejected with `error.code` `EXEMPTION_REQUIRES_RECIPIENT_ID_TYPE` and nothing is written; the template keeps the customer and lines it had.');
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
