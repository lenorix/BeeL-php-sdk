<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class UpdateCustomer extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $customer_id;
    /**
     * Replaces an existing customer with the body you send.
     *
     * - **Not a partial update:** `trade_name`, `email`, `website`, `billing_emails`,
     *   `contact_person`, `notes` and `general_discount` are cleared when they are absent from the
     *   body, so send the customer complete. To change only some fields, use
     *   `PATCH /v1/companies/{company_id}/customers/{customer_id}`.
     * - **AEAT census:** the customer's Spanish tax identifier is only checked against the AEAT
     *   census when the body changes the `nif` or the `legal_name` of the stored customer.
     *   Resending the same pair never asks the census, so a customer stored long ago stays
     *   editable even if its NIF is no longer listed.
     *   For a **legal entity** the census checks the CIF only and its `legal_name` is not
     *   verified, so the name never causes the rejection; only a **natural person**'s NIF is
     *   crossed with the name.
     *   Duplicate and format checks run on every update.
     * - **Deprecated:** this route will be retired on the date announced in its `Sunset` response
     *   header. The canonical form has a single update verb,
     *   `PATCH /v1/companies/{company_id}/customers/{customer_id}`, which is not a drop-in
     *   replacement for this one: it changes only the fields present in the body. To reproduce a
     *   total replacement, send every field and pass `null` in the ones you want cleared.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $customerId Customer ID
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequest $requestBody
     */
    public function __construct(string $customerId, \Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequest $requestBody)
    {
        $this->customer_id = $customerId;
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PUT';
    }
    public function getUri(): string
    {
        return str_replace(['{customer_id}'], [rawurlencode($this->customer_id)], '/v1/customers/{customer_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequest) {
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdPutResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateCustomerInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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