<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanyVeriFactuConfigurationResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    public function get(): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyVeriFactuConfiguration($this->companyId));
    }

    public function update(UpdateVeriFactuConfigurationRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->updateCompanyVeriFactuConfiguration($this->companyId, $request));
    }
}
