<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class DeleteSeries extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
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
     * @param string $seriesId Series ID
     */
    public function __construct(string $seriesId)
    {
        $this->series_id = $seriesId;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'DELETE';
    }
    public function getUri(): string
    {
        return str_replace(['{series_id}'], [rawurlencode($this->series_id)], '/v1/configuration/series/{series_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (204 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeleteSeriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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