<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\RetryCompanyPaymentEventUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class RetryCompanyPaymentEvent extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $connection_id;

    protected $event_id;

    /**
     * Reprocesses a payment event whose automatic invoicing did not complete, applying the
     * configuration of the NIF as it stands now. Use it after fixing what caused the failure,
     * for example a missing invoice series.
     *
     * - **`retry_available`:** only events where it is `true` can be retried. Read it instead
     *   of deriving retryability from `status` yourself; anything else returns `400`.
     * - **Limit:** the status and the skip reason must admit reprocessing, and the event must
     *   still be under the limit of 3 retries (`retry_count`). A retry that fails for a
     *   transient cause outside the event (provider outage, timeout) does not count towards
     *   the limit.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the events belong to — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $connectionId  Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
     * @param  string  $eventId  Identifier of the payment event, as returned by the list operation.
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
    public function __construct(string $companyId, string $connectionId, string $eventId, array $headerParameters = [])
    {
        $this->company_id = $companyId;
        $this->connection_id = $connectionId;
        $this->event_id = $eventId;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{connection_id}', '{event_id}'], [rawurlencode($this->company_id), rawurlencode($this->connection_id), rawurlencode($this->event_id)], '/v1/companies/{company_id}/payment-connections/{connection_id}/events/{event_id}/retry');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
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
     * @return null|ManagedPaymentEventResponse|ErrorResponse
     *
     * @throws RetryCompanyPaymentEventBadRequestException
     * @throws RetryCompanyPaymentEventUnauthorizedException
     * @throws RetryCompanyPaymentEventForbiddenException
     * @throws RetryCompanyPaymentEventNotFoundException
     * @throws RetryCompanyPaymentEventUnprocessableEntityException
     * @throws RetryCompanyPaymentEventTooManyRequestsException
     * @throws RetryCompanyPaymentEventInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RetryCompanyPaymentEventBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RetryCompanyPaymentEventUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RetryCompanyPaymentEventForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RetryCompanyPaymentEventNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RetryCompanyPaymentEventUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RetryCompanyPaymentEventTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RetryCompanyPaymentEventInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
