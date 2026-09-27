<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class PatchCompanyByIdUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation or business rule error. Two codes are specific to this operation:

- `FISCAL_IDENTITY_LIVE_ONLY` — the call came from Test on a company that is
  activated in Live and touched a field outside the six a test credential may
  write (`logo_url`, `invoice_accent_color`, `invoice_template_type`,
  `invoice_language`, `email_language`, `additional_info`). Repeat it with a live
  key; nothing was written.
- `UNPROCESSABLE_ENTITY` — the generic validation failure, with the offending
  field in `error.details`.
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