<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class CreateCompanyProductsBulkUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('The **request** is wrong, so nothing was processed: a required field missing, a value of
the wrong type, an empty array, more than `maxItems`. `error.details` names the offending
field **with its index** (`products[1].main_tax.percentage`). A row that only the domain
can reject — a rate the law does not allow, a duplicate code — is NOT this: it comes back
inside the report of the `201`.
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
