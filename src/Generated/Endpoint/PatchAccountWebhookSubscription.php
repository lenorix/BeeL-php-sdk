<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\PatchAccountWebhookSubscriptionUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PatchAccountWebhookSubscription extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    protected $webhook_id;

    /**
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
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
     * @param  string  $webhookId  Subscription of the account in the path. A subscription of another account answers `404`, the same as one that does not exist: under the account resolved from `{account_id}` it simply is not there.
     */
    public function __construct(string $accountId, string $webhookId, UpdateWebhookSubscriptionRequest $requestBody)
    {
        $this->account_id = $accountId;
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
        return str_replace(['{account_id}', '{webhook_id}'], [rawurlencode($this->account_id), rawurlencode($this->webhook_id)], '/v1/accounts/{account_id}/webhooks/{webhook_id}');
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
     * @return null|V1AccountsAccountIdWebhooksWebhookIdPatchResponse200|ErrorResponse
     *
     * @throws PatchAccountWebhookSubscriptionBadRequestException
     * @throws PatchAccountWebhookSubscriptionUnauthorizedException
     * @throws PatchAccountWebhookSubscriptionForbiddenException
     * @throws PatchAccountWebhookSubscriptionNotFoundException
     * @throws PatchAccountWebhookSubscriptionUnprocessableEntityException
     * @throws PatchAccountWebhookSubscriptionTooManyRequestsException
     * @throws PatchAccountWebhookSubscriptionInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountWebhookSubscriptionBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountWebhookSubscriptionUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountWebhookSubscriptionForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountWebhookSubscriptionNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountWebhookSubscriptionUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountWebhookSubscriptionTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountWebhookSubscriptionInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
