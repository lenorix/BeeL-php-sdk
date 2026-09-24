<?php

namespace Lenorix\BeelSdk\Generated\Exception;

use Lenorix\BeelSdk\Generated\Model\PaymentRequiredResponse;
use Psr\Http\Message\ResponseInterface;

class CreateCompanyPaymentRequiredException extends PaymentRequiredException
{
    /**
     * @var PaymentRequiredResponse
     */
    private $paymentRequiredResponse;

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(PaymentRequiredResponse $paymentRequiredResponse, ResponseInterface $response)
    {
        parent::__construct('Payment required before creating a production NIF. No company is created and no
checkout is opened. Three distinct reasons, so branch on `error.code`:

* `CHECKOUT_REQUIRED` — the account has **no card on file**. Nothing is owed; billing
  simply has not been set up. It gets set up by activating a company in Live.
* `PAYMENT_REQUIRED` — the account has billing but is **past due**. The outstanding
  invoice must be settled; no new checkout is opened for it.
* `PLAN_ACTIVATION_REQUIRED` — the account is on a **fixed-quota plan still on trial**.
  Nothing is owed and the per-NIF checkout does not apply, because the quota already
  includes this NIF: the act that unblocks Live is activating the plan.
');
        $this->paymentRequiredResponse = $paymentRequiredResponse;
        $this->response = $response;
    }

    public function getPaymentRequiredResponse(): PaymentRequiredResponse
    {
        return $this->paymentRequiredResponse;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
