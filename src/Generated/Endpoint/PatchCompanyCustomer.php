<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerConflictException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyCustomerUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersCustomerIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PatchCompanyCustomer extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $customer_id;

    /**
     * Updates only the fields present in the body, leaving every other field of the customer as it
     * is.
     *
     * - **Null vs omitted:** a field sent as `null` is cleared, which is different from omitting
     *   it (see `PatchCustomerRequest`).
     * - **AEAT census:** the customer's Spanish tax identifier is only checked against the AEAT
     *   census when the request changes the `nif` or the `legal_name`. Editing anything else —
     *   phone, notes, address, billing emails — never asks the census, so a customer stored long
     *   ago stays editable even if its NIF is no longer listed.
     *   For a **legal entity** the census checks the CIF only and its `legal_name` is not
     *   verified, so the name never causes the rejection; only a **natural person**'s NIF is
     *   crossed with the name.
     *   Duplicate and format checks run on every update.
     * - **Only update verb:** this is the canonical way to edit a customer. There is no `PUT` of
     *   full replacement under the company, which would clear the fields you omit.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $customerId  Customer ID
     */
    public function __construct(string $companyId, string $customerId, PatchCustomerRequest $requestBody)
    {
        $this->company_id = $companyId;
        $this->customer_id = $customerId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{customer_id}'], [rawurlencode($this->company_id), rawurlencode($this->customer_id)], '/v1/companies/{company_id}/customers/{customer_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof PatchCustomerRequest) {
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
     * @return null|V1CompaniesCompanyIdCustomersCustomerIdPatchResponse200|ErrorResponse
     *
     * @throws PatchCompanyCustomerBadRequestException
     * @throws PatchCompanyCustomerUnauthorizedException
     * @throws PatchCompanyCustomerForbiddenException
     * @throws PatchCompanyCustomerNotFoundException
     * @throws PatchCompanyCustomerConflictException
     * @throws PatchCompanyCustomerUnprocessableEntityException
     * @throws PatchCompanyCustomerTooManyRequestsException
     * @throws PatchCompanyCustomerInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersCustomerIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyCustomerBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyCustomerUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyCustomerForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyCustomerNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyCustomerConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyCustomerUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyCustomerTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyCustomerInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
