<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class PatchSeries extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
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
     * @param string $seriesId Series ID
     * @param \Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest $requestBody
     */
    public function __construct(string $seriesId, \Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest $requestBody)
    {
        $this->series_id = $seriesId;
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PATCH';
    }
    public function getUri(): string
    {
        return str_replace(['{series_id}'], [rawurlencode($this->series_id)], '/v1/configuration/series/{series_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest) {
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchSeriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchSeriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchSeriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchSeriesNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchSeriesUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchSeriesInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesSeriesIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchSeriesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchSeriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchSeriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchSeriesNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchSeriesUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchSeriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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