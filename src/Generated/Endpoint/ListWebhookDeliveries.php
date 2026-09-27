<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListWebhookDeliveriesBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ListWebhookDeliveriesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListWebhookDeliveriesNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\ListWebhookDeliveriesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdDeliveriesGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ListWebhookDeliveries extends BaseEndpoint implements Endpoint
{
    protected $webhook_id;

    /**
     * **Deprecated.** Use `GET /v1/accounts/{account_id}/webhooks/{webhook_id}/deliveries`, which behaves identically.
     *
     * Returns the delivery attempts of this subscription, newest first. Each entry records
     * one attempt with the response it got, so a retried event appears once per attempt.
     *
     * - **`event_type`:** narrows the list to a single event type.
     * - **`event_id`:** follows one event across every attempt made on it, without paging
     *   through the whole history.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "event_type"?: string, //Only deliveries of this event type.
     *    "event_id"?: string, //Only deliveries of this event. Use it to follow every attempt on one event without paging through the whole history.
     * } $queryParameters
     */
    public function __construct(string $webhookId, array $queryParameters = [])
    {
        $this->webhook_id = $webhookId;
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{webhook_id}'], [rawurlencode($this->webhook_id)], '/v1/webhooks/{webhook_id}/deliveries');
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
        $optionsResolver->setDefined(['page', 'limit', 'event_type', 'event_id']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['page' => 1, 'limit' => 20]);
        $optionsResolver->addAllowedTypes('page', ['int']);
        $optionsResolver->addAllowedTypes('limit', ['int']);
        $optionsResolver->addAllowedTypes('event_type', ['string']);
        $optionsResolver->addAllowedTypes('event_id', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1WebhooksWebhookIdDeliveriesGetResponse200|ErrorResponse
     *
     * @throws ListWebhookDeliveriesBadRequestException
     * @throws ListWebhookDeliveriesUnauthorizedException
     * @throws ListWebhookDeliveriesForbiddenException
     * @throws ListWebhookDeliveriesNotFoundException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdDeliveriesGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListWebhookDeliveriesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListWebhookDeliveriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListWebhookDeliveriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListWebhookDeliveriesNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
