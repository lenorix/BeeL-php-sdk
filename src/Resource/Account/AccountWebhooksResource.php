<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateWebhookSubscriptionRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateWebhookSubscriptionRequest;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\WebhookDeliveryLog;
use Lenorix\BeelSdk\Generated\Model\WebhookSubscription;
use Lenorix\BeelSdk\Generated\Model\WebhookSubscriptionWithSecret;
use Lenorix\BeelSdk\Generated\Model\WebhookTestResult;
use Lenorix\BeelSdk\Http\RequestModels;
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
    public function list(array $query = []): V1AccountsAccountIdWebhooksGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listAccountWebhookSubscriptions($this->accountId, $query));
    }

    /**
     * Iterate over all of this account's webhook subscriptions, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, WebhookSubscription>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): V1AccountsAccountIdWebhooksGetResponse200Data => $this->list($query),
            static fn (V1AccountsAccountIdWebhooksGetResponse200Data $page): array => $page->getWebhooks(),
            $query,
        );
    }

    /**
     * @param  CreateWebhookSubscriptionRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function create(CreateWebhookSubscriptionRequest|array $request): WebhookSubscriptionWithSecret
    {
        $request = RequestModels::from($request, CreateWebhookSubscriptionRequest::class);

        return $this->execute(fn () => $this->client->createAccountWebhookSubscription($this->accountId, $request));
    }

    public function get(string $webhookId): WebhookSubscription
    {
        return $this->execute(fn () => $this->client->getAccountWebhookSubscription($this->accountId, $webhookId));
    }

    /**
     * @param  UpdateWebhookSubscriptionRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function update(string $webhookId, UpdateWebhookSubscriptionRequest|array $request): WebhookSubscription
    {
        $request = RequestModels::from($request, UpdateWebhookSubscriptionRequest::class);

        return $this->execute(fn () => $this->client->patchAccountWebhookSubscription($this->accountId, $webhookId, $request));
    }

    public function delete(string $webhookId): void
    {
        $this->execute(fn () => $this->client->deleteAccountWebhookSubscription($this->accountId, $webhookId));
    }

    public function test(string $webhookId): WebhookTestResult
    {
        return $this->execute(fn () => $this->client->testAccountWebhookSubscription($this->accountId, $webhookId));
    }

    public function rotateSecret(string $webhookId): WebhookSubscriptionWithSecret
    {
        return $this->execute(fn () => $this->client->rotateAccountWebhookSecret($this->accountId, $webhookId));
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function listDeliveries(string $webhookId, array $query = []): V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listAccountWebhookDeliveries($this->accountId, $webhookId, $query));
    }

    /**
     * Iterate over all of a webhook subscription's deliveries, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `listDeliveries()`.
     * @return \Generator<int, WebhookDeliveryLog>
     */
    public function allDeliveries(string $webhookId, array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200Data => $this->listDeliveries($webhookId, $query),
            static fn (V1AccountsAccountIdWebhooksWebhookIdDeliveriesGetResponse200Data $page): array => $page->getDeliveries(),
            $query,
        );
    }

    public function retryDelivery(string $webhookId, string $deliveryId): WebhookDeliveryLog
    {
        return $this->execute(fn () => $this->client->retryAccountWebhookDelivery($this->accountId, $webhookId, $deliveryId));
    }
}
