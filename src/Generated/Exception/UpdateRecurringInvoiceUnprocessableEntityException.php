<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class UpdateRecurringInvoiceUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation error. Separately: on a line priced by declared total (`total_excluding_tax` or `total_including_tax`) the unit price is not sent — it is derived as total ÷ quantity — so a quotient that does not fit the field storing it is rejected with `error.code` `LINE_UNIT_PRICE_OUT_OF_RANGE` and an `error.details` that follows `LineUnitPriceOutOfRangeDetails`: `field` names the offending line (`lines[0]`), not a `unit_price` you never sent, while `max` and `derived_unit_price` carry the limit and the quotient as JSON numbers, so they can be compared without parsing `error.message`. Also: changing `frequency` is checked against the window. If the new cadence leaves no occurrence at all between `start_date` and `end_date`, the update is rejected with `error.code` `RECURRING_NO_OCCURRENCE_IN_WINDOW`, whose `error.details` hangs off `end_date` — the field you can move; the other lever is `frequency` itself. Nothing is written, so the template keeps the cadence and the `next_generation` it had. Shortening `end_date` without touching `frequency` is a different case and not this check: that still answers `RECURRING_END_DATE_BEFORE_START` when the end falls before the next generation.');
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