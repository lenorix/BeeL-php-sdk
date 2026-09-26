<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequest;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanyPaymentConnectionsResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    public function events(string $connectionId): CompanyPaymentEventsResource
    {
        return $this->inheritOptions(new CompanyPaymentEventsResource($this->client, $this->companyId, $connectionId, $this->responseContext));
    }

    public function list(): mixed
    {
        return $this->execute(fn () => $this->client->listCompanyPaymentConnections($this->companyId));
    }

    public function authorize(InitiatePaymentConnectionRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->initiatePaymentConnection($this->companyId, $request));
    }

    public function disconnect(string $connectionId): void
    {
        $this->execute(fn () => $this->client->disconnectCompanyPaymentConnection($this->companyId, $connectionId));
    }

    public function update(string $connectionId, UpdateCompanyPaymentConnectionRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->updateCompanyPaymentConnection($this->companyId, $connectionId, $request));
    }
}
