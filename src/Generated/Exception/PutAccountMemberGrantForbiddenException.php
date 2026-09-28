<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class PutAccountMemberGrantForbiddenException extends ForbiddenException
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
        parent::__construct('Every cause listed under the plain `403` above, plus the two that govern a change to the people of an account: `MEMBER_MANAGEMENT_FORBIDDEN`, when your role in the account does not manage its members, invitations or grants (only an `OWNER` or an `ADMIN` does), and `LIVE_CREDENTIAL_REQUIRED`, when the call is made with a test API key (`beel_sk_test_…`): members, invitations and grants are shared between Test and Live, so changing them is always a real change. Use your live API key or the dashboard.');
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