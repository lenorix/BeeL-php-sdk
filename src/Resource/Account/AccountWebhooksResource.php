<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateWebhookSubscriptionRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class AccountWebhooksResource extends GeneratedResource
{
    public function __construct(Client $client, private string $accountId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listAccountWebhookSubscriptions($this->accountId, $query));
    }

    public function create(CreateWebhookSubscriptionRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createAccountWebhookSubscription($this->accountId, $request));
    }

    public function get(string $webhookId): mixed
    {
        return $this->execute(fn () => $this->client->getAccountWebhookSubscription($this->accountId, $webhookId));
    }

    public function update(string $webhookId, UpdateWebhookSubscriptionRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->patchAccountWebhookSubscription($this->accountId, $webhookId, $request));
    }

    public function delete(string $webhookId): void
    {
        $this->execute(fn () => $this->client->deleteAccountWebhookSubscription($this->accountId, $webhookId));
    }

    public function test(string $webhookId): mixed
    {
        return $this->execute(fn () => $this->client->testAccountWebhookSubscription($this->accountId, $webhookId));
    }

    public function rotateSecret(string $webhookId): mixed
    {
        return $this->execute(fn () => $this->client->rotateAccountWebhookSecret($this->accountId, $webhookId));
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function listDeliveries(string $webhookId, array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listAccountWebhookDeliveries($this->accountId, $webhookId, $query));
    }

    public function retryDelivery(string $webhookId, string $deliveryId): mixed
    {
        return $this->execute(fn () => $this->client->retryAccountWebhookDelivery($this->accountId, $webhookId, $deliveryId));
    }
}
