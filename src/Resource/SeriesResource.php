<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\InvoiceSeries;
use Lenorix\BeelSdk\Generated\Model\UpdateSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesGetResponse200Data;

/**
 * @deprecated Use a company-scoped series resource.
 */
final readonly class SeriesResource extends GeneratedResource
{
    public function list(?bool $active = null): V1ConfigurationSeriesGetResponse200Data
    {
        $query = $active === null ? [] : ['active' => $active];

        return $this->execute(fn () => $this->client->listSeries($query));
    }

    /**
     * @param  CreateSeriesRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function create(CreateSeriesRequest|array $request): InvoiceSeries
    {
        $request = $this->model($request, CreateSeriesRequest::class);

        return $this->execute(fn () => $this->client->createSeries($request));
    }

    /**
     * @param  UpdateSeriesRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function update(string $seriesId, UpdateSeriesRequest|array $request): InvoiceSeries
    {
        $request = $this->model($request, UpdateSeriesRequest::class);

        return $this->execute(fn () => $this->client->updateSeries($seriesId, $request));
    }

    public function delete(string $seriesId): void
    {
        $this->executeVoid(fn () => $this->client->deleteSeries($seriesId));
    }

    public function setDefault(string $seriesId): InvoiceSeries
    {
        return $this->execute(fn () => $this->client->setDefaultSeries($seriesId));
    }
}
