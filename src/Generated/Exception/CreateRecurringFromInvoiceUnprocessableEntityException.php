<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateRecurringFromInvoiceUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation error. Also: `frequency` and `end_date` can each be valid on their own and still be impossible together, when the window between `start_date` and `end_date` holds no occurrence at all — a `YEARLY` template covering a calendar year, created with the year already under way, is the everyday case. The cadence and the end date come from this request, not from the source invoice, so a derivation can ask for that window just like a template created from scratch. It is rejected with `error.code` `RECURRING_NO_OCCURRENCE_IN_WINDOW`, and its `error.details` hangs off `end_date`, the field you can move; the other lever is `frequency`. It is not the same as `RECURRING_END_DATE_BEFORE_START`, which says the *next* generation of a template that already had one falls past its end: this one says there is no first invoice, and never will be. Retrying does not help — widen `end_date` or shorten `frequency`.');
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