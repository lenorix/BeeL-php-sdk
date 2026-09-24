<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CompanyPaymentConnection implements AdditionalPropertiesInterface
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
     * Unique identifier of the connection, the `{connection_id}` that addresses it.
     *
     * @var string
     */
    protected $id;
    /**
     * Payment provider slug (lowercase).
     *
     * @var string
     */
    protected $provider;
    /**
     * Provider-side account id (e.g. Stripe `acct_...`). Read-only.
     *
     * @var string
     */
    protected $externalAccountId;
    /**
     * Provider-side account display name, if any.
     *
     * @var string|null
     */
    protected $externalAccountName;
    /**
     * Mode the connection lives in (`beel_sk_test_*` → `TEST`, `beel_sk_live_*` → `PROD`).
     * Read-only: Test and Live connections are independent and never move between modes.
     * 
     *
     * @var string
     */
    protected $environment;
    /**
     * Status of the payment provider connection.
     * 
     * - `PENDING`: authorization opened, not completed yet
     * - `ACTIVE`: the connection invoices incoming charges
     * - `DISCONNECTED`: withdrawn — it no longer invoices anything
     * - `ERROR`: the provider rejected the last call, so it needs reconnecting
     * 
     *
     * @var string
     */
    protected $status;
    /**
     * When the connection was established. Read-only.
     *
     * @var \DateTime|null
     */
    protected $connectedAt;
    /**
     * When the last charge from the provider came in through this connection. Read-only, and
     * a signal of **traffic**, not of success: it is stamped even when the charge is filtered
     * out. `null` means no charge has ever arrived.
     * 
     *
     * @var \DateTime|null
     */
    protected $lastEventAt;
    /**
     * Whether incoming charges are auto-invoiced. Disconnecting the connection does not
     * change it.
     * 
     *
     * @var bool
     */
    protected $autoInvoiceEnabled;
    /**
     * Which family of Stripe events this connection acts on. A single webhook endpoint
     * receives everything the connected account emits, so the events outside the declared
     * family are recorded as skipped and deliberately ignored, and need no attention.
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
     * Whether the auto-issued invoice is emailed to the payer, using the address the provider
     * reported. A charge with no payer email is invoiced all the same and sends nothing.
     * 
     *
     * @var bool
     */
    protected $sendInvoiceByEmail;
    /**
     * Whether provider amounts are read as tax-inclusive, in which case BeeL reverses the
     * calculation when auto-invoicing instead of adding the tax on top.
     * 
     *
     * @var bool
     */
    protected $pricesIncludeTax;
    /**
     * The tax to reverse out of the gross amount when `prices_include_tax` is true, and the
     * reason the two fields travel together: without it the amount cannot be split into base
     * and tax. `null` while `prices_include_tax` is false.
     * 
     *
     * @var CompanyPaymentConnectionTaxInclusiveTax|null
     */
    protected $taxInclusiveTax;
    /**
     * Invoice series the connection numbers its auto-issued invoices in, one per document type.
     * A series left out falls back to the company default series for that type.
     * 
     *
     * @var CompanyPaymentConnectionSeries
     */
    protected $series;
    /**
     * Amount in EUR at or above which auto-invoicing must issue an ordinary invoice, with the
     * recipient's full fiscal data, instead of a simplified one.
     * 
     *
     * @var float
     */
    protected $simplificadaThreshold;
    /**
     * Rules that decide which incoming charges reach auto-invoicing. Every axis is opt-in: a
     * field left out does not filter anything. A charge filtered out produces no invoice and is
     * recorded as skipped.
     * 
     *
     * @var CompanyPaymentConnectionFilters
     */
    protected $filterConfig;
    /**
     * Filter axes that currently hold a value, so you can tell a connection that filters
     * nothing from one that does without reading every field. An empty list means every
     * charge reaches auto-invoicing.
     * 
     *
     * @var list<string>
     */
    protected $activeFilters;
    /**
     * Unique identifier of the connection, the `{connection_id}` that addresses it.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    /**
     * Unique identifier of the connection, the `{connection_id}` that addresses it.
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
     * Payment provider slug (lowercase).
     *
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }
    /**
     * Payment provider slug (lowercase).
     *
     * @param string $provider
     *
     * @return self
     */
    public function setProvider(string $provider): self
    {
        $this->initialized['provider'] = true;
        $this->provider = $provider;
        return $this;
    }
    /**
     * Provider-side account id (e.g. Stripe `acct_...`). Read-only.
     *
     * @return string
     */
    public function getExternalAccountId(): string
    {
        return $this->externalAccountId;
    }
    /**
     * Provider-side account id (e.g. Stripe `acct_...`). Read-only.
     *
     * @param string $externalAccountId
     *
     * @return self
     */
    public function setExternalAccountId(string $externalAccountId): self
    {
        $this->initialized['externalAccountId'] = true;
        $this->externalAccountId = $externalAccountId;
        return $this;
    }
    /**
     * Provider-side account display name, if any.
     *
     * @return string|null
     */
    public function getExternalAccountName(): ?string
    {
        return $this->externalAccountName;
    }
    /**
     * Provider-side account display name, if any.
     *
     * @param string|null $externalAccountName
     *
     * @return self
     */
    public function setExternalAccountName(?string $externalAccountName): self
    {
        $this->initialized['externalAccountName'] = true;
        $this->externalAccountName = $externalAccountName;
        return $this;
    }
    /**
     * Mode the connection lives in (`beel_sk_test_*` → `TEST`, `beel_sk_live_*` → `PROD`).
     * Read-only: Test and Live connections are independent and never move between modes.
     * 
     *
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }
    /**
    * Mode the connection lives in (`beel_sk_test_*` → `TEST`, `beel_sk_live_*` → `PROD`).
    Read-only: Test and Live connections are independent and never move between modes.
    
    *
    * @param string $environment
    *
    * @return self
    */
    public function setEnvironment(string $environment): self
    {
        $this->initialized['environment'] = true;
        $this->environment = $environment;
        return $this;
    }
    /**
     * Status of the payment provider connection.
     * 
     * - `PENDING`: authorization opened, not completed yet
     * - `ACTIVE`: the connection invoices incoming charges
     * - `DISCONNECTED`: withdrawn — it no longer invoices anything
     * - `ERROR`: the provider rejected the last call, so it needs reconnecting
     * 
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
    /**
    * Status of the payment provider connection.
    
    - `PENDING`: authorization opened, not completed yet
    - `ACTIVE`: the connection invoices incoming charges
    - `DISCONNECTED`: withdrawn — it no longer invoices anything
    - `ERROR`: the provider rejected the last call, so it needs reconnecting
    
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
     * When the connection was established. Read-only.
     *
     * @return \DateTime|null
     */
    public function getConnectedAt(): ?\DateTime
    {
        return $this->connectedAt;
    }
    /**
     * When the connection was established. Read-only.
     *
     * @param \DateTime|null $connectedAt
     *
     * @return self
     */
    public function setConnectedAt(?\DateTime $connectedAt): self
    {
        $this->initialized['connectedAt'] = true;
        $this->connectedAt = $connectedAt;
        return $this;
    }
    /**
     * When the last charge from the provider came in through this connection. Read-only, and
     * a signal of **traffic**, not of success: it is stamped even when the charge is filtered
     * out. `null` means no charge has ever arrived.
     * 
     *
     * @return \DateTime|null
     */
    public function getLastEventAt(): ?\DateTime
    {
        return $this->lastEventAt;
    }
    /**
    * When the last charge from the provider came in through this connection. Read-only, and
    a signal of **traffic**, not of success: it is stamped even when the charge is filtered
    out. `null` means no charge has ever arrived.
    
    *
    * @param \DateTime|null $lastEventAt
    *
    * @return self
    */
    public function setLastEventAt(?\DateTime $lastEventAt): self
    {
        $this->initialized['lastEventAt'] = true;
        $this->lastEventAt = $lastEventAt;
        return $this;
    }
    /**
     * Whether incoming charges are auto-invoiced. Disconnecting the connection does not
     * change it.
     * 
     *
     * @return bool
     */
    public function getAutoInvoiceEnabled(): bool
    {
        return $this->autoInvoiceEnabled;
    }
    /**
    * Whether incoming charges are auto-invoiced. Disconnecting the connection does not
    change it.
    
    *
    * @param bool $autoInvoiceEnabled
    *
    * @return self
    */
    public function setAutoInvoiceEnabled(bool $autoInvoiceEnabled): self
    {
        $this->initialized['autoInvoiceEnabled'] = true;
        $this->autoInvoiceEnabled = $autoInvoiceEnabled;
        return $this;
    }
    /**
     * Which family of Stripe events this connection acts on. A single webhook endpoint
     * receives everything the connected account emits, so the events outside the declared
     * family are recorded as skipped and deliberately ignored, and need no attention.
     * 
     *
     * @return string
     */
    public function getEventSource(): string
    {
        return $this->eventSource;
    }
    /**
    * Which family of Stripe events this connection acts on. A single webhook endpoint
    receives everything the connected account emits, so the events outside the declared
    family are recorded as skipped and deliberately ignored, and need no attention.
    
    *
    * @param string $eventSource
    *
    * @return self
    */
    public function setEventSource(string $eventSource): self
    {
        $this->initialized['eventSource'] = true;
        $this->eventSource = $eventSource;
        return $this;
    }
    /**
     * Whether customers are created from the fiscal data the provider supplies.
     *
     * @return bool
     */
    public function getAutoCreateCustomer(): bool
    {
        return $this->autoCreateCustomer;
    }
    /**
     * Whether customers are created from the fiscal data the provider supplies.
     *
     * @param bool $autoCreateCustomer
     *
     * @return self
     */
    public function setAutoCreateCustomer(bool $autoCreateCustomer): self
    {
        $this->initialized['autoCreateCustomer'] = true;
        $this->autoCreateCustomer = $autoCreateCustomer;
        return $this;
    }
    /**
     * Whether the auto-issued invoice is emailed to the payer, using the address the provider
     * reported. A charge with no payer email is invoiced all the same and sends nothing.
     * 
     *
     * @return bool
     */
    public function getSendInvoiceByEmail(): bool
    {
        return $this->sendInvoiceByEmail;
    }
    /**
    * Whether the auto-issued invoice is emailed to the payer, using the address the provider
    reported. A charge with no payer email is invoiced all the same and sends nothing.
    
    *
    * @param bool $sendInvoiceByEmail
    *
    * @return self
    */
    public function setSendInvoiceByEmail(bool $sendInvoiceByEmail): self
    {
        $this->initialized['sendInvoiceByEmail'] = true;
        $this->sendInvoiceByEmail = $sendInvoiceByEmail;
        return $this;
    }
    /**
     * Whether provider amounts are read as tax-inclusive, in which case BeeL reverses the
     * calculation when auto-invoicing instead of adding the tax on top.
     * 
     *
     * @return bool
     */
    public function getPricesIncludeTax(): bool
    {
        return $this->pricesIncludeTax;
    }
    /**
    * Whether provider amounts are read as tax-inclusive, in which case BeeL reverses the
    calculation when auto-invoicing instead of adding the tax on top.
    
    *
    * @param bool $pricesIncludeTax
    *
    * @return self
    */
    public function setPricesIncludeTax(bool $pricesIncludeTax): self
    {
        $this->initialized['pricesIncludeTax'] = true;
        $this->pricesIncludeTax = $pricesIncludeTax;
        return $this;
    }
    /**
     * The tax to reverse out of the gross amount when `prices_include_tax` is true, and the
     * reason the two fields travel together: without it the amount cannot be split into base
     * and tax. `null` while `prices_include_tax` is false.
     * 
     *
     * @return CompanyPaymentConnectionTaxInclusiveTax|null
     */
    public function getTaxInclusiveTax(): ?CompanyPaymentConnectionTaxInclusiveTax
    {
        return $this->taxInclusiveTax;
    }
    /**
    * The tax to reverse out of the gross amount when `prices_include_tax` is true, and the
    reason the two fields travel together: without it the amount cannot be split into base
    and tax. `null` while `prices_include_tax` is false.
    
    *
    * @param CompanyPaymentConnectionTaxInclusiveTax|null $taxInclusiveTax
    *
    * @return self
    */
    public function setTaxInclusiveTax(?CompanyPaymentConnectionTaxInclusiveTax $taxInclusiveTax): self
    {
        $this->initialized['taxInclusiveTax'] = true;
        $this->taxInclusiveTax = $taxInclusiveTax;
        return $this;
    }
    /**
     * Invoice series the connection numbers its auto-issued invoices in, one per document type.
     * A series left out falls back to the company default series for that type.
     * 
     *
     * @return CompanyPaymentConnectionSeries
     */
    public function getSeries(): CompanyPaymentConnectionSeries
    {
        return $this->series;
    }
    /**
    * Invoice series the connection numbers its auto-issued invoices in, one per document type.
    A series left out falls back to the company default series for that type.
    
    *
    * @param CompanyPaymentConnectionSeries $series
    *
    * @return self
    */
    public function setSeries(CompanyPaymentConnectionSeries $series): self
    {
        $this->initialized['series'] = true;
        $this->series = $series;
        return $this;
    }
    /**
     * Amount in EUR at or above which auto-invoicing must issue an ordinary invoice, with the
     * recipient's full fiscal data, instead of a simplified one.
     * 
     *
     * @return float
     */
    public function getSimplificadaThreshold(): float
    {
        return $this->simplificadaThreshold;
    }
    /**
    * Amount in EUR at or above which auto-invoicing must issue an ordinary invoice, with the
    recipient's full fiscal data, instead of a simplified one.
    
    *
    * @param float $simplificadaThreshold
    *
    * @return self
    */
    public function setSimplificadaThreshold(float $simplificadaThreshold): self
    {
        $this->initialized['simplificadaThreshold'] = true;
        $this->simplificadaThreshold = $simplificadaThreshold;
        return $this;
    }
    /**
     * Rules that decide which incoming charges reach auto-invoicing. Every axis is opt-in: a
     * field left out does not filter anything. A charge filtered out produces no invoice and is
     * recorded as skipped.
     * 
     *
     * @return CompanyPaymentConnectionFilters
     */
    public function getFilterConfig(): CompanyPaymentConnectionFilters
    {
        return $this->filterConfig;
    }
    /**
    * Rules that decide which incoming charges reach auto-invoicing. Every axis is opt-in: a
    field left out does not filter anything. A charge filtered out produces no invoice and is
    recorded as skipped.
    
    *
    * @param CompanyPaymentConnectionFilters $filterConfig
    *
    * @return self
    */
    public function setFilterConfig(CompanyPaymentConnectionFilters $filterConfig): self
    {
        $this->initialized['filterConfig'] = true;
        $this->filterConfig = $filterConfig;
        return $this;
    }
    /**
     * Filter axes that currently hold a value, so you can tell a connection that filters
     * nothing from one that does without reading every field. An empty list means every
     * charge reaches auto-invoicing.
     * 
     *
     * @return list<string>
     */
    public function getActiveFilters(): array
    {
        return $this->activeFilters;
    }
    /**
    * Filter axes that currently hold a value, so you can tell a connection that filters
    nothing from one that does without reading every field. An empty list means every
    charge reaches auto-invoicing.
    
    *
    * @param list<string> $activeFilters
    *
    * @return self
    */
    public function setActiveFilters(array $activeFilters): self
    {
        $this->initialized['activeFilters'] = true;
        $this->activeFilters = $activeFilters;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['id' => ['id', 'getId', 'setId'], 'provider' => ['provider', 'getProvider', 'setProvider'], 'externalAccountId' => ['external_account_id', 'getExternalAccountId', 'setExternalAccountId'], 'externalAccountName' => ['external_account_name', 'getExternalAccountName', 'setExternalAccountName'], 'environment' => ['environment', 'getEnvironment', 'setEnvironment'], 'status' => ['status', 'getStatus', 'setStatus'], 'connectedAt' => ['connected_at', 'getConnectedAt', 'setConnectedAt'], 'lastEventAt' => ['last_event_at', 'getLastEventAt', 'setLastEventAt'], 'autoInvoiceEnabled' => ['auto_invoice_enabled', 'getAutoInvoiceEnabled', 'setAutoInvoiceEnabled'], 'eventSource' => ['event_source', 'getEventSource', 'setEventSource'], 'autoCreateCustomer' => ['auto_create_customer', 'getAutoCreateCustomer', 'setAutoCreateCustomer'], 'sendInvoiceByEmail' => ['send_invoice_by_email', 'getSendInvoiceByEmail', 'setSendInvoiceByEmail'], 'pricesIncludeTax' => ['prices_include_tax', 'getPricesIncludeTax', 'setPricesIncludeTax'], 'taxInclusiveTax' => ['tax_inclusive_tax', 'getTaxInclusiveTax', 'setTaxInclusiveTax'], 'series' => ['series', 'getSeries', 'setSeries'], 'simplificadaThreshold' => ['simplificada_threshold', 'getSimplificadaThreshold', 'setSimplificadaThreshold'], 'filterConfig' => ['filter_config', 'getFilterConfig', 'setFilterConfig'], 'activeFilters' => ['active_filters', 'getActiveFilters', 'setActiveFilters']];
    }
}