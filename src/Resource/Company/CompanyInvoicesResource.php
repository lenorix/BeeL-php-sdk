<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ConvertProformaToInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceBatchRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceDeliveryRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceDerivationRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoicePdfArchiveRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\Invoice;
use Lenorix\BeelSdk\Generated\Model\InvoicePdfResponseData;
use Lenorix\BeelSdk\Generated\Model\SendEmailRequest;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceScheduleRequest;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceStatusRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanyInvoicesResource extends GeneratedResource
{
    public CompanyInvoiceScheduleResource $schedule;

    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        $this->schedule = new CompanyInvoiceScheduleResource($client, $companyId, $responseContext);
        parent::__construct($client, $responseContext);
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): V1CompaniesCompanyIdInvoicesGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listCompanyInvoices($this->companyId, $query));
    }

    /**
     * @param  array<string, mixed>  $query
     * @param  array<string, mixed>  $headers
     */
    public function create(CreateInvoiceRequest $request, array $query = [], array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->createCompanyInvoice($this->companyId, $request, $query, $headers));
    }

    public function get(string $invoiceId): Invoice
    {
        return $this->execute(fn () => $this->client->getCompanyInvoice($this->companyId, $invoiceId));
    }

    public function update(string $invoiceId, UpdateInvoiceRequest $request): Invoice
    {
        return $this->execute(fn () => $this->client->patchCompanyInvoice($this->companyId, $invoiceId, $request));
    }

    /**
     * @param  array<string, mixed>  $query
     * @param  array<string, mixed>  $headers
     */
    public function issue(string $invoiceId, array $query = [], array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->issueCompanyInvoice($this->companyId, $invoiceId, $query, $headers));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function void(string $invoiceId, VoidInvoiceRequest $request, array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->voidCompanyInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function createCorrective(string $invoiceId, CreateCorrectiveInvoiceRequest $request, array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->createCompanyCorrectiveInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function setStatus(string $invoiceId, SetInvoiceStatusRequest $request, array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->setCompanyInvoiceStatus($this->companyId, $invoiceId, $request, $headers));
    }

    public function getPdf(string $invoiceId): ?InvoicePdfResponseData
    {
        return $this->execute(fn () => $this->client->getCompanyInvoicePdf($this->companyId, $invoiceId));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function derive(CreateInvoiceDerivationRequest $request, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyInvoiceDerivation($this->companyId, $request, $headers));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function createBatch(CreateInvoiceBatchRequest $request, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyInvoiceBatch($this->companyId, $request, $headers));
    }

    public function createPdfArchive(CreateInvoicePdfArchiveRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyInvoicePdfArchive($this->companyId, $request));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function deliver(CreateInvoiceDeliveryRequest $request, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyInvoiceDelivery($this->companyId, $request, $headers));
    }

    public function export(CreateInvoiceExportRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyInvoiceExport($this->companyId, $request));
    }

    public function delete(string $invoiceId): void
    {
        $this->execute(fn () => $this->client->deleteCompanyInvoice($this->companyId, $invoiceId));
    }

    public function preview(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyInvoicePreview($this->companyId, $invoiceId));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function send(string $invoiceId, ?SendEmailRequest $request = null, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->sendCompanyInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function convertToInvoice(string $invoiceId, ?ConvertProformaToInvoiceRequest $request = null, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->convertCompanyProformaToInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    public function getSchedule(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyInvoiceSchedule($this->companyId, $invoiceId));
    }

    public function setSchedule(string $invoiceId, SetInvoiceScheduleRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->setCompanyInvoiceSchedule($this->companyId, $invoiceId, $request));
    }

    public function clearSchedule(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->deleteCompanyInvoiceSchedule($this->companyId, $invoiceId));
    }
}
