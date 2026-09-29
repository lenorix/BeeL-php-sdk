<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Model\InvoiceCustomization;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceCustomizationRequest;

/** How this company's invoices look: PDF template, colour and languages. */
final readonly class CompanyInvoiceCustomizationResource extends CompanyResource
{
    /**
     * Retrieve this company's invoice customization.
     *
     * @see https://docs.beel.es/companies/getCompanyInvoiceCustomization
     */
    public function get(): InvoiceCustomization
    {
        return $this->execute(fn () => $this->client->getCompanyInvoiceCustomization($this->companyId));
    }

    /**
     * Update this company's invoice customization.
     *
     * @param  UpdateInvoiceCustomizationRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Request headers, including optional `Idempotency-Key`.
     *
     * @see https://docs.beel.es/companies/updateCompanyInvoiceCustomization
     */
    public function update(UpdateInvoiceCustomizationRequest|array $request, array $headers = []): InvoiceCustomization
    {
        $request = $this->model($request, UpdateInvoiceCustomizationRequest::class);

        return $this->execute(fn () => $this->client->updateCompanyInvoiceCustomization($this->companyId, $request, $headers));
    }
}
