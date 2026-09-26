<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryListResponseData;
use Lenorix\BeelSdk\Generated\Model\EmailDeliveryResponse;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class AccountEmailsResource extends GeneratedResource
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
        return $this->execute(fn () => $this->client->listAccountEmailDeliveries($this->accountId, $query));
    }

    /**
     * Iterate over all of this account's email deliveries, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, EmailDeliveryResponse>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): EmailDeliveryListResponseData => $this->list($query),
            static fn (EmailDeliveryListResponseData $page): array => $page->getEmails(),
            $query,
        );
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function indicators(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->getAccountEmailDeliveryIndicators($this->accountId, $query));
    }

    public function get(string $emailId): mixed
    {
        return $this->execute(fn () => $this->client->getAccountEmailDelivery($this->accountId, $emailId));
    }
}
