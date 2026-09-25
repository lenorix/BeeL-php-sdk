<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\BulkOperationResult;
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
use Lenorix\BeelSdk\Generated\Model\InvoicePreviewResponseData;
use Lenorix\BeelSdk\Generated\Model\InvoiceSchedule;
use Lenorix\BeelSdk\Generated\Model\SendEmailRequest;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceScheduleRequest;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceStatusRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Data;
use Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** Invoice lifecycle and document operations for a single company. */
final readonly class CompanyInvoicesResource extends GeneratedResource
{
    /** Set, inspect or clear a future issue date for an invoice. */
    public CompanyInvoiceScheduleResource $schedule;

    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        $this->schedule = new CompanyInvoiceScheduleResource($client, $companyId, $responseContext);
        parent::__construct($client, $responseContext);
    }

    /**
     * List this company's invoices.
     *
     * The result contains the invoice collection and pagination metadata.
     *
     * @param  array<string, mixed>  $query  Invoice filters and pagination options.
     *
     * @see https://docs.beel.es/invoices/listCompanyInvoices
     */
    public function list(array $query = []): V1CompaniesCompanyIdInvoicesGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listCompanyInvoices($this->companyId, $query));
    }

    /**
     * Create an invoice for this company.
     *
     * BeeL creates a draft unless `options.issue_directly` is true. With VeriFactu
     * enabled, submission to AEAT completes asynchronously. Use `wait_for_pdf` when
     * the response must wait for PDF generation.
     *
     * @param  array<string, mixed>  $query  Query options such as `wait_for_pdf`.
     * @param  array<string, mixed>  $headers  Request headers, including optional `Idempotency-Key`.
     * @return Invoice The created invoice, unwrapped from BeeL's response envelope.
     *
     * @see https://docs.beel.es/invoices/createCompanyInvoice
     */
    public function create(CreateInvoiceRequest $request, array $query = [], array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->createCompanyInvoice($this->companyId, $request, $query, $headers));
    }

    /** Retrieve an invoice, including its recipient, lines, totals and VeriFactu state. */
    public function get(string $invoiceId): Invoice
    {
        return $this->execute(fn () => $this->client->getCompanyInvoice($this->companyId, $invoiceId));
    }

    /**
     * Update fields on a draft invoice; omitted fields keep their current values.
     * Issued invoices cannot be edited: create a corrective invoice or void them.
     *
     * @see https://docs.beel.es/invoices/patchCompanyInvoice
     */
    public function update(string $invoiceId, UpdateInvoiceRequest $request): Invoice
    {
        return $this->execute(fn () => $this->client->patchCompanyInvoice($this->companyId, $invoiceId, $request));
    }

    /**
     * Issue a draft invoice, assign its definitive number and make it immutable.
     * VeriFactu submission and PDF generation are asynchronous; success means accepted
     * for submission, not registered by AEAT. Set `wait_for_pdf` to wait for the PDF.
     *
     * @param  array<string, mixed>  $query  Issue options such as `wait_for_pdf`.
     * @param  array<string, mixed>  $headers  Request headers, including optional `Idempotency-Key`.
     *
     * @see https://docs.beel.es/invoices/issueCompanyInvoice
     */
    public function issue(string $invoiceId, array $query = [], array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->issueCompanyInvoice($this->companyId, $invoiceId, $query, $headers));
    }

    /**
     * Void an issued invoice without reusing its number.
     *
     * @param  array<string, mixed>  $headers  Optional request headers.
     *
     * @see https://docs.beel.es/invoices/voidCompanyInvoice
     */
    public function void(string $invoiceId, VoidInvoiceRequest $request, array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->voidCompanyInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * Create a corrective invoice linked to the invoice being corrected.
     *
     * @param  array<string, mixed>  $headers  Optional request headers.
     *
     * @see https://docs.beel.es/invoices/createCompanyCorrectiveInvoice
     */
    public function createCorrective(string $invoiceId, CreateCorrectiveInvoiceRequest $request, array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->createCompanyCorrectiveInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * Change an invoice's status using the company-scoped status operation.
     *
     * @param  array<string, mixed>  $headers  Optional request headers.
     *
     * @see https://docs.beel.es/invoices/setCompanyInvoiceStatus
     */
    public function setStatus(string $invoiceId, SetInvoiceStatusRequest $request, array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->setCompanyInvoiceStatus($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * Get a temporary download URL for an issued invoice's PDF.
     *
     * Returns PDF metadata and a pre-signed URL, not PDF bytes. BeeL waits briefly
     * for asynchronous generation; the URL expires after five minutes. Draft invoices
     * have no fiscal PDF; use `preview()` to render a draft preview.
     *
     * @see https://docs.beel.es/invoices/getCompanyInvoicePdf
     */
    public function getPdf(string $invoiceId): ?InvoicePdfResponseData
    {
        return $this->execute(fn () => $this->client->getCompanyInvoicePdf($this->companyId, $invoiceId));
    }

    /**
     * Create a new draft based on an existing invoice in this company.
     * The source stays unchanged; numbering, status, dates and VeriFactu data reset.
     *
     * @param  array<string, mixed>  $headers  Optional request headers.
     * @return Invoice The new draft invoice.
     *
     * @see https://docs.beel.es/invoices/createCompanyInvoiceDerivation
     */
    public function derive(CreateInvoiceDerivationRequest $request, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyInvoiceDerivation($this->companyId, $request, $headers));
    }

    /**
     * Apply one supported bulk operation to a set of this company's invoices.
     *
     * @param  array<string, mixed>  $headers  Optional request headers.
     * @return BulkOperationResult Per-invoice results and summary counts.
     */
    public function createBatch(CreateInvoiceBatchRequest $request, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyInvoiceBatch($this->companyId, $request, $headers));
    }

    /** Create a ZIP archive with the available PDFs for the requested invoices. */
    public function createPdfArchive(CreateInvoicePdfArchiveRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyInvoicePdfArchive($this->companyId, $request));
    }

    /**
     * Email PDFs for several invoices together in one message.
     *
     * @param  array<string, mixed>  $headers  Optional request headers.
     * @return V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data Delivery result and any per-invoice failures.
     *
     * @see https://docs.beel.es/invoices/createCompanyInvoiceDelivery
     */
    public function deliver(CreateInvoiceDeliveryRequest $request, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyInvoiceDelivery($this->companyId, $request, $headers));
    }

    /** Export this company's invoices using the requested format and filters. */
    public function export(CreateInvoiceExportRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyInvoiceExport($this->companyId, $request));
    }

    /** Delete a draft invoice. Issued invoices must be corrected or voided instead. */
    public function delete(string $invoiceId): void
    {
        $this->execute(fn () => $this->client->deleteCompanyInvoice($this->companyId, $invoiceId));
    }

    /**
     * Render a draft invoice PDF for preview; this does not issue or number it.
     *
     * @return InvoicePreviewResponseData Preview metadata and PDF content or URL.
     */
    public function preview(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyInvoicePreview($this->companyId, $invoiceId));
    }

    /**
     * Queue an email with the issued invoice PDF attached.
     *
     * A successful response means accepted for delivery, not delivered. Pass
     * `recipients` to override configured addresses; otherwise BeeL resolves them
     * from account defaults, invoice settings and customer billing emails. Check
     * email delivery history for the final status.
     *
     * @param  array<string, mixed>  $headers  Optional request headers.
     * @return V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Data Email delivery acceptance details.
     *
     * @see https://docs.beel.es/invoices/sendCompanyInvoice
     */
    public function send(string $invoiceId, ?SendEmailRequest $request = null, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->sendCompanyInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * Convert a non-fiscal proforma into a fiscal invoice.
     *
     * @param  array<string, mixed>  $headers  Optional request headers.
     * @return Invoice The newly created fiscal invoice.
     */
    public function convertToInvoice(string $invoiceId, ?ConvertProformaToInvoiceRequest $request = null, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->convertCompanyProformaToInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * Retrieve an invoice's scheduled issue date, if it has one.
     *
     * @return InvoiceSchedule The schedule and processing details.
     */
    public function getSchedule(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyInvoiceSchedule($this->companyId, $invoiceId));
    }

    /**
     * Set or move an invoice's scheduled issue date.
     *
     * @return Invoice The updated invoice.
     */
    public function setSchedule(string $invoiceId, SetInvoiceScheduleRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->setCompanyInvoiceSchedule($this->companyId, $invoiceId, $request));
    }

    /** Remove an invoice's scheduled issue date. */
    public function clearSchedule(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->deleteCompanyInvoiceSchedule($this->companyId, $invoiceId));
    }
}
