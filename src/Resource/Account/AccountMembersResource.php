<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/**
 * @method mixed list()
 * @method mixed get(string $memberId)
 * @method mixed update(string $memberId, \Lenorix\BeelSdk\Generated\Model\ChangeMemberRoleRequest $request)
 * @method void remove(string $memberId)
 * @method mixed listGrants(string $memberId)
 * @method mixed putGrant(string $memberId, string $companyId, \Lenorix\BeelSdk\Generated\Model\PutMemberGrantRequest $request)
 * @method void removeGrant(string $memberId, string $companyId)
 */
final readonly class AccountMembersResource extends GeneratedResource
{
    public function __construct(Client $client, string $accountId)
    {
        parent::__construct($client, [
            'list' => 'listAccountMembers',
            'get' => 'getAccountMember',
            'update' => 'patchAccountMember',
            'remove' => 'deleteAccountMember',
            'listGrants' => 'listAccountMemberGrants',
            'putGrant' => 'putAccountMemberGrant',
            'removeGrant' => 'deleteAccountMemberGrant',
        ], [$accountId]);
    }
}
