<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class PatchCompanySeriesBadRequestException extends BadRequestException
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
        parent::__construct('The update is rejected. Error codes:
- `SERIES_CODE_LOCKED_HAS_INVOICES`, `SERIES_FORMAT_LOCKED_HAS_INVOICES`,
  `SERIES_RESET_LOCKED_HAS_INVOICES`, `SERIES_INITIAL_NUMBER_LOCKED_HAS_INVOICES`
  — the series already consumed a number (`numbering_locked` is `true`)
- `DEFAULT_CANNOT_BE_UNMARKED` — `default_series: false` on the series that
  currently is the default; promote another one with
  `PUT .../series/{series_id}/default` instead
- `DEFAULT_CANNOT_DEACTIVATE` — `active: false` on the default series
- `INACTIVE_CANNOT_BE_DEFAULT` — `default_series: true` on an inactive series
- `REFERENCED_BY_PAYMENT_CONNECTION` — deactivating a series a payment
  connection is configured to use
- `REFERENCED_BY_RECURRING_INVOICE` — deactivating a series with a live
  (ACTIVE or PAUSED) recurring invoice template using it. Finish it or switch it
  to another series first
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