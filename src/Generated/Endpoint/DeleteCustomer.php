<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteCustomerConflictException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCustomerForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCustomerInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCustomerNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCustomerTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCustomerUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdDeleteResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteCustomer extends BaseEndpoint implements Endpoint
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
     * @param  string  $customerId  Customer ID
     */
    public function __construct(string $customerId)
    {
        $this->customer_id = $customerId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{customer_id}'], [rawurlencode($this->customer_id)], '/v1/customers/{customer_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
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
     *
     * @return null|V1CustomersCustomerIdDeleteResponse200|ErrorResponse
     *
     * @throws DeleteCustomerUnauthorizedException
     * @throws DeleteCustomerForbiddenException
     * @throws DeleteCustomerNotFoundException
     * @throws DeleteCustomerConflictException
     * @throws DeleteCustomerTooManyRequestsException
     * @throws DeleteCustomerInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdDeleteResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCustomerUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCustomerForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCustomerNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCustomerConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCustomerTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCustomerInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
