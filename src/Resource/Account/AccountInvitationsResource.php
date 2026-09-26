<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateInvitationRequest;
use Lenorix\BeelSdk\Generated\Model\InvitationSummary;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsGetResponse200Data;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class AccountInvitationsResource extends GeneratedResource
{
    public function __construct(Client $client, private string $accountId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * @param  array<string, mixed>  $query  Pagination options such as `page` and `limit`.
     */
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listAccountInvitations($this->accountId, $query));
    }

    /**
     * Iterate over all of this account's invitations, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, InvitationSummary>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): V1AccountsAccountIdInvitationsGetResponse200Data => $this->list($query),
            static fn (V1AccountsAccountIdInvitationsGetResponse200Data $page): array => $page->getInvitations(),
            $query,
        );
    }

    public function create(CreateInvitationRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createAccountInvitation($this->accountId, $request));
    }

    public function get(string $invitationId): mixed
    {
        return $this->execute(fn () => $this->client->getAccountInvitation($this->accountId, $invitationId));
    }

    public function revoke(string $invitationId): void
    {
        $this->execute(fn () => $this->client->deleteAccountInvitation($this->accountId, $invitationId));
    }
}
