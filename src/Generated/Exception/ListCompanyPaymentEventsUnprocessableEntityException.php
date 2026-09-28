<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class ListCompanyPaymentEventsUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('The request cannot be answered as written:

- `EVENT_FILTER_RANGE_INVALID`: a range came inverted — `min_amount` above
  `max_amount`, or `from` after `to`. Both ends are inclusive, so equal values are
  fine. The range is rejected rather than applied because an inverted one matches
  nothing, and an empty list would be indistinguishable from having no events.
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
