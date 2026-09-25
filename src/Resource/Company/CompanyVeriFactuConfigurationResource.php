<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** Read or update whether VeriFactu applies to one company's invoices. */
final readonly class CompanyVeriFactuConfigurationResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /** Retrieve the VeriFactu setting and server-resolved fiscal regime. */
    public function get(): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyVeriFactuConfiguration($this->companyId));
    }

    /**
     * Enable or disable VeriFactu for this company's invoices.
     *
     * Sandbox companies always have VeriFactu enabled. In production, enabling it
     * requires a signed AEAT representation for the company.
     *
     * @see https://docs.beel.es/verifactu/getCompanyVeriFactuConfiguration
     */
    public function update(UpdateVeriFactuConfigurationRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->updateCompanyVeriFactuConfiguration($this->companyId, $request));
    }
}
