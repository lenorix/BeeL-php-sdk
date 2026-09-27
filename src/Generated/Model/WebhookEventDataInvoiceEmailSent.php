<?php

namespace Lenorix\BeelSdk\Generated\Model;

class WebhookEventDataInvoiceEmailSent
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * @var string
     */
    protected $invoiceId;
    /**
     * @var string|null
     */
    protected $invoiceNumber;
    /**
     * All email recipients (TO + CC).
     *
     * @var list<string>
     */
    protected $allRecipients;
    /**
     * @var \DateTime
     */
    protected $sentAt;
    /**
     * @return string
     */
    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }
    /**
     * @param string $invoiceId
     *
     * @return self
     */
    public function setInvoiceId(string $invoiceId): self
    {
        $this->initialized['invoiceId'] = true;
        $this->invoiceId = $invoiceId;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }
    /**
     * @param string|null $invoiceNumber
     *
     * @return self
     */
    public function setInvoiceNumber(?string $invoiceNumber): self
    {
        $this->initialized['invoiceNumber'] = true;
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }
    /**
     * All email recipients (TO + CC).
     *
     * @return list<string>
     */
    public function getAllRecipients(): array
    {
        return $this->allRecipients;
    }
    /**
     * All email recipients (TO + CC).
     *
     * @param list<string> $allRecipients
     *
     * @return self
     */
    public function setAllRecipients(array $allRecipients): self
    {
        $this->initialized['allRecipients'] = true;
        $this->allRecipients = $allRecipients;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getSentAt(): \DateTime
    {
        return $this->sentAt;
    }
    /**
     * @param \DateTime $sentAt
     *
     * @return self
     */
    public function setSentAt(\DateTime $sentAt): self
    {
        $this->initialized['sentAt'] = true;
        $this->sentAt = $sentAt;
        return $this;
    }
}