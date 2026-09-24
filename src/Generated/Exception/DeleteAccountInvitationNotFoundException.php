<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class DeleteAccountInvitationNotFoundException extends NotFoundException
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
        parent::__construct('`PENDING_INVITATION_NOT_FOUND` — no revocable invitation with that id exists in the account. Returned both when the invitation does not exist and when it exists but is not in PENDING state (state is not disclosed). It is a different code from the `INVITATION_NOT_FOUND` of `GET /v1/accounts/{account_id}/invitations/{invitation_id}`, which reads invitations in any state.');
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
