<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class RequestLogDetail implements AdditionalPropertiesInterface
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
     * Request correlation identifier (X-Request-Id header).
     *
     * @var string
     */
    protected $requestId;

    /**
     * Time the request was received.
     *
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected $httpMethod;

    /**
     * @var string
     */
    protected $httpPath;

    /**
     * @var int
     */
    protected $httpStatus;

    /**
     * Request latency in milliseconds.
     *
     * @var int|null
     */
    protected $durationMs;

    /**
     * @var string|null
     */
    protected $environment;

    /**
     * Id of the API key the request authenticated with.
     *
     * @var string|null
     */
    protected $apiKeyId;

    /**
     * Public error code returned (e.g. INVOICE_NOT_FOUND). Null if the request succeeded.
     *
     * @var string|null
     */
    protected $errorCode;

    /**
     * @var string|null
     */
    protected $clientIp;

    /**
     * @var string|null
     */
    protected $queryString;

    /**
     * @var string|null
     */
    protected $userAgent;

    /**
     * Request body (truncated by the ingestor; no sensitive headers).
     *
     * @var string|null
     */
    protected $requestBody;

    /**
     * Response body (truncated by the ingestor).
     *
     * @var string|null
     */
    protected $responseBody;

    /**
     * @var array<string, string>|null
     */
    protected $requestHeaders;

    /**
     * @var array<string, string>|null
     */
    protected $responseHeaders;

    /**
     * Request correlation identifier (X-Request-Id header).
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }

    /**
     * Request correlation identifier (X-Request-Id header).
     */
    public function setRequestId(string $requestId): self
    {
        $this->initialized['requestId'] = true;
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * Time the request was received.
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }

    /**
     * Time the request was received.
     */
    public function setTimestamp(\DateTime $timestamp): self
    {
        $this->initialized['timestamp'] = true;
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    public function setHttpMethod(string $httpMethod): self
    {
        $this->initialized['httpMethod'] = true;
        $this->httpMethod = $httpMethod;

        return $this;
    }

    public function getHttpPath(): string
    {
        return $this->httpPath;
    }

    public function setHttpPath(string $httpPath): self
    {
        $this->initialized['httpPath'] = true;
        $this->httpPath = $httpPath;

        return $this;
    }

    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    public function setHttpStatus(int $httpStatus): self
    {
        $this->initialized['httpStatus'] = true;
        $this->httpStatus = $httpStatus;

        return $this;
    }

    /**
     * Request latency in milliseconds.
     */
    public function getDurationMs(): ?int
    {
        return $this->durationMs;
    }

    /**
     * Request latency in milliseconds.
     */
    public function setDurationMs(?int $durationMs): self
    {
        $this->initialized['durationMs'] = true;
        $this->durationMs = $durationMs;

        return $this;
    }

    public function getEnvironment(): ?string
    {
        return $this->environment;
    }

    public function setEnvironment(?string $environment): self
    {
        $this->initialized['environment'] = true;
        $this->environment = $environment;

        return $this;
    }

    /**
     * Id of the API key the request authenticated with.
     */
    public function getApiKeyId(): ?string
    {
        return $this->apiKeyId;
    }

    /**
     * Id of the API key the request authenticated with.
     */
    public function setApiKeyId(?string $apiKeyId): self
    {
        $this->initialized['apiKeyId'] = true;
        $this->apiKeyId = $apiKeyId;

        return $this;
    }

    /**
     * Public error code returned (e.g. INVOICE_NOT_FOUND). Null if the request succeeded.
     */
    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    /**
     * Public error code returned (e.g. INVOICE_NOT_FOUND). Null if the request succeeded.
     */
    public function setErrorCode(?string $errorCode): self
    {
        $this->initialized['errorCode'] = true;
        $this->errorCode = $errorCode;

        return $this;
    }

    public function getClientIp(): ?string
    {
        return $this->clientIp;
    }

    public function setClientIp(?string $clientIp): self
    {
        $this->initialized['clientIp'] = true;
        $this->clientIp = $clientIp;

        return $this;
    }

    public function getQueryString(): ?string
    {
        return $this->queryString;
    }

    public function setQueryString(?string $queryString): self
    {
        $this->initialized['queryString'] = true;
        $this->queryString = $queryString;

        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function setUserAgent(?string $userAgent): self
    {
        $this->initialized['userAgent'] = true;
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Request body (truncated by the ingestor; no sensitive headers).
     */
    public function getRequestBody(): ?string
    {
        return $this->requestBody;
    }

    /**
     * Request body (truncated by the ingestor; no sensitive headers).
     */
    public function setRequestBody(?string $requestBody): self
    {
        $this->initialized['requestBody'] = true;
        $this->requestBody = $requestBody;

        return $this;
    }

    /**
     * Response body (truncated by the ingestor).
     */
    public function getResponseBody(): ?string
    {
        return $this->responseBody;
    }

    /**
     * Response body (truncated by the ingestor).
     */
    public function setResponseBody(?string $responseBody): self
    {
        $this->initialized['responseBody'] = true;
        $this->responseBody = $responseBody;

        return $this;
    }

    /**
     * @return array<string, string>|null
     */
    public function getRequestHeaders(): ?iterable
    {
        return $this->requestHeaders;
    }

    /**
     * @param  array<string, string>|null  $requestHeaders
     */
    public function setRequestHeaders(?iterable $requestHeaders): self
    {
        $this->initialized['requestHeaders'] = true;
        $this->requestHeaders = $requestHeaders;

        return $this;
    }

    /**
     * @return array<string, string>|null
     */
    public function getResponseHeaders(): ?iterable
    {
        return $this->responseHeaders;
    }

    /**
     * @param  array<string, string>|null  $responseHeaders
     */
    public function setResponseHeaders(?iterable $responseHeaders): self
    {
        $this->initialized['responseHeaders'] = true;
        $this->responseHeaders = $responseHeaders;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['requestId' => ['request_id', 'getRequestId', 'setRequestId'], 'timestamp' => ['timestamp', 'getTimestamp', 'setTimestamp'], 'httpMethod' => ['http_method', 'getHttpMethod', 'setHttpMethod'], 'httpPath' => ['http_path', 'getHttpPath', 'setHttpPath'], 'httpStatus' => ['http_status', 'getHttpStatus', 'setHttpStatus'], 'durationMs' => ['duration_ms', 'getDurationMs', 'setDurationMs'], 'environment' => ['environment', 'getEnvironment', 'setEnvironment'], 'apiKeyId' => ['api_key_id', 'getApiKeyId', 'setApiKeyId'], 'errorCode' => ['error_code', 'getErrorCode', 'setErrorCode'], 'clientIp' => ['client_ip', 'getClientIp', 'setClientIp'], 'queryString' => ['query_string', 'getQueryString', 'setQueryString'], 'userAgent' => ['user_agent', 'getUserAgent', 'setUserAgent'], 'requestBody' => ['request_body', 'getRequestBody', 'setRequestBody'], 'responseBody' => ['response_body', 'getResponseBody', 'setResponseBody'], 'requestHeaders' => ['request_headers', 'getRequestHeaders', 'setRequestHeaders'], 'responseHeaders' => ['response_headers', 'getResponseHeaders', 'setResponseHeaders']];
    }
}
