<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteCompanySeriesBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanySeriesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanySeriesInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanySeriesNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanySeriesTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanySeriesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteCompanySeries extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $series_id;

    /**
     * Soft-deletes an invoice series, deactivating it first if it is active.
     *
     * - **The code is not released:** it stays taken after the deletion because it identifies the
     *   invoices already issued under it, so recreating a series with the same code answers
     *   `409 SERIES_CODE_DUPLICATED`.
     * - **Default series:** it cannot be deleted while another active series of the same document
     *   type exists — promote that other one first. If it is the only series of its type it is
     *   deleted and the type is left with none, a valid state in which issuing without an
     *   explicit `series_id` answers `SERIES_DEFAULT_NOT_FOUND`.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $seriesId  Series ID
     */
    public function __construct(string $companyId, string $seriesId)
    {
        $this->company_id = $companyId;
        $this->series_id = $seriesId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{series_id}'], [rawurlencode($this->company_id), rawurlencode($this->series_id)], '/v1/companies/{company_id}/series/{series_id}');
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
     * @return null|ErrorResponse
     *
     * @throws DeleteCompanySeriesBadRequestException
     * @throws DeleteCompanySeriesUnauthorizedException
     * @throws DeleteCompanySeriesForbiddenException
     * @throws DeleteCompanySeriesNotFoundException
     * @throws DeleteCompanySeriesTooManyRequestsException
     * @throws DeleteCompanySeriesInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanySeriesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanySeriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanySeriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanySeriesNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanySeriesTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanySeriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
