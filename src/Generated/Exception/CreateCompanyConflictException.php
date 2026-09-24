<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class CreateCompanyConflictException extends ConflictException
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
        parent::__construct('The NIF cannot be created. Two distinct reasons, so branch on `error.code`:

* `NIF_ALREADY_REGISTERED` — the NIF **already exists in your account**. Creating is
  done; switching an environment on for it is a different act and has its own endpoint:
  `POST /v1/companies/{company_id}/activations`. The existing
  company\'s id travels in `error.details.company_id`, so no lookup is needed to call it.
* `NIF_PROD_ALREADY_ACTIVE_IN_ANOTHER_ACCOUNT` — the NIF is live in **another
  account**. A NIF can only issue in production from one account (tax rule).
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
