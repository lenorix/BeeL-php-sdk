<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\RetryAccountWebhookDeliveryForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\RetryAccountWebhookDeliveryInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\RetryAccountWebhookDeliveryNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\RetryAccountWebhookDeliveryTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\RetryAccountWebhookDeliveryUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class RetryAccountWebhookDelivery extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    protected $webhook_id;

    protected $delivery_id;

    /**
     * Re-sends the original payload of a delivery immediately.
     *
     * - **Payload:** the one captured when the event happened, not a fresh snapshot, so
     *   changes made to the entity since then are not reflected.
     * - **History:** the outcome is recorded as a new entry and the original entry is kept
     *   as it was. `attempt_number` continues the same sequence, so it can exceed the 5
     *   automatic attempts.
     *
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
     * @param  string  $webhookId  Subscription of the account in the path. A subscription of another account answers `404`, the same as one that does not exist: under the account resolved from `{account_id}` it simply is not there.
     * @param  string  $deliveryId  Delivery attempt of that subscription to replay.
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
    public function __construct(string $accountId, string $webhookId, string $deliveryId, array $headerParameters = [])
    {
        $this->account_id = $accountId;
        $this->webhook_id = $webhookId;
        $this->delivery_id = $deliveryId;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}', '{webhook_id}', '{delivery_id}'], [rawurlencode($this->account_id), rawurlencode($this->webhook_id), rawurlencode($this->delivery_id)], '/v1/accounts/{account_id}/webhooks/{webhook_id}/deliveries/{delivery_id}/retry');
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
     * @return null|V1AccountsAccountIdWebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200|ErrorResponse
     *
     * @throws RetryAccountWebhookDeliveryUnauthorizedException
     * @throws RetryAccountWebhookDeliveryForbiddenException
     * @throws RetryAccountWebhookDeliveryNotFoundException
     * @throws RetryAccountWebhookDeliveryTooManyRequestsException
     * @throws RetryAccountWebhookDeliveryInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesDeliveryIdRetryPostResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RetryAccountWebhookDeliveryUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RetryAccountWebhookDeliveryForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RetryAccountWebhookDeliveryNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RetryAccountWebhookDeliveryTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RetryAccountWebhookDeliveryInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
