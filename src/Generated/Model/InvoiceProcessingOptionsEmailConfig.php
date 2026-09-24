<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class InvoiceProcessingOptionsEmailConfig implements AdditionalPropertiesInterface
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
     * List of recipient emails (at least 1 required)
     *
     * @var list<string>
     */
    protected $recipients;

    /**
     * List of CC emails (optional)
     *
     * @var list<string>
     */
    protected $cc;

    /**
     * Custom email subject (optional, if not specified uses a default)
     *
     * @var string
     */
    protected $subject;

    /**
     * Custom message (optional, added to email body)
     *
     * @var string
     */
    protected $message;

    /**
     * List of recipient emails (at least 1 required)
     *
     * @return list<string>
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * List of recipient emails (at least 1 required)
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
     * List of CC emails (optional)
     *
     * @return list<string>
     */
    public function getCc(): array
    {
        return $this->cc;
    }

    /**
     * List of CC emails (optional)
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
     * Custom email subject (optional, if not specified uses a default)
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * Custom email subject (optional, if not specified uses a default)
     */
    public function setSubject(string $subject): self
    {
        $this->initialized['subject'] = true;
        $this->subject = $subject;

        return $this;
    }

    /**
     * Custom message (optional, added to email body)
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Custom message (optional, added to email body)
     */
    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['recipients' => ['recipients', 'getRecipients', 'setRecipients'], 'cc' => ['cc', 'getCc', 'setCc'], 'subject' => ['subject', 'getSubject', 'setSubject'], 'message' => ['message', 'getMessage', 'setMessage']];
    }
}
