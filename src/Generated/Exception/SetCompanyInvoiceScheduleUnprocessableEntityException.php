<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class SetCompanyInvoiceScheduleUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation error. A missing `generation_mode` is rejected here: there is no default,
because silently falling back to `DRAFT` would downgrade an `ISSUE_AND_SEND` and the
invoice would never be issued. `SCHEDULED_DATE_IN_PAST` when `scheduled_for` is before
today, with the rejected value in `error.details.scheduled_for`.
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
