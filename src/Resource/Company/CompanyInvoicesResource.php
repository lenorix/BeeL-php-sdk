<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\Invoice;
use Lenorix\BeelSdk\Generated\Model\InvoicePdfResponseData;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceStatusRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/**
 * @method \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesGetResponse200Data list(array $query = [])
 * @method \Lenorix\BeelSdk\Generated\Model\Invoice create(\Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest $request, array $query = [], array $headers = [])
 * @method mixed derive(\Lenorix\BeelSdk\Generated\Model\CreateInvoiceDerivationRequest $request, array $headers = [])
 * @method mixed createBatch(\Lenorix\BeelSdk\Generated\Model\CreateInvoiceBatchRequest $request, array $headers = [])
 * @method mixed createPdfArchive(\Lenorix\BeelSdk\Generated\Model\CreateInvoicePdfArchiveRequest $request, array $headers = [])
 * @method mixed deliver(\Lenorix\BeelSdk\Generated\Model\CreateInvoiceDeliveryRequest $request, array $headers = [])
 * @method mixed export(\Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest $request, array $headers = [])
 * @method void delete(string $invoiceId)
 * @method \Lenorix\BeelSdk\Generated\Model\Invoice get(string $invoiceId)
 * @method \Lenorix\BeelSdk\Generated\Model\Invoice update(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest $request)
 * @method mixed preview(string $invoiceId)
 * @method mixed send(string $invoiceId, ?\Lenorix\BeelSdk\Generated\Model\SendEmailRequest $request = null, array $headers = [])
 * @method \Lenorix\BeelSdk\Generated\Model\Invoice issue(string $invoiceId, array $query = [], array $headers = [])
 * @method mixed convertToInvoice(string $invoiceId, ?\Lenorix\BeelSdk\Generated\Model\ConvertProformaToInvoiceRequest $request = null, array $headers = [])
 * @method \Lenorix\BeelSdk\Generated\Model\Invoice void(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest $request, array $headers = [])
 * @method \Lenorix\BeelSdk\Generated\Model\Invoice createCorrective(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest $request, array $headers = [])
 * @method \Lenorix\BeelSdk\Generated\Model\Invoice setStatus(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\SetInvoiceStatusRequest $request, array $headers = [])
 * @method null|\Lenorix\BeelSdk\Generated\Model\InvoicePdfResponseData getPdf(string $invoiceId)
 * @method mixed getSchedule(string $invoiceId)
 * @method mixed setSchedule(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\SetInvoiceScheduleRequest $request)
 * @method mixed clearSchedule(string $invoiceId)
 */
final readonly class CompanyInvoicesResource extends GeneratedResource
{
    public CompanyInvoiceScheduleResource $schedule;

    public function __construct(Client $client, private string $companyId)
    {
        $this->schedule = new CompanyInvoiceScheduleResource($client, $companyId);
        parent::__construct($client, [
            'list' => 'listCompanyInvoices', 'create' => 'createCompanyInvoice', 'derive' => 'createCompanyInvoiceDerivation',
            'createBatch' => 'createCompanyInvoiceBatch', 'createPdfArchive' => 'createCompanyInvoicePdfArchive',
            'deliver' => 'createCompanyInvoiceDelivery', 'export' => 'createCompanyInvoiceExport', 'delete' => 'deleteCompanyInvoice',
            'get' => 'getCompanyInvoice', 'update' => 'patchCompanyInvoice', 'getPdf' => 'getCompanyInvoicePdf',
            'preview' => 'getCompanyInvoicePreview', 'send' => 'sendCompanyInvoice', 'issue' => 'issueCompanyInvoice', 'convertToInvoice' => 'convertCompanyProformaToInvoice',
            'void' => 'voidCompanyInvoice', 'createCorrective' => 'createCompanyCorrectiveInvoice', 'setStatus' => 'setCompanyInvoiceStatus',
            'getSchedule' => 'getCompanyInvoiceSchedule', 'setSchedule' => 'setCompanyInvoiceSchedule', 'clearSchedule' => 'deleteCompanyInvoiceSchedule',
        ], [$companyId]);
    }

    public function list(array $query = []): V1CompaniesCompanyIdInvoicesGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listCompanyInvoices($this->companyId, $query));
    }

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

    public function issue(string $invoiceId, array $query = [], array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->issueCompanyInvoice($this->companyId, $invoiceId, $query, $headers));
    }

    public function void(string $invoiceId, VoidInvoiceRequest $request, array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->voidCompanyInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    public function createCorrective(string $invoiceId, CreateCorrectiveInvoiceRequest $request, array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->createCompanyCorrectiveInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    public function setStatus(string $invoiceId, SetInvoiceStatusRequest $request, array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->setCompanyInvoiceStatus($this->companyId, $invoiceId, $request, $headers));
    }

    public function getPdf(string $invoiceId): ?InvoicePdfResponseData
    {
        return $this->execute(fn () => $this->client->getCompanyInvoicePdf($this->companyId, $invoiceId));
    }
}
