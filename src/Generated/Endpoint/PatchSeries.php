<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\PatchSeriesBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\PatchSeriesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PatchSeriesInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\PatchSeriesNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\PatchSeriesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\PatchSeriesUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PatchSeries extends BaseEndpoint implements Endpoint
{
    protected $series_id;

    /**
     * **Deprecated.** Use `PATCH /v1/companies/{company_id}/series/{series_id}`, which behaves
     * identically.
     *
     * Updates only the fields present in the body, leaving every other field of the series as it
     * is.
     *
     * - **Clearing a field:** a field sent as `null` is cleared — only `description` supports it
     *   (see `PatchSeriesRequest`).
     * - **Numbering fields:** the same guard as `PUT`. `code`, `format`, `counter_reset` and
     *   `initial_number` are rejected once the series has issued invoices.
     * - **`default_series`:** it is not a way to clear the default. Sending `false` for the
     *   series that currently *is* the default is rejected with `DEFAULT_CANNOT_BE_UNMARKED`;
     *   promote another series with
     *   `PUT /v1/companies/{company_id}/series/{series_id}/default` instead. Sending `false` for
     *   a series that is *not* the default stays a no-op `200`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  string  $seriesId  Series ID
     */
    public function __construct(string $seriesId, PatchSeriesRequest $requestBody)
    {
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
        return str_replace(['{series_id}'], [rawurlencode($this->series_id)], '/v1/configuration/series/{series_id}');
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
     * @return null|V1ConfigurationSeriesSeriesIdPatchResponse200|ErrorResponse
     *
     * @throws PatchSeriesBadRequestException
     * @throws PatchSeriesUnauthorizedException
     * @throws PatchSeriesForbiddenException
     * @throws PatchSeriesNotFoundException
     * @throws PatchSeriesUnprocessableEntityException
     * @throws PatchSeriesInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchSeriesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchSeriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchSeriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchSeriesNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchSeriesUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchSeriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
