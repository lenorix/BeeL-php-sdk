<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Exception\BeelApiError;
use Lenorix\BeelSdk\Exception\BeelNotReadyError;
use Lenorix\BeelSdk\Exception\BeelValidationError;
use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyInvoiceExport;
use Lenorix\BeelSdk\Generated\Endpoint\CreateCompanyInvoicePdfArchive;
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
use Lenorix\BeelSdk\Http\BinaryDownload;
use Lenorix\BeelSdk\Http\QueryParameters;
use Lenorix\BeelSdk\Http\RequestModels;
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
        return $this->execute(fn () => $this->client->listCompanyInvoices($this->companyId, QueryParameters::lists($query)));
    }

    /**
     * Iterate over all of this company's invoices, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, Invoice>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): V1CompaniesCompanyIdInvoicesGetResponse200Data => $this->list($query),
            static fn (V1CompaniesCompanyIdInvoicesGetResponse200Data $page): array => $page->getInvoices(),
            $query,
        );
    }

    /**
     * Create an invoice for this company.
     *
     * BeeL creates a draft unless `options.issue_directly` is true. With VeriFactu
     * enabled, submission to AEAT completes asynchronously. Use `wait_for_pdf` when
     * the response must wait for PDF generation.
     *
     * @param  CreateInvoiceRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $query  Query options such as `wait_for_pdf`.
     * @param  array<string, mixed>  $headers  Request headers, including optional `Idempotency-Key`.
     * @return Invoice The created invoice, unwrapped from BeeL's response envelope.
     *
     * @see https://docs.beel.es/invoices/createCompanyInvoice
     */
    public function create(CreateInvoiceRequest|array $request, array $query = [], array $headers = []): Invoice
    {
        $request = RequestModels::from($request, CreateInvoiceRequest::class);

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
     * @param  UpdateInvoiceRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     *
     * @see https://docs.beel.es/invoices/patchCompanyInvoice
     */
    public function update(string $invoiceId, UpdateInvoiceRequest|array $request): Invoice
    {
        $request = RequestModels::from($request, UpdateInvoiceRequest::class);

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
     * @param  VoidInvoiceRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Optional request headers.
     *
     * @see https://docs.beel.es/invoices/voidCompanyInvoice
     */
    public function void(string $invoiceId, VoidInvoiceRequest|array $request, array $headers = []): Invoice
    {
        $request = RequestModels::from($request, VoidInvoiceRequest::class);

        return $this->execute(fn () => $this->client->voidCompanyInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * Create a corrective invoice linked to the invoice being corrected.
     *
     * @param  CreateCorrectiveInvoiceRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Optional request headers.
     *
     * @see https://docs.beel.es/invoices/createCompanyCorrectiveInvoice
     */
    public function createCorrective(string $invoiceId, CreateCorrectiveInvoiceRequest|array $request, array $headers = []): Invoice
    {
        $request = RequestModels::from($request, CreateCorrectiveInvoiceRequest::class);

        return $this->execute(fn () => $this->client->createCompanyCorrectiveInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * Change an invoice's status using the company-scoped status operation.
     *
     * @param  SetInvoiceStatusRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Optional request headers.
     *
     * @see https://docs.beel.es/invoices/setCompanyInvoiceStatus
     */
    public function setStatus(string $invoiceId, SetInvoiceStatusRequest|array $request, array $headers = []): Invoice
    {
        $request = RequestModels::from($request, SetInvoiceStatusRequest::class);

        return $this->execute(fn () => $this->client->setCompanyInvoiceStatus($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * Get a temporary download URL for an issued invoice's PDF.
     *
     * Returns PDF metadata and a pre-signed URL, not PDF bytes. BeeL waits for asynchronous
     * generation (ten seconds by default); the URL expires after five minutes. Draft invoices
     * have no fiscal PDF and fail with `INVOICE_NOT_ISSUED_NO_PDF`; use `preview()` to render
     * a draft preview.
     *
     * @param  int|null  $waitSeconds  Maximum seconds BeeL waits for the PDF, sent as `Prefer: wait=N`.
     *                                 `0` answers at once; null keeps BeeL's default.
     *
     * @throws BeelNotReadyError If the PDF is still being generated (HTTP 202); see its `retryAfter`.
     *
     * @see https://docs.beel.es/invoices/getCompanyInvoicePdf
     */
    public function getPdf(string $invoiceId, ?int $waitSeconds = null): InvoicePdfResponseData
    {
        return $this->executeReady(
            fn () => $this->client->getCompanyInvoicePdf($this->companyId, $invoiceId, $this->preferWait($waitSeconds)),
            'Invoice PDF is still being generated; retry the request later.',
        );
    }

    /**
     * Create a new draft based on an existing invoice in this company.
     * The source stays unchanged; numbering, status, dates and VeriFactu data reset.
     *
     * @param  CreateInvoiceDerivationRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Optional request headers.
     * @return Invoice The new draft invoice.
     *
     * @see https://docs.beel.es/invoices/createCompanyInvoiceDerivation
     */
    public function derive(CreateInvoiceDerivationRequest|array $request, array $headers = []): Invoice
    {
        $request = RequestModels::from($request, CreateInvoiceDerivationRequest::class);

        return $this->execute(fn () => $this->client->createCompanyInvoiceDerivation($this->companyId, $request, $headers));
    }

    /**
     * Apply one supported bulk operation to a set of this company's invoices.
     *
     * @param  CreateInvoiceBatchRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Optional request headers.
     * @return BulkOperationResult Per-invoice results and summary counts.
     */
    public function createBatch(CreateInvoiceBatchRequest|array $request, array $headers = []): BulkOperationResult
    {
        $request = RequestModels::from($request, CreateInvoiceBatchRequest::class);

        return $this->execute(fn () => $this->client->createCompanyInvoiceBatch($this->companyId, $request, $headers));
    }

    /**
     * Download a ZIP with the available PDFs of up to 500 of this company's invoices.
     *
     * The body is returned as a stream and never read into memory. Invoices without an
     * available PDF are left out; `counts` reports `total`, `successful` and `failed`.
     * A `5xx` is not retried by default, since each attempt builds the archive again;
     * pass `RequestOptions(retryServerErrors: true)` to change that.
     *
     * @param  CreateInvoicePdfArchiveRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     *
     * @throws BeelApiError If BeeL rejects the request, for example when no PDF is available.
     *
     * @see https://docs.beel.es/invoices/createCompanyInvoicePdfArchive
     */
    public function createPdfArchive(CreateInvoicePdfArchiveRequest|array $request): BinaryDownload
    {
        $request = RequestModels::from($request, CreateInvoicePdfArchiveRequest::class);

        return BinaryDownload::fromResponse(
            $this->executeRaw(new CreateCompanyInvoicePdfArchive($this->companyId, $request), retryServerErrors: false),
            ['total' => 'X-Bulk-Total', 'successful' => 'X-Bulk-Successful', 'failed' => 'X-Bulk-Failed'],
        );
    }

    /**
     * Email PDFs for several invoices together in one message.
     *
     * @param  CreateInvoiceDeliveryRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Optional request headers.
     * @return V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data Delivery result and any per-invoice failures.
     *
     * @see https://docs.beel.es/invoices/createCompanyInvoiceDelivery
     */
    public function deliver(CreateInvoiceDeliveryRequest|array $request, array $headers = []): V1CompaniesCompanyIdInvoicesDeliveriesPostResponse200Data
    {
        $request = RequestModels::from($request, CreateInvoiceDeliveryRequest::class);

        return $this->execute(fn () => $this->client->createCompanyInvoiceDelivery($this->companyId, $request, $headers));
    }

    /**
     * Export this company's invoices to a spreadsheet (`.xlsx`).
     *
     * Selects the invoices in `invoice_ids`, or those matching `filters`; up to 50,000 per export.
     * The body is returned as a stream and never read into memory, and `counts` reports `total`.
     * A `5xx` is not retried by default, since each attempt builds the file again.
     *
     * @param  CreateInvoiceExportRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     *
     * @throws BeelApiError If BeeL rejects the request, for example `EXPORT_SELECTION_REQUIRED` or
     *                      `EXPORT_LIMIT_EXCEEDED` (a {@see BeelValidationError}).
     *
     * @see https://docs.beel.es/invoices/createCompanyInvoiceExport
     */
    public function export(CreateInvoiceExportRequest|array $request): BinaryDownload
    {
        $request = RequestModels::from($request, CreateInvoiceExportRequest::class);

        return BinaryDownload::fromResponse(
            $this->executeRaw(new CreateCompanyInvoiceExport($this->companyId, $request), retryServerErrors: false),
            ['total' => 'X-Total-Invoices'],
        );
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
    public function preview(string $invoiceId): InvoicePreviewResponseData
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
     * @param  SendEmailRequest|array<string, mixed>|null  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Optional request headers.
     * @return V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Data Email delivery acceptance details.
     *
     * @see https://docs.beel.es/invoices/sendCompanyInvoice
     */
    public function send(string $invoiceId, SendEmailRequest|array|null $request = null, array $headers = []): V1CompaniesCompanyIdInvoicesInvoiceIdSendPostResponse200Data
    {
        $request = RequestModels::from($request, SendEmailRequest::class);

        return $this->execute(fn () => $this->client->sendCompanyInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * Convert a non-fiscal proforma into a fiscal invoice.
     *
     * @param  ConvertProformaToInvoiceRequest|array<string, mixed>|null  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Optional request headers.
     * @return Invoice The newly created fiscal invoice.
     */
    public function convertToInvoice(string $invoiceId, ConvertProformaToInvoiceRequest|array|null $request = null, array $headers = []): Invoice
    {
        $request = RequestModels::from($request, ConvertProformaToInvoiceRequest::class);

        return $this->execute(fn () => $this->client->convertCompanyProformaToInvoice($this->companyId, $invoiceId, $request, $headers));
    }

    /**
     * Retrieve an invoice's scheduled issue date, if it has one.
     *
     * @return InvoiceSchedule The schedule and processing details.
     */
    public function getSchedule(string $invoiceId): InvoiceSchedule
    {
        return $this->execute(fn () => $this->client->getCompanyInvoiceSchedule($this->companyId, $invoiceId));
    }

    /**
     * Set or move an invoice's scheduled issue date.
     *
     * @param  SetInvoiceScheduleRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @return Invoice The updated invoice.
     */
    public function setSchedule(string $invoiceId, SetInvoiceScheduleRequest|array $request): Invoice
    {
        $request = RequestModels::from($request, SetInvoiceScheduleRequest::class);

        return $this->execute(fn () => $this->client->setCompanyInvoiceSchedule($this->companyId, $invoiceId, $request));
    }

    /** Remove an invoice's scheduled issue date. */
    public function clearSchedule(string $invoiceId): void
    {
        $this->execute(fn () => $this->client->deleteCompanyInvoiceSchedule($this->companyId, $invoiceId));
    }
}
