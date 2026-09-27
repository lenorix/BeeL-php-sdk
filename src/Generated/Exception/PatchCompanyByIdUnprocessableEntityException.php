<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class PatchCompanyByIdUnprocessableEntityException extends UnprocessableEntityException
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

    public function getErrorResponse(): ErrorResponse
    {
        return $this->errorResponse;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
