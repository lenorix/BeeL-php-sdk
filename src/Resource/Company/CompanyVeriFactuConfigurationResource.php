<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanyVeriFactuConfigurationResource extends GeneratedResource
{
    public function __construct(Client $client, string $companyId)
    {
        parent::__construct($client, ['get' => 'getCompanyVeriFactuConfiguration', 'update' => 'updateCompanyVeriFactuConfiguration'], [$companyId]);
    }
}
