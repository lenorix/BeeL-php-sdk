<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetAccountWebhookSubscriptionForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountWebhookSubscriptionInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountWebhookSubscriptionNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountWebhookSubscriptionTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GetAccountWebhookSubscriptionUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetAccountWebhookSubscription extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    protected $webhook_id;

    /**
     * Returns a single webhook subscription. The signing secret is never included.
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
        return 'GET';
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
     * @return null|V1AccountsAccountIdWebhooksWebhookIdGetResponse200|ErrorResponse
     *
     * @throws GetAccountWebhookSubscriptionUnauthorizedException
     * @throws GetAccountWebhookSubscriptionForbiddenException
     * @throws GetAccountWebhookSubscriptionNotFoundException
     * @throws GetAccountWebhookSubscriptionTooManyRequestsException
     * @throws GetAccountWebhookSubscriptionInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountWebhookSubscriptionUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountWebhookSubscriptionForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountWebhookSubscriptionNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountWebhookSubscriptionTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetAccountWebhookSubscriptionInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
