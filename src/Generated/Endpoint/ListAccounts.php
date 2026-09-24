<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListAccountsBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ListAccountsForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListAccountsInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ListAccountsTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ListAccountsUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1AccountsGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ListAccounts extends BaseEndpoint implements Endpoint
{
    /**
     * Returns the accounts you provisioned, newest first. Each carries its lifecycle `status`
     * (`PROVISIONED` → `CLAIMED` → `ACTIVE`), the `access_level` you hold over it and the state
     * of its claim link.
     *
     * - **`status`:** narrows the list to one lifecycle stage.
     * - **`external_ref`:** looks an account up by the reference you assigned when provisioning
     *   it; returns the 0..1 matching accounts.
     *
     * **Cursor pagination.** This collection pages by `cursor`/`next_cursor` instead of by
     * `page`, so it carries no `pagination` block. That is a documented variant of pagination,
     * not a different envelope: the collection still travels under a named key inside `data`.
     * Keep asking with the `next_cursor` of the previous response until it comes back `null`.
     *
     * @param array{
     *    "status"?: string,
     *    "external_ref"?: string, //Your own id for the account; returns the 0..1 matching accounts.
     *    "limit"?: int, //Maximum number of accounts to return per page (1–200). Defaults to 50.
     *    "cursor"?: string, //Opaque pagination cursor from a previous response's `next_cursor`.
     * } $queryParameters
     */
    public function __construct(array $queryParameters = [])
    {
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return '/v1/accounts';
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
        $optionsResolver->setDefined(['status', 'external_ref', 'limit', 'cursor']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['limit' => 50]);
        $optionsResolver->addAllowedTypes('status', ['string']);
        $optionsResolver->addAllowedTypes('external_ref', ['string']);
        $optionsResolver->addAllowedTypes('limit', ['int']);
        $optionsResolver->addAllowedTypes('cursor', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1AccountsGetResponse200|ErrorResponse
     *
     * @throws ListAccountsBadRequestException
     * @throws ListAccountsUnauthorizedException
     * @throws ListAccountsForbiddenException
     * @throws ListAccountsTooManyRequestsException
     * @throws ListAccountsInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListAccountsBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListAccountsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListAccountsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListAccountsTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListAccountsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
