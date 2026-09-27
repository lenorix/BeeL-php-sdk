<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class PutAccountOwnerForbiddenException extends ForbiddenException
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
        parent::__construct('Every cause listed under the plain `403` above, plus the one that governs this operation: `OPERATION_REQUIRES_SESSION` — "This operation is only available from the web session; it cannot be performed with an API key or OAuth." It is returned to **every** machine credential, live key included, whatever scopes it holds, and before any other check, so it is not a permission you can be granted and retrying with a different key never helps. The operation is reserved to a signed-in human in the dashboard because a leaked key must not be able to take an account over.');
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