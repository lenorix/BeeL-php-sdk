<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class GetCompanyFiscalSummaryBadRequestException extends BadRequestException
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
        parent::__construct('The request target is malformed: a date that is not `YYYY-MM-DD`, or a range that is
not a period. A range fault names itself in `details.reason`:
- `PERIOD_INVERTED` — `start_date` is after `end_date`
- `PERIOD_TOO_LONG` — the range exceeds `details.max_days` (365)
- `PERIOD_INCOMPLETE` — only one of `start_date` / `end_date` was supplied

`details` also echoes whichever of `start_date` and `end_date` was received. These are query
parameters, so the fault is in the request target and the status is `400`, not `422`.
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
