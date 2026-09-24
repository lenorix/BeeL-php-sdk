<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class CreateCustomersBulkUnprocessableEntityException extends UnprocessableEntityException
{
    /**
     * @var \Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse422
     */
    private $v1CustomersBulkPostResponse422;
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    public function __construct(\Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse422 $v1CustomersBulkPostResponse422, \Psr\Http\Message\ResponseInterface $response)
    {
        parent::__construct('Validation error in one or more customers');
        $this->v1CustomersBulkPostResponse422 = $v1CustomersBulkPostResponse422;
        $this->response = $response;
    }
    public function getV1CustomersBulkPostResponse422(): \Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse422
    {
        return $this->v1CustomersBulkPostResponse422;
    }
    public function getResponse(): \Psr\Http\Message\ResponseInterface
    {
        return $this->response;
    }
}