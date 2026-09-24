<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanySeriesResource extends GeneratedResource
{
    public function __construct(Client $client, string $companyId)
    {
        parent::__construct($client, ['list' => 'listCompanySeries', 'create' => 'createCompanySeries', 'get' => 'getCompanySeries', 'update' => 'patchCompanySeries', 'delete' => 'deleteCompanySeries', 'getDefaults' => 'getCompanyDefaultSeries', 'getDefault' => 'getCompanyDefaultSeries', 'setDefault' => 'setCompanyDefaultSeries', 'ensureDefaults' => 'ensureCompanyDefaultSeries'], [$companyId]);
    }
}
