<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Data implements AdditionalPropertiesInterface
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

    public function definedProperties(): array
    {
        return ['emailId' => ['email_id', 'getEmailId', 'setEmailId'], 'sentTo' => ['sent_to', 'getSentTo', 'setSentTo'], 'sentAt' => ['sent_at', 'getSentAt', 'setSentAt']];
    }
}
