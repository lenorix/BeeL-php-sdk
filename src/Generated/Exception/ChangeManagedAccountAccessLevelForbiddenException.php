<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class ChangeManagedAccountAccessLevelForbiddenException extends ForbiddenException
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
        parent::__construct('Every cause listed under the plain `403`, plus `LIVE_CREDENTIAL_REQUIRED` when the call is made with a test API key (`beel_sk_test_…`), and `MANAGED_SCOPE_ELEVATION_REQUIRES_OWNER` when the request raises your access over an account its holder has already claimed: from then on only they can raise it.');
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