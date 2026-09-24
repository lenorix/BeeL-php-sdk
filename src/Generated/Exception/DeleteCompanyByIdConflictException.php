<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class DeleteCompanyByIdConflictException extends ConflictException
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
        parent::__construct('The company cannot be deleted:

- `COMPANY_ACTIVE_IN_PRODUCTION` — it is active in Live. Deactivate it in Live and
  delete it from the effective date of that deactivation.
- `COMPANY_HAS_INVOICES` — it has invoices in Live (issued, draft or proforma).
  Delete its drafts and proformas first; once it has issued, deactivate it instead.
  Invoices in Test never block the deletion.
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