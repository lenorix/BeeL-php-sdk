<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateProductsBulkUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('The **request** is wrong, so nothing was processed: a required field missing, a value of
the wrong type, an empty array, more than `maxItems`. `error.details` names the offending
field **with its index** (`products[1].main_tax.percentage`). A row that only the domain
can reject — a rate the law does not allow, a duplicate code — is NOT this: it comes back
inside the report of the `201`.
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