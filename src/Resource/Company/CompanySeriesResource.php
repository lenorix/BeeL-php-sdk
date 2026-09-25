<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\PatchSeriesRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanySeriesResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listCompanySeries($this->companyId, $query));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function create(CreateSeriesRequest $request, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->createCompanySeries($this->companyId, $request, $headers));
    }

    public function get(string $seriesId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanySeries($this->companyId, $seriesId));
    }

    public function update(string $seriesId, PatchSeriesRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->patchCompanySeries($this->companyId, $seriesId, $request));
    }

    public function delete(string $seriesId): mixed
    {
        return $this->execute(fn () => $this->client->deleteCompanySeries($this->companyId, $seriesId));
    }

    public function getDefaults(): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyDefaultSeries($this->companyId));
    }

    public function getDefault(): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyDefaultSeries($this->companyId));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function setDefault(string $seriesId, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->setCompanyDefaultSeries($this->companyId, $seriesId, $headers));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function ensureDefaults(array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->ensureCompanyDefaultSeries($this->companyId, $headers));
    }
}
