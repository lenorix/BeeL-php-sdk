<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1InvoicesInvoiceIdSendPostResponse202Data implements AdditionalPropertiesInterface
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
     * @var string|null
     */
    protected $emailId;

    /**
     * @var list<string>|null
     */
    protected $sentTo;

    /**
     * The moment this request was accepted, not the moment the email was
     * sent — it has not been sent yet. See the `202` description.
     *
     *
     * @var \DateTime|null
     */
    protected $sentAt;

    public function getEmailId(): ?string
    {
        return $this->emailId;
    }

    public function setEmailId(?string $emailId): self
    {
        $this->initialized['emailId'] = true;
        $this->emailId = $emailId;

        return $this;
    }

    /**
     * @return list<string>|null
     */
    public function getSentTo(): ?array
    {
        return $this->sentTo;
    }

    /**
     * @param  list<string>|null  $sentTo
     */
    public function setSentTo(?array $sentTo): self
    {
        $this->initialized['sentTo'] = true;
        $this->sentTo = $sentTo;

        return $this;
    }

    /**
     * The moment this request was accepted, not the moment the email was
     * sent — it has not been sent yet. See the `202` description.
     */
    public function getSentAt(): ?\DateTime
    {
        return $this->sentAt;
    }

    /**
     * The moment this request was accepted, not the moment the email was
    sent — it has not been sent yet. See the `202` description.
     */
    public function setSentAt(?\DateTime $sentAt): self
    {
        $this->initialized['sentAt'] = true;
        $this->sentAt = $sentAt;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['emailId' => ['email_id', 'getEmailId', 'setEmailId'], 'sentTo' => ['sent_to', 'getSentTo', 'setSentTo'], 'sentAt' => ['sent_at', 'getSentAt', 'setSentAt']];
    }
}
