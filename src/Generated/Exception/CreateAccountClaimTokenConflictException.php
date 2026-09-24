<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class CreateAccountClaimTokenConflictException extends ConflictException
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
        parent::__construct('Conflict. `PROVISIONING_ACCOUNT_CLAIMED` — the holder already took ownership, so there is nothing left to claim. `PROVISIONING_EMAIL_ALREADY_REGISTERED` — the `email` you sent belongs to another BeeL. account. `CLAIM_TOKEN_HOLDER_MISMATCH` — the account already has a holder and the `email` you sent is a different one; omit it to re-issue for the holder it already has.');
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
