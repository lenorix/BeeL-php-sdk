<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class ResolveCompanyPaymentEvent extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $company_id;
    protected $connection_id;
    protected $event_id;
    /**
    * Marks a payment event as resolved outside BeeL, for example when the invoice was issued
    * through another tool or the situation was otherwise handled by hand. The event leaves the
    * events that need action without generating any invoice.
    *
    * The operation applies to the whole payment the event belongs to. Its scope is every active
    * event of the connection that shares the payment identity of the event named in the
    * request: when the event carries a payment identifier (`external_payment_id`), every event
    * with that same identifier, whatever its kind (the sale, its failed attempts, its refunds);
    * otherwise, when it carries a source object (`source_object_id`, such as a credit note or a
    * dispute), every event with that same source object; otherwise, the event alone. Within that
    * scope, the events that need action (the same criterion as the `needs_action` filter) and
    * are eligible are resolved together, in a single transaction; a failed event still pending
    * automatic retry is resolved as well, so that no retry is attempted for a payment the
    * caller has declared handled elsewhere. Events that do not need action — for instance an
    * event still in `RECEIVED` state that has not stalled — remain unchanged. The response
    * carries the event named in the request.
    *
    * - **Eligible events:** only events in `FAILED`, `SKIPPED` or `RECEIVED` can be resolved;
    *   if the event named in the request is not eligible, the request returns `400`.
    * - **Terminal:** a resolved event cannot be retried afterwards.
    *
    * @param string $companyId Unique identifier (UUID) of the company the events belong to — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $connectionId Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
    * @param string $eventId Identifier of the payment event, as returned by the list operation.
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
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return str_replace(['{company_id}', '{connection_id}', '{event_id}'], [rawurlencode($this->company_id), rawurlencode($this->connection_id), rawurlencode($this->event_id)], '/v1/companies/{company_id}/payment-connections/{connection_id}/events/{event_id}/resolve');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ManagedPaymentEventResponse', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ResolveCompanyPaymentEventInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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