<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class SetCompanyInvoiceScheduleBadRequestException extends BadRequestException
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

    public function getErrorResponse(): ErrorResponse
    {
        return $this->errorResponse;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
