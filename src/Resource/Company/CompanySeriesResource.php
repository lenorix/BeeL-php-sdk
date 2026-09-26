<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\InvoiceSeries;
use Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdSeriesGetResponse200Data;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** Manage invoice numbering series for one company. */
final readonly class CompanySeriesResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * List invoice series for this company.
     *
     * @param  array<string, mixed>  $query  Series filters accepted by BeeL.
     */
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listCompanySeries($this->companyId, $query));
    }

    /**
     * Iterate over all of this company's invoice series, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, InvoiceSeries>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): V1CompaniesCompanyIdSeriesGetResponse200Data => $this->list($query),
            static fn (V1CompaniesCompanyIdSeriesGetResponse200Data $page): array => $page->getSeries(),
            $query,
        );
    }

    /**
     * Create an invoice numbering series.
     *
     * @param  array<string, mixed>  $headers  Optional request headers.
     */
    public function create(CreateSeriesRequest $request, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->createCompanySeries($this->companyId, $request, $headers));
    }

    /** Retrieve one numbering series. */
    public function get(string $seriesId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanySeries($this->companyId, $seriesId));
    }

    /** Partially update a series; omitted fields remain unchanged. */
    public function update(string $seriesId, PatchSeriesRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->patchCompanySeries($this->companyId, $seriesId, $request));
    }

    /** Delete a series that is no longer in use. */
    public function delete(string $seriesId): mixed
    {
        return $this->execute(fn () => $this->client->deleteCompanySeries($this->companyId, $seriesId));
    }

    /** Retrieve the default series assignments for this company's invoice types. */
    public function getDefaults(): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyDefaultSeries($this->companyId));
    }

    /** Alias for {@see getDefaults()}. */
    public function getDefault(): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyDefaultSeries($this->companyId));
    }

    /**
     * Set the default series for this company's invoices.
     *
     * @param  array<string, mixed>  $headers  Optional request headers.
     */
    public function setDefault(string $seriesId, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->setCompanyDefaultSeries($this->companyId, $seriesId, $headers));
    }

    /**
     * Create BeeL's default series when they are missing.
     *
     * @param  array<string, mixed>  $headers  Optional request headers.
     */
    public function ensureDefaults(array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->ensureCompanyDefaultSeries($this->companyId, $headers));
    }
}
