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
     * @var string|null
     */
    protected $emailId;
    /**
     * @var list<string>|null
     */
    protected $sentTo;
    /**
     * @var \DateTime|null
     */
    protected $sentAt;
    /**
     * @return string|null
     */
    public function getEmailId(): ?string
    {
        return $this->emailId;
    }
    /**
     * @param string|null $emailId
     *
     * @return self
     */
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
     * @param list<string>|null $sentTo
     *
     * @return self
     */
    public function setSentTo(?array $sentTo): self
    {
        $this->initialized['sentTo'] = true;
        $this->sentTo = $sentTo;
        return $this;
    }
    /**
     * @return \DateTime|null
     */
    public function getSentAt(): ?\DateTime
    {
        return $this->sentAt;
    }
    /**
     * @param \DateTime|null $sentAt
     *
     * @return self
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