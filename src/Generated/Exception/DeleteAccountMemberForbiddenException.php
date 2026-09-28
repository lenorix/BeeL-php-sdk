<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class DeleteAccountMemberForbiddenException extends ForbiddenException
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
        parent::__construct('Every cause listed under the plain `403` above, plus the three that govern a change to a member: `MEMBER_MANAGEMENT_FORBIDDEN`, when your role in the account does not manage its members (only an `OWNER` or an `ADMIN` does); `OWNER_ROLE_RESERVED`, when the member you act on is an `OWNER` and you are not one, since an `ADMIN` manages members but not owners; and `LIVE_CREDENTIAL_REQUIRED`, when the call is made with a test API key (`beel_sk_test_…`).');
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