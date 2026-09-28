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
        parent::__construct('Original invoice cannot be rectified (invalid status) — `error.code` is `INVOICE_NOT_CORRECTIBLE_IN_CURRENT_STATUS`. This is also what a **second TOTAL corrective** gets: the first one left the original `VOIDED`, and a `VOIDED` invoice is not rectifiable. There is no dedicated `409` for it; to retry the same call safely, send an `Idempotency-Key`. Or the company/NIF is not ready to issue in this environment — `error.code` is `EMISSION_NOT_READY` and `error.details.blockers[]` lists the reasons (`PROFILE_INCOMPLETE`, `COMPANY_NOT_ACTIVATED`, `ENV_MISMATCH`, `NIF_NOT_REGISTERED`, `NIF_REPRESENTATION_REQUIRED` — the last one only in production, where the operation reaches the real tax authority); when a blocker is `PROFILE_INCOMPLETE`, `error.details.missing_fields[]` names which fields of the company\'s fiscal identity are still missing (`entity_type`, `legal_name`, `address`) — the same tokens the profile endpoints use. Or the explicit `series_id` is a series of the wrong type — `error.code` is `SERIES_INCOMPATIBLE_DOC_TYPE` and `error.details.expected_document_type` says which type was required. When `series_id` is omitted and the company has no default corrective series, one is created on first use (code `R`, or the next free one). Separately: on a line priced by declared total (`total_excluding_tax` or `total_including_tax`) the unit price is not sent — it is derived as total ÷ quantity — so a quotient that does not fit the field storing it is rejected with `error.code` `LINE_UNIT_PRICE_OUT_OF_RANGE` and an `error.details` that follows `LineUnitPriceOutOfRangeDetails`: `field` names the offending line (`lines[0]`), not a `unit_price` you never sent, while `max` and `derived_unit_price` carry the limit and the quotient as JSON numbers, so they can be compared without parsing `error.message`. At issue time the generated number must also fit the AEAT invoice number: more than 60 characters answers `INVOICE_NUMBER_TOO_LONG`, a character outside printable ASCII or one of `"`, `\'`, `<`, `>`, `=` answers `INVOICE_NUMBER_INVALID_CHARACTERS`. In both cases the invoice is not issued and the number is not used; issue it with another series, or fix the series code or format while the series has no issued invoices, and retry. When the invoice is recorded with VeriFactu, its tax breakdown must also fit one AEAT record: lines are grouped by tax, regime key, operation type, exemption, tax rate and equivalence surcharge rate, and more than 12 different groups answers `INVOICE_TAX_BREAKDOWN_TOO_LONG`, and a tax or surcharge rate with more than two decimals answers `INVOICE_TAX_RATE_TOO_MANY_DECIMALS`. The recipient\'s `legal_name` is recorded as it is on the invoice, so with VeriFactu it must be at most 120 characters: a longer one answers `FIELD_TOO_LONG`. BeeL. builds the record it will send before numbering and checks it against AEAT\'s validations: an invoice with nothing but disbursements (`SUPLIDO` lines) is not an invoice and answers `INVOICE_REQUIRES_AT_LEAST_ONE_NORMAL_LINE`, and any other record AEAT would reject answers the specific code or `VERIFACTU_RECORD_NOT_DECLARABLE`, with the AEAT section in its message. In all these cases the invoice is not issued and the number is not used.');
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