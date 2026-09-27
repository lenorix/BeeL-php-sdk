<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class DeleteCustomer extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $customer_id;
    /**
     * Deletes a customer that has no invoices.
     *
     * - **Deprecated:** use `DELETE /v1/companies/{company_id}/customers/{customer_id}`, which
     *   deletes the same way but answers `204` with no body instead of `200`. This route keeps
     *   working until the date announced in its `Sunset` response header.
     *
     * ## What deleting means
     *
     * - **No longer exposed:** the customer is retained internally for tax record-keeping
     *   purposes, but is no longer exposed by the API: subsequent requests to it return `404`, and
     *   it is never included in the customer list, under any value of the `active` filter.
     * - **Identifier released:** its NIF or alternative identifier is freed, so a new customer may
     *   be created with the same identifier.
     *
     * ## Customers you cannot delete
     *
     * - **Customers with invoices:** they cannot be deleted and the request answers `409`
     *   `CLIENT_HAS_INVOICES`, leaving the customer untouched — neither deleted nor deactivated.
     * - **Deactivating instead:** to stop using a customer, whether or not it has invoices, update
     *   it with `active` set to `false`: that releases no identifier and keeps the customer
     *   retrievable through `GET /v1/customers?active=false`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $customerId Customer ID
     */
    public function __construct(string $customerId)
    {
        $this->customer_id = $customerId;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'DELETE';
    }
    public function getUri(): string
    {
        return str_replace(['{customer_id}'], [rawurlencode($this->customer_id)], '/v1/customers/{customer_id}');
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdDeleteResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdDeleteResponse200', 'json');
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (409 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\DeleteCustomerInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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