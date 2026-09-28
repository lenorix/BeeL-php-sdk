<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateAccountWebhookSubscriptionUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('The body parses but a value is not acceptable. Branch on `error.code`:

- `VALIDATION_ERROR` — a field fails validation; `error.details` maps each offending
  property to what is wrong with it.
- `URL_MUST_BE_HTTPS` — `url` does not use `https`.
- `WEBHOOK_URL_INVALID` — `url` is not a valid absolute URL.
- `URL_TARGET_NOT_ALLOWED` — `url` points to an internal network address: a private,
  loopback or link-local range, either as a literal IP or through a host name that
  resolves to one. Use an endpoint reachable from the internet. A host name that does not
  resolve yet is accepted, and deliveries to an internal address are refused anyway.
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