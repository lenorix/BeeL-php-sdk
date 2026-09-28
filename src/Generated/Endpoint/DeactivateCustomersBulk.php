<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class DeactivateCustomersBulk extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    /**
     * Deletes the customers listed in `ids`.
     *
     * - **Deprecated:** use `DELETE /v1/companies/{company_id}/customers/bulk`, which behaves
     *   identically.
     *
     * ## Partial results
     *
     * - **Partial:** the customers that can be deleted are deleted, and the rest keep their
     *   place in `customers_deletion` with the status that explains why.
     * - **`HAS_INVOICES`:** a customer that has invoices cannot be deleted and comes back with
     *   that row status.
     *
     * ## What deleting means
     *
     * - **Semantics:** each deletion behaves as `DELETE /v1/customers/{customer_id}`. The
     *   customer is retained for tax record-keeping purposes but is no longer exposed by the
     *   API, its identifier is released for reuse, and invoices already issued to it keep their
     *   own copy of the recipient's details.
     * - **Not deactivating:** deleting frees the identifier, so the same NIF can be registered
     *   again, while `PATCH` with `active: false` leaves the customer where it is with its NIF
     *   still taken.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "ids": string, //Comma-separated customer IDs
     * } $queryParameters
     */
    public function __construct(array $queryParameters = [])
    {
        $this->queryParameters = $queryParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'DELETE';
    }
    public function getUri(): string
    {
        return '/v1/customers/bulk';
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
        $optionsResolver->setDefined(['ids']);
        $optionsResolver->setRequired(['ids']);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('ids', ['string']);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1CustomersBulkDeleteResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersBulkDeleteResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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