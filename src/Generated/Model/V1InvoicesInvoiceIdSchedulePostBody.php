<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1InvoicesInvoiceIdSchedulePostBody implements AdditionalPropertiesInterface
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
     * Date when the invoice should be processed (must be today or future)
     *
     * @var \DateTime
     */
    protected $scheduledFor;

    /**
     * Action to perform when processing a scheduled invoice:
     * - DRAFT: Create as draft for manual review
     * - ISSUE_AND_SEND: Issue and send automatically via email
     *
     *
     * @var string
     */
    protected $action;

    /**
     * Date when the invoice should be processed (must be today or future)
     */
    public function getScheduledFor(): \DateTime
    {
        return $this->scheduledFor;
    }

    /**
     * Date when the invoice should be processed (must be today or future)
     */
    public function setScheduledFor(\DateTime $scheduledFor): self
    {
        $this->initialized['scheduledFor'] = true;
        $this->scheduledFor = $scheduledFor;

        return $this;
    }

    /**
     * Action to perform when processing a scheduled invoice:
     * - DRAFT: Create as draft for manual review
     * - ISSUE_AND_SEND: Issue and send automatically via email
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Action to perform when processing a scheduled invoice:
    - DRAFT: Create as draft for manual review
    - ISSUE_AND_SEND: Issue and send automatically via email
     */
    public function setAction(string $action): self
    {
        $this->initialized['action'] = true;
        $this->action = $action;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['scheduledFor' => ['scheduled_for', 'getScheduledFor', 'setScheduledFor'], 'action' => ['action', 'getAction', 'setAction']];
    }
}
