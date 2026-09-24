<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class ListInvoicesBadRequestException extends BadRequestException
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

    public function getErrorResponse(): ErrorResponse
    {
        return $this->errorResponse;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
