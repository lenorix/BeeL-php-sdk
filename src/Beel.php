<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk;

use GuzzleHttp\Client as GuzzleClient;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\AddPathPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Lenorix\BeelSdk\Exception\BeelNotReadyError;
use Lenorix\BeelSdk\Generated\Client as JaneClient;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Http\RetryingClient;
use Lenorix\BeelSdk\Resource\AccountScope;
use Lenorix\BeelSdk\Resource\AccountsResource;
use Lenorix\BeelSdk\Resource\CatalogsResource;
use Lenorix\BeelSdk\Resource\CompanyScope;
use Lenorix\BeelSdk\Resource\ConfigurationResource;
use Lenorix\BeelSdk\Resource\CustomersResource;
use Lenorix\BeelSdk\Resource\InvoicesResource;
use Lenorix\BeelSdk\Resource\MeResource;
use Lenorix\BeelSdk\Resource\NifResource;
use Lenorix\BeelSdk\Resource\ProductsResource;
use Lenorix\BeelSdk\Resource\SeriesResource;
use Psr\Http\Client\ClientInterface;

/**
 * Instance-based client for the BeeL API.
 *
 * Each instance keeps its own API key and HTTP transport. Use {@see self::company()}
 * for company-owned data so every request names the NIF it operates on.
 */
final readonly class Beel
{
    /** The generated Jane client for calling any operation in the OpenAPI contract directly. */
    public JaneClient $raw;

    /** Shared catalogs such as tax types and invoice customization options. */
    public CatalogsResource $catalogs;

    /** AEAT NIF validation. */
    public NifResource $nif;

    /** The authenticated principal: its account, environment and scopes. */
    public MeResource $me;

    /** Account-wide operations and account scoping. */
    public AccountsResource $accounts;

    /** @deprecated Use company($companyId)->invoices instead. */
    public InvoicesResource $invoices;

    /** @deprecated Use company($companyId)->customers instead. */
    public CustomersResource $customers;

    /** @deprecated Use company($companyId)->products instead. */
    public ProductsResource $products;

    /** @deprecated Use company($companyId)->series instead. */
    public SeriesResource $series;

    /** @deprecated Use company($companyId)->taxConfiguration instead. */
    public ConfigurationResource $configuration;

    private ClientInterface $transport;

    private ResponseContext $responseContext;

    /**
     * Create an authenticated BeeL API client.
     *
     * @param  string  $apiKey  BeeL API key. Test keys route requests to sandbox; live keys use production.
     * @param  string  $baseUrl  API base URL. Defaults to `https://app.beel.es/api`.
     * @param  int  $maxRetries  Maximum retries for HTTP 429 and 5xx responses. Defaults to 3.
     * @param  int  $retryDelayMs  Initial retry delay in milliseconds; delays use exponential backoff.
     * @param  int  $maxRetryDelayMs  Maximum retry delay in milliseconds.
     * @param  bool  $autoIdempotencyKey  Add one stable `Idempotency-Key` to each POST request.
     * @param  ClientInterface|null  $httpClient  Optional PSR-18 transport, useful for custom transports and tests.
     */
    public function __construct(
        string $apiKey,
        string $baseUrl = 'https://app.beel.es/api',
        int $maxRetries = RetryingClient::DEFAULT_MAX_RETRIES,
        int $retryDelayMs = RetryingClient::DEFAULT_RETRY_DELAY_MS,
        int $maxRetryDelayMs = RetryingClient::DEFAULT_MAX_RETRY_DELAY_MS,
        bool $autoIdempotencyKey = true,
        ?ClientInterface $httpClient = null,
    ) {
        if (trim($apiKey) === '') {
            throw new \InvalidArgumentException('BeeL API key must not be empty.');
        }
        if (filter_var($baseUrl, FILTER_VALIDATE_URL) === false || ! in_array(parse_url($baseUrl, PHP_URL_SCHEME), ['http', 'https'], true) || parse_url($baseUrl, PHP_URL_HOST) === null) {
            throw new \InvalidArgumentException('BeeL base URL must be an absolute HTTP or HTTPS URL.');
        }

        $uri = Psr17FactoryDiscovery::findUriFactory()->createUri(rtrim($baseUrl, '/'));
        $this->responseContext = new ResponseContext;
        $this->transport = new RetryingClient($httpClient ?? new GuzzleClient, $maxRetries, $retryDelayMs, $maxRetryDelayMs, $autoIdempotencyKey, $this->responseContext);
        $this->raw = JaneClient::create($this->transport, [
            new AddHostPlugin($uri),
            new AddPathPlugin($uri),
            new HeaderDefaultsPlugin(['Authorization' => 'Bearer '.$apiKey]),
        ], applyServerPlugins: false);

        $this->catalogs = new CatalogsResource($this->raw, $this->responseContext);
        $this->nif = new NifResource($this->raw, $this->responseContext);
        $this->me = new MeResource($this->raw, $this->responseContext);
        $this->accounts = new AccountsResource($this->raw, $this->responseContext);
        $this->invoices = new InvoicesResource($this->raw, $this->responseContext);
        $this->customers = new CustomersResource($this->raw, $this->responseContext);
        $this->products = new ProductsResource($this->raw, $this->responseContext);
        $this->series = new SeriesResource($this->raw, $this->responseContext);
        $this->configuration = new ConfigurationResource($this->raw, $this->responseContext);
    }

    /**
     * Scope subsequent resource calls to one company (NIF).
     *
     * @param  string  $companyId  Company UUID returned by BeeL, not the company's NIF.
     */
    public function company(string $companyId): CompanyScope
    {
        return new CompanyScope($this->raw, $companyId, $this->responseContext);
    }

    /** Scope account-level resources to one account UUID. */
    public function account(string $accountId): AccountScope
    {
        return new AccountScope($this->raw, $accountId, $this->responseContext);
    }

    /**
     * Download an invoice PDF and return its binary contents and suggested filename.
     *
     * @deprecated Uses the legacy session-focus endpoint. Use `company($id)->invoices->getPdf()` and download its temporary URL.
     *
     * @return array{buffer: string, fileName: string}
     *
     * @throws BeelNotReadyError If the PDF is still being generated (HTTP 202).
     */
    public function downloadPdf(string $invoiceId): array
    {
        $pdf = $this->invoices->getPdf($invoiceId);

        $request = Psr17FactoryDiscovery::findRequestFactory()->createRequest('GET', $pdf->getDownloadUrl());
        $response = $this->transport->sendRequest($request);
        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            throw new \RuntimeException('Failed to download invoice PDF: HTTP '.$response->getStatusCode());
        }

        return ['buffer' => (string) $response->getBody(), 'fileName' => $pdf->getFileName()];
    }
}
