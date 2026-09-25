<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanyTaxConfigurationResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    public function get(): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyTaxConfiguration($this->companyId));
    }

    public function update(UpdateTaxConfigurationRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->updateCompanyTaxConfiguration($this->companyId, $request));
    }
}
