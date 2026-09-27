<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\InvoiceSeries;
use Lenorix\BeelSdk\Generated\Model\UpdateSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationSeriesGetResponse200Data;
use Lenorix\BeelSdk\Http\RequestModels;
use Lenorix\BeelSdk\Http\ResponseContext;

/**
 * @deprecated Use a company-scoped series resource.
 */
final readonly class SeriesResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

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
        $request = RequestModels::from($request, CreateSeriesRequest::class);

        return $this->execute(fn () => $this->client->createSeries($request));
    }

    /**
     * @param  UpdateSeriesRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function update(string $seriesId, UpdateSeriesRequest|array $request): InvoiceSeries
    {
        $request = RequestModels::from($request, UpdateSeriesRequest::class);

        return $this->execute(fn () => $this->client->updateSeries($seriesId, $request));
    }

    public function delete(string $seriesId): void
    {
        $this->execute(fn () => $this->client->deleteSeries($seriesId));
    }

    public function setDefault(string $seriesId): InvoiceSeries
    {
        return $this->execute(fn () => $this->client->setDefaultSeries($seriesId));
    }
}
