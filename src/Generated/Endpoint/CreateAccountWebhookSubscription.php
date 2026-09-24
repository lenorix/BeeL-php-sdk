<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateAccountWebhookSubscriptionBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountWebhookSubscriptionForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountWebhookSubscriptionInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountWebhookSubscriptionTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountWebhookSubscriptionUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountWebhookSubscriptionUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\CreateWebhookSubscriptionRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksPostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateAccountWebhookSubscription extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    /**
     * Registers an HTTPS endpoint to receive notifications for the event types listed
     * in `events`.
     *
     * - **`secret`:** returned **only** in this response and never again. Store it before
     *   discarding the body; deliveries are signed with it and carry the signature in the
     *   `BeeL-Signature` header.
     * - **`test_delivery`:** a one-off signed delivery sent to your URL as part of creating
     *   the subscription, so you learn whether your endpoint answers without a second call.
     *   It is best effort: the subscription exists and is active whatever it says, and the
     *   field is `null` when the test could not be run at all.
     * - **`account_relationship`:** which accounts the subscription receives events from —
     *   `own` (the default), `managed`, or `all`.
     * - **Limits:** an account holds at most **10 active subscriptions**; creating an
     *   eleventh is rejected. Registering the same URL twice creates two subscriptions, and
     *   the endpoint then receives each event twice.
     *
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
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
    public function __construct(string $accountId, CreateWebhookSubscriptionRequest $requestBody, array $headerParameters = [])
    {
        $this->account_id = $accountId;
        $this->body = $requestBody;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}'], [rawurlencode($this->account_id)], '/v1/accounts/{account_id}/webhooks');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof CreateWebhookSubscriptionRequest) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
        }

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
     * @return null|V1AccountsAccountIdWebhooksPostResponse201|ErrorResponse
     *
     * @throws CreateAccountWebhookSubscriptionBadRequestException
     * @throws CreateAccountWebhookSubscriptionUnauthorizedException
     * @throws CreateAccountWebhookSubscriptionForbiddenException
     * @throws CreateAccountWebhookSubscriptionUnprocessableEntityException
     * @throws CreateAccountWebhookSubscriptionTooManyRequestsException
     * @throws CreateAccountWebhookSubscriptionInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksPostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountWebhookSubscriptionBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountWebhookSubscriptionUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountWebhookSubscriptionForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountWebhookSubscriptionUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountWebhookSubscriptionTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountWebhookSubscriptionInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
