<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListCompanySeriesBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanySeriesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanySeriesInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanySeriesTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanySeriesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanySeriesUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ListCompanySeries extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Returns the invoice series of a company.
     *
     * - **Filters:** `active` restricts to active or inactive series — omit it and you get all of
     *   them. `document_type` filters by type and always includes the `UNASSIGNED` series, which
     *   are compatible with any type.
     * - **Pagination (opt-in):** send `page` and/or `limit` to receive a single page plus a
     *   `data.pagination` block with the totals. Omit both and the response carries the full list
     *   in `data.series` and no `pagination` block.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param array{
     *    "active"?: bool, //Filters by activity: `true` returns only active series, `false` only inactive ones.
    Omit it and you get **all** the series, active and inactive.
     *    "document_type"?: string, //Filter by document type (UNASSIGNED series are always included)
     *    "page"?: int, //Page number (starts at 1). Omit for the full, unpaginated list.
     *    "limit"?: int, //Items per page. Omit for the full, unpaginated list.
     * } $queryParameters
     */
    public function __construct(string $companyId, array $queryParameters = [])
    {
        $this->company_id = $companyId;
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/series');
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
     * @return null|V1CompaniesCompanyIdSeriesGetResponse200|ErrorResponse
     *
     * @throws ListCompanySeriesBadRequestException
     * @throws ListCompanySeriesUnauthorizedException
     * @throws ListCompanySeriesForbiddenException
     * @throws ListCompanySeriesUnprocessableEntityException
     * @throws ListCompanySeriesTooManyRequestsException
     * @throws ListCompanySeriesInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanySeriesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanySeriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanySeriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanySeriesUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanySeriesTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanySeriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
