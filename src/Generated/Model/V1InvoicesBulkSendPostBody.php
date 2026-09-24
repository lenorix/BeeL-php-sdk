<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class V1InvoicesBulkSendPostBody implements AdditionalPropertiesInterface
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
     * List of invoice IDs to send
     *
     * @var list<string>
     */
    protected $invoiceIds;

    /**
     * Email recipients. At least one is required: no address is inferred from any
     * profile, and a request without recipients is rejected.
     *
     *
     * @var list<string>
     */
    protected $recipients;

    /**
     * CC recipients
     *
     * @var list<string>
     */
    protected $cc;

    /**
     * Custom email subject. If not provided, uses default template.
     *
     * @var string
     */
    protected $subject;

    /**
     * Custom message body. If not provided, uses default template.
     *
     * @var string
     */
    protected $message;

    /**
     * Email language. If not provided, uses user's language.
     *
     * @var string
     */
    protected $language;

    /**
     * List of invoice IDs to send
     *
     * @return list<string>
     */
    public function getInvoiceIds(): array
    {
        return $this->invoiceIds;
    }

    /**
     * List of invoice IDs to send
     *
     * @param  list<string>  $invoiceIds
     */
    public function setInvoiceIds(array $invoiceIds): self
    {
        $this->initialized['invoiceIds'] = true;
        $this->invoiceIds = $invoiceIds;

        return $this;
    }

    /**
     * Email recipients. At least one is required: no address is inferred from any
     * profile, and a request without recipients is rejected.
     *
     *
     * @return list<string>
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * Email recipients. At least one is required: no address is inferred from any
    profile, and a request without recipients is rejected.

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
     * CC recipients
     *
     * @return list<string>
     */
    public function getCc(): array
    {
        return $this->cc;
    }

    /**
     * CC recipients
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
     * Custom email subject. If not provided, uses default template.
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * Custom email subject. If not provided, uses default template.
     */
    public function setSubject(string $subject): self
    {
        $this->initialized['subject'] = true;
        $this->subject = $subject;

        return $this;
    }

    /**
     * Custom message body. If not provided, uses default template.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Custom message body. If not provided, uses default template.
     */
    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;

        return $this;
    }

    /**
     * Email language. If not provided, uses user's language.
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Email language. If not provided, uses user's language.
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
