<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class GetAccountInvitationForbiddenException extends ForbiddenException
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
        parent::__construct('Every cause listed under the plain `403` above, plus the one that governs the people of an account: `MEMBER_MANAGEMENT_FORBIDDEN`, returned when you reach the account but your role in it does not manage its members, invitations or grants. Only an `OWNER` or an `ADMIN` does; a `MEMBER` gets this code, and so does an API key minted by one.');
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