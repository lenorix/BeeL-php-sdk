<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\SetInvoiceScheduleRequest;
use Lenorix\BeelSdk\Http\RequestModels;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanyInvoiceScheduleResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    public function get(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyInvoiceSchedule($this->companyId, $invoiceId));
    }

    /**
     * @param  SetInvoiceScheduleRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function set(string $invoiceId, SetInvoiceScheduleRequest|array $request): mixed
    {
        $request = RequestModels::from($request, SetInvoiceScheduleRequest::class);

        return $this->execute(fn () => $this->client->setCompanyInvoiceSchedule($this->companyId, $invoiceId, $request));
    }

    public function clear(string $invoiceId): mixed
    {
        return $this->execute(fn () => $this->client->deleteCompanyInvoiceSchedule($this->companyId, $invoiceId));
    }
}
