<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data implements AdditionalPropertiesInterface
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
     * Universally Unique Identifier (UUID v4)
     *
     * @var string
     */
    protected $emailId;

    /**
     * @var list<string>
     */
    protected $sentTo;

    /**
     * @var \DateTime
     */
    protected $sentAt;

    /**
     * Total number of requested invoices
     *
     * @var int
     */
    protected $totalInvoices;

    /**
     * Number of PDFs successfully attached
     *
     * @var int
     */
    protected $invoicesAttached;

    /**
     * List of invoices that could not be attached
     *
     * @var list<V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataFailuresItem>
     */
    protected $failures;

    /**
     * Universally Unique Identifier (UUID v4)
     */
    public function getEmailId(): string
    {
        return $this->emailId;
    }

    /**
     * Universally Unique Identifier (UUID v4)
     */
    public function setEmailId(string $emailId): self
    {
        $this->initialized['emailId'] = true;
        $this->emailId = $emailId;

        return $this;
    }

    /**
     * @return list<string>
     */
    public function getSentTo(): array
    {
        return $this->sentTo;
    }

    /**
     * @param  list<string>  $sentTo
     */
    public function setSentTo(array $sentTo): self
    {
        $this->initialized['sentTo'] = true;
        $this->sentTo = $sentTo;

        return $this;
    }

    public function getSentAt(): \DateTime
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTime $sentAt): self
    {
        $this->initialized['sentAt'] = true;
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * Total number of requested invoices
     */
    public function getTotalInvoices(): int
    {
        return $this->totalInvoices;
    }

    /**
     * Total number of requested invoices
     */
    public function setTotalInvoices(int $totalInvoices): self
    {
        $this->initialized['totalInvoices'] = true;
        $this->totalInvoices = $totalInvoices;

        return $this;
    }

    /**
     * Number of PDFs successfully attached
     */
    public function getInvoicesAttached(): int
    {
        return $this->invoicesAttached;
    }

    /**
     * Number of PDFs successfully attached
     */
    public function setInvoicesAttached(int $invoicesAttached): self
    {
        $this->initialized['invoicesAttached'] = true;
        $this->invoicesAttached = $invoicesAttached;

        return $this;
    }

    /**
     * List of invoices that could not be attached
     *
     * @return list<V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataFailuresItem>
     */
    public function getFailures(): array
    {
        return $this->failures;
    }

    /**
     * List of invoices that could not be attached
     *
     * @param  list<V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200DataFailuresItem>  $failures
     */
    public function setFailures(array $failures): self
    {
        $this->initialized['failures'] = true;
        $this->failures = $failures;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['emailId' => ['email_id', 'getEmailId', 'setEmailId'], 'sentTo' => ['sent_to', 'getSentTo', 'setSentTo'], 'sentAt' => ['sent_at', 'getSentAt', 'setSentAt'], 'totalInvoices' => ['total_invoices', 'getTotalInvoices', 'setTotalInvoices'], 'invoicesAttached' => ['invoices_attached', 'getInvoicesAttached', 'setInvoicesAttached'], 'failures' => ['failures', 'getFailures', 'setFailures']];
    }
}
