<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class PatchAccountMemberUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation error. `error.code` is `OWNER_ROLE_NOT_ASSIGNABLE` (`account_role` was `OWNER`; use `PUT /v1/accounts/{account_id}/owner` instead — returned to every caller, owners included, and also when the member already is the owner) or `LAST_OWNER_PROTECTED` (the change would demote the account\'s only owner).');
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