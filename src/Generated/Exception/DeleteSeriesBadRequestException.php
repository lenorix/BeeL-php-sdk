<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class DeleteSeriesBadRequestException extends BadRequestException
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
    public function getErrorResponse(): \Lenorix\BeelSdk\Generated\Model\ErrorResponse
    {
        return $this->errorResponse;
    }
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}