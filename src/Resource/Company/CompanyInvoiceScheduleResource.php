<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceScheduleRequest;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanyInvoiceScheduleResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId)
    {
        parent::__construct($client, ['get' => 'getCompanyInvoiceSchedule', 'set' => 'setCompanyInvoiceSchedule', 'clear' => 'deleteCompanyInvoiceSchedule'], [$companyId]);
    }

    public function get(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyInvoiceSchedule($this->companyId, $invoiceId));
    }

    public function set(string $invoiceId, SetInvoiceScheduleRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->setCompanyInvoiceSchedule($this->companyId, $invoiceId, $request));
    }

    public function clear(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->deleteCompanyInvoiceSchedule($this->companyId, $invoiceId));
    }
}
