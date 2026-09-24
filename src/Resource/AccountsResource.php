<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;

/**
 * @method mixed list(array $query = [])
 * @method mixed provision(\Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequest $request)
 * @method mixed get(string $accountId)
 */
final readonly class AccountsResource extends GeneratedResource
{
    public function __construct(Client $client)
    {
        parent::__construct($client, ['list' => 'listAccounts', 'provision' => 'provisionAccount', 'get' => 'getAccount']);
    }

    public function scope(string $accountId): AccountScope
    {
        return new AccountScope($this->client, $accountId);
    }
}
