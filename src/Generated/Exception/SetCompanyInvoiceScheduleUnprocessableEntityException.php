<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class SetCompanyInvoiceScheduleUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Validation error. A missing `generation_mode` is rejected here: there is no default,
because silently falling back to `DRAFT` would downgrade an `ISSUE_AND_SEND` and the
invoice would never be issued. `SCHEDULED_DATE_IN_PAST` when `scheduled_for` is before
today, with the rejected value in `error.details.scheduled_for`.
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