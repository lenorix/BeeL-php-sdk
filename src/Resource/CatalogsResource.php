<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\InvoiceCustomizationOptionsResponse;
use Lenorix\BeelSdk\Generated\Model\TaxTypesCatalogResponse;
use Lenorix\BeelSdk\Generated\Model\UpdateMeRequest;
use Lenorix\BeelSdk\Http\ResponseContext;

final readonly class CatalogsResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    public function taxTypes(): TaxTypesCatalogResponse
    {
        return $this->execute(fn () => $this->client->getTaxTypes());
    }

    public function invoiceCustomizationOptions(): InvoiceCustomizationOptionsResponse
    {
        return $this->execute(fn () => $this->client->listInvoiceCustomizationOptions());
    }

    public function updateMe(UpdateMeRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->updateMe($request));
    }
}
