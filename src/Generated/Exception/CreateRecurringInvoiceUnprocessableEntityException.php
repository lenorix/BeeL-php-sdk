<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class CreateRecurringInvoiceUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation error. Separately: on a line priced by declared total (`total_excluding_tax` or `total_including_tax`) the unit price is not sent — it is derived as total ÷ quantity — so a quotient that does not fit the field storing it is rejected with `error.code` `LINE_UNIT_PRICE_OUT_OF_RANGE` and an `error.details` that follows `LineUnitPriceOutOfRangeDetails`: `field` names the offending line (`lines[0]`), not a `unit_price` you never sent, while `max` and `derived_unit_price` carry the limit and the quotient as JSON numbers, so they can be compared without parsing `error.message`. Also: `frequency` and `end_date` can each be valid on their own and still be impossible together, when the window between `start_date` and `end_date` holds no occurrence at all — a `YEARLY` template covering a calendar year, created with the year already under way, is the everyday case. That is rejected with `error.code` `RECURRING_NO_OCCURRENCE_IN_WINDOW`, and its `error.details` hangs off `end_date`, the field you can move; the other lever is `frequency`. It is not the same as `RECURRING_END_DATE_BEFORE_START`, which says the *next* generation of a template that already had one falls past its end: this one says there is no first invoice, and never will be. Retrying does not help — widen `end_date` or shorten `frequency`. Also: `series_id` (explicit or resolved by default) numbering against a series that is inactive is rejected with `error.code` `SERIES_INACTIVE` — no template is created. Activate the series, or send a `series_id` for one that is already active.');
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
