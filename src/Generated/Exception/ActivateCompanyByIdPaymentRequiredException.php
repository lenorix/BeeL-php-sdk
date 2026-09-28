<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

class ActivateCompanyByIdPaymentRequiredException extends PaymentRequiredException
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
        parent::__construct('Switching on in Live requires payment. `CHECKOUT_REQUIRED` means there is no card on file yet; `error.details.checkout_url` carries the checkout when `success_url` and `cancel_url` were supplied. `PAYMENT_REQUIRED` means billing exists but is past due, and the outstanding invoice has to be settled first.');
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
