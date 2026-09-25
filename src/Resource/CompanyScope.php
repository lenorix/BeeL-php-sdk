<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\Company\CompanyCustomersResource;
use Lenorix\BeelSdk\Resource\Company\CompanyInvoicesResource;
use Lenorix\BeelSdk\Resource\Company\CompanyPaymentConnectionsResource;
use Lenorix\BeelSdk\Resource\Company\CompanyProductsResource;
use Lenorix\BeelSdk\Resource\Company\CompanyRecurringInvoicesResource;
use Lenorix\BeelSdk\Resource\Company\CompanySeriesResource;
use Lenorix\BeelSdk\Resource\Company\CompanyTaxConfigurationResource;
use Lenorix\BeelSdk\Resource\Company\CompanyVeriFactuConfigurationResource;

final readonly class CompanyScope extends GeneratedResource
{
    public CompanyInvoicesResource $invoices;

    public CompanyCustomersResource $customers;

    public CompanyProductsResource $products;

    public CompanySeriesResource $series;

    public CompanyRecurringInvoicesResource $recurringInvoices;

    public CompanyPaymentConnectionsResource $paymentConnections;

    public CompanyTaxConfigurationResource $taxConfiguration;

    public CompanyVeriFactuConfigurationResource $verifactuConfiguration;

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
    }

    public function get(): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyById($this->companyId));
    }

    public function update(UpdateCompanyRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->patchCompanyById($this->companyId, $request));
    }

    public function delete(): mixed
    {
        return $this->execute(fn () => $this->client->deleteCompanyById($this->companyId));
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function fiscalSummary(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyFiscalSummary($this->companyId, $query));
    }

    public function issuingReadiness(): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyIssuingReadiness($this->companyId));
    }
}
