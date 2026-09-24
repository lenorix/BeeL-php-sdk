<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class UpdateInvoiceCustomizationRequest implements AdditionalPropertiesInterface
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
     * Template used to render the invoice PDF.
     *
     * @var string|null
     */
    protected $invoiceTemplateType;
    /**
     * Accent colour applied to the invoice PDF, in `#RRGGBB` format.
     *
     * @var string
     */
    protected $invoiceAccentColor;
    /**
     * @var string|null
     */
    protected $invoiceLanguage;
    /**
     * @var string|null
     */
    protected $emailLanguage;
    /**
     * Template used to render the invoice PDF.
     *
     * @return string|null
     */
    public function getInvoiceTemplateType(): ?string
    {
        return $this->invoiceTemplateType;
    }
    /**
     * Template used to render the invoice PDF.
     *
     * @param string|null $invoiceTemplateType
     *
     * @return self
     */
    public function setInvoiceTemplateType(?string $invoiceTemplateType): self
    {
        $this->initialized['invoiceTemplateType'] = true;
        $this->invoiceTemplateType = $invoiceTemplateType;
        return $this;
    }
    /**
     * Accent colour applied to the invoice PDF, in `#RRGGBB` format.
     *
     * @return string
     */
    public function getInvoiceAccentColor(): string
    {
        return $this->invoiceAccentColor;
    }
    /**
     * Accent colour applied to the invoice PDF, in `#RRGGBB` format.
     *
     * @param string $invoiceAccentColor
     *
     * @return self
     */
    public function setInvoiceAccentColor(string $invoiceAccentColor): self
    {
        $this->initialized['invoiceAccentColor'] = true;
        $this->invoiceAccentColor = $invoiceAccentColor;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getInvoiceLanguage(): ?string
    {
        return $this->invoiceLanguage;
    }
    /**
     * @param string|null $invoiceLanguage
     *
     * @return self
     */
    public function setInvoiceLanguage(?string $invoiceLanguage): self
    {
        $this->initialized['invoiceLanguage'] = true;
        $this->invoiceLanguage = $invoiceLanguage;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getEmailLanguage(): ?string
    {
        return $this->emailLanguage;
    }
    /**
     * @param string|null $emailLanguage
     *
     * @return self
     */
    public function setEmailLanguage(?string $emailLanguage): self
    {
        $this->initialized['emailLanguage'] = true;
        $this->emailLanguage = $emailLanguage;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['invoiceTemplateType' => ['invoice_template_type', 'getInvoiceTemplateType', 'setInvoiceTemplateType'], 'invoiceAccentColor' => ['invoice_accent_color', 'getInvoiceAccentColor', 'setInvoiceAccentColor'], 'invoiceLanguage' => ['invoice_language', 'getInvoiceLanguage', 'setInvoiceLanguage'], 'emailLanguage' => ['email_language', 'getEmailLanguage', 'setEmailLanguage']];
    }
}