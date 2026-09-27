<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class V1InvoicesInvoiceIdReschedulePatchBody implements AdditionalPropertiesInterface
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
     * New date when the invoice should be processed
     *
     * @var \DateTime
     */
    protected $scheduledFor;
    /**
     * New date when the invoice should be processed
     *
     * @return \DateTime
     */
    public function getScheduledFor(): \DateTime
    {
        return $this->scheduledFor;
    }
    /**
     * New date when the invoice should be processed
     *
     * @param \DateTime $scheduledFor
     *
     * @return self
     */
    public function setScheduledFor(\DateTime $scheduledFor): self
    {
        $this->initialized['scheduledFor'] = true;
        $this->scheduledFor = $scheduledFor;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['scheduledFor' => ['scheduled_for', 'getScheduledFor', 'setScheduledFor']];
    }
}