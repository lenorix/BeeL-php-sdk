<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateCompanyRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class AccountCompaniesResource extends GeneratedResource
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
        return $this->execute(fn () => $this->client->listCompanies($this->accountId, $query));
    }

    public function create(CreateCompanyRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createCompany($this->accountId, $request));
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function stats(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listCompanyStats($this->accountId, $query));
    }
}
