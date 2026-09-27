<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookDeliveriesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookDeliveriesInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookDeliveriesNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookDeliveriesTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ListAccountWebhookDeliveriesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ListAccountWebhookDeliveries extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    protected $webhook_id;

    /**
     * Returns the delivery attempts of this subscription, newest first. Each entry records
     * one attempt with the response it got, so a retried event appears once per attempt.
     *
     * - **`event_type`:** narrows the list to a single event type.
     * - **`event_id`:** follows one event across every attempt made on it, without paging
     *   through the whole history.
     *
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
     * @param  string  $webhookId  Subscription of the account in the path. A subscription of another account answers `404`, the same as one that does not exist: under the account resolved from `{account_id}` it simply is not there.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "event_type"?: string, //Only deliveries of this event type.
     *    "event_id"?: string, //Only deliveries of this event. Use it to follow every attempt on one event without paging through the whole history.
     * } $queryParameters
     */
    public function __construct(string $accountId, string $webhookId, array $queryParameters = [])
    {
        $this->account_id = $accountId;
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
        return str_replace(['{account_id}', '{webhook_id}'], [rawurlencode($this->account_id), rawurlencode($this->webhook_id)], '/v1/accounts/{account_id}/webhooks/{webhook_id}/deliveries');
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
     * @return null|V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200|ErrorResponse
     *
     * @throws ListAccountWebhookDeliveriesUnauthorizedException
     * @throws ListAccountWebhookDeliveriesForbiddenException
     * @throws ListAccountWebhookDeliveriesNotFoundException
     * @throws ListAccountWebhookDeliveriesTooManyRequestsException
     * @throws ListAccountWebhookDeliveriesInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListAccountWebhookDeliveriesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListAccountWebhookDeliveriesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListAccountWebhookDeliveriesNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListAccountWebhookDeliveriesTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListAccountWebhookDeliveriesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
