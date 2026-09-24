<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListSeriesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListSeriesInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ListSeriesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ListSeries extends BaseEndpoint implements Endpoint
{
    /**
     * **Deprecated.** Use `GET /v1/companies/{company_id}/series`, which behaves identically.
     *
     * Retrieves the invoice series of the company in focus. The listing is always scoped
     * to one company; it never spans several.
     *
     * - **Filters:** `active` restricts to active or inactive series — omit it and you get all of
     *   them. `document_type` filters by type and always includes the `UNASSIGNED` series.
     * - **Pagination (opt-in):** send `page` and/or `limit` to receive a single page plus a
     *   `data.pagination` block with the totals. Omit both and the response carries the full list
     *   in `data.series` and no `pagination` block.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "active"?: bool, //Filters by activity: `true` returns only active series, `false` only inactive ones.
    Omit it and you get **all** the series, active and inactive.
     *    "document_type"?: string, //Filter by document type (UNASSIGNED series are always included)
     *    "page"?: int, //Page number (starts at 1). Omit for the full, unpaginated list.
     *    "limit"?: int, //Items per page. Omit for the full, unpaginated list.
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
        return '/v1/configuration/series';
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
        $optionsResolver->setDefined(['active', 'document_type', 'page', 'limit']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('active', ['bool']);
        $optionsResolver->addAllowedTypes('document_type', ['string']);
        $optionsResolver->addAllowedTypes('page', ['int']);
        $optionsResolver->addAllowedTypes('limit', ['int']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1ConfigurationSeriesGetResponse200|ErrorResponse
     *
     * @throws ListSeriesUnauthorizedException
     * @throws ListSeriesForbiddenException
     * @throws ListSeriesInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListSeriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListSeriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListSeriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
