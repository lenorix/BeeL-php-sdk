<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\GetDeveloperRequestLogUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\RequestLogSingleResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class GetDeveloperRequestLog extends BaseEndpoint implements Endpoint
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
     * @param  string  $requestId  Correlation identifier (X-Request-Id).
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

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{request_id}'], [rawurlencode($this->request_id)], '/v1/developers/request-logs/{request_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): OptionsResolver
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
     *
     * @return null|RequestLogSingleResponse|ErrorResponse
     *
     * @throws GetDeveloperRequestLogUnauthorizedException
     * @throws GetDeveloperRequestLogForbiddenException
     * @throws GetDeveloperRequestLogNotFoundException
     * @throws GetDeveloperRequestLogInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\RequestLogSingleResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetDeveloperRequestLogUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetDeveloperRequestLogForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetDeveloperRequestLogNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetDeveloperRequestLogInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
