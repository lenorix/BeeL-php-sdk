<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class GetAccountMemberForbiddenException extends ForbiddenException
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
        parent::__construct('Every cause listed under the plain `403` above, plus the one that governs the people of an account: `MEMBER_MANAGEMENT_FORBIDDEN`, returned when you reach the account but your role in it does not manage its members, invitations or grants. Only an `OWNER` or an `ADMIN` does; a `MEMBER` gets this code, and so does an API key minted by one.');
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
