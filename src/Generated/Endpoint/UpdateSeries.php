<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class UpdateSeries extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
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
     * @param string $seriesId Series ID
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateSeriesRequest $requestBody
     */
    public function __construct(string $seriesId, \Lenorix\BeelSdk\Generated\Model\UpdateSeriesRequest $requestBody)
    {
        $this->series_id = $seriesId;
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PUT';
    }
    public function getUri(): string
    {
        return str_replace(['{series_id}'], [rawurlencode($this->series_id)], '/v1/configuration/series/{series_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\UpdateSeriesRequest) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPutResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateSeriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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