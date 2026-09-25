<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateInvitationRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class AccountInvitationsResource extends GeneratedResource
{
    public function __construct(Client $client, private string $accountId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    public function list(): mixed
    {
        return $this->execute(fn () => $this->client->listAccountInvitations($this->accountId));
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
