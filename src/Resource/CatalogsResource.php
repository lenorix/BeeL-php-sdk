<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Model\InvoiceCustomizationOptionsResponse;
use Lenorix\BeelSdk\Generated\Model\MyPreferences;
use Lenorix\BeelSdk\Generated\Model\TaxTypesCatalog;
use Lenorix\BeelSdk\Generated\Model\UpdateMeRequest;

/** Read-only shared API catalogs and person-level preferences. */
final readonly class CatalogsResource extends GeneratedResource
{
    /** List the tax types and regimes accepted by the API. */
    public function taxTypes(): TaxTypesCatalog
    {
        return $this->execute(fn () => $this->client->listTaxTypes());
    }

    /** List the options available when customizing invoice appearance. */
    public function invoiceCustomizationOptions(): InvoiceCustomizationOptionsResponse
    {
        return $this->execute(fn () => $this->client->listInvoiceCustomizationOptions());
    }

    /**
     * Update preferences for the authenticated person, such as language.
     *
     * @param  UpdateMeRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function updateMe(UpdateMeRequest|array $request): MyPreferences
    {
        return $this->inheritOptions(new MeResource($this->client, $this->responseContext))->update($request);
    }
}
