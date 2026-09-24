<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class DeleteCompanySeriesBadRequestException extends BadRequestException
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
        parent::__construct('The series cannot be deleted. `error.code` says why:

- `DEFAULT_CANNOT_DELETE` — it is the default of its document type and another
  active series of that same type exists. Promote that one as default first.
- `HAS_INVOICES_CANNOT_DELETE` — it has invoices associated. Remove or discard
  those invoices first.
- `REFERENCED_BY_PAYMENT_CONNECTION` — it is configured in a payment connection.
  Point that connection at another series first.
- `REFERENCED_BY_RECURRING_INVOICE` — a live (ACTIVE or PAUSED) recurring invoice
  template uses this series. Finish it or switch it to another series first.
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
