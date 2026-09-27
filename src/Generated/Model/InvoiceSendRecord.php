<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class InvoiceSendRecord implements AdditionalPropertiesInterface
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
     * Id of the delivery record (same id as in `GET /v1/emails`).
     *
     * @var string
     */
    protected $id;
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
     * Moment the email provider ACCEPTED the message — not the moment it
     * reached the mailbox. Later outcomes (delivered, bounced, opened) are
     * reflected in `status` as the provider reports them.
     * 
     * Absent while there is no such moment: the history records decisions,
     * and a `QUEUED` record has not been dispatched yet, a `REJECTED` one
     * never will be, and a `FAILED` one never got that far. Read `status`
     * to tell those apart; do not read an absent `sent_at` as "sent long
     * ago". It is omitted, never sent as `null`.
     * 
     *
     * @var \DateTime
     */
    protected $sentAt;
    /**
     * Message id at the email provider, when available.
     *
     * @var string|null
     */
    protected $externalMessageId;
    /**
     * Failure detail, present only when `status` is FAILED.
     *
     * @var string|null
     */
    protected $error;
    /**
     * Id of the delivery record (same id as in `GET /v1/emails`).
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * Id of the delivery record (same id as in `GET /v1/emails`).
     *
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
     * Moment the email provider ACCEPTED the message — not the moment it
     * reached the mailbox. Later outcomes (delivered, bounced, opened) are
     * reflected in `status` as the provider reports them.
     * 
     * Absent while there is no such moment: the history records decisions,
     * and a `QUEUED` record has not been dispatched yet, a `REJECTED` one
     * never will be, and a `FAILED` one never got that far. Read `status`
     * to tell those apart; do not read an absent `sent_at` as "sent long
     * ago". It is omitted, never sent as `null`.
     * 
     *
     * @return \DateTime
     */
    public function getSentAt(): \DateTime
    {
        return $this->sentAt;
    }
    /**
    * Moment the email provider ACCEPTED the message — not the moment it
    reached the mailbox. Later outcomes (delivered, bounced, opened) are
    reflected in `status` as the provider reports them.
    
    Absent while there is no such moment: the history records decisions,
    and a `QUEUED` record has not been dispatched yet, a `REJECTED` one
    never will be, and a `FAILED` one never got that far. Read `status`
    to tell those apart; do not read an absent `sent_at` as "sent long
    ago". It is omitted, never sent as `null`.
    
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
    /**
     * Message id at the email provider, when available.
     *
     * @return string|null
     */
    public function getExternalMessageId(): ?string
    {
        return $this->externalMessageId;
    }
    /**
     * Message id at the email provider, when available.
     *
     * @param string|null $externalMessageId
     *
     * @return self
     */
    public function setExternalMessageId(?string $externalMessageId): self
    {
        $this->initialized['externalMessageId'] = true;
        $this->externalMessageId = $externalMessageId;
        return $this;
    }
    /**
     * Failure detail, present only when `status` is FAILED.
     *
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }
    /**
     * Failure detail, present only when `status` is FAILED.
     *
     * @param string|null $error
     *
     * @return self
     */
    public function setError(?string $error): self
    {
        $this->initialized['error'] = true;
        $this->error = $error;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'recipients' => ['recipients', 'getRecipients', 'setRecipients'], 'cc' => ['cc', 'getCc', 'setCc'], 'subject' => ['subject', 'getSubject', 'setSubject'], 'status' => ['status', 'getStatus', 'setStatus'], 'sentAt' => ['sent_at', 'getSentAt', 'setSentAt'], 'externalMessageId' => ['external_message_id', 'getExternalMessageId', 'setExternalMessageId'], 'error' => ['error', 'getError', 'setError']];
    }
}