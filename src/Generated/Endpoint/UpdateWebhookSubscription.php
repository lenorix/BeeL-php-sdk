<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\UpdateWebhookSubscriptionUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest;
use Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateWebhookSubscription extends BaseEndpoint implements Endpoint
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
     */
    public function __construct(string $webhookId, UpdateWebhookSubscriptionRequest $requestBody)
    {
        $this->webhook_id = $webhookId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        return str_replace(['{webhook_id}'], [rawurlencode($this->webhook_id)], '/v1/webhooks/{webhook_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof UpdateWebhookSubscriptionRequest) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
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
     *
     * @return null|V1WebhooksWebhookIdPatchResponse200|ErrorResponse
     *
     * @throws UpdateWebhookSubscriptionBadRequestException
     * @throws UpdateWebhookSubscriptionUnauthorizedException
     * @throws UpdateWebhookSubscriptionForbiddenException
     * @throws UpdateWebhookSubscriptionNotFoundException
     * @throws UpdateWebhookSubscriptionUnprocessableEntityException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1WebhooksWebhookIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateWebhookSubscriptionBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateWebhookSubscriptionUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateWebhookSubscriptionForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateWebhookSubscriptionNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateWebhookSubscriptionUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
