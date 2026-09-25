<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\UpdateTaxConfigurationRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateVeriFactuConfigurationRequest;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutBody;
use Lenorix\BeelSdk\Http\ResponseContext;

/** @deprecated Prefer company configuration resources and global catalogs. */
final readonly class ConfigurationResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    public function updateLanguage(string $language): mixed
    {
        $request = (new V1ConfigurationLanguagePutBody)->setLanguage($language);

        return $this->execute(fn () => $this->client->updateLanguage($request));
    }

    public function getTaxConfig(): mixed
    {
        return $this->execute(fn () => $this->client->getTaxConfiguration());
    }

    public function updateTaxConfig(UpdateTaxConfigurationRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->updateTaxConfiguration($request));
    }

    public function getVeriFactu(): mixed
    {
        return $this->execute(fn () => $this->client->getVeriFactuConfiguration());
    }

    public function updateVeriFactu(UpdateVeriFactuConfigurationRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->updateVeriFactuConfiguration($request));
    }

    public function getTaxTypes(): mixed
    {
        return $this->execute(fn () => $this->client->getTaxTypes());
    }

    public function getInvoiceCustomizationOptions(): mixed
    {
        return $this->execute(fn () => $this->client->listInvoiceCustomizationOptions());
    }
}
