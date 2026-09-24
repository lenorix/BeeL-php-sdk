<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse422;
use Psr\Http\Message\ResponseInterface;

class CreateCustomersBulkUnprocessableEntityException extends UnprocessableEntityException
{
    /**
     * @var V1CustomersBulkPostResponse422
     */
    private $v1CustomersBulkPostResponse422;

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(V1CustomersBulkPostResponse422 $v1CustomersBulkPostResponse422, ResponseInterface $response)
    {
        parent::__construct('Validation error in one or more customers');
        $this->v1CustomersBulkPostResponse422 = $v1CustomersBulkPostResponse422;
        $this->response = $response;
    }

    public function getV1CustomersBulkPostResponse422(): V1CustomersBulkPostResponse422
    {
        return $this->v1CustomersBulkPostResponse422;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
