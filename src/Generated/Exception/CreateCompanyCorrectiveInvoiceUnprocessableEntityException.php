<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class CreateCompanyCorrectiveInvoiceUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation error, or the company/NIF is not ready to issue in this environment (`error.code` `EMISSION_NOT_READY`). A `PARTIAL` corrective whose lines leave a fiscal figure undeclared also lands here when the original invoice is ambiguous: `CORRECTIVE_ORIGINAL_MIXED_IRPF` (different IRPF rates per line) and `CORRECTIVE_ORIGINAL_MIXED_SURCHARGE` (equivalence surcharge on some lines only). Separately: on a line priced by declared total (`total_excluding_tax` or `total_including_tax`) the unit price is not sent — it is derived as total ÷ quantity — so a quotient that does not fit the field storing it is rejected with `error.code` `LINE_UNIT_PRICE_OUT_OF_RANGE` and an `error.details` that follows `LineUnitPriceOutOfRangeDetails`: `field` names the offending line (`lines[0]`), not a `unit_price` you never sent, while `max` and `derived_unit_price` carry the limit and the quotient as JSON numbers, so they can be compared without parsing `error.message`.');
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
