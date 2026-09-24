<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateInvitationRequest;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/**
 * @method mixed list()
 * @method mixed create(CreateInvitationRequest $request)
 * @method mixed get(string $invitationId)
 * @method void revoke(string $invitationId)
 */
final readonly class AccountInvitationsResource extends GeneratedResource
{
    public function __construct(Client $client, string $accountId)
    {
        parent::__construct($client, [
            'list' => 'listAccountInvitations',
            'create' => 'createAccountInvitation',
            'get' => 'getAccountInvitation',
            'revoke' => 'deleteAccountInvitation',
        ], [$accountId]);
    }
}
