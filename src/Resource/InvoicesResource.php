<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Exception\BeelNotReadyError;
use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\InvoicePdfResponseData;
use Lenorix\BeelSdk\Generated\Model\SendEmailRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdDuplicatePostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkPaidPostBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSchedulePostBody;
use Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest;
use Lenorix\BeelSdk\Http\ResponseContext;

/**
 * @deprecated Session-focus invoice operations. Prefer company-scoped resources.
 */
final readonly class InvoicesResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listInvoices($query));
    }

    public function create(CreateInvoiceRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createInvoice($request));
    }

    public function get(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->getInvoice($invoiceId));
    }

    public function update(string $invoiceId, UpdateInvoiceRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->updateInvoice($invoiceId, $request));
    }

    public function delete(string $invoiceId): void
    {
        $this->execute(fn () => $this->client->deleteInvoice($invoiceId));
    }

    public function duplicate(string $invoiceId, ?V1InvoicesInvoiceIdDuplicatePostBody $request = null): mixed
    {
        return $this->execute(fn () => $this->client->duplicateInvoice($invoiceId, $request));
    }

    /**
     * @param  array<string, mixed>  $query
     * @param  array<string, mixed>  $headers
     */
    public function issue(string $invoiceId, array $query = [], array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->issueInvoice($invoiceId, $query, $headers));
    }

    public function markPaid(string $invoiceId, ?V1InvoicesInvoiceIdMarkPaidPostBody $request = null): mixed
    {
        return $this->execute(fn () => $this->client->markInvoicePaid($invoiceId, $request));
    }

    public function markSent(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->markInvoiceSent($invoiceId));
    }

    public function revertToIssued(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->revertInvoiceToIssued($invoiceId));
    }

    public function void(string $invoiceId, VoidInvoiceRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->voidInvoice($invoiceId, $request));
    }

    public function createCorrective(string $invoiceId, CreateCorrectiveInvoiceRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createCorrectiveInvoice($invoiceId, $request));
    }

    public function schedule(string $invoiceId, V1InvoicesInvoiceIdSchedulePostBody $request): mixed
    {
        return $this->execute(fn () => $this->client->scheduleInvoice($invoiceId, $request));
    }

    public function unschedule(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->unscheduleInvoice($invoiceId));
    }

    public function reschedule(string $invoiceId, V1InvoicesInvoiceIdReschedulePatchBody $request): mixed
    {
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

    public function sendEmail(string $invoiceId, ?SendEmailRequest $request = null): mixed
    {
        return $this->execute(fn () => $this->client->sendInvoiceEmail($invoiceId, $request));
    }
}
