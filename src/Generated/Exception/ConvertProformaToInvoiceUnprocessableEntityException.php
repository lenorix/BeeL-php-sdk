<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class ConvertProformaToInvoiceUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Document is not a proforma, or its status does not allow conversion, or the company/NIF is not ready to issue in this environment. In the latter case `error.code` is `EMISSION_NOT_READY` and `error.details.blockers[]` lists the reasons (`PROFILE_INCOMPLETE`, `COMPANY_NOT_ACTIVATED`, `ENV_MISMATCH`, `NIF_NOT_REGISTERED`, `NIF_REPRESENTATION_REQUIRED`). When a blocker is `PROFILE_INCOMPLETE`, `error.details.missing_fields[]` names which fields of the company\'s fiscal identity are still missing (`entity_type`, `legal_name`, `address`) — the same tokens the profile endpoints use.');
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