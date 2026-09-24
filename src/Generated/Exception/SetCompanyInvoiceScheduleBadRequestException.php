<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class SetCompanyInvoiceScheduleBadRequestException extends BadRequestException
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
        parent::__construct('The invoice cannot be scheduled, for one of two reasons:

- `INVOICE_STATUS_NOT_SCHEDULABLE` — it is in a status that cannot be scheduled:
  already issued, voided or corrected.
- `PROFORMA_SCHEDULE_FORBIDDEN` — it is a proforma. Scheduling is not part of the
  proforma lifecycle: a proforma is not a fiscal document and issues nothing on a
  date. Convert it to an invoice first, then schedule the resulting draft.
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