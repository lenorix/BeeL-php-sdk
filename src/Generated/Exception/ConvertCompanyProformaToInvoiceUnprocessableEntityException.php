<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class ConvertCompanyProformaToInvoiceUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('The document is not a proforma (`error.code` `CONVERSION_REQUIRES_PROFORMA`), or its status does not allow conversion (`PROFORMA_NOT_CONVERTIBLE`), or another validation error, or the company/NIF is not ready to issue in this environment (`EMISSION_NOT_READY`).');
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