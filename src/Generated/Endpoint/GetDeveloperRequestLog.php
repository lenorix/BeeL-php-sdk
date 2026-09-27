<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class GetDeveloperRequestLog extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $request_id;
    /**
    * Returns the full detail (bodies and headers) of a request made by you, with any of your API
    * keys in this environment — the axis is the person, not the individual credential.
    *
    * - **Deprecated:** use `GET /v1/accounts/{account_id}/request-logs/{request_id}`, whose
    *   result is identical.
    * - **`404`:** the request does not exist, was made by another user, or belongs to the other
    *   environment.
    * - **The widest read `logs:read` opens:** it returns the bodies and headers that any key
    *   of yours exchanged in this environment, so a key holding only `logs:read` reads the
    *   traffic of your privileged keys too. It never crosses to another user or to another
    *   account. Grant it accordingly.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param string $requestId Correlation identifier (X-Request-Id).
    * @param array{
    *    "timestamp"?: string, //Log timestamp (the one returned by the list). Narrows the search window around
    that instant so the detail also works for logs older than the default window.
    If omitted, the default recent window is searched.
    * } $queryParameters
    */
    public function __construct(string $requestId, array $queryParameters = [])
    {
        $this->request_id = $requestId;
        $this->queryParameters = $queryParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{request_id}'], [rawurlencode($this->request_id)], '/v1/developers/request-logs/{request_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['timestamp']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('timestamp', ['string']);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\RequestLogSingleResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\RequestLogSingleResponse', 'json');
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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