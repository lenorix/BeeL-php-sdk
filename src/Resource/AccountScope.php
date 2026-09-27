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
use Lenorix\BeelSdk\Http\RequestModels;
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
    public function get(): ManagedAccountSummary
    {
        return $this->execute(fn () => $this->client->getAccount($this->accountId));
    }

    /**
     * Retrieve usage and billing counters for this account.
     *
     * @return ProvisioningUsage Current account usage.
     */
    public function usage(): ProvisioningUsage
    {
        return $this->execute(fn () => $this->client->getAccountUsage($this->accountId));
    }

    /** Change the access level for a managed acco     *
     * @param  ChangeAccessLevelRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function changeAccessLevel(ChangeAccessLevelRequest|array $request): void
    {
        $request = RequestModels::from($request, ChangeAccessLevelRequest::class);

        $this->execute(fn () => $this->client->changeManagedAccountAccessLevel($this->accountId, $request));
    }

    /**
     * Create a token that lets the account owner claim this managed account.
     *
     * @param  CreateClaimTokenRequest|array<string, mixed>|null  $request  The request as a model or as an array in API format.
     * @return ClaimTokenResult Claim URL/token and expiration details.
     */
    public function createClaimToken(CreateClaimTokenRequest|array|null $request = null): ClaimTokenResult
    {
        $request = RequestModels::from($request, CreateClaimTokenRequest::class);

        return $this->execute(fn () => $this->client->createAccountClaimToken($this->accountId, $request));
    }

    /** Transfer account ownership to another mem     *
     * @param  SetAccountOwnerRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function setOwner(SetAccountOwnerRequest|array $request): void
    {
        $request = RequestModels::from($request, SetAccountOwnerRequest::class);

        $this->execute(fn () => $this->client->putAccountOwner($this->accountId, $request));
    }

    /** End the management relationship for this account. */
    public function endManagement(): void
    {
        $this->execute(fn () => $this->client->endAccountManagement($this->accountId));
    }
}
