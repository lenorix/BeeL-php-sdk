<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class AccountEmailsResource extends GeneratedResource
{
    public function __construct(Client $client, string $accountId)
    {
        parent::__construct($client, ['list' => 'listAccountEmailDeliveries', 'indicators' => 'getAccountEmailDeliveryIndicators', 'get' => 'getAccountEmailDelivery'], [$accountId]);
    }
}
