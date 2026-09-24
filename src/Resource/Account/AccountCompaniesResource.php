<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/**
 * @method mixed list(array $query = [])
 * @method mixed create(\Lenorix\BeelSdk\Generated\Model\CreateCompanyRequest $request)
 * @method mixed stats(array $query = [])
 */
final readonly class AccountCompaniesResource extends GeneratedResource
{
    public function __construct(Client $client, string $accountId)
    {
        parent::__construct($client, [
            'list' => 'listCompanies',
            'create' => 'createCompany',
            'stats' => 'listCompanyStats',
        ], [$accountId]);
    }
}
