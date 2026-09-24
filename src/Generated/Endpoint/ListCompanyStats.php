<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListCompanyStatsBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyStatsForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyStatsInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyStatsTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyStatsUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\ListCompanyStats200Response;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ListCompanyStats extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    /**
     * Returns, for each company of the account, how many fiscal documents it has
     * issued and when it last issued one.
     *
     * - **`invoice_count`:** drafts, scheduled invoices and proformas are not counted; a
     *   rectifying invoice counts as a document of its own, and a voided invoice counts only
     *   when a live rectifying invoice compensates it.
     * - **`last_invoice_at`:** issue date of the most recent document in that same set, or
     *   `null` when there is none.
     * - **Not a cursor:** the count is not monotonic — voiding an uncompensated invoice
     *   lowers it and moves `last_invoice_at` backwards — so do not synchronise on it.
     *
     * **Paginated** with the usual `page`/`limit`, and the usual defaults: without them you get
     * the stats of the first 20 companies, not of all of them. One row per company, over the same
     * universe and in the same order as `GET /v1/accounts/{account_id}/companies` — `search`
     * included — so asking both with the same `page`, `limit` and `search` lines the two
     * responses up company by company.
     *
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "search"?: string, //Case-insensitive filter on NIF, legal name or trade name — the same filter, over the same universe, as the one `GET /v1/accounts/{account_id}/companies` applies. Blank or omitted returns all.
     * } $queryParameters
     */
    public function __construct(string $accountId, array $queryParameters = [])
    {
        $this->account_id = $accountId;
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}'], [rawurlencode($this->account_id)], '/v1/accounts/{account_id}/companies/stats');
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
        $optionsResolver->setDefined(['page', 'limit', 'search']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['page' => 1, 'limit' => 20]);
        $optionsResolver->addAllowedTypes('page', ['int']);
        $optionsResolver->addAllowedTypes('limit', ['int']);
        $optionsResolver->addAllowedTypes('search', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|ListCompanyStats200Response|ErrorResponse
     *
     * @throws ListCompanyStatsBadRequestException
     * @throws ListCompanyStatsUnauthorizedException
     * @throws ListCompanyStatsForbiddenException
     * @throws ListCompanyStatsTooManyRequestsException
     * @throws ListCompanyStatsInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ListCompanyStats200Response', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyStatsBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyStatsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyStatsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyStatsTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyStatsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
