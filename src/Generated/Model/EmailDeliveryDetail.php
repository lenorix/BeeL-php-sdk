<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class EmailDeliveryDetail implements AdditionalPropertiesInterface
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
     * `true` if the email content could be retrieved from the provider.
     * `false` if the email has no provider id or the provider no longer
     * retains it.
     *
     *
     * @var bool
     */
    protected $bodyAvailable;

    /**
     * HTML body of the email as it was sent. Null if not available.
     *
     * @var string|null
     */
    protected $htmlBody;

    /**
     * Plain-text body of the email. Null if not available.
     *
     * @var string|null
     */
    protected $textBody;

    /**
     * Email attachments (e.g. the invoice PDF). In invoice emails the actual
     * content goes here, not in the body.
     *
     *
     * @var list<EmailAttachment>
     */
    protected $attachments;

    /**
     * Invoices included in a batch email (BULK_INVOICES). Each element links
     * to its invoice. Absent/empty in single-entity emails.
     *
     *
     * @var list<RelatedInvoice>
     */
    protected $relatedInvoices;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;

        return $this;
    }

    /**
     * Email type (EmailType name or template). e.g. INVOICE_EMITTED
     */
    public function getEmailType(): string
    {
        return $this->emailType;
    }

    /**
     * Email type (EmailType name or template). e.g. INVOICE_EMITTED
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
     * @param  list<string>  $recipients
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
     * @param  list<string>  $cc
     */
    public function setCc(array $cc): self
    {
        $this->initialized['cc'] = true;
        $this->cc = $cc;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

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
     */
    public function getRelatedEntityType(): ?string
    {
        return $this->relatedEntityType;
    }

    /**
     * Type of the SINGLE related entity (e.g. INVOICE for an invoice,
    USER, SUBSCRIPTION). `null` for batch emails (BULK_INVOICES): their
    relation is the invoices in `related_invoices`, not a single entity.
     */
    public function setRelatedEntityType(?string $relatedEntityType): self
    {
        $this->initialized['relatedEntityType'] = true;
        $this->relatedEntityType = $relatedEntityType;

        return $this;
    }

    /**
     * Id of the single related entity. `null` for batch emails.
     */
    public function getRelatedEntityId(): ?string
    {
        return $this->relatedEntityId;
    }

    /**
     * Id of the single related entity. `null` for batch emails.
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
     */
    public function setStatus(string $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;

        return $this;
    }

    /**
     * Time the email was sent
     */
    public function getSentAt(): \DateTime
    {
        return $this->sentAt;
    }

    /**
     * Time the email was sent
     */
    public function setSentAt(\DateTime $sentAt): self
    {
        $this->initialized['sentAt'] = true;
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * `true` if the email content could be retrieved from the provider.
     * `false` if the email has no provider id or the provider no longer
     * retains it.
     */
    public function getBodyAvailable(): bool
    {
        return $this->bodyAvailable;
    }

    /**
     * `true` if the email content could be retrieved from the provider.
    `false` if the email has no provider id or the provider no longer
    retains it.
     */
    public function setBodyAvailable(bool $bodyAvailable): self
    {
        $this->initialized['bodyAvailable'] = true;
        $this->bodyAvailable = $bodyAvailable;

        return $this;
    }

    /**
     * HTML body of the email as it was sent. Null if not available.
     */
    public function getHtmlBody(): ?string
    {
        return $this->htmlBody;
    }

    /**
     * HTML body of the email as it was sent. Null if not available.
     */
    public function setHtmlBody(?string $htmlBody): self
    {
        $this->initialized['htmlBody'] = true;
        $this->htmlBody = $htmlBody;

        return $this;
    }

    /**
     * Plain-text body of the email. Null if not available.
     */
    public function getTextBody(): ?string
    {
        return $this->textBody;
    }

    /**
     * Plain-text body of the email. Null if not available.
     */
    public function setTextBody(?string $textBody): self
    {
        $this->initialized['textBody'] = true;
        $this->textBody = $textBody;

        return $this;
    }

    /**
     * Email attachments (e.g. the invoice PDF). In invoice emails the actual
     * content goes here, not in the body.
     *
     *
     * @return list<EmailAttachment>
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * Email attachments (e.g. the invoice PDF). In invoice emails the actual
    content goes here, not in the body.

     *
     * @param  list<EmailAttachment>  $attachments
     */
    public function setAttachments(array $attachments): self
    {
        $this->initialized['attachments'] = true;
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * Invoices included in a batch email (BULK_INVOICES). Each element links
     * to its invoice. Absent/empty in single-entity emails.
     *
     *
     * @return list<RelatedInvoice>
     */
    public function getRelatedInvoices(): array
    {
        return $this->relatedInvoices;
    }

    /**
     * Invoices included in a batch email (BULK_INVOICES). Each element links
    to its invoice. Absent/empty in single-entity emails.

     *
     * @param  list<RelatedInvoice>  $relatedInvoices
     */
    public function setRelatedInvoices(array $relatedInvoices): self
    {
        $this->initialized['relatedInvoices'] = true;
        $this->relatedInvoices = $relatedInvoices;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'emailType' => ['email_type', 'getEmailType', 'setEmailType'], 'recipients' => ['recipients', 'getRecipients', 'setRecipients'], 'cc' => ['cc', 'getCc', 'setCc'], 'subject' => ['subject', 'getSubject', 'setSubject'], 'relatedEntityType' => ['related_entity_type', 'getRelatedEntityType', 'setRelatedEntityType'], 'relatedEntityId' => ['related_entity_id', 'getRelatedEntityId', 'setRelatedEntityId'], 'status' => ['status', 'getStatus', 'setStatus'], 'sentAt' => ['sent_at', 'getSentAt', 'setSentAt'], 'bodyAvailable' => ['body_available', 'getBodyAvailable', 'setBodyAvailable'], 'htmlBody' => ['html_body', 'getHtmlBody', 'setHtmlBody'], 'textBody' => ['text_body', 'getTextBody', 'setTextBody'], 'attachments' => ['attachments', 'getAttachments', 'setAttachments'], 'relatedInvoices' => ['related_invoices', 'getRelatedInvoices', 'setRelatedInvoices']];
    }
}
