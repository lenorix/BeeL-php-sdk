<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class TestAccountWebhookSubscription extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $account_id;
    protected $webhook_id;
    /**
    * Sends a synthetic payload to the subscription's URL immediately, outside the normal
    * delivery queue. Use it to verify that your endpoint is reachable and handles
    * deliveries correctly before you rely on real events.
    *
    * - **Payload:** carries `"test": true` and synthetic data, and is signed like any other
    *   delivery, so it also exercises your signature check.
    * - **Retries:** none. A failed test is not retried and does not appear in the delivery
    *   history.
    * - **`Idempotency-Key`:** repeating the call with the same key returns the cached
    *   result without sending the test payload again.
    * - **Result:** read `delivery_success`; a delivery your endpoint rejected is still a
    *   successful test run, not an error.
    *
    * @param string $accountId Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
    * @param string $webhookId Subscription of the account in the path. A subscription of another account answers `404`, the same as one that does not exist: under the account resolved from `{account_id}` it simply is not there.
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
    public function __construct(string $accountId, string $webhookId, array $headerParameters = [])
    {
        $this->account_id = $accountId;
        $this->webhook_id = $webhookId;
        $this->headerParameters = $headerParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return str_replace(['{account_id}', '{webhook_id}'], [rawurlencode($this->account_id), rawurlencode($this->webhook_id)], '/v1/accounts/{account_id}/webhooks/{webhook_id}/test');
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdTestPostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdTestPostResponse200', 'json');
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\TestAccountWebhookSubscriptionInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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