<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\AccountMember;
use Lenorix\BeelSdk\Generated\Model\ChangeMemberRoleRequest;
use Lenorix\BeelSdk\Generated\Model\GrantAssignment;
use Lenorix\BeelSdk\Generated\Model\PutMemberGrantRequest;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsGetResponse200Data;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class AccountMembersResource extends GeneratedResource
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
        return $this->execute(fn () => $this->client->listAccountMembers($this->accountId, $query));
    }

    /**
     * Iterate over all of this account's members, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, AccountMember>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): V1AccountsAccountIdMembersGetResponse200Data => $this->list($query),
            static fn (V1AccountsAccountIdMembersGetResponse200Data $page): array => $page->getMembers(),
            $query,
        );
    }

    public function get(string $memberId): mixed
    {
        return $this->execute(fn () => $this->client->getAccountMember($this->accountId, $memberId));
    }

    public function update(string $memberId, ChangeMemberRoleRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->patchAccountMember($this->accountId, $memberId, $request));
    }

    public function remove(string $memberId): void
    {
        $this->execute(fn () => $this->client->deleteAccountMember($this->accountId, $memberId));
    }

    /**
     * @param  array<string, mixed>  $query  Pagination options such as `page` and `limit`.
     */
    public function listGrants(string $memberId, array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listAccountMemberGrants($this->accountId, $memberId, $query));
    }

    /**
     * Iterate over all of a member's company grants, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `listGrants()`.
     * @return \Generator<int, GrantAssignment>
     */
    public function allGrants(string $memberId, array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): V1AccountsAccountIdMembersMemberIdGrantsGetResponse200Data => $this->listGrants($memberId, $query),
            static fn (V1AccountsAccountIdMembersMemberIdGrantsGetResponse200Data $page): array => $page->getGrants(),
            $query,
        );
    }

    public function putGrant(string $memberId, string $companyId, PutMemberGrantRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->putAccountMemberGrant($this->accountId, $memberId, $companyId, $request));
    }

    public function removeGrant(string $memberId, string $companyId): void
    {
        $this->execute(fn () => $this->client->deleteAccountMemberGrant($this->accountId, $memberId, $companyId));
    }
}
