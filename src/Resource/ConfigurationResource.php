<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\InvoiceCustomizationOptionsResponse;
use Lenorix\BeelSdk\Generated\Model\TaxConfiguration;
use Lenorix\BeelSdk\Generated\Model\TaxTypesCatalog;
use Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutBody;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutResponse200Data;
use Lenorix\BeelSdk\Generated\Model\VeriFactuConfiguration;
use Lenorix\BeelSdk\Http\RequestModels;
use Lenorix\BeelSdk\Http\ResponseContext;

/** @deprecated Prefer company configuration resources and global catalogs. */
final readonly class ConfigurationResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    public function updateLanguage(string $language): V1ConfigurationLanguagePutResponse200Data
    {
        $request = (new V1ConfigurationLanguagePutBody)->setLanguage($language);

        return $this->execute(fn () => $this->client->updateLanguage($request));
    }

    public function getTaxConfig(): TaxConfiguration
    {
        return $this->execute(fn () => $this->client->getTaxConfiguration());
    }

    /**
     * @param  UpdateTaxConfigurationRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function updateTaxConfig(UpdateTaxConfigurationRequest|array $request): TaxConfiguration
    {
        $request = RequestModels::from($request, UpdateTaxConfigurationRequest::class);

        return $this->execute(fn () => $this->client->updateTaxConfiguration($request));
    }

    public function getVeriFactu(): VeriFactuConfiguration
    {
        return $this->execute(fn () => $this->client->getVeriFactuConfiguration());
    }

    /**
     * @param  UpdateVeriFactuConfigurationRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function updateVeriFactu(UpdateVeriFactuConfigurationRequest|array $request): VeriFactuConfiguration
    {
        $request = RequestModels::from($request, UpdateVeriFactuConfigurationRequest::class);

        return $this->execute(fn () => $this->client->updateVeriFactuConfiguration($request));
    }

    public function getTaxTypes(): TaxTypesCatalog
    {
        return $this->execute(fn () => $this->client->getTaxTypes());
    }

    public function getInvoiceCustomizationOptions(): InvoiceCustomizationOptionsResponse
    {
        return $this->execute(fn () => $this->client->listInvoiceCustomizationOptions());
    }
}
