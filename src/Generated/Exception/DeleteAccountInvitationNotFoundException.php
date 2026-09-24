<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class DeleteAccountInvitationNotFoundException extends NotFoundException
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
        parent::__construct('`PENDING_INVITATION_NOT_FOUND` — no revocable invitation with that id exists in the account. Returned both when the invitation does not exist and when it exists but is not in PENDING state (state is not disclosed). It is a different code from the `INVITATION_NOT_FOUND` of `GET /v1/accounts/{account_id}/invitations/{invitation_id}`, which reads invitations in any state.');
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