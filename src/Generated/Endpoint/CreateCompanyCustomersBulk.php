<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkConflictException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCustomersBulkUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCompanyCustomersBulk extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Creates up to 500 customers of this company in a single call.
     *
     * - **Atomic:** if any customer fails validation the whole batch is rejected with `422`
     *   `BULK_VALIDATION_ERROR` and nothing is persisted. This is not a partial operation.
     * - **`dry_run`:** with `dry_run=true` the batch is only validated — tax identifiers against
     *   the AEAT register, duplicates inside the batch and against the existing customers, field
     *   formats — nothing is written and the answer is `200`. With `dry_run=false`, the default,
     *   validation is followed by creation and the answer is `201`.
     * - **Report:** both modes return the same per-record report, so a dry run and a real run are
     *   read the same way.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param array{
     *    "dry_run"?: bool, //Validate the batch without persisting it (`true`), or validate and create it (`false`,
    the default). Either way the batch is atomic.
     * } $queryParameters
     * @param array{
     *    "Idempotency-Key"?: string, //Idempotency key to prevent duplicates in sensitive operations.

    - Any unique client-generated string (e.g. an order id). A UUID also works but is not required
    - Allowed characters: letters, digits, `_` and `-` (max 255 chars)
    - If the same key is sent twice, the result of the first operation is returned
    - Keys expire 24 hours after processing

    The key is scoped per user and environment, and bound to the request body, so retrying after
    a network timeout replays the stored response instead of repeating the operation.

    | Status | Code | When |
    |---|---|---|
    | `400` | `INVALID_IDEMPOTENCY_KEY` | The key breaks the format rules above. |
    | `409` | `IDEMPOTENCY_KEY_PROCESSING` | The first request is still in flight. Wait and retry with the same key. |
    | `409` | `IDEMPOTENCY_KEY_MISMATCH` | The key was already used with a **different** body. Use a new key. |
     * } $headerParameters
     */
    public function __construct(string $companyId, V1CompaniesCompanyIdCustomersBulkPostBody $requestBody, array $queryParameters = [], array $headerParameters = [])
    {
        $this->company_id = $companyId;
        $this->body = $requestBody;
        $this->queryParameters = $queryParameters;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/customers/bulk');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof V1CompaniesCompanyIdCustomersBulkPostBody) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
        }

        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['dry_run']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['dry_run' => false]);
        $optionsResolver->addAllowedTypes('dry_run', ['bool']);

        return $optionsResolver;
    }

    protected function getHeadersOptionsResolver(): OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(['Idempotency-Key']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('Idempotency-Key', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1CompaniesCompanyIdCustomersBulkPostResponse200|V1CompaniesCompanyIdCustomersBulkPostResponse201|ErrorResponse
     *
     * @throws CreateCompanyCustomersBulkBadRequestException
     * @throws CreateCompanyCustomersBulkUnauthorizedException
     * @throws CreateCompanyCustomersBulkForbiddenException
     * @throws CreateCompanyCustomersBulkConflictException
     * @throws CreateCompanyCustomersBulkUnprocessableEntityException
     * @throws CreateCompanyCustomersBulkTooManyRequestsException
     * @throws CreateCompanyCustomersBulkInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomersBulkBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomersBulkUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomersBulkForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomersBulkConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomersBulkUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomersBulkTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCustomersBulkInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
