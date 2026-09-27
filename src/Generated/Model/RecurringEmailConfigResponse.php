<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class RecurringEmailConfigResponse implements AdditionalPropertiesInterface
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
    protected $recipients;

    /**
     * @var list<string>
     */
    protected $cc;

    /**
     * @var string|null
     */
    protected $subject;

    /**
     * @var string|null
     */
    protected $message;

    /**
     * @return list<string>
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * @param  list<string>  $recipients
     */
    public function setRecipients(array $recipients): self
    {
        $this->initialized['recipients'] = true;
        $this->recipients = $recipients;

        return $this;
    }

    /**
     * @return list<string>
     */
    public function getCc(): array
    {
        return $this->cc;
    }

    /**
     * @param  list<string>  $cc
     */
    public function setCc(array $cc): self
    {
        $this->initialized['cc'] = true;
        $this->cc = $cc;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->initialized['subject'] = true;
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
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
