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
     * Status of an email.
     * 
     * The history records every email the system decided to send, not only the ones that
     * went out: an email stopped by policy is listed as REJECTED rather than omitted.
     * 
     * - QUEUED: authorised and recorded, not dispatched yet
     * - REJECTED: stopped by policy and never sent (terminal, not retried). In test
     *   environments invoices may only be emailed to the account owner's own address
     *   (`+tag` aliases included), so a message addressed elsewhere lands here
     * - SENT: successfully sent to the provider
     * - FAILED: sending failed
     * - DELIVERED / BOUNCED / OPENED: reported by the provider's webhooks
     * 
     *
     * @var string
     */
    protected $lastStatus;
    /**
     * Time of the last email sent for the entity
     *
     * @var \DateTime
     */
    protected $lastSentAt;
    /**
     * Id of the related entity (e.g. invoice_id)
     *
     * @return string
     */
    public function getRelatedEntityId(): string
    {
        return $this->relatedEntityId;
    }
    /**
     * Id of the related entity (e.g. invoice_id)
     *
     * @param string $relatedEntityId
     *
     * @return self
     */
    public function setRelatedEntityId(string $relatedEntityId): self
    {
        $this->initialized['relatedEntityId'] = true;
        $this->relatedEntityId = $relatedEntityId;
        return $this;
    }
    /**
     * Number of emails recorded for the entity, whatever their outcome
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
    /**
     * Number of emails recorded for the entity, whatever their outcome
     *
     * @param int $count
     *
     * @return self
     */
    public function setCount(int $count): self
    {
        $this->initialized['count'] = true;
        $this->count = $count;
        return $this;
    }
    /**
     * Status of an email.
     * 
     * The history records every email the system decided to send, not only the ones that
     * went out: an email stopped by policy is listed as REJECTED rather than omitted.
     * 
     * - QUEUED: authorised and recorded, not dispatched yet
     * - REJECTED: stopped by policy and never sent (terminal, not retried). In test
     *   environments invoices may only be emailed to the account owner's own address
     *   (`+tag` aliases included), so a message addressed elsewhere lands here
     * - SENT: successfully sent to the provider
     * - FAILED: sending failed
     * - DELIVERED / BOUNCED / OPENED: reported by the provider's webhooks
     * 
     *
     * @return string
     */
    public function getLastStatus(): string
    {
        return $this->lastStatus;
    }
    /**
    * Status of an email.
    
    The history records every email the system decided to send, not only the ones that
    went out: an email stopped by policy is listed as REJECTED rather than omitted.
    
    - QUEUED: authorised and recorded, not dispatched yet
    - REJECTED: stopped by policy and never sent (terminal, not retried). In test
     environments invoices may only be emailed to the account owner's own address
     (`+tag` aliases included), so a message addressed elsewhere lands here
    - SENT: successfully sent to the provider
    - FAILED: sending failed
    - DELIVERED / BOUNCED / OPENED: reported by the provider's webhooks
    
    *
    * @param string $lastStatus
    *
    * @return self
    */
    public function setLastStatus(string $lastStatus): self
    {
        $this->initialized['lastStatus'] = true;
        $this->lastStatus = $lastStatus;
        return $this;
    }
    /**
     * Time of the last email sent for the entity
     *
     * @return \DateTime
     */
    public function getLastSentAt(): \DateTime
    {
        return $this->lastSentAt;
    }
    /**
     * Time of the last email sent for the entity
     *
     * @param \DateTime $lastSentAt
     *
     * @return self
     */
    public function setLastSentAt(\DateTime $lastSentAt): self
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