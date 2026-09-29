<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CompanyData;
use Lenorix\BeelSdk\Generated\Model\FiscalSummaryResponse;
use Lenorix\BeelSdk\Generated\Model\IssuingReadinessData;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyRequest;
use Lenorix\BeelSdk\Http\RequestModels;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\Company\CompanyActivationsResource;
use Lenorix\BeelSdk\Resource\Company\CompanyCustomersResource;
use Lenorix\BeelSdk\Resource\Company\CompanyInvoiceCustomizationResource;
use Lenorix\BeelSdk\Resource\Company\CompanyInvoicesResource;
use Lenorix\BeelSdk\Resource\Company\CompanyLogoResource;
use Lenorix\BeelSdk\Resource\Company\CompanyPaymentConnectionsResource;
use Lenorix\BeelSdk\Resource\Company\CompanyProductsResource;
use Lenorix\BeelSdk\Resource\Company\CompanyRecurringInvoicesResource;
use Lenorix\BeelSdk\Resource\Company\CompanyRepresentationResource;
use Lenorix\BeelSdk\Resource\Company\CompanySeriesResource;
use Lenorix\BeelSdk\Resource\Company\CompanyTaxConfigurationResource;
use Lenorix\BeelSdk\Resource\Company\CompanyVeriFactuConfigurationResource;

/**
 * Resource access for one company (one fiscal identity/NIF).
 *
 * The company UUID is placed in every company-scoped URL. This avoids relying
 * on an account's active-company selection when it owns or manages multiple NIFs.
 */
final readonly class CompanyScope extends GeneratedResource
{
    /** Invoice creation, issue, correction, delivery and PDF operations for this company. */
    public CompanyInvoicesResource $invoices;

    /** Customer records belonging to this company. */
    public CompanyCustomersResource $customers;

    /** Product catalog belonging to this company. */
    public CompanyProductsResource $products;

    /** Invoice numbering series belonging to this company. */
    public CompanySeriesResource $series;

    /** Recurring invoice templates belonging to this company. */
    public CompanyRecurringInvoicesResource $recurringInvoices;

    /** Payment provider connections and their event history for this company. */
    public CompanyPaymentConnectionsResource $paymentConnections;

    /** Tax configuration for this company's fiscal profile. */
    public CompanyTaxConfigurationResource $taxConfiguration;

    /** VeriFactu configuration for this company's fiscal profile. */
    public CompanyVeriFactuConfigurationResource $verifactuConfiguration;

    /** The AEAT representation this company signs to invoice in production. */
    public CompanyRepresentationResource $representation;

    /** Switch this company on or off in Test or Live. */
    public CompanyActivationsResource $activations;

    /** PDF template, colour and languages of this company's invoices. */
    public CompanyInvoiceCustomizationResource $invoiceCustomization;

    /** The logo printed on this company's invoices. */
    public CompanyLogoResource $logo;

    /**
     * @param  string  $companyId  Company UUID, not its NIF or legal name.
     */
    public function __construct(Client $client, public string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
        $this->invoices = new CompanyInvoicesResource($client, $companyId, $this->responseContext);
        $this->customers = new CompanyCustomersResource($client, $companyId, $this->responseContext);
        $this->products = new CompanyProductsResource($client, $companyId, $this->responseContext);
        $this->series = new CompanySeriesResource($client, $companyId, $this->responseContext);
        $this->recurringInvoices = new CompanyRecurringInvoicesResource($client, $companyId, $this->responseContext);
        $this->paymentConnections = new CompanyPaymentConnectionsResource($client, $companyId, $this->responseContext);
        $this->taxConfiguration = new CompanyTaxConfigurationResource($client, $companyId, $this->responseContext);
        $this->verifactuConfiguration = new CompanyVeriFactuConfigurationResource($client, $companyId, $this->responseContext);
        $this->representation = new CompanyRepresentationResource($client, $companyId, $this->responseContext);
        $this->activations = new CompanyActivationsResource($client, $companyId, $this->responseContext);
        $this->invoiceCustomization = new CompanyInvoiceCustomizationResource($client, $companyId, $this->responseContext);
        $this->logo = new CompanyLogoResource($client, $companyId, $this->responseContext);
    }

    /**
     * Retrieve this company's profile and fiscal identity.
     *
     * @return CompanyData Company data, unwrapped from BeeL's response envelope.
     */
    public function get(): CompanyData
    {
        return $this->execute(fn () => $this->client->getCompanyById($this->companyId));
    }

    /**
     * Partially update this company's profile with the fields provided.
     *
     * @param  UpdateCompanyRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @return CompanyData Updated company data.
     */
    public function update(UpdateCompanyRequest|array $request): CompanyData
    {
        $request = RequestModels::from($request, UpdateCompanyRequest::class);

        return $this->execute(fn () => $this->client->patchCompanyById($this->companyId, $request));
    }

    /** Delete this company profile. */
    public function delete(): void
    {
        $this->executeVoid(fn () => $this->client->deleteCompanyById($this->companyId));
    }

    /**
     * Return the company's fiscal summary for the requested period.
     *
     * @param  array<string, mixed>  $query
     * @return FiscalSummaryResponse Totals and invoice counts for the requested period.
     */
    public function fiscalSummary(array $query = []): FiscalSummaryResponse
    {
        return $this->execute(fn () => $this->client->getCompanyFiscalSummary($this->companyId, $query));
    }

    /**
     * Check which company setup requirements currently block invoice issuance.
     *
     * @return IssuingReadinessData Readiness and any issuance blockers.
     *
     * @see https://docs.beel.es/companies/getCompanyIssuingReadiness
     */
    public function issuingReadiness(): IssuingReadinessData
    {
        return $this->execute(fn () => $this->client->getCompanyIssuingReadiness($this->companyId));
    }
}
