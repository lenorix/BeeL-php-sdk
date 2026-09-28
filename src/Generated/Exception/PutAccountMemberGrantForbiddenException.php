<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class PutAccountMemberGrantForbiddenException extends ForbiddenException
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
        parent::__construct('Every cause listed under the plain `403` above, plus the two that govern a change to the people of an account: `MEMBER_MANAGEMENT_FORBIDDEN`, when your role in the account does not manage its members, invitations or grants (only an `OWNER` or an `ADMIN` does), and `LIVE_CREDENTIAL_REQUIRED`, when the call is made with a test API key (`beel_sk_test_…`): members, invitations and grants are shared between Test and Live, so changing them is always a real change. Use your live API key or the dashboard.');
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
