<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class CreateAccountInvitationUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation error. `error.code` is `OWNER_ROLE_NOT_ASSIGNABLE` (`account_role` was `OWNER`; returned to every caller, owners included), `GRANTS_ONLY_FOR_MEMBER` (grants provided with `account_role` other than `MEMBER`) or `GRANT_COMPANY_NOT_IN_ACCOUNT` (a grant\'s company does not belong to the account).');
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
