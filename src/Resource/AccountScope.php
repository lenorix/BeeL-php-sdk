<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ChangeAccessLevelRequest;
use Lenorix\BeelSdk\Generated\Model\ClaimTokenResult;
use Lenorix\BeelSdk\Generated\Model\CreateClaimTokenRequest;
use Lenorix\BeelSdk\Generated\Model\ManagedAccountSummary;
use Lenorix\BeelSdk\Generated\Model\ProvisioningUsage;
use Lenorix\BeelSdk\Generated\Model\SetAccountOwnerRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\Account\AccountCompaniesResource;
use Lenorix\BeelSdk\Resource\Account\AccountEmailsResource;
use Lenorix\BeelSdk\Resource\Account\AccountInvitationsResource;
use Lenorix\BeelSdk\Resource\Account\AccountMembersResource;
use Lenorix\BeelSdk\Resource\Account\AccountWebhooksResource;

/** Account-level resources and operations for one BeeL account. */
final readonly class AccountScope extends GeneratedResource
{
    /** Companies (NIFs) owned by or managed within this account. */
    public AccountCompaniesResource $companies;

    /** Account members and their company permissions. */
    public AccountMembersResource $members;

    /** Account member invitations. */
    public AccountInvitationsResource $invitations;

    /** Webhook subscriptions and delivery history for this account. */
    public AccountWebhooksResource $webhooks;

    /** Email delivery history and account-level delivery indicators. */
    public AccountEmailsResource $emails;

    /** @param string $accountId Account UUID returned by BeeL. */
    public function __construct(Client $client, public string $accountId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
        $this->companies = new AccountCompaniesResource($client, $accountId, $this->responseContext);
        $this->members = new AccountMembersResource($client, $accountId, $this->responseContext);
        $this->invitations = new AccountInvitationsResource($client, $accountId, $this->responseContext);
        $this->webhooks = new AccountWebhooksResource($client, $accountId, $this->responseContext);
        $this->emails = new AccountEmailsResource($client, $accountId, $this->responseContext);
    }

    /**
     * Retrieve account details and the caller's access level.
     *
     * @return ManagedAccountSummary Account details and access level.
     */
    public function get(): mixed
    {
        return $this->execute(fn () => $this->client->getAccount($this->accountId));
    }

    /**
     * Retrieve usage and billing counters for this account.
     *
     * @return ProvisioningUsage Current account usage.
     */
    public function usage(): mixed
    {
        return $this->execute(fn () => $this->client->getAccountUsage($this->accountId));
    }

    /** Change the access level for a managed account. */
    public function changeAccessLevel(ChangeAccessLevelRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->changeManagedAccountAccessLevel($this->accountId, $request));
    }

    /**
     * Create a token that lets the account owner claim this managed account.
     *
     * @return ClaimTokenResult Claim URL/token and expiration details.
     */
    public function createClaimToken(?CreateClaimTokenRequest $request = null): mixed
    {
        return $this->execute(fn () => $this->client->createAccountClaimToken($this->accountId, $request));
    }

    /** Transfer account ownership to another member. */
    public function setOwner(SetAccountOwnerRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->putAccountOwner($this->accountId, $request));
    }

    /** End the management relationship for this account. */
    public function endManagement(): mixed
    {
        return $this->execute(fn () => $this->client->endAccountManagement($this->accountId));
    }
}
