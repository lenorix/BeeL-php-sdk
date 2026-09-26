<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceDerivationRequest;
use Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\GenerationHistoryResponse;
use Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\RecurringInvoiceResponse;
use Lenorix\BeelSdk\Generated\Model\SetRecurringInvoiceStatusRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** Manage recurring invoice templates and generated-invoice history for a company. */
final readonly class CompanyRecurringInvoicesResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * List recurring invoice templates for this company.
     *
     * @param  array<string, mixed>  $query  Status, search and pagination filters accepted by BeeL.
     */
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listCompanyRecurringInvoices($this->companyId, $query));
    }

    /**
     * Iterate over all of this company's recurring invoices, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, RecurringInvoiceResponse>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): V1CompaniesCompanyIdRecurringInvoicesGetResponse200Data => $this->list($query),
            static fn (V1CompaniesCompanyIdRecurringInvoicesGetResponse200Data $page): array => $page->getRecurringInvoices(),
            $query,
        );
    }

    /** Create a recurring invoice template. */
    public function create(CreateRecurringInvoiceRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyRecurringInvoice($this->companyId, $request));
    }

    /** Get recurring template and generation statistics for this company. */
    public function stats(): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyRecurringInvoiceStats($this->companyId));
    }

    /** Delete a recurring invoice template. Already-issued invoices are not deleted. */
    public function delete(string $recurringInvoiceId): void
    {
        $this->execute(fn () => $this->client->deleteCompanyRecurringInvoice($this->companyId, $recurringInvoiceId));
    }

    /** Retrieve a recurring invoice template. */
    public function get(string $recurringInvoiceId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyRecurringInvoice($this->companyId, $recurringInvoiceId));
    }

    /** Partially update a recurring template; omitted fields remain unchanged. */
    public function update(string $recurringInvoiceId, PatchRecurringInvoiceRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->patchCompanyRecurringInvoice($this->companyId, $recurringInvoiceId, $request));
    }

    /** Pause or resume a recurring invoice template. */
    public function setStatus(string $recurringInvoiceId, SetRecurringInvoiceStatusRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->setCompanyRecurringInvoiceStatus($this->companyId, $recurringInvoiceId, $request));
    }

    /** Preview the date and amount of the template's next occurrence. */
    public function nextOccurrence(string $recurringInvoiceId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyRecurringInvoiceNextOccurrence($this->companyId, $recurringInvoiceId));
    }

    /**
     * List generation history for one recurring template.
     *
     * @param  array<string, mixed>  $query  History filters and pagination accepted by BeeL.
     */
    public function history(string $recurringInvoiceId, array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyRecurringInvoiceHistory($this->companyId, $recurringInvoiceId, $query));
    }

    /**
     * Iterate over a recurring invoice's whole generation history, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `history()`.
     * @return \Generator<int, GenerationHistoryResponse>
     */
    public function allHistory(string $recurringInvoiceId, array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data => $this->history($recurringInvoiceId, $query),
            static fn (V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200Data $page): array => $page->getHistory(),
            $query,
        );
    }

    /** Create a recurring template derived from an existing invoice. */
    public function derive(CreateRecurringInvoiceDerivationRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyRecurringInvoiceDerivation($this->companyId, $request));
    }

    /** Generate an invoice from this template immediately. */
    public function generateNow(string $recurringInvoiceId): mixed
    {
        return $this->execute(fn () => $this->client->generateCompanyRecurringInvoiceNow($this->companyId, $recurringInvoiceId));
    }

    /**
     * Generate an invoice from this template immediately.
     *
     * @param  array<string, mixed>  $headers  Optional request headers.
     */
    public function generate(string $recurringInvoiceId, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->generateCompanyRecurringInvoiceNow($this->companyId, $recurringInvoiceId, $headers));
    }

    /** Skip the template's next scheduled occurrence. */
    public function skip(string $recurringInvoiceId): mixed
    {
        return $this->execute(fn () => $this->client->skipCompanyRecurringInvoice($this->companyId, $recurringInvoiceId));
    }
}
