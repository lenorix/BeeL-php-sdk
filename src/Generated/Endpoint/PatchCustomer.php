<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class PatchCustomer extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $customer_id;
    /**
     * Updates only the fields present in the body, leaving every other field of the customer as it
     * is.
     *
     * - **Null vs omitted:** a field sent as `null` is cleared, which is different from omitting
     *   it (see `PatchCustomerRequest`). The result goes through the same validation as `PUT`.
     * - **AEAT census:** the customer's Spanish tax identifier is only checked against the AEAT
     *   census when the request changes the `nif` or the `legal_name`. Editing anything else never
     *   asks the census.
     *   For a **legal entity** the census checks the CIF only and its `legal_name` is not
     *   verified, so the name never causes the rejection; only a **natural person**'s NIF is
     *   crossed with the name.
     *   Duplicate and format checks run on every update.
     * - **Deprecated:** use `PATCH /v1/companies/{company_id}/customers/{customer_id}`, which
     *   behaves identically.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $customerId Customer ID
     * @param \Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest $requestBody
     */
    public function __construct(string $customerId, \Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest $requestBody)
    {
        $this->customer_id = $customerId;
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PATCH';
    }
    public function getUri(): string
    {
        return str_replace(['{customer_id}'], [rawurlencode($this->customer_id)], '/v1/customers/{customer_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchCustomerInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchCustomerBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchCustomerUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchCustomerForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchCustomerNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (409 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchCustomerConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchCustomerUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchCustomerInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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