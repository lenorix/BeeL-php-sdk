<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1InvoicesInvoiceIdMarkSentPostBody implements AdditionalPropertiesInterface
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
     * Custom timestamp for when the invoice was sent.
     * If not provided, the current time will be used.
     *
     *
     * @var \DateTime
     */
    protected $sentAt;

    /**
     * Custom timestamp for when the invoice was sent.
     * If not provided, the current time will be used.
     */
    public function getSentAt(): \DateTime
    {
        return $this->sentAt;
    }

    /**
     * Custom timestamp for when the invoice was sent.
    If not provided, the current time will be used.
     */
    public function setSentAt(\DateTime $sentAt): self
    {
        $this->initialized['sentAt'] = true;
        $this->sentAt = $sentAt;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['sentAt' => ['sent_at', 'getSentAt', 'setSentAt']];
    }
}
