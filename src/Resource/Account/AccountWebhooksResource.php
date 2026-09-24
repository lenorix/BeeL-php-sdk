<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateWebhookSubscriptionRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/**
 * @method mixed list(array $query = [])
 * @method mixed create(CreateWebhookSubscriptionRequest $request)
 * @method mixed get(string $webhookId)
 * @method mixed update(string $webhookId, UpdateWebhookSubscriptionRequest $request)
 * @method void delete(string $webhookId)
 * @method mixed test(string $webhookId)
 * @method mixed rotateSecret(string $webhookId)
 * @method mixed listDeliveries(string $webhookId, array $query = [])
 * @method mixed retryDelivery(string $webhookId, string $deliveryId)
 */
final readonly class AccountWebhooksResource extends GeneratedResource
{
    public function __construct(Client $client, string $accountId)
    {
        parent::__construct($client, [
            'list' => 'listAccountWebhookSubscriptions',
            'create' => 'createAccountWebhookSubscription',
            'get' => 'getAccountWebhookSubscription',
            'update' => 'patchAccountWebhookSubscription',
            'delete' => 'deleteAccountWebhookSubscription',
            'test' => 'testAccountWebhookSubscription',
            'rotateSecret' => 'rotateAccountWebhookSecret',
            'listDeliveries' => 'listAccountWebhookDeliveries',
            'retryDelivery' => 'retryAccountWebhookDelivery',
        ], [$accountId]);
    }
}
