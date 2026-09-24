<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\UpdateSeriesBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\UpdateSeriesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\UpdateSeriesInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\UpdateSeriesNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\UpdateSeriesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\UpdateSeriesUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\UpdateSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPutResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateSeries extends BaseEndpoint implements Endpoint
{
    protected $series_id;

    /**
     * **Deprecated.** The canonical form has a single update verb,
     * `PATCH /v1/companies/{company_id}/series/{series_id}`. The same body produces the same
     * result there — this route already merges field by field, leaving absent fields untouched —
     * with one difference: an explicit `description: null`, which this route ignores, clears the
     * description under `PATCH`.
     *
     * Updates an existing invoice series with the body you send; absent fields keep their value.
     *
     * - **Numbering fields:** `code`, `format`, `counter_reset` and `initial_number` are rejected
     *   once the series has issued invoices (`numbering_locked` is `true`). `name`,
     *   `description`, `active`, `default_series` and `document_type` can always be changed.
     * - **`active`:** a default series cannot be deactivated — set another one as default first.
     * - **`default_series`:** sending `false` on the series that currently is the default is
     *   rejected with `DEFAULT_CANNOT_BE_UNMARKED`. Promote another series with
     *   `PUT /v1/companies/{company_id}/series/{series_id}/default`, which unmarks the previous
     *   one for you. An inactive series cannot be marked as default.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  string  $seriesId  Series ID
     */
    public function __construct(string $seriesId, UpdateSeriesRequest $requestBody)
    {
        $this->series_id = $seriesId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{series_id}'], [rawurlencode($this->series_id)], '/v1/configuration/series/{series_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof UpdateSeriesRequest) {
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
     * @return null|V1ConfigurationSeriesSeriesIdPutResponse200|ErrorResponse
     *
     * @throws UpdateSeriesBadRequestException
     * @throws UpdateSeriesUnauthorizedException
     * @throws UpdateSeriesForbiddenException
     * @throws UpdateSeriesNotFoundException
     * @throws UpdateSeriesUnprocessableEntityException
     * @throws UpdateSeriesInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPutResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateSeriesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateSeriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateSeriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateSeriesNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateSeriesUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateSeriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
