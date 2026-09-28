<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class GenerateCompanyPaymentEventDraftUnprocessableEntityException extends UnprocessableEntityException
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
        parent::__construct('Invoicing rules rejected the draft (`EVENT_DRAFT_NOT_POSSIBLE`, with the pipeline
reason as message argument), for example a payment in a currency other than EUR. A
payment over 3,000 € without the customer\'s tax data does produce a draft: a
`STANDARD` invoice whose recipient you complete before issuing it.
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