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
        parent::__construct('Validation or business rule error. These codes are specific to this operation:

- `FISCAL_IDENTITY_LIVE_ONLY` — the call came from Test on a company that is
  activated in Live and touched a field outside the six a test credential may
  write (`logo_url`, `invoice_accent_color`, `invoice_template_type`,
  `invoice_language`, `email_language`, `additional_info`). Repeat it with a live
  key; nothing was written.
- `IMMUTABLE_NIF`, `IMMUTABLE_ENTITY_TYPE`, `IMMUTABLE_LEGAL_FORM` — the request
  changes `nif`, `entity_type` or `legal_form`, which cannot change once set. Nothing
  was written; drop the field from the request.
- `NIF_CENSUS_MISMATCH`, `NIF_DE_BAJA`, `NIF_REVOCADO` — the request changes
  `legal_name` and the AEAT census re-validation rejects it: the census does not
  recognise the NIF (for an `INDIVIDUAL`, with that name; for a legal entity the name is
  not verified, only the NIF), or the NIF is deregistered or revoked. Nothing was
  written.
- `POSTAL_CODE_INVALID_ES` — a Spanish postal code in `address` or in
  `legal_representative.address` does not have 5 digits. Nothing was written.
- `SWIFT_INVALID` — `default_swift` is not a SWIFT/BIC of 8 or 11 characters.
  Nothing was written.
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
