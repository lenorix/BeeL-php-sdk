<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteAccountWebhookSubscriptionForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteAccountWebhookSubscriptionInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeleteAccountWebhookSubscriptionNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\DeleteAccountWebhookSubscriptionTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DeleteAccountWebhookSubscriptionUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteAccountWebhookSubscription extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    protected $webhook_id;

    /**
     * Permanently deletes a webhook subscription. No further events are
     * delivered to its URL. To stop deliveries reversibly, set `active` to
     * `false` instead.
     *
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential, and not the `BeeL-Active-Company` header — decides which account the operation acts on. An account you do not reach answers `403`, and so does an account that does not exist, so the existence of somebody else's account is never disclosed.
     * @param  string  $webhookId  Subscription of the account in the path. A subscription of another account answers `404`, the same as one that does not exist: under the account resolved from `{account_id}` it simply is not there.
     */
    public function __construct(string $accountId, string $webhookId)
    {
        $this->account_id = $accountId;
        $this->webhook_id = $webhookId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}', '{webhook_id}'], [rawurlencode($this->account_id), rawurlencode($this->webhook_id)], '/v1/accounts/{account_id}/webhooks/{webhook_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
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
     * @return null|ErrorResponse
     *
     * @throws DeleteAccountWebhookSubscriptionUnauthorizedException
     * @throws DeleteAccountWebhookSubscriptionForbiddenException
     * @throws DeleteAccountWebhookSubscriptionNotFoundException
     * @throws DeleteAccountWebhookSubscriptionTooManyRequestsException
     * @throws DeleteAccountWebhookSubscriptionInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountWebhookSubscriptionUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountWebhookSubscriptionForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountWebhookSubscriptionNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountWebhookSubscriptionTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountWebhookSubscriptionInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
