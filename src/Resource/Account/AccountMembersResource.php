<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ChangeMemberRoleRequest;
use Lenorix\BeelSdk\Generated\Model\PutMemberGrantRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class AccountMembersResource extends GeneratedResource
{
    public function __construct(Client $client, private string $accountId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    public function list(): mixed
    {
        return $this->execute(fn () => $this->client->listAccountMembers($this->accountId));
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

    public function listGrants(string $memberId): mixed
    {
        return $this->execute(fn () => $this->client->listAccountMemberGrants($this->accountId, $memberId));
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
