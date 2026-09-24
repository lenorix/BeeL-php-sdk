<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\InvoiceCustomizationOptionsResponse;
use Lenorix\BeelSdk\Generated\Model\TaxTypesCatalogResponse;
use Lenorix\BeelSdk\Generated\Model\UpdateMeRequest;

/**
 * @method TaxTypesCatalogResponse taxTypes()
 * @method InvoiceCustomizationOptionsResponse invoiceCustomizationOptions()
 * @method mixed updateMe(UpdateMeRequest $request)
 */
final readonly class CatalogsResource extends GeneratedResource
{
    public function __construct(Client $client)
    {
        parent::__construct($client, ['taxTypes' => 'getTaxTypes', 'invoiceCustomizationOptions' => 'listInvoiceCustomizationOptions', 'updateMe' => 'updateMe']);
    }
}
