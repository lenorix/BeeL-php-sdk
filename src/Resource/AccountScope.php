<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ChangeAccessLevelRequest;
use Lenorix\BeelSdk\Generated\Model\CreateClaimTokenRequest;
use Lenorix\BeelSdk\Generated\Model\SetAccountOwnerRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\Account\AccountCompaniesResource;
use Lenorix\BeelSdk\Resource\Account\AccountEmailsResource;
use Lenorix\BeelSdk\Resource\Account\AccountInvitationsResource;
use Lenorix\BeelSdk\Resource\Account\AccountMembersResource;
use Lenorix\BeelSdk\Resource\Account\AccountWebhooksResource;

final readonly class AccountScope extends GeneratedResource
{
    public AccountCompaniesResource $companies;

    public AccountMembersResource $members;

    public AccountInvitationsResource $invitations;

    public AccountWebhooksResource $webhooks;

    public AccountEmailsResource $emails;

    public function __construct(Client $client, public string $accountId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
        $this->companies = new AccountCompaniesResource($client, $accountId, $this->responseContext);
        $this->members = new AccountMembersResource($client, $accountId, $this->responseContext);
        $this->invitations = new AccountInvitationsResource($client, $accountId, $this->responseContext);
        $this->webhooks = new AccountWebhooksResource($client, $accountId, $this->responseContext);
        $this->emails = new AccountEmailsResource($client, $accountId, $this->responseContext);
    }

    public function get(): mixed
    {
        return $this->execute(fn () => $this->client->getAccount($this->accountId));
    }

    public function usage(): mixed
    {
        return $this->execute(fn () => $this->client->getAccountUsage($this->accountId));
    }

    public function changeAccessLevel(ChangeAccessLevelRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->changeManagedAccountAccessLevel($this->accountId, $request));
    }

    public function createClaimToken(?CreateClaimTokenRequest $request = null): mixed
    {
        return $this->execute(fn () => $this->client->createAccountClaimToken($this->accountId, $request));
    }

    public function setOwner(SetAccountOwnerRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->putAccountOwner($this->accountId, $request));
    }

    public function endManagement(): mixed
    {
        return $this->execute(fn () => $this->client->endAccountManagement($this->accountId));
    }
}
