<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class SetInvoiceScheduleRequest implements AdditionalPropertiesInterface
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
     * Date on which the invoice should be processed. Today or later.
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
    protected $generationMode;

    /**
     * Date on which the invoice should be processed. Today or later.
     */
    public function getScheduledFor(): \DateTime
    {
        return $this->scheduledFor;
    }

    /**
     * Date on which the invoice should be processed. Today or later.
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
    public function getGenerationMode(): string
    {
        return $this->generationMode;
    }

    /**
     * Action to perform when processing a scheduled invoice:
    - DRAFT: Create as draft for manual review
    - ISSUE_AND_SEND: Issue and send automatically via email
     */
    public function setGenerationMode(string $generationMode): self
    {
        $this->initialized['generationMode'] = true;
        $this->generationMode = $generationMode;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['scheduledFor' => ['scheduled_for', 'getScheduledFor', 'setScheduledFor'], 'generationMode' => ['generation_mode', 'getGenerationMode', 'setGenerationMode']];
    }
}
