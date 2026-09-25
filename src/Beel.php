<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk;

use GuzzleHttp\Client as GuzzleClient;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\AddPathPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Lenorix\BeelSdk\Generated\Client as JaneClient;
use Lenorix\BeelSdk\Generated\Model\InvoicePdfResponseData;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Http\RetryingClient;
use Lenorix\BeelSdk\Resource\AccountScope;
use Lenorix\BeelSdk\Resource\AccountsResource;
use Lenorix\BeelSdk\Resource\CatalogsResource;
use Lenorix\BeelSdk\Resource\CompanyScope;
use Lenorix\BeelSdk\Resource\ConfigurationResource;
use Lenorix\BeelSdk\Resource\CustomersResource;
use Lenorix\BeelSdk\Resource\InvoicesResource;
use Lenorix\BeelSdk\Resource\NifResource;
use Lenorix\BeelSdk\Resource\ProductsResource;
use Lenorix\BeelSdk\Resource\SeriesResource;
use Psr\Http\Client\ClientInterface;

final readonly class Beel
{
    public JaneClient $raw;

    public CatalogsResource $catalogs;

    public NifResource $nif;

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
        $this->accounts = new AccountsResource($this->raw, $this->responseContext);
        $this->invoices = new InvoicesResource($this->raw, $this->responseContext);
        $this->customers = new CustomersResource($this->raw, $this->responseContext);
        $this->products = new ProductsResource($this->raw, $this->responseContext);
        $this->series = new SeriesResource($this->raw, $this->responseContext);
        $this->configuration = new ConfigurationResource($this->raw, $this->responseContext);
    }

    public function company(string $companyId): CompanyScope
    {
        return new CompanyScope($this->raw, $companyId, $this->responseContext);
    }

    public function account(string $accountId): AccountScope
    {
        return new AccountScope($this->raw, $accountId, $this->responseContext);
    }

    /**
     * @deprecated Uses the legacy session-focus endpoint. Use company($id)->invoices->getPdf() and its download URL.
     *
     * @return array{buffer: string, fileName: string}
     */
    public function downloadPdf(string $invoiceId): array
    {
        /** @var InvoicePdfResponseData|null $pdf */
        $pdf = $this->invoices->getPdf($invoiceId);
        if (! $pdf instanceof InvoicePdfResponseData) {
            throw new \RuntimeException('\Lenorix\BeelSdk\Generated\Model\Invoice PDF is still being generated; retry the request later.');
        }

        $request = Psr17FactoryDiscovery::findRequestFactory()->createRequest('GET', $pdf->getDownloadUrl());
        $response = $this->transport->sendRequest($request);
        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            throw new \RuntimeException('Failed to download invoice PDF: HTTP '.$response->getStatusCode());
        }

        return ['buffer' => (string) $response->getBody(), 'fileName' => $pdf->getFileName()];
    }
}
