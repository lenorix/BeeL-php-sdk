<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class EmailDeliveryResponse implements AdditionalPropertiesInterface
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
     * @var string
     */
    protected $id;
    /**
     * Email type (EmailType name or template). e.g. INVOICE_EMITTED
     *
     * @var string
     */
    protected $emailType;
    /**
     * Recipient addresses (To)
     *
     * @var list<string>
     */
    protected $recipients;
    /**
     * Carbon-copy addresses (CC)
     *
     * @var list<string>
     */
    protected $cc;
    /**
     * @var string
     */
    protected $subject;
    /**
     * Type of the SINGLE related entity (e.g. INVOICE for an invoice,
     * USER, SUBSCRIPTION). `null` for batch emails (BULK_INVOICES): their
     * relation is the invoices in `related_invoices`, not a single entity.
     * 
     *
     * @var string|null
     */
    protected $relatedEntityType;
    /**
     * Id of the single related entity. `null` for batch emails.
     *
     * @var string|null
     */
    protected $relatedEntityId;
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
    protected $status;
    /**
     * Time the email was sent
     *
     * @var \DateTime
     */
    protected $sentAt;
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * Email type (EmailType name or template). e.g. INVOICE_EMITTED
     *
     * @return string
     */
    public function getEmailType(): string
    {
        return $this->emailType;
    }
    /**
     * Email type (EmailType name or template). e.g. INVOICE_EMITTED
     *
     * @param string $emailType
     *
     * @return self
     */
    public function setEmailType(string $emailType): self
    {
        $this->initialized['emailType'] = true;
        $this->emailType = $emailType;
        return $this;
    }
    /**
     * Recipient addresses (To)
     *
     * @return list<string>
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }
    /**
     * Recipient addresses (To)
     *
     * @param list<string> $recipients
     *
     * @return self
     */
    public function setRecipients(array $recipients): self
    {
        $this->initialized['recipients'] = true;
        $this->recipients = $recipients;
        return $this;
    }
    /**
     * Carbon-copy addresses (CC)
     *
     * @return list<string>
     */
    public function getCc(): array
    {
        return $this->cc;
    }
    /**
     * Carbon-copy addresses (CC)
     *
     * @param list<string> $cc
     *
     * @return self
     */
    public function setCc(array $cc): self
    {
        $this->initialized['cc'] = true;
        $this->cc = $cc;
        return $this;
    }
    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }
    /**
     * @param string $subject
     *
     * @return self
     */
    public function setSubject(string $subject): self
    {
        $this->initialized['subject'] = true;
        $this->subject = $subject;
        return $this;
    }
    /**
     * Type of the SINGLE related entity (e.g. INVOICE for an invoice,
     * USER, SUBSCRIPTION). `null` for batch emails (BULK_INVOICES): their
     * relation is the invoices in `related_invoices`, not a single entity.
     * 
     *
     * @return string|null
     */
    public function getRelatedEntityType(): ?string
    {
        return $this->relatedEntityType;
    }
    /**
    * Type of the SINGLE related entity (e.g. INVOICE for an invoice,
    USER, SUBSCRIPTION). `null` for batch emails (BULK_INVOICES): their
    relation is the invoices in `related_invoices`, not a single entity.
    
    *
    * @param string|null $relatedEntityType
    *
    * @return self
    */
    public function setRelatedEntityType(?string $relatedEntityType): self
    {
        $this->initialized['relatedEntityType'] = true;
        $this->relatedEntityType = $relatedEntityType;
        return $this;
    }
    /**
     * Id of the single related entity. `null` for batch emails.
     *
     * @return string|null
     */
    public function getRelatedEntityId(): ?string
    {
        return $this->relatedEntityId;
    }
    /**
     * Id of the single related entity. `null` for batch emails.
     *
     * @param string|null $relatedEntityId
     *
     * @return self
     */
    public function setRelatedEntityId(?string $relatedEntityId): self
    {
        $this->initialized['relatedEntityId'] = true;
        $this->relatedEntityId = $relatedEntityId;
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
    public function getStatus(): string
    {
        return $this->status;
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
    * @param string $status
    *
    * @return self
    */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;
        return $this;
    }
    /**
     * Time the email was sent
     *
     * @return \DateTime
     */
    public function getSentAt(): \DateTime
    {
        return $this->sentAt;
    }
    /**
     * Time the email was sent
     *
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
    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'emailType' => ['email_type', 'getEmailType', 'setEmailType'], 'recipients' => ['recipients', 'getRecipients', 'setRecipients'], 'cc' => ['cc', 'getCc', 'setCc'], 'subject' => ['subject', 'getSubject', 'setSubject'], 'relatedEntityType' => ['related_entity_type', 'getRelatedEntityType', 'setRelatedEntityType'], 'relatedEntityId' => ['related_entity_id', 'getRelatedEntityId', 'setRelatedEntityId'], 'status' => ['status', 'getStatus', 'setStatus'], 'sentAt' => ['sent_at', 'getSentAt', 'setSentAt']];
    }
}