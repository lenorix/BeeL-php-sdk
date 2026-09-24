<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\V1ConfigurationLanguagePutBody;

/** @deprecated Prefer company configuration resources and global catalogs. */
final readonly class ConfigurationResource extends GeneratedResource
{
    public function __construct(Client $client)
    {
        parent::__construct($client, ['getTaxConfig' => 'getTaxConfiguration', 'updateTaxConfig' => 'updateTaxConfiguration', 'getVeriFactu' => 'getVeriFactuConfiguration', 'updateVeriFactu' => 'updateVeriFactuConfiguration', 'getTaxTypes' => 'getTaxTypes', 'getInvoiceCustomizationOptions' => 'listInvoiceCustomizationOptions']);
    }

    public function updateLanguage(string $language): mixed
    {
        $request = (new V1ConfigurationLanguagePutBody)->setLanguage($language);

        return $this->execute(fn () => $this->client->updateLanguage($request));
    }
}
