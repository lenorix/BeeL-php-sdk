<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetAccountRequestLogForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountRequestLogInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountRequestLogNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountRequestLogTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountRequestLogUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\RequestLogSingleResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class GetAccountRequestLog extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    protected $request_id;

    /**
     * Returns the full detail (bodies and headers) of a request made by you, with any of your API
     * keys in this environment — including one made with a key other than the one you are
     * authenticating with, because the axis is the person, not the individual credential.
     *
     * - **`{account_id}`:** authorizes the call; it does not widen what you can see.
     * - **`404`:** the request does not exist, was made by another user (including another user
     *   of this same account), or belongs to the other environment.
     * - **The widest read `logs:read` opens:** it returns the bodies and headers that any key
     *   of yours exchanged in this environment, so a key holding only `logs:read` reads the
     *   traffic of your privileged keys too. It never crosses to another user or to another
     *   account. Grant it accordingly.
     *
     * @param  string  $accountId  Account the call is authorized against. It does not widen the result set.
     * @param  string  $requestId  Correlation identifier (X-Request-Id).
     * @param array{
     *    "timestamp"?: string, //Log timestamp (the one returned by the list). Narrows the search window around
    that instant so the detail also works for logs older than the default window.
    If omitted, the default recent window is searched.
     * } $queryParameters
     */
    public function __construct(string $accountId, string $requestId, array $queryParameters = [])
    {
        $this->account_id = $accountId;
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
        return str_replace(['{account_id}', '{request_id}'], [rawurlencode($this->account_id), rawurlencode($this->request_id)], '/v1/accounts/{account_id}/request-logs/{request_id}');
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
     * @throws GetAccountRequestLogUnauthorizedException
     * @throws GetAccountRequestLogForbiddenException
     * @throws GetAccountRequestLogNotFoundException
     * @throws GetAccountRequestLogTooManyRequestsException
     * @throws GetAccountRequestLogInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\RequestLogSingleResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountRequestLogUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountRequestLogForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountRequestLogNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountRequestLogTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountRequestLogInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
