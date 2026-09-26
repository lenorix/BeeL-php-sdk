<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Account;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CompanyData;
use Lenorix\BeelSdk\Generated\Model\CreateCompanyRequest;
use Lenorix\BeelSdk\Generated\Model\ListCompanies200ResponseData;
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

    /**
     * Iterate over all of this account's companies, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, CompanyData>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): ListCompanies200ResponseData => $this->list($query),
            static fn (ListCompanies200ResponseData $page): array => $page->getCompanies(),
            $query,
        );
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
