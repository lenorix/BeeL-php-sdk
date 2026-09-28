<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1InvoicesInvoiceIdMarkPaidPostBody implements AdditionalPropertiesInterface
{
    use AdditionalAndPatternProperties;
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * Payment date (defaults to today)
     *
     * @var \DateTime
     */
    protected $paymentDate;
    /**
     * @var PaymentInfo
     */
    protected $paymentMethod;
    /**
     * Payment date (defaults to today)
     *
     * @return \DateTime
     */
    public function getPaymentDate(): \DateTime
    {
        return $this->paymentDate;
    }
    /**
     * Payment date (defaults to today)
     *
     * @param \DateTime $paymentDate
     *
     * @return self
     */
    public function setPaymentDate(\DateTime $paymentDate): self
    {
        $this->initialized['paymentDate'] = true;
        $this->paymentDate = $paymentDate;
        return $this;
    }
    /**
     * @return PaymentInfo
     */
    public function getPaymentMethod(): PaymentInfo
    {
        return $this->paymentMethod;
    }
    /**
     * @param PaymentInfo $paymentMethod
     *
     * @return self
     */
    public function setPaymentMethod(PaymentInfo $paymentMethod): self
    {
        $this->initialized['paymentMethod'] = true;
        $this->paymentMethod = $paymentMethod;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['paymentDate' => ['payment_date', 'getPaymentDate', 'setPaymentDate'], 'paymentMethod' => ['payment_method', 'getPaymentMethod', 'setPaymentMethod']];
    }
}