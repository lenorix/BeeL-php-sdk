<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class PatchSeriesBadRequestException extends BadRequestException
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
        parent::__construct('The update is rejected. Error codes: `SERIES_CODE_LOCKED_HAS_INVOICES`,
`SERIES_FORMAT_LOCKED_HAS_INVOICES`, `SERIES_RESET_LOCKED_HAS_INVOICES`,
`SERIES_INITIAL_NUMBER_LOCKED_HAS_INVOICES` (the series already consumed a
number), `DEFAULT_CANNOT_BE_UNMARKED`, `DEFAULT_CANNOT_DEACTIVATE`,
`INACTIVE_CANNOT_BE_DEFAULT`, `REFERENCED_BY_PAYMENT_CONNECTION`,
`REFERENCED_BY_RECURRING_INVOICE` (deactivating a series with a live —ACTIVE or
PAUSED— recurring invoice template using it; finish it or switch it to another
series first).
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
