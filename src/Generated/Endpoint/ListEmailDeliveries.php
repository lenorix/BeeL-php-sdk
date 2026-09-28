<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\ListEmailDeliveriesUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryListResponse;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ListEmailDeliveries extends BaseEndpoint implements Endpoint
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

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return '/v1/emails';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): OptionsResolver
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
     *
     * @return null|EmailDeliveryListResponse|ErrorResponse
     *
     * @throws ListEmailDeliveriesUnauthorizedException
     * @throws ListEmailDeliveriesForbiddenException
     * @throws ListEmailDeliveriesUnprocessableEntityException
     * @throws ListEmailDeliveriesInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\EmailDeliveryListResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListEmailDeliveriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListEmailDeliveriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListEmailDeliveriesUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListEmailDeliveriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
