<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class CreateCustomersBulk extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    /**
    * Creates up to 500 customers in a single call.
    *
    * - **Deprecated:** use `POST /v1/companies/{company_id}/customers/bulk`, which validates
    *   and creates the same way. A dry run still answers `200`; an actual creation answers
    *   `201` instead of `200`.
    * - **Atomic:** if any customer fails validation the whole batch is rejected with
    *   `422 BULK_VALIDATION_ERROR` and nothing is persisted.
    * - **`dry_run`:** with `true` the batch is only validated — tax identifiers against the
    *   AEAT register, duplicates inside the batch and against the existing customers, field
    *   formats — and nothing is written. With `false`, the default, validation is followed by
    *   creation.
    * - **Report:** both modes return the same per-record report, so a dry run and a real run
    *   are read the same way.
    *
    * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
    *
    * @param \Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostBody $requestBody
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
    public function __construct(\Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostBody $requestBody, array $queryParameters = [], array $headerParameters = [])
    {
        $this->body = $requestBody;
        $this->queryParameters = $queryParameters;
        $this->headerParameters = $headerParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return '/v1/customers/bulk';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostBody) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['dry_run']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['dry_run' => false]);
        $optionsResolver->addAllowedTypes('dry_run', ['bool']);
        return $optionsResolver;
    }
    protected function getHeadersOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse200|\Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse201|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse200', 'json');
        }
        if (is_null($contentType) === false && (201 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse201', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse422', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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