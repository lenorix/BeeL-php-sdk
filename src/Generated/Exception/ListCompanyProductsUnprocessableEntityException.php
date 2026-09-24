<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class ListCompanyProductsUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('A parameter parsed as its declared type but its value is not one the operation admits:
a `limit` under the minimum, a `cursor` that is not one this API issued, more keys than
the `metadata` filter accepts, a value outside the supported set. The query was rejected
whole and nothing was read.

Where a `400` says the target could not be understood, this says it was understood and
refused. Fix the value — retrying the same query answers the same way.
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
