<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateCustomersBulkUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse200;
use Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCustomersBulk extends BaseEndpoint implements Endpoint
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
    public function __construct(V1CustomersBulkPostBody $requestBody, array $queryParameters = [], array $headerParameters = [])
    {
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
        return '/v1/customers/bulk';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof V1CustomersBulkPostBody) {
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
     * @return null|V1CustomersBulkPostResponse200|V1CustomersBulkPostResponse201|ErrorResponse
     *
     * @throws CreateCustomersBulkBadRequestException
     * @throws CreateCustomersBulkUnauthorizedException
     * @throws CreateCustomersBulkForbiddenException
     * @throws CreateCustomersBulkUnprocessableEntityException
     * @throws CreateCustomersBulkTooManyRequestsException
     * @throws CreateCustomersBulkInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCustomersBulkBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCustomersBulkUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCustomersBulkForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCustomersBulkUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersBulkPostResponse422', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCustomersBulkTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCustomersBulkInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
