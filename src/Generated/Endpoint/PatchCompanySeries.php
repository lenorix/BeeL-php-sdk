<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanySeriesUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesSeriesIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PatchCompanySeries extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $series_id;

    /**
     * Updates only the fields present in the body, leaving every other field of the series as
     * it is.
     *
     * - **Clearing a field:** a field sent as `null` is cleared, which only `description`
     *   supports.
     * - **Numbering fields:** `code`, `format`, `counter_reset` and `initial_number` are rejected
     *   once the series has issued invoices (`numbering_locked` is `true`).
     * - **`default_series`:** it cannot be used to clear the default. Sending `false` for the
     *   series that currently is the default answers `DEFAULT_CANNOT_BE_UNMARKED`, because it
     *   would leave the document type with active series and no default, and issuing without an
     *   explicit `series_id` would then fail with `SERIES_DEFAULT_NOT_FOUND`. Hand the default
     *   over with `PUT /v1/companies/{company_id}/series/{series_id}/default` on the new series,
     *   which unmarks the previous one. Sending `false` for a series that is not the default is a
     *   no-op.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $seriesId  Series ID
     */
    public function __construct(string $companyId, string $seriesId, PatchSeriesRequest $requestBody)
    {
        $this->company_id = $companyId;
        $this->series_id = $seriesId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{series_id}'], [rawurlencode($this->company_id), rawurlencode($this->series_id)], '/v1/companies/{company_id}/series/{series_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof PatchSeriesRequest) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
        }

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
     * @return null|V1CompaniesCompanyIdSeriesSeriesIdPatchResponse200|ErrorResponse
     *
     * @throws PatchCompanySeriesBadRequestException
     * @throws PatchCompanySeriesUnauthorizedException
     * @throws PatchCompanySeriesForbiddenException
     * @throws PatchCompanySeriesNotFoundException
     * @throws PatchCompanySeriesUnprocessableEntityException
     * @throws PatchCompanySeriesTooManyRequestsException
     * @throws PatchCompanySeriesInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesSeriesIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanySeriesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanySeriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanySeriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanySeriesNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanySeriesUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanySeriesTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanySeriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
