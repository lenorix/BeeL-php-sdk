<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListDeveloperRequestLogsBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ListDeveloperRequestLogsForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListDeveloperRequestLogsInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ListDeveloperRequestLogsUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\ListDeveloperRequestLogsUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\RequestLogListResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ListDeveloperRequestLogs extends BaseEndpoint implements Endpoint
{
    /**
     * Returns the history of public API requests made by you, with any of your API keys in this
     * environment — not only the key you are authenticating with. Only `auth_type=API_KEY`
     * traffic is recorded.
     *
     * - **Deprecated:** use `GET /v1/accounts/{account_id}/request-logs`, whose result set is
     *   identical.
     *
     * ## Whose traffic you see
     *
     * - **The axis is the person, not the individual credential:** a second key of yours sees the
     *   same history, and narrowing it to one key is a filter (`api_key_id`), not the default.
     *   Requests made by other users, including other users of the same account, are never
     *   returned.
     * - **Environment is not a filter:** results are always scoped to the environment of the
     *   credential you authenticate with — a `beel_sk_test_*` key sees the test traffic of all
     *   your test keys, a `beel_sk_live_*` key the live traffic of all your live ones. To see
     *   the other environment, use a key from that environment.
     *
     * ## Browsing the history
     *
     * - **Cursor pagination:** navigate with the opaque `cursor` returned in `next_cursor` /
     *   `prev_cursor`; there is no jump to an arbitrary page N.
     * - **Time window:** defaults to the last 30 days; narrow or move it with `from`/`to`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "only_errors"?: bool, //If true, only requests with status >= 400.
     *    "method"?: string, //Filter by HTTP method.
     *    "http_status"?: int, //Filter by an exact HTTP status code.
     *    "path_contains"?: string, //Filter by path substring (case-insensitive).
     *    "api_key_id"?: string, //Filter by a specific API key.
     *    "from"?: string, //Lower bound of the time range (inclusive). Defaults to 30 days ago.
     *    "to"?: string, //Upper bound of the time range (inclusive). Defaults to now.
     *    "cursor"?: string, //Opaque cursor returned by a previous response (next_cursor / prev_cursor).
     *    "limit"?: int,
     * } $queryParameters
     */
    public function __construct(array $queryParameters = [])
    {
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return '/v1/developers/request-logs';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): OptionsResolver
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
     *
     * @return null|RequestLogListResponse|ErrorResponse
     *
     * @throws ListDeveloperRequestLogsBadRequestException
     * @throws ListDeveloperRequestLogsUnauthorizedException
     * @throws ListDeveloperRequestLogsForbiddenException
     * @throws ListDeveloperRequestLogsUnprocessableEntityException
     * @throws ListDeveloperRequestLogsInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\RequestLogListResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListDeveloperRequestLogsBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListDeveloperRequestLogsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListDeveloperRequestLogsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListDeveloperRequestLogsUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListDeveloperRequestLogsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
