<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class InvoiceCustomization implements AdditionalPropertiesInterface
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
     * Unique identifier (UUID) of the company this customization belongs to.
     *
     * @var string
     */
    protected $companyId;

    /**
     * Invoice PDF template. `MODERN_TABLE` is a structured table layout for
     * product/service lines; `PROFESSIONAL_SERVICE` is a text-based layout.
     *
     *
     * @var string
     */
    protected $invoiceTemplateType;

    /**
     * Accent colour applied to the invoice PDF, in `#RRGGBB` format.
     *
     * @var string
     */
    protected $invoiceAccentColor;

    /**
     * Supported languages
     *
     * @var string
     */
    protected $invoiceLanguage;

    /**
     * Supported languages
     *
     * @var string
     */
    protected $emailLanguage;

    /**
     * Public URL of the logo, or `null` when none is set.
     *
     * @var string|null
     */
    protected $logoUrl;

    /**
     * Unique identifier (UUID) of the company this customization belongs to.
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    /**
     * Unique identifier (UUID) of the company this customization belongs to.
     */
    public function setCompanyId(string $companyId): self
    {
        $this->initialized['companyId'] = true;
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Invoice PDF template. `MODERN_TABLE` is a structured table layout for
     * product/service lines; `PROFESSIONAL_SERVICE` is a text-based layout.
     */
    public function getInvoiceTemplateType(): string
    {
        return $this->invoiceTemplateType;
    }

    /**
     * Invoice PDF template. `MODERN_TABLE` is a structured table layout for
    product/service lines; `PROFESSIONAL_SERVICE` is a text-based layout.
     */
    public function setInvoiceTemplateType(string $invoiceTemplateType): self
    {
        $this->initialized['invoiceTemplateType'] = true;
        $this->invoiceTemplateType = $invoiceTemplateType;

        return $this;
    }

    /**
     * Accent colour applied to the invoice PDF, in `#RRGGBB` format.
     */
    public function getInvoiceAccentColor(): string
    {
        return $this->invoiceAccentColor;
    }

    /**
     * Accent colour applied to the invoice PDF, in `#RRGGBB` format.
     */
    public function setInvoiceAccentColor(string $invoiceAccentColor): self
    {
        $this->initialized['invoiceAccentColor'] = true;
        $this->invoiceAccentColor = $invoiceAccentColor;

        return $this;
    }

    /**
     * Supported languages
     */
    public function getInvoiceLanguage(): string
    {
        return $this->invoiceLanguage;
    }

    /**
     * Supported languages
     */
    public function setInvoiceLanguage(string $invoiceLanguage): self
    {
        $this->initialized['invoiceLanguage'] = true;
        $this->invoiceLanguage = $invoiceLanguage;

        return $this;
    }

    /**
     * Supported languages
     */
    public function getEmailLanguage(): string
    {
        return $this->emailLanguage;
    }

    /**
     * Supported languages
     */
    public function setEmailLanguage(string $emailLanguage): self
    {
        $this->initialized['emailLanguage'] = true;
        $this->emailLanguage = $emailLanguage;

        return $this;
    }

    /**
     * Public URL of the logo, or `null` when none is set.
     */
    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    /**
     * Public URL of the logo, or `null` when none is set.
     */
    public function setLogoUrl(?string $logoUrl): self
    {
        $this->initialized['logoUrl'] = true;
        $this->logoUrl = $logoUrl;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['companyId' => ['company_id', 'getCompanyId', 'setCompanyId'], 'invoiceTemplateType' => ['invoice_template_type', 'getInvoiceTemplateType', 'setInvoiceTemplateType'], 'invoiceAccentColor' => ['invoice_accent_color', 'getInvoiceAccentColor', 'setInvoiceAccentColor'], 'invoiceLanguage' => ['invoice_language', 'getInvoiceLanguage', 'setInvoiceLanguage'], 'emailLanguage' => ['email_language', 'getEmailLanguage', 'setEmailLanguage'], 'logoUrl' => ['logo_url', 'getLogoUrl', 'setLogoUrl']];
    }
}
