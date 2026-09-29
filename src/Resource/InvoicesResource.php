<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Exception\BeelNotReadyError;
use Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\Invoice;
use Lenorix\BeelSdk\Generated\Model\InvoicePdfResponseData;
use Lenorix\BeelSdk\Generated\Model\SendEmailRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdDuplicatePostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkPaidPostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkSentPostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSchedulePostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSendPostResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSendPostResponse202Data;
use Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest;
use Lenorix\BeelSdk\Http\QueryParameters;

/**
 * @deprecated Session-focus invoice operations. Prefer company-scoped resources.
 */
final readonly class InvoicesResource extends GeneratedResource
{
    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): V1InvoicesGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listInvoices(QueryParameters::numbers(QueryParameters::lists($query))));
    }

    /**
     * @param  CreateInvoiceRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function create(CreateInvoiceRequest|array $request): Invoice
    {
        $request = $this->model($request, CreateInvoiceRequest::class);

        return $this->execute(fn () => $this->client->createInvoice($request));
    }

    public function get(string $invoiceId): Invoice
    {
        return $this->execute(fn () => $this->client->getInvoice($invoiceId));
    }

    /**
     * @param  UpdateInvoiceRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function update(string $invoiceId, UpdateInvoiceRequest|array $request): Invoice
    {
        $request = $this->model($request, UpdateInvoiceRequest::class);

        return $this->execute(fn () => $this->client->updateInvoice($invoiceId, $request));
    }

    public function delete(string $invoiceId): void
    {
        $this->executeVoid(fn () => $this->client->deleteInvoice($invoiceId));
    }

    /**
     * @param  V1InvoicesInvoiceIdDuplicatePostBody|array<string, mixed>|null  $request  The request as a model or as an array in API format.
     */
    public function duplicate(string $invoiceId, V1InvoicesInvoiceIdDuplicatePostBody|array|null $request = null): Invoice
    {
        $request = $this->model($request, V1InvoicesInvoiceIdDuplicatePostBody::class);

        return $this->execute(fn () => $this->client->duplicateInvoice($invoiceId, $request));
    }

    /**
     * @param  array<string, mixed>  $query
     * @param  array<string, mixed>  $headers
     */
    public function issue(string $invoiceId, array $query = [], array $headers = []): Invoice
    {
        return $this->execute(fn () => $this->client->issueInvoice($invoiceId, $query, $headers));
    }

    /**
     * @param  V1InvoicesInvoiceIdMarkPaidPostBody|array<string, mixed>|null  $request  The request as a model or as an array in API format.
     */
    public function markPaid(string $invoiceId, V1InvoicesInvoiceIdMarkPaidPostBody|array|null $request = null): Invoice
    {
        $request = $this->model($request, V1InvoicesInvoiceIdMarkPaidPostBody::class);

        return $this->execute(fn () => $this->client->markInvoicePaid($invoiceId, $request));
    }

    /**
     * Mark an invoice as sent, optionally recording when (`sent_at`).
     *
     * @param  V1InvoicesInvoiceIdMarkSentPostBody|array<string, mixed>|null  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Request headers, including optional `Idempotency-Key`.
     */
    public function markSent(string $invoiceId, V1InvoicesInvoiceIdMarkSentPostBody|array|null $request = null, array $headers = []): Invoice
    {
        $request = $this->model($request, V1InvoicesInvoiceIdMarkSentPostBody::class);

        return $this->execute(fn () => $this->client->markInvoiceSent($invoiceId, $request, $headers));
    }

    public function revertToIssued(string $invoiceId): Invoice
    {
        return $this->execute(fn () => $this->client->revertInvoiceToIssued($invoiceId));
    }

    /**
     * @param  VoidInvoiceRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function void(string $invoiceId, VoidInvoiceRequest|array $request): Invoice
    {
        $request = $this->model($request, VoidInvoiceRequest::class);

        return $this->execute(fn () => $this->client->voidInvoice($invoiceId, $request));
    }

    /**
     * @param  CreateCorrectiveInvoiceRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function createCorrective(string $invoiceId, CreateCorrectiveInvoiceRequest|array $request): Invoice
    {
        $request = $this->model($request, CreateCorrectiveInvoiceRequest::class);

        return $this->execute(fn () => $this->client->createCorrectiveInvoice($invoiceId, $request));
    }

    /**
     * @param  V1InvoicesInvoiceIdSchedulePostBody|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function schedule(string $invoiceId, V1InvoicesInvoiceIdSchedulePostBody|array $request): Invoice
    {
        $request = $this->model($request, V1InvoicesInvoiceIdSchedulePostBody::class);

        return $this->execute(fn () => $this->client->scheduleInvoice($invoiceId, $request));
    }

    public function unschedule(string $invoiceId): Invoice
    {
        return $this->execute(fn () => $this->client->unscheduleInvoice($invoiceId));
    }

    /**
     * @param  V1InvoicesInvoiceIdReschedulePatchBody|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function reschedule(string $invoiceId, V1InvoicesInvoiceIdReschedulePatchBody|array $request): Invoice
    {
        $request = $this->model($request, V1InvoicesInvoiceIdReschedulePatchBody::class);

        return $this->execute(fn () => $this->client->rescheduleInvoice($invoiceId, $request));
    }

    /**
     * Get a temporary download URL for an invoice's PDF.
     *
     * Returns PDF metadata and a pre-signed download URL.
     *
     * @param  int|null  $waitSeconds  Maximum seconds BeeL waits for the PDF, sent as `Prefer: wait=N`.
     *
     * @throws BeelNotReadyError If the PDF is still being generated (HTTP 202); see its `retryAfter`.
     */
    public function getPdf(string $invoiceId, ?int $waitSeconds = null): InvoicePdfResponseData
    {
        return $this->executeReady(
            fn () => $this->client->generateInvoicePdf($invoiceId, $this->preferWait($waitSeconds)),
            'Invoice PDF is still being generated; retry the request later.',
        );
    }

    /**
     * @param  SendEmailRequest|array<string, mixed>|null  $request  The request as a model or as an array in API format.
     */
    public function sendEmail(string $invoiceId, SendEmailRequest|array|null $request = null): V1InvoicesInvoiceIdSendPostResponse200Data|V1InvoicesInvoiceIdSendPostResponse202Data
    {
        $request = $this->model($request, SendEmailRequest::class);

        return $this->execute(fn () => $this->client->sendInvoiceEmail($invoiceId, $request));
    }
}
