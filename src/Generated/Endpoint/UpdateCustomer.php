<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\UpdateCustomerBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCustomerForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCustomerInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCustomerNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCustomerTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCustomerUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCustomerUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdPutResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateCustomer extends BaseEndpoint implements Endpoint
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
     * @param  string  $customerId  Customer ID
     */
    public function __construct(string $customerId, UpdateCustomerRequest $requestBody)
    {
        $this->customer_id = $customerId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{customer_id}'], [rawurlencode($this->customer_id)], '/v1/customers/{customer_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof UpdateCustomerRequest) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
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
     *
     * @return null|V1CustomersCustomerIdPutResponse200|ErrorResponse
     *
     * @throws UpdateCustomerBadRequestException
     * @throws UpdateCustomerUnauthorizedException
     * @throws UpdateCustomerForbiddenException
     * @throws UpdateCustomerNotFoundException
     * @throws UpdateCustomerUnprocessableEntityException
     * @throws UpdateCustomerTooManyRequestsException
     * @throws UpdateCustomerInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersCustomerIdPutResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCustomerBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCustomerUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCustomerForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCustomerNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCustomerUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCustomerTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCustomerInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
