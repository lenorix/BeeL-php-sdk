<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class ProvisionAccountConflictException extends ConflictException
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
        parent::__construct('Conflict. Returned when the email is already used by an existing BeeL. account that this request can neither reuse idempotently (same `external_ref`) nor reactivate. Two distinct cases:

- `PROVISIONING_ACCOUNT_CLAIMED` — you did manage this account and ended it, but its holder has already claimed it. It is theirs now: ask them to grant you access from their account. Provisioning cannot take it back.
- `PROVISIONING_EMAIL_ALREADY_REGISTERED` — the email belongs to an account you never managed, one someone else manages, or one whose management someone else ended. Use a different email or contact support.');
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