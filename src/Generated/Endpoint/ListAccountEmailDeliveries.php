<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class ListAccountEmailDeliveries extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $account_id;
    /**
     * Returns the emails the system recorded on behalf of the account in the path: invoice
     * deliveries, verification, onboarding. It only reads the history; it does not send or resend
     * anything.
     *
     * - **Every attempt is recorded**, not only the ones that went out: an email stopped by
     *   policy is listed with `status` `REJECTED`, and one accepted but not dispatched yet as
     *   `QUEUED`, rather than being omitted.
     * - **Order:** by `sent_at` descending, configurable with `sort_by` / `sort_order`.
     * - **Filters:** `type`, `status`, `recipient` and `related_entity_id`.
     * - **`sent_at`:** the moment the message was handed over, so it is absent while an email is
     *   still `QUEUED`.
     * - **Scope:** the account is the one named in the path; the environment is not, and comes
     *   from the credential.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
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
    public function __construct(string $accountId, array $queryParameters = [])
    {
        $this->account_id = $accountId;
        $this->queryParameters = $queryParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{account_id}'], [rawurlencode($this->account_id)], '/v1/accounts/{account_id}/emails');
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesInternalServerErrorException
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
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListAccountEmailDeliveriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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