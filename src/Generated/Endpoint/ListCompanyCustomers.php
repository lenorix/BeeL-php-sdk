<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class ListCompanyCustomers extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $company_id;
    /**
    * Returns a paginated list of the customers of this company, with optional filters.
    * Only the customers of the company in the path are returned.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param array{
    *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
    *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
    *    "active"?: bool, //Filter by active/inactive status. Defaults to `true`, so inactive customers must be
    requested explicitly with `active=false`. Deleted customers are never returned by
    either value.
    *    "search"?: string, //Global search by name, NIF or email
    *    "legal_name"?: string, //Filter by legal name (partial search case-insensitive)
    *    "nif"?: string, //Filter by NIF (partial search)
    *    "email"?: string, //Filter by email (partial search)
    *    "phone"?: string, //Filter by phone (partial search)
    *    "city"?: string, //Filter by city
    *    "province"?: string, //Filter by province
    *    "sort_by"?: string, //Field to sort by. Results are always tie-broken by a stable internal key, so paging through the collection never repeats or skips a customer.
    *    "sort_order"?: string, //Sort order direction
    * } $queryParameters
    */
    public function __construct(string $companyId, array $queryParameters = [])
    {
        $this->company_id = $companyId;
        $this->queryParameters = $queryParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/customers');
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
        $optionsResolver->setDefined(['page', 'limit', 'active', 'search', 'legal_name', 'nif', 'email', 'phone', 'city', 'province', 'sort_by', 'sort_order']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['page' => 1, 'limit' => 20, 'sort_by' => 'legal_name', 'sort_order' => 'asc']);
        $optionsResolver->addAllowedTypes('page', ['int']);
        $optionsResolver->addAllowedTypes('limit', ['int']);
        $optionsResolver->addAllowedTypes('active', ['bool']);
        $optionsResolver->addAllowedTypes('search', ['string']);
        $optionsResolver->addAllowedTypes('legal_name', ['string']);
        $optionsResolver->addAllowedTypes('nif', ['string']);
        $optionsResolver->addAllowedTypes('email', ['string']);
        $optionsResolver->addAllowedTypes('phone', ['string']);
        $optionsResolver->addAllowedTypes('city', ['string']);
        $optionsResolver->addAllowedTypes('province', ['string']);
        $optionsResolver->addAllowedTypes('sort_by', ['string']);
        $optionsResolver->addAllowedTypes('sort_order', ['string']);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersGetResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListCompanyCustomersInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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