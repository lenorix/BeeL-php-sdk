<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class SetInvoiceStatusRequest implements AdditionalPropertiesInterface
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
     * Target status.
     *
     * - **PAID**: from `ISSUED`, `SENT` or `OVERDUE`.
     * - **SENT**: from `ISSUED`. Records `sent_at`.
     * - **ISSUED**: from `SENT` only. Clears `sent_at`. Use it to undo a `SENT` set by
     *   mistake; it never un-issues an invoice, which is irreversible.
     *
     *
     * @var string
     */
    protected $status;

    /**
     * Payment date. Only read when `status` is `PAID`; defaults to today.
     *
     * @var \DateTime
     */
    protected $paymentDate;

    /**
     * Payment details object. Only read when `status` is `PAID`. Example:
     * `{ "method": "BANK_TRANSFER", "iban": "ES9121000418450200051332" }`
     *
     *
     * @var SetInvoiceStatusRequestPaymentMethod
     */
    protected $paymentMethod;

    /**
     * Timestamp for when the invoice was sent. Only read when `status` is `SENT`;
     * defaults to now.
     *
     *
     * @var \DateTime
     */
    protected $sentAt;

    /**
     * Target status.
     *
     * - **PAID**: from `ISSUED`, `SENT` or `OVERDUE`.
     * - **SENT**: from `ISSUED`. Records `sent_at`.
     * - **ISSUED**: from `SENT` only. Clears `sent_at`. Use it to undo a `SENT` set by
     *   mistake; it never un-issues an invoice, which is irreversible.
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Target status.

    - **PAID**: from `ISSUED`, `SENT` or `OVERDUE`.
    - **SENT**: from `ISSUED`. Records `sent_at`.
    - **ISSUED**: from `SENT` only. Clears `sent_at`. Use it to undo a `SENT` set by
     mistake; it never un-issues an invoice, which is irreversible.
     */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

        return $this;
    }

    /**
     * Payment date. Only read when `status` is `PAID`; defaults to today.
     */
    public function getPaymentDate(): \DateTime
    {
        return $this->paymentDate;
    }

    /**
     * Payment date. Only read when `status` is `PAID`; defaults to today.
     */
    public function setPaymentDate(\DateTime $paymentDate): self
    {
        $this->initialized['paymentDate'] = true;
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /**
     * Payment details object. Only read when `status` is `PAID`. Example:
     * `{ "method": "BANK_TRANSFER", "iban": "ES9121000418450200051332" }`
     */
    public function getPaymentMethod(): SetInvoiceStatusRequestPaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * Payment details object. Only read when `status` is `PAID`. Example:
    `{ "method": "BANK_TRANSFER", "iban": "ES9121000418450200051332" }`
     */
    public function setPaymentMethod(SetInvoiceStatusRequestPaymentMethod $paymentMethod): self
    {
        $this->initialized['paymentMethod'] = true;
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Timestamp for when the invoice was sent. Only read when `status` is `SENT`;
     * defaults to now.
     */
    public function getSentAt(): \DateTime
    {
        return $this->sentAt;
    }

    /**
     * Timestamp for when the invoice was sent. Only read when `status` is `SENT`;
    defaults to now.
     */
    public function setSentAt(\DateTime $sentAt): self
    {
        $this->initialized['sentAt'] = true;
        $this->sentAt = $sentAt;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['status' => ['status', 'getStatus', 'setStatus'], 'paymentDate' => ['payment_date', 'getPaymentDate', 'setPaymentDate'], 'paymentMethod' => ['payment_method', 'getPaymentMethod', 'setPaymentMethod'], 'sentAt' => ['sent_at', 'getSentAt', 'setSentAt']];
    }
}
