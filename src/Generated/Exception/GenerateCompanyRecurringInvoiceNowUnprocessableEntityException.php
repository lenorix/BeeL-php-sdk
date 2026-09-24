<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class GenerateCompanyRecurringInvoiceNowUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('The template cannot generate right now, or the company/NIF is not ready to issue in this environment (`error.code` `EMISSION_NOT_READY`). When the template\'s `start_date` is still in the future, `error.code` is `RECURRING_NOT_STARTED`: there is no occurrence to bring forward yet, nothing is created and `next_generation` does not move. To bill before that date, create a normal invoice.');
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
