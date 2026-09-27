<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class CreateInvoiceDeliveryRequest implements AdditionalPropertiesInterface
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
     * @var list<string>
     */
    protected $invoiceIds;

    /**
     * Email recipients. At least one is required: no address is inferred from any profile.
     *
     *
     * @var list<string>
     */
    protected $recipients;

    /**
     * CC recipients. Copied addresses count as recipients of the message: they are subject
     * to the same sending restrictions and to the same quota as the addresses in `recipients`.
     * When omitted, the CC addresses configured in the sender's email defaults apply; send an
     * empty array to deliver the message without any copy.
     *
     *
     * @var list<string>
     */
    protected $cc;

    /**
     * Custom email subject. Defaults to the standard template.
     *
     * @var string
     */
    protected $subject;

    /**
     * Custom message body. Defaults to the standard template.
     *
     * @var string
     */
    protected $message;

    /**
     * Email language. Defaults to the language of the requesting user.
     *
     * @var string
     */
    protected $language;

    /**
     * @return list<string>
     */
    public function getInvoiceIds(): array
    {
        return $this->invoiceIds;
    }

    /**
     * @param  list<string>  $invoiceIds
     */
    public function setInvoiceIds(array $invoiceIds): self
    {
        $this->initialized['invoiceIds'] = true;
        $this->invoiceIds = $invoiceIds;

        return $this;
    }

    /**
     * Email recipients. At least one is required: no address is inferred from any profile.
     *
     *
     * @return list<string>
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * Email recipients. At least one is required: no address is inferred from any profile.
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
     * CC recipients. Copied addresses count as recipients of the message: they are subject
     * to the same sending restrictions and to the same quota as the addresses in `recipients`.
     * When omitted, the CC addresses configured in the sender's email defaults apply; send an
     * empty array to deliver the message without any copy.
     *
     *
     * @return list<string>
     */
    public function getCc(): array
    {
        return $this->cc;
    }

    /**
     * CC recipients. Copied addresses count as recipients of the message: they are subject
    to the same sending restrictions and to the same quota as the addresses in `recipients`.
    When omitted, the CC addresses configured in the sender's email defaults apply; send an
    empty array to deliver the message without any copy.

     *
     * @param  list<string>  $cc
     */
    public function setCc(array $cc): self
    {
        $this->initialized['cc'] = true;
        $this->cc = $cc;

        return $this;
    }

    /**
     * Custom email subject. Defaults to the standard template.
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * Custom email subject. Defaults to the standard template.
     */
    public function setSubject(string $subject): self
    {
        $this->initialized['subject'] = true;
        $this->subject = $subject;

        return $this;
    }

    /**
     * Custom message body. Defaults to the standard template.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Custom message body. Defaults to the standard template.
     */
    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;

        return $this;
    }

    /**
     * Email language. Defaults to the language of the requesting user.
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Email language. Defaults to the language of the requesting user.
     */
    public function setLanguage(string $language): self
    {
        $this->initialized['language'] = true;
        $this->language = $language;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['invoiceIds' => ['invoice_ids', 'getInvoiceIds', 'setInvoiceIds'], 'recipients' => ['recipients', 'getRecipients', 'setRecipients'], 'cc' => ['cc', 'getCc', 'setCc'], 'subject' => ['subject', 'getSubject', 'setSubject'], 'message' => ['message', 'getMessage', 'setMessage'], 'language' => ['language', 'getLanguage', 'setLanguage']];
    }
}
