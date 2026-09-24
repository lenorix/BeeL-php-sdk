<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class ListEmailDeliveries extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    /**
     * Returns the emails the system recorded on behalf of the authenticated account: invoice
     * deliveries, verification, onboarding. It only reads the history; it does not send or resend
     * anything.
     *
     * - **Deprecated:** use `GET /v1/accounts/{account_id}/emails`, which behaves identically.
     *
     * - **Every attempt is recorded**, not only the ones that went out: an email stopped by
     *   policy is listed with `status` `REJECTED`, and one accepted but not dispatched yet as
     *   `QUEUED`, rather than being omitted.
     * - **Order:** by `sent_at` descending, configurable with `sort_by` / `sort_order`.
     * - **Filters:** `type`, `status`, `recipient` and `related_entity_id`.
     * - **`sent_at`:** the moment the message was handed over, so it is absent while an email is
     *   still `QUEUED`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "type"?: string, //Filter by email type (e.g. INVOICE_EMITTED)
     *    "status"?: string, //Filter by delivery status
     *    "recipient"?: string, //Filter to emails where any recipient contains the term (case-insensitive)
     *    "related_entity_id"?: string, //Filter to emails associated with a given related entity (e.g. an invoice id)
     *    "sort_by"?: string, //Field to sort by
     *    "sort_order"?: string, //Sort order direction
     * } $queryParameters
     */
    public function __construct(array $queryParameters = [])
    {
        $this->queryParameters = $queryParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return '/v1/emails';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['page', 'limit', 'type', 'status', 'recipient', 'related_entity_id', 'sort_by', 'sort_order']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['page' => 1, 'limit' => 20, 'sort_by' => 'sent_at', 'sort_order' => 'desc']);
        $optionsResolver->addAllowedTypes('page', ['int']);
        $optionsResolver->addAllowedTypes('limit', ['int']);
        $optionsResolver->addAllowedTypes('type', ['string']);
        $optionsResolver->addAllowedTypes('status', ['string']);
        $optionsResolver->addAllowedTypes('recipient', ['string']);
        $optionsResolver->addAllowedTypes('related_entity_id', ['string']);
        $optionsResolver->addAllowedTypes('sort_by', ['string']);
        $optionsResolver->addAllowedTypes('sort_order', ['string']);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\EmailDeliveryListResponse|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\EmailDeliveryListResponse', 'json');
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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