<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class ScheduleInvoiceBadRequestException extends BadRequestException
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
        parent::__construct('The invoice cannot be scheduled from its current status — it is already issued, voided
or scheduled (`INVOICE_STATUS_NOT_SCHEDULABLE`), the same code the canonical
`PUT /v1/companies/{company_id}/invoices/{invoice_id}/schedule` answers. A proforma is
rejected earlier, by type, with `PROFORMA_SCHEDULE_FORBIDDEN`.
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