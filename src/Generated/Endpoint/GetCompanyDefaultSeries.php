<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetCompanyDefaultSeriesBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyDefaultSeriesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyDefaultSeriesInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyDefaultSeriesTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyDefaultSeriesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesDefaultsGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetCompanyDefaultSeries extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Reports, for each `DocumentType` used by automatic invoicing flows, whether the company
     * (NIF) has a default invoice series and which one: `exists`, plus the `series_id` when there
     * is one.
     *
     * - **No default:** that document type cannot be issued without naming a `series_id`
     *   explicitly, and automatic flows skip it with
     *   `failure.payment.skip.missing_default_series`.
     * - **Environment:** resolved from the request context; it takes no input.
     *
     * **Closed catalogue.** This collection is fixed and bounded — one entry per `DocumentType`:
     * it carries no `pagination`, it takes no `page`/`limit`, and every response holds the whole
     * set.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     */
    public function __construct(string $companyId)
    {
        $this->company_id = $companyId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/series/defaults');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1CompaniesCompanyIdSeriesDefaultsGetResponse200|ErrorResponse
     *
     * @throws GetCompanyDefaultSeriesBadRequestException
     * @throws GetCompanyDefaultSeriesUnauthorizedException
     * @throws GetCompanyDefaultSeriesForbiddenException
     * @throws GetCompanyDefaultSeriesTooManyRequestsException
     * @throws GetCompanyDefaultSeriesInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesDefaultsGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyDefaultSeriesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyDefaultSeriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyDefaultSeriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyDefaultSeriesTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyDefaultSeriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
