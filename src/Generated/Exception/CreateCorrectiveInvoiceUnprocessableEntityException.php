<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateCorrectiveInvoiceUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Original invoice cannot be rectified (invalid status) — `error.code` is `INVOICE_NOT_CORRECTIBLE_IN_CURRENT_STATUS`. This is also what a **second TOTAL corrective** gets: the first one left the original `VOIDED`, and a `VOIDED` invoice is not rectifiable. There is no dedicated `409` for it; to retry the same call safely, send an `Idempotency-Key`. Or the company/NIF is not ready to issue in this environment — `error.code` is `EMISSION_NOT_READY` and `error.details.blockers[]` lists the reasons (`PROFILE_INCOMPLETE`, `COMPANY_NOT_ACTIVATED`, `ENV_MISMATCH`, `NIF_NOT_REGISTERED`, `NIF_REPRESENTATION_REQUIRED` — the last one only in production, where the operation reaches the real tax authority); when a blocker is `PROFILE_INCOMPLETE`, `error.details.missing_fields[]` names which fields of the company\'s fiscal identity are still missing (`entity_type`, `legal_name`, `address`) — the same tokens the profile endpoints use. Or the explicit `series_id` is a series of the wrong type — `error.code` is `SERIES_INCOMPATIBLE_DOC_TYPE` and `error.details.expected_document_type` says which type was required; or — when `series_id` is omitted — the company has no default series compatible with corrective invoices (`error.code` is `SERIES_DEFAULT_NOT_FOUND`, with `error.details.expected_document_type` and the endpoint that diagnoses it). That last one is an account configuration problem, not a request problem: create the corrective series, or send an explicit `series_id`. Separately: on a line priced by declared total (`total_excluding_tax` or `total_including_tax`) the unit price is not sent — it is derived as total ÷ quantity — so a quotient that does not fit the field storing it is rejected with `error.code` `LINE_UNIT_PRICE_OUT_OF_RANGE` and an `error.details` that follows `LineUnitPriceOutOfRangeDetails`: `field` names the offending line (`lines[0]`), not a `unit_price` you never sent, while `max` and `derived_unit_price` carry the limit and the quotient as JSON numbers, so they can be compared without parsing `error.message`.');
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