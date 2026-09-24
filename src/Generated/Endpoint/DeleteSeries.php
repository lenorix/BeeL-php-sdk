<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteSeriesBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\DeleteSeriesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteSeriesInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeleteSeriesNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\DeleteSeriesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteSeries extends BaseEndpoint implements Endpoint
{
    protected $series_id;

    /**
     * **Deprecated.** Use `DELETE /v1/companies/{company_id}/series/{series_id}`, which
     * behaves identically.
     *
     * Soft-deletes an invoice series. If the series is active, it is automatically deactivated
     * before deletion.
     *
     * - **The code is NOT released:** it stays taken even after deletion, because it identifies
     *   invoices already issued under it. Recreating a series with the same code returns
     *   `409 SERIES_CODE_DUPLICATED`, so always pick a new code.
     * - **Default series:** it cannot be deleted *while another active series of the same
     *   document type exists* — promote that other one first. If it is the only series of its
     *   type, it can be deleted and the type is left with no series: a valid state in which
     *   issuing without an explicit series returns `SERIES_DEFAULT_NOT_FOUND`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  string  $seriesId  Series ID
     */
    public function __construct(string $seriesId)
    {
        $this->series_id = $seriesId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{series_id}'], [rawurlencode($this->series_id)], '/v1/configuration/series/{series_id}');
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
     * @throws DeleteSeriesBadRequestException
     * @throws DeleteSeriesUnauthorizedException
     * @throws DeleteSeriesForbiddenException
     * @throws DeleteSeriesNotFoundException
     * @throws DeleteSeriesInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteSeriesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteSeriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteSeriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteSeriesNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteSeriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
