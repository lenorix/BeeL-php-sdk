<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ManagedAccountSummary;
use Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequest;
use Lenorix\BeelSdk\Generated\Model\V1AccountsGetResponse200Data;
use Lenorix\BeelSdk\Http\ResponseContext;

final readonly class AccountsResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    public function scope(string $accountId): AccountScope
    {
        return $this->inheritOptions(new AccountScope($this->client, $accountId, $this->responseContext));
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listAccounts($query));
    }

    /**
     * Iterate over all accounts, across every page.
     *
     * Pages are fetched lazily while you iterate by following `next_cursor`.
     * Filters and `limit` apply to every page.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, ManagedAccountSummary>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginateCursor(
            fn (array $query): V1AccountsGetResponse200Data => $this->list($query),
            static fn (V1AccountsGetResponse200Data $page): array => $page->getAccounts(),
            static fn (V1AccountsGetResponse200Data $page): ?string => $page->isInitialized('nextCursor') ? $page->getNextCursor() : null,
            $query,
        );
    }

    public function provision(ProvisionAccountRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->provisionAccount($request));
    }

    public function get(string $accountId): mixed
    {
        return $this->execute(fn () => $this->client->getAccount($accountId));
    }
}
