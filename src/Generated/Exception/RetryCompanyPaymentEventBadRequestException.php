<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class RetryCompanyPaymentEventBadRequestException extends BadRequestException
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
        parent::__construct('The event cannot be retried: its state does not admit a retry
(`EVENT_INVALID_STATUS_FOR_RETRY`), it exhausted its retries
(`EVENT_MAX_RETRIES_EXCEEDED`), or it no longer holds the original provider payload
(`EVENT_SOURCE_PAYLOAD_UNAVAILABLE`), in which case retrying will never succeed.
');
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