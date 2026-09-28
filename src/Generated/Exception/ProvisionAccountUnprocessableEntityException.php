<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class ProvisionAccountUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation error. Specific to this operation:

- `PROVISIONING_TAX_PROFILE_REQUIRED` — `access_level` is `OPERATE` and there is no
  `tax_profile`: invoicing on the account\'s behalf needs its NIF, so it is refused here rather
  than at the first invoice.
- `PROVISIONING_EMAIL_REQUIRED` — `send_email` is `true` and there is no `email` to send the
  claim link to.

Any other field failure answers `VALIDATION_ERROR`, with the offending field in `error.details`.
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
