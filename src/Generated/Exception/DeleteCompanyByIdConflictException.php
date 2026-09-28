<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class DeleteCompanyByIdConflictException extends ConflictException
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

    public function getErrorResponse(): ErrorResponse
    {
        return $this->errorResponse;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
