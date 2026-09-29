<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** A resource scoped to one account. */
abstract readonly class AccountResource extends GeneratedResource
{
    /** @internal Resources are created by {@see Beel::account()}. */
    public function __construct(Client $client, protected string $accountId, ResponseContext $responseContext)
    {
        parent::__construct($client, $responseContext);
    }
}
