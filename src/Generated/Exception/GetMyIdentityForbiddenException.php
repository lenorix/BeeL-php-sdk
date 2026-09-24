<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class GetMyIdentityForbiddenException extends ForbiddenException
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
        parent::__construct('The credential is genuine, but the account\'s plan does not include API access (`error.code` = `FEATURE_NOT_AVAILABLE`, `error.details.feature_code` = `api_access`). Whoami requires no scope, so for an API key this is the only refusal besides `401`: without `api_access` the key reaches no public endpoint at all, and saying so here — rather than a `401` that reads as "wrong key" — tells a health-check the credential is fine and the plan is not. Browser sessions never get this.');
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
