<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class UpdateCompanyPaymentConnectionRequest implements AdditionalPropertiesInterface
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
     * Whether incoming charges are auto-invoiced.
     *
     * @var bool
     */
    protected $autoInvoiceEnabled;

    /**
     * Which family of Stripe events this connection acts on. Changing it affects the events
     * that arrive from then on; events already recorded keep their outcome.
     *
     *
     * @var string
     */
    protected $eventSource;

    /**
     * Whether customers are created from the fiscal data the provider supplies.
     *
     * @var bool
     */
    protected $autoCreateCustomer;

    /**
     * Whether the auto-issued invoice is emailed to the payer.
     *
     * @var bool
     */
    protected $sendInvoiceByEmail;

    /**
     * Whether provider amounts are read as tax-inclusive. Turning it on requires
     * `tax_inclusive_tax` in the same request, or the request answers `422`
     * `TAX_INCLUSIVE_RATE_REQUIRED`: without the tax there is nothing to reverse.
     *
     *
     * @var bool
     */
    protected $pricesIncludeTax;

    /**
     * The tax to reverse out of the gross amount. Send it together with
     * `prices_include_tax: true`; `null` clears it.
     *
     *
     * @var UpdateCompanyPaymentConnectionRequestTaxInclusiveTax|null
     */
    protected $taxInclusiveTax;

    /**
     * Series to number auto-issued invoices in. Omit a field to keep it, send `null` to clear it
     * and fall back to the company default series for that document type.
     *
     *
     * @var UpdateCompanyPaymentConnectionSeries
     */
    protected $series;

    /**
     * Amount in EUR at or above which auto-invoicing must issue an ordinary invoice instead
     * of a simplified one. Between 0.01 and 3000.00.
     *
     *
     * @var float
     */
    protected $simplificadaThreshold;

    /**
     * Omit to keep the current filter configuration untouched. When sent, it **replaces the
     * whole object** — every axis you leave out is cleared, not preserved. Send the complete
     * configuration you want, not just the axis you are changing.
     *
     *
     * @var UpdateCompanyPaymentConnectionRequestFilterConfig
     */
    protected $filterConfig;

    /**
     * Whether incoming charges are auto-invoiced.
     */
    public function getAutoInvoiceEnabled(): bool
    {
        return $this->autoInvoiceEnabled;
    }

    /**
     * Whether incoming charges are auto-invoiced.
     */
    public function setAutoInvoiceEnabled(bool $autoInvoiceEnabled): self
    {
        $this->initialized['autoInvoiceEnabled'] = true;
        $this->autoInvoiceEnabled = $autoInvoiceEnabled;

        return $this;
    }

    /**
     * Which family of Stripe events this connection acts on. Changing it affects the events
     * that arrive from then on; events already recorded keep their outcome.
     */
    public function getEventSource(): string
    {
        return $this->eventSource;
    }

    /**
     * Which family of Stripe events this connection acts on. Changing it affects the events
    that arrive from then on; events already recorded keep their outcome.
     */
    public function setEventSource(string $eventSource): self
    {
        $this->initialized['eventSource'] = true;
        $this->eventSource = $eventSource;

        return $this;
    }

    /**
     * Whether customers are created from the fiscal data the provider supplies.
     */
    public function getAutoCreateCustomer(): bool
    {
        return $this->autoCreateCustomer;
    }

    /**
     * Whether customers are created from the fiscal data the provider supplies.
     */
    public function setAutoCreateCustomer(bool $autoCreateCustomer): self
    {
        $this->initialized['autoCreateCustomer'] = true;
        $this->autoCreateCustomer = $autoCreateCustomer;

        return $this;
    }

    /**
     * Whether the auto-issued invoice is emailed to the payer.
     */
    public function getSendInvoiceByEmail(): bool
    {
        return $this->sendInvoiceByEmail;
    }

    /**
     * Whether the auto-issued invoice is emailed to the payer.
     */
    public function setSendInvoiceByEmail(bool $sendInvoiceByEmail): self
    {
        $this->initialized['sendInvoiceByEmail'] = true;
        $this->sendInvoiceByEmail = $sendInvoiceByEmail;

        return $this;
    }

    /**
     * Whether provider amounts are read as tax-inclusive. Turning it on requires
     * `tax_inclusive_tax` in the same request, or the request answers `422`
     * `TAX_INCLUSIVE_RATE_REQUIRED`: without the tax there is nothing to reverse.
     */
    public function getPricesIncludeTax(): bool
    {
        return $this->pricesIncludeTax;
    }

    /**
     * Whether provider amounts are read as tax-inclusive. Turning it on requires
    `tax_inclusive_tax` in the same request, or the request answers `422`
    `TAX_INCLUSIVE_RATE_REQUIRED`: without the tax there is nothing to reverse.
     */
    public function setPricesIncludeTax(bool $pricesIncludeTax): self
    {
        $this->initialized['pricesIncludeTax'] = true;
        $this->pricesIncludeTax = $pricesIncludeTax;

        return $this;
    }

    /**
     * The tax to reverse out of the gross amount. Send it together with
     * `prices_include_tax: true`; `null` clears it.
     */
    public function getTaxInclusiveTax(): ?UpdateCompanyPaymentConnectionRequestTaxInclusiveTax
    {
        return $this->taxInclusiveTax;
    }

    /**
     * The tax to reverse out of the gross amount. Send it together with
    `prices_include_tax: true`; `null` clears it.
     */
    public function setTaxInclusiveTax(?UpdateCompanyPaymentConnectionRequestTaxInclusiveTax $taxInclusiveTax): self
    {
        $this->initialized['taxInclusiveTax'] = true;
        $this->taxInclusiveTax = $taxInclusiveTax;

        return $this;
    }

    /**
     * Series to number auto-issued invoices in. Omit a field to keep it, send `null` to clear it
     * and fall back to the company default series for that document type.
     */
    public function getSeries(): UpdateCompanyPaymentConnectionSeries
    {
        return $this->series;
    }

    /**
     * Series to number auto-issued invoices in. Omit a field to keep it, send `null` to clear it
    and fall back to the company default series for that document type.
     */
    public function setSeries(UpdateCompanyPaymentConnectionSeries $series): self
    {
        $this->initialized['series'] = true;
        $this->series = $series;

        return $this;
    }

    /**
     * Amount in EUR at or above which auto-invoicing must issue an ordinary invoice instead
     * of a simplified one. Between 0.01 and 3000.00.
     */
    public function getSimplificadaThreshold(): float
    {
        return $this->simplificadaThreshold;
    }

    /**
     * Amount in EUR at or above which auto-invoicing must issue an ordinary invoice instead
    of a simplified one. Between 0.01 and 3000.00.
     */
    public function setSimplificadaThreshold(float $simplificadaThreshold): self
    {
        $this->initialized['simplificadaThreshold'] = true;
        $this->simplificadaThreshold = $simplificadaThreshold;

        return $this;
    }

    /**
     * Omit to keep the current filter configuration untouched. When sent, it **replaces the
     * whole object** — every axis you leave out is cleared, not preserved. Send the complete
     * configuration you want, not just the axis you are changing.
     */
    public function getFilterConfig(): UpdateCompanyPaymentConnectionRequestFilterConfig
    {
        return $this->filterConfig;
    }

    /**
     * Omit to keep the current filter configuration untouched. When sent, it **replaces the
    whole object** — every axis you leave out is cleared, not preserved. Send the complete
    configuration you want, not just the axis you are changing.
     */
    public function setFilterConfig(UpdateCompanyPaymentConnectionRequestFilterConfig $filterConfig): self
    {
        $this->initialized['filterConfig'] = true;
        $this->filterConfig = $filterConfig;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['autoInvoiceEnabled' => ['auto_invoice_enabled', 'getAutoInvoiceEnabled', 'setAutoInvoiceEnabled'], 'eventSource' => ['event_source', 'getEventSource', 'setEventSource'], 'autoCreateCustomer' => ['auto_create_customer', 'getAutoCreateCustomer', 'setAutoCreateCustomer'], 'sendInvoiceByEmail' => ['send_invoice_by_email', 'getSendInvoiceByEmail', 'setSendInvoiceByEmail'], 'pricesIncludeTax' => ['prices_include_tax', 'getPricesIncludeTax', 'setPricesIncludeTax'], 'taxInclusiveTax' => ['tax_inclusive_tax', 'getTaxInclusiveTax', 'setTaxInclusiveTax'], 'series' => ['series', 'getSeries', 'setSeries'], 'simplificadaThreshold' => ['simplificada_threshold', 'getSimplificadaThreshold', 'setSimplificadaThreshold'], 'filterConfig' => ['filter_config', 'getFilterConfig', 'setFilterConfig']];
    }
}
