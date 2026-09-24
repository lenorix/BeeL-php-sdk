<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class PatchAccountMemberUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation error. `error.code` is `OWNER_ROLE_NOT_ASSIGNABLE` (`account_role` was `OWNER`; use `PUT /v1/accounts/{account_id}/owner` instead — returned to every caller, owners included, and also when the member already is the owner) or `LAST_OWNER_PROTECTED` (the change would demote the account\'s only owner).');
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
