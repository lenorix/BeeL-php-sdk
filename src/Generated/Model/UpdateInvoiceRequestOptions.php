<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class UpdateInvoiceRequestOptions implements AdditionalPropertiesInterface
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
     * Whether the invoice should be auto-emailed after issuing.
     *
     * @var bool
     */
    protected $sendAutomatically;

    /**
     * Email configuration for auto-send. null clears the existing config.
     *
     * @var UpdateInvoiceRequestOptionsEmailConfig|null
     */
    protected $emailConfig;

    /**
     * Whether the invoice should be auto-emailed after issuing.
     */
    public function getSendAutomatically(): bool
    {
        return $this->sendAutomatically;
    }

    /**
     * Whether the invoice should be auto-emailed after issuing.
     */
    public function setSendAutomatically(bool $sendAutomatically): self
    {
        $this->initialized['sendAutomatically'] = true;
        $this->sendAutomatically = $sendAutomatically;

        return $this;
    }

    /**
     * Email configuration for auto-send. null clears the existing config.
     */
    public function getEmailConfig(): ?UpdateInvoiceRequestOptionsEmailConfig
    {
        return $this->emailConfig;
    }

    /**
     * Email configuration for auto-send. null clears the existing config.
     */
    public function setEmailConfig(?UpdateInvoiceRequestOptionsEmailConfig $emailConfig): self
    {
        $this->initialized['emailConfig'] = true;
        $this->emailConfig = $emailConfig;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['sendAutomatically' => ['send_automatically', 'getSendAutomatically', 'setSendAutomatically'], 'emailConfig' => ['email_config', 'getEmailConfig', 'setEmailConfig']];
    }
}
