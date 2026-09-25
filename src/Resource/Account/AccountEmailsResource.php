<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class AccountEmailsResource extends GeneratedResource
{
    public function __construct(Client $client, private string $accountId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listAccountEmailDeliveries($this->accountId, $query));
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function indicators(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->getAccountEmailDeliveryIndicators($this->accountId, $query));
    }

    public function get(string $emailId): mixed
    {
        return $this->execute(fn () => $this->client->getAccountEmailDelivery($this->accountId, $emailId));
    }
}
