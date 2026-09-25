<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateSeriesRequest;
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

    public function list(?bool $active = null): mixed
    {
        $query = $active === null ? [] : ['active' => $active];

        return $this->execute(fn () => $this->client->listSeries($query));
    }

    public function create(CreateSeriesRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createSeries($request));
    }

    public function update(string $seriesId, UpdateSeriesRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->updateSeries($seriesId, $request));
    }

    public function delete(string $seriesId): mixed
    {
        return $this->execute(fn () => $this->client->deleteSeries($seriesId));
    }

    public function setDefault(string $seriesId): mixed
    {
        return $this->execute(fn () => $this->client->setDefaultSeries($seriesId));
    }
}
