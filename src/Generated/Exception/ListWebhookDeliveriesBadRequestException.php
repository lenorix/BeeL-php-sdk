<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class ListWebhookDeliveriesBadRequestException extends BadRequestException
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
        parent::__construct('The request target could not be read as declared, so nothing was looked up. Three causes,
all named in `error.details`: a path or query parameter whose value does not parse as its
type (`VALIDATION_ERROR` — a UUID that is not a UUID, an unknown enum value), a required
parameter that was not sent (`MISSING_PARAMETER`), or a header that is meant to carry an
identifier and does not (`ACTIVE_COMPANY_HEADER_INVALID`).

The fault is in the target, not in the content — which is what `422` is defined over.
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