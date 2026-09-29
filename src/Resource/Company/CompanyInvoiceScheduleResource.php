<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Model\Invoice;
use Lenorix\BeelSdk\Generated\Model\InvoiceSchedule;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceScheduleRequest;

final readonly class CompanyInvoiceScheduleResource extends CompanyResource
{
    public function get(string $invoiceId): InvoiceSchedule
    {
        return $this->execute(fn () => $this->client->getCompanyInvoiceSchedule($this->companyId, $invoiceId));
    }

    /**
     * @param  SetInvoiceScheduleRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function set(string $invoiceId, SetInvoiceScheduleRequest|array $request): Invoice
    {
        $request = $this->model($request, SetInvoiceScheduleRequest::class);

        return $this->execute(fn () => $this->client->setCompanyInvoiceSchedule($this->companyId, $invoiceId, $request));
    }

    public function clear(string $invoiceId): void
    {
        $this->executeVoid(fn () => $this->client->deleteCompanyInvoiceSchedule($this->companyId, $invoiceId));
    }
}
