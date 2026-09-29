<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnection;
use Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionRequest;
use Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionResponseData;
use Lenorix\BeelSdk\Generated\Model\ListManagedPaymentConnectionsResponseData;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequest;

final readonly class CompanyPaymentConnectionsResource extends CompanyResource
{
    public function events(string $connectionId): CompanyPaymentEventsResource
    {
        return $this->inheritOptions(new CompanyPaymentEventsResource($this->client, $this->companyId, $connectionId, $this->responseContext));
    }

    public function list(): ListManagedPaymentConnectionsResponseData
    {
        return $this->execute(fn () => $this->client->listCompanyPaymentConnections($this->companyId));
    }

    /**
     * @param  InitiatePaymentConnectionRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function authorize(InitiatePaymentConnectionRequest|array $request): InitiatePaymentConnectionResponseData
    {
        $request = $this->model($request, InitiatePaymentConnectionRequest::class);

        return $this->execute(fn () => $this->client->initiatePaymentConnection($this->companyId, $request));
    }

    public function disconnect(string $connectionId): void
    {
        $this->executeVoid(fn () => $this->client->disconnectCompanyPaymentConnection($this->companyId, $connectionId));
    }

    /**
     * @param  UpdateCompanyPaymentConnectionRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function update(string $connectionId, UpdateCompanyPaymentConnectionRequest|array $request): CompanyPaymentConnection
    {
        $request = $this->model($request, UpdateCompanyPaymentConnectionRequest::class);

        return $this->execute(fn () => $this->client->updateCompanyPaymentConnection($this->companyId, $connectionId, $request));
    }
}
