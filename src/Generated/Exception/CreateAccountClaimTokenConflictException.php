<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateAccountClaimTokenConflictException extends ConflictException
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
        parent::__construct('Conflict. `PROVISIONING_ACCOUNT_CLAIMED` — the holder already took ownership, so there is nothing left to claim. `PROVISIONING_EMAIL_ALREADY_REGISTERED` — the `email` you sent belongs to another BeeL. account. `CLAIM_TOKEN_HOLDER_MISMATCH` — the account already has a holder and the `email` you sent is a different one; omit it to re-issue for the holder it already has.');
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