<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class ListCompanyPaymentEventsUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('The request cannot be answered as written:

- `EVENT_FILTER_RANGE_INVALID`: a range came inverted — `min_amount` above
  `max_amount`, or `from` after `to`. Both ends are inclusive, so equal values are
  fine. The range is rejected rather than applied because an inverted one matches
  nothing, and an empty list would be indistinguishable from having no events.
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