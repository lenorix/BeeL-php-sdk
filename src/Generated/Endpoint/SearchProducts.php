<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\SearchProductsBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\SearchProductsForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\SearchProductsInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\SearchProductsUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\SearchProductsUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1ProductsSearchGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class SearchProducts extends BaseEndpoint implements Endpoint
{
    /**
     * Searches the active products by name or code and returns at most 20 of them, for
     * autocomplete.
     *
     * - **Deprecated — withdrawn, not moved:** its replacement is
     *   `GET /v1/companies/{company_id}/products?q=`, which searches the name, the code **and**
     *   the description, so it returns at least everything this endpoint returned.
     * - **Response shape:** it differs, and that is why this notice exists. Here `data` is a plain
     *   array of products, limited to 20 active ones, while there `data` is the paginated envelope
     *   of the list (`data.products` + `data.pagination`). Change the way you read the response
     *   when you migrate.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "search"?: string, //Search term (empty to get recent products).

    This parameter was previously named `q`. The old name is still accepted for backwards
    compatibility (see `q` below) and will be withdrawn in a future major version — send
    `search`.
     *    "q"?: string, //**Deprecated** — former name of `search`, still honoured so existing integrations keep
    working. Ignored when `search` is also present. Use `search`.
     *    "limit"?: int, //Result limit (max 20)
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
        return '/v1/products/search';
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
        $optionsResolver->setDefined(['search', 'q', 'limit']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['limit' => 10]);
        $optionsResolver->addAllowedTypes('search', ['string']);
        $optionsResolver->addAllowedTypes('q', ['string']);
        $optionsResolver->addAllowedTypes('limit', ['int']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1ProductsSearchGetResponse200|ErrorResponse
     *
     * @throws SearchProductsBadRequestException
     * @throws SearchProductsUnauthorizedException
     * @throws SearchProductsForbiddenException
     * @throws SearchProductsUnprocessableEntityException
     * @throws SearchProductsInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ProductsSearchGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SearchProductsBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SearchProductsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SearchProductsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SearchProductsUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SearchProductsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
