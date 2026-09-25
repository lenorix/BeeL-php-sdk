<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceDerivationRequest;
use Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\SetRecurringInvoiceStatusRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanyRecurringInvoicesResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listCompanyRecurringInvoices($this->companyId, $query));
    }

    public function create(CreateRecurringInvoiceRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyRecurringInvoice($this->companyId, $request));
    }

    public function stats(): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyRecurringInvoiceStats($this->companyId));
    }

    public function delete(string $recurringInvoiceId): void
    {
        $this->execute(fn () => $this->client->deleteCompanyRecurringInvoice($this->companyId, $recurringInvoiceId));
    }

    public function get(string $recurringInvoiceId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyRecurringInvoice($this->companyId, $recurringInvoiceId));
    }

    public function update(string $recurringInvoiceId, PatchRecurringInvoiceRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->patchCompanyRecurringInvoice($this->companyId, $recurringInvoiceId, $request));
    }

    public function setStatus(string $recurringInvoiceId, SetRecurringInvoiceStatusRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->setCompanyRecurringInvoiceStatus($this->companyId, $recurringInvoiceId, $request));
    }

    public function nextOccurrence(string $recurringInvoiceId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyRecurringInvoiceNextOccurrence($this->companyId, $recurringInvoiceId));
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function history(string $recurringInvoiceId, array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyRecurringInvoiceHistory($this->companyId, $recurringInvoiceId, $query));
    }

    public function derive(CreateRecurringInvoiceDerivationRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyRecurringInvoiceDerivation($this->companyId, $request));
    }

    public function generateNow(string $recurringInvoiceId): mixed
    {
        return $this->execute(fn () => $this->client->generateCompanyRecurringInvoiceNow($this->companyId, $recurringInvoiceId));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function generate(string $recurringInvoiceId, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->generateCompanyRecurringInvoiceNow($this->companyId, $recurringInvoiceId, $headers));
    }

    public function skip(string $recurringInvoiceId): mixed
    {
        return $this->execute(fn () => $this->client->skipCompanyRecurringInvoice($this->companyId, $recurringInvoiceId));
    }
}
