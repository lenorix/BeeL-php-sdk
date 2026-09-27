<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class GetMyIdentityForbiddenException extends ForbiddenException
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
        parent::__construct('The credential is genuine, but the account\'s plan does not include API access (`error.code` = `FEATURE_NOT_AVAILABLE`, `error.details.feature_code` = `api_access`). Whoami requires no scope, so for an API key this is the only refusal besides `401`: without `api_access` the key reaches no public endpoint at all, and saying so here — rather than a `401` that reads as "wrong key" — tells a health-check the credential is fine and the plan is not. Browser sessions never get this.');
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