<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class UpdateWebhookSubscription extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $webhook_id;
    /**
     * **Deprecated.** Use `PATCH /v1/accounts/{account_id}/webhooks/{webhook_id}`, which behaves identically.
     *
     * Updates the fields present in the body — `url`, `events`, `active`,
     * `account_relationship` — and leaves the rest untouched.
     *
     * - **`events`:** replaces the whole list, it does not add to it, so an event left out
     *   of it stops being delivered.
     * - **`active`:** setting it to `false` stops deliveries without discarding the delivery
     *   history. A subscription we turned off ourselves (`deactivated_by: beel`) needs a
     *   successful test delivery before it can be turned back on.
     * - **Signing secret:** not touched here. Rotate it with
     *   `POST /v1/accounts/{account_id}/webhooks/{webhook_id}/secret`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $webhookId
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest $requestBody
     */
    public function __construct(string $webhookId, \Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest $requestBody)
    {
        $this->webhook_id = $webhookId;
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PATCH';
    }
    public function getUri(): string
    {
        return str_replace(['{webhook_id}'], [rawurlencode($this->webhook_id)], '/v1/webhooks/{webhook_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionUnprocessableEntityException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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