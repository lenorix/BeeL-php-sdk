<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk;

use GuzzleHttp\Client as GuzzleClient;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\AddPathPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\PluginClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Exception\BeelNotReadyError;
use Lenorix\BeelSdk\Generated\Client as JaneClient;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Http\BooleanQueryPlugin;
use Lenorix\BeelSdk\Http\DateTimeNormalizer;
use Lenorix\BeelSdk\Http\RequestOptions;
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
use Lenorix\BeelSdk\Resource\TemplatesResource;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

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

    /** CSV templates for bulk imports. */
    public TemplatesResource $templates;

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

    /** The transport with the API host, base path and authentication applied, for {@see self::request()}. */
    private ClientInterface $api;

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
        $plugins = [
            new AddHostPlugin($uri),
            new AddPathPlugin($uri),
            new HeaderDefaultsPlugin(['Authorization' => 'Bearer '.$apiKey]),
            new BooleanQueryPlugin,
        ];
        $this->raw = JaneClient::create($this->transport, $plugins, [new DateTimeNormalizer], applyServerPlugins: false);
        $this->api = new PluginClient($this->transport, $plugins);

        $this->catalogs = new CatalogsResource($this->raw, $this->responseContext);
        $this->nif = new NifResource($this->raw, $this->responseContext);
        $this->me = new MeResource($this->raw, $this->responseContext);
        $this->templates = new TemplatesResource($this->raw, $this->responseContext);
        $this->accounts = new AccountsResource($this->raw, $this->responseContext);
        $this->invoices = new InvoicesResource($this->raw, $this->responseContext);
        $this->customers = new CustomersResource($this->raw, $this->responseContext);
        $this->products = new ProductsResource($this->raw, $this->responseContext);
        $this->series = new SeriesResource($this->raw, $this->responseContext);
        $this->configuration = new ConfigurationResource($this->raw, $this->responseContext);
    }

    /**
     * The HTTP response of the last call made through this client, like Stripe's `getLastResponse()`.
     *
     * Useful to read what BeeL sent exactly, without repeating the request: headers, the status
     * code, or the raw JSON body, where date-times keep the nanoseconds that PHP's `DateTime`
     * cannot hold. JSON and error bodies are always readable from the start; the body of a
     * successful file download is the same stream the call returned. After a failed call it is
     * the error response; with retries, the last attempt.
     */
    public function getLastResponse(): ?ResponseInterface
    {
        $response = $this->responseContext->response();
        $body = $this->responseContext->body();

        return $response === null || $body === null
            ? $response
            : $response->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream($body));
    }

    /**
     * Call any API path, like the official Node.js SDK's `beel.raw.GET(...)`.
     *
     * Use it for operations without a convenience method. It shares the client's
     * authentication, retries and idempotency keys, and maps errors to {@see BeelApiError}
     * like every resource method. `{name}` placeholders in the path are filled from
     * `$pathParams`. In the query, booleans are sent as `true`/`false`, lists as a
     * comma-separated value, and maps as `name[key]=value`.
     *
     * @param  string  $method  HTTP method, such as `GET` or `POST`.
     * @param  string  $path  API path, such as `/v1/companies/{company_id}/logo`.
     * @param  array<string, string|int>  $pathParams  Values for the `{name}` placeholders.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  mixed  $body  JSON body: an array, a JSON-serializable object, or null for none.
     * @return mixed The decoded JSON response, including BeeL's envelope, or null for an empty body.
     *
     * @throws BeelApiError If BeeL answers outside `2xx`.
     * @throws \UnexpectedValueException If a successful response is not JSON, such as a file download.
     */
    public function request(string $method, string $path, array $pathParams = [], array $query = [], mixed $body = null, ?RequestOptions $options = null): mixed
    {
        $path = (string) preg_replace_callback('/\{([A-Za-z0-9_]+)\}/', static function (array $matches) use ($pathParams): string {
            if (! isset($pathParams[$matches[1]])) {
                throw new \InvalidArgumentException(sprintf('Missing path parameter "%s".', $matches[1]));
            }

            return rawurlencode((string) $pathParams[$matches[1]]);
        }, $path);
        $queryString = self::queryString($query);

        $request = Psr17FactoryDiscovery::findRequestFactory()->createRequest(strtoupper($method), $path.($queryString === '' ? '' : '?'.$queryString))
            ->withHeader('Accept', 'application/json');
        if ($body !== null) {
            $request = $request->withHeader('Content-Type', 'application/json')
                ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(json_encode($body, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRESERVE_ZERO_FRACTION)));
        }

        $this->responseContext->reset();
        $response = $this->responseContext->withRequestOptions($options, fn () => $this->api->sendRequest($request));
        if ($response->getStatusCode() >= 400) {
            throw BeelApiError::fromErrorResponse(new ErrorResponse, $response, (string) $response->getBody());
        }
        // Check the type before reading, so a file is never loaded into memory here.
        $contentType = $response->getHeaderLine('Content-Type');
        if ($contentType !== '' && ! str_contains(strtolower($contentType), 'json')) {
            throw new \UnexpectedValueException(sprintf('BeeL answered %s, not JSON. request() is for JSON endpoints; use createPdfArchive(), export() or getPdf() for files.', $contentType));
        }
        $contents = (string) $response->getBody();

        return $contents === '' ? null : json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
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

    /**
     * @param  array<array-key, mixed>  $query
     */
    private static function queryString(array $query, ?string $prefix = null): string
    {
        $pairs = [];
        foreach ($query as $key => $value) {
            $name = $prefix === null ? (string) $key : $prefix.'['.$key.']';
            if ($value === null) {
                continue;
            }
            if (is_array($value) && ! array_is_list($value)) {
                $nested = self::queryString($value, $name);
                if ($nested !== '') {
                    $pairs[] = $nested;
                }

                continue;
            }
            $value = is_array($value)
                ? implode(',', array_map(static fn (mixed $item): string => is_bool($item) ? ($item ? 'true' : 'false') : (string) $item, $value))
                : (is_bool($value) ? ($value ? 'true' : 'false') : (string) $value);
            $pairs[] = rawurlencode($name).'='.rawurlencode($value);
        }

        return implode('&', $pairs);
    }
}
