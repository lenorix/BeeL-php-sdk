<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class ListAccountRequestLogs extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $account_id;
    /**
     * Returns the history of public API requests made by you, with any of your API keys in this
     * environment — not only the key you are authenticating with. Only `auth_type=API_KEY`
     * traffic is recorded.
     *
     * - **The axis is the person, not the individual credential:** a second key of yours sees the
     *   same history, and narrowing it to one key is a filter (`api_key_id`), not the default.
     * - **It is still not the account's traffic:** requests made by other users of the same
     *   account, or by their API keys, are never returned. The `{account_id}` in the path
     *   authorizes the call; it does not widen what you can see.
     * - **Environment is not a filter:** results are always scoped to the environment of the
     *   credential you authenticate with — a `beel_sk_test_*` key sees the test traffic of all
     *   your test keys, a `beel_sk_live_*` key the live traffic of all your live ones. To see
     *   the other environment, use a key from that environment.
     * - **Cursor pagination:** navigate with the opaque `cursor` returned in `next_cursor` /
     *   `prev_cursor`; there is no jump to an arbitrary page N.
     * - **Time window:** defaults to the last 30 days; narrow or move it with `from`/`to`.
     *
     * @param string $accountId Account the call is authorized against. It does not widen the result set.
     * @param array{
     *    "only_errors"?: bool, //If true, only requests with status >= 400.
     *    "method"?: string, //Filter by HTTP method.
     *    "http_status"?: int, //Filter by an exact HTTP status code.
     *    "path_contains"?: string, //Case-insensitive substring of the actual request path, IDs included (for example `/v1/companies/3f1c9a2e-5b7d-4e8f-9a1b-2c3d4e5f6a7b/invoices/8a2b4c6d-1e3f-4a5b-8c7d-9e0f1a2b3c4d/send`), so a path template with `{placeholders}` never matches, and a full path only matches requests made to that exact route shape. Prefer a resource segment such as `/invoices`, which matches that resource on every route that serves it.
     *    "api_key_id"?: string, //Narrow the result to one of your API keys. Any key of yours in this environment is accepted, not just the one you authenticate with; a key belonging to someone else simply yields no results.
     *    "from"?: string, //Lower bound of the time range (inclusive). Defaults to 30 days ago.
     *    "to"?: string, //Upper bound of the time range (inclusive). Defaults to now.
     *    "cursor"?: string, //Opaque cursor returned by a previous response (next_cursor / prev_cursor).
     *    "limit"?: int, //Maximum number of log entries in the page, from 1 to 100. Defaults to 25.
     * } $queryParameters
     */
    public function __construct(string $accountId, array $queryParameters = [])
    {
        $this->account_id = $accountId;
        $this->queryParameters = $queryParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{account_id}'], [rawurlencode($this->account_id)], '/v1/accounts/{account_id}/request-logs');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['only_errors', 'method', 'http_status', 'path_contains', 'api_key_id', 'from', 'to', 'cursor', 'limit']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['only_errors' => false, 'limit' => 25]);
        $optionsResolver->addAllowedTypes('only_errors', ['bool']);
        $optionsResolver->addAllowedTypes('method', ['string']);
        $optionsResolver->addAllowedTypes('http_status', ['int']);
        $optionsResolver->addAllowedTypes('path_contains', ['string']);
        $optionsResolver->addAllowedTypes('api_key_id', ['string']);
        $optionsResolver->addAllowedTypes('from', ['string']);
        $optionsResolver->addAllowedTypes('to', ['string']);
        $optionsResolver->addAllowedTypes('cursor', ['string']);
        $optionsResolver->addAllowedTypes('limit', ['int']);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\RequestLogListResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\RequestLogListResponse', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListAccountRequestLogsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (stripos(strtolower($contentType), 'application/json') !== false) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json');
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['ApiKeyAuth'];
    }
}