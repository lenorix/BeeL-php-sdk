<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateInvoiceUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation error, or (when creating and issuing directly) the company/NIF is not ready to issue in this environment. In the latter case `error.code` is `EMISSION_NOT_READY` and `error.details.blockers[]` lists the reasons (`PROFILE_INCOMPLETE`, `COMPANY_NOT_ACTIVATED`, `ENV_MISMATCH`, `NIF_NOT_REGISTERED`, `NIF_REPRESENTATION_REQUIRED`). When a blocker is `PROFILE_INCOMPLETE`, `error.details.missing_fields[]` names which fields of the company\'s fiscal identity are still missing (`entity_type`, `legal_name`, `address`) — the same tokens the profile endpoints use. Sandbox applies the same gate as production, except `NIF_REPRESENTATION_REQUIRED`: the signed representation is only required when the operation reaches the real tax authority. Separately: on a line priced by declared total (`total_excluding_tax` or `total_including_tax`) the unit price is not sent — it is derived as total ÷ quantity — so a quotient that does not fit the field storing it is rejected with `error.code` `LINE_UNIT_PRICE_OUT_OF_RANGE` and an `error.details` that follows `LineUnitPriceOutOfRangeDetails`: `field` names the offending line (`lines[0]`), not a `unit_price` you never sent, while `max` and `derived_unit_price` carry the limit and the quotient as JSON numbers, so they can be compared without parsing `error.message`.');
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