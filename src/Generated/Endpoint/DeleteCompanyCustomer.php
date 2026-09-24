<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomerConflictException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomerForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomerInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomerNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomerTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomerUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteCompanyCustomer extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $customer_id;

    /**
     * Deletes a customer of this company that has no invoices.
     *
     * - **What deleting means:** the customer is retained internally for tax record-keeping
     *   purposes, but is no longer exposed by the API: subsequent requests to it return `404`, and
     *   it is never included in the customer list, under any value of the `active` filter.
     * - **Identifier released:** its NIF or alternative identifier is freed, so a new customer may
     *   be created with the same identifier.
     * - **Customers with invoices:** they cannot be deleted and the request answers `409`
     *   `CLIENT_HAS_INVOICES`. To stop using a customer, update it with `active` set to `false`
     *   instead of deleting it.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $customerId  Customer ID
     */
    public function __construct(string $companyId, string $customerId)
    {
        $this->company_id = $companyId;
        $this->customer_id = $customerId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{customer_id}'], [rawurlencode($this->company_id), rawurlencode($this->customer_id)], '/v1/companies/{company_id}/customers/{customer_id}');
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
     * @return null|ErrorResponse
     *
     * @throws DeleteCompanyCustomerUnauthorizedException
     * @throws DeleteCompanyCustomerForbiddenException
     * @throws DeleteCompanyCustomerNotFoundException
     * @throws DeleteCompanyCustomerConflictException
     * @throws DeleteCompanyCustomerTooManyRequestsException
     * @throws DeleteCompanyCustomerInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyCustomerUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyCustomerForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyCustomerNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyCustomerConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyCustomerTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyCustomerInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
