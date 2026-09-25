<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequest;
use Lenorix\BeelSdk\Http\ResponseContext;

final readonly class AccountsResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    public function scope(string $accountId): AccountScope
    {
        return new AccountScope($this->client, $accountId, $this->responseContext);
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listAccounts($query));
    }

    public function provision(ProvisionAccountRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->provisionAccount($request));
    }

    public function get(string $accountId): mixed
    {
        return $this->execute(fn () => $this->client->getAccount($accountId));
    }
}
