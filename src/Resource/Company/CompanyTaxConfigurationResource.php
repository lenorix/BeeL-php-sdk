<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** Read and update the tax defaults for one company's fiscal profile. */
final readonly class CompanyTaxConfigurationResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /** Retrieve this company's tax configuration and default tax settings. */
    public function get(): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyTaxConfiguration($this->companyId));
    }

    /** Update the company's tax defaults used by the BeeL dashboard. */
    public function update(UpdateTaxConfigurationRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->updateCompanyTaxConfiguration($this->companyId, $request));
    }
}
