<?php

namespace Lenorix\BeelSdk\Generated\Exception;

class ActivateCompanyByIdPaymentRequiredException extends PaymentRequiredException
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
        parent::__construct('Switching on in Live requires payment. `CHECKOUT_REQUIRED` means there is no card on file yet; `error.details.checkout_url` carries the checkout when `success_url` and `cancel_url` were supplied. `PAYMENT_REQUIRED` means billing exists but is past due, and the outstanding invoice has to be settled first.');
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