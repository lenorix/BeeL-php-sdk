<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateSeriesRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateSeriesRequest;

/**
 * @deprecated Use a company-scoped series resource.
 *
 * @method mixed setDefault(string $seriesId)
 */
final readonly class SeriesResource extends GeneratedResource
{
    public function __construct(Client $client)
    {
        parent::__construct($client, [
            'list' => 'listSeries',
            'create' => 'createSeries',
            'update' => 'updateSeries',
            'delete' => 'deleteSeries',
            'setDefault' => 'setDefaultSeries',
        ]);
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
}
