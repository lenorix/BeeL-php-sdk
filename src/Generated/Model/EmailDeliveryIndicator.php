<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class EmailDeliveryIndicator implements AdditionalPropertiesInterface
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
     * Id of the related entity (e.g. invoice_id)
     *
     * @var string
     */
    protected $relatedEntityId;

    /**
     * Number of emails recorded for the entity, whatever their outcome
     *
     * @var int
     */
    protected $count;

    /**
     * @var string|null
     */
    protected $lastStatus;

    /**
     * Time of the last email sent for the entity
     *
     * @var \DateTime|null
     */
    protected $lastSentAt;

    /**
     * Id of the related entity (e.g. invoice_id)
     */
    public function getRelatedEntityId(): string
    {
        return $this->relatedEntityId;
    }

    /**
     * Id of the related entity (e.g. invoice_id)
     */
    public function setRelatedEntityId(string $relatedEntityId): self
    {
        $this->initialized['relatedEntityId'] = true;
        $this->relatedEntityId = $relatedEntityId;

        return $this;
    }

    /**
     * Number of emails recorded for the entity, whatever their outcome
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Number of emails recorded for the entity, whatever their outcome
     */
    public function setCount(int $count): self
    {
        $this->initialized['count'] = true;
        $this->count = $count;

        return $this;
    }

    public function getLastStatus(): ?string
    {
        return $this->lastStatus;
    }

    public function setLastStatus(?string $lastStatus): self
    {
        $this->initialized['lastStatus'] = true;
        $this->lastStatus = $lastStatus;

        return $this;
    }

    /**
     * Time of the last email sent for the entity
     */
    public function getLastSentAt(): ?\DateTime
    {
        return $this->lastSentAt;
    }

    /**
     * Time of the last email sent for the entity
     */
    public function setLastSentAt(?\DateTime $lastSentAt): self
    {
        $this->initialized['lastSentAt'] = true;
        $this->lastSentAt = $lastSentAt;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['relatedEntityId' => ['related_entity_id', 'getRelatedEntityId', 'setRelatedEntityId'], 'count' => ['count', 'getCount', 'setCount'], 'lastStatus' => ['last_status', 'getLastStatus', 'setLastStatus'], 'lastSentAt' => ['last_sent_at', 'getLastSentAt', 'setLastSentAt']];
    }
}
