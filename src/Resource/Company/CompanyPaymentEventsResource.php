<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanyPaymentEventsResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, private string $connectionId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listCompanyPaymentEvents($this->companyId, $this->connectionId, $query));
    }

    public function get(string $eventId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyPaymentEvent($this->companyId, $this->connectionId, $eventId));
    }

    public function retry(string $eventId): mixed
    {
        return $this->execute(fn () => $this->client->retryCompanyPaymentEvent($this->companyId, $this->connectionId, $eventId));
    }

    public function draft(string $eventId): mixed
    {
        return $this->execute(fn () => $this->client->generateCompanyPaymentEventDraft($this->companyId, $this->connectionId, $eventId));
    }

    public function resolve(string $eventId): mixed
    {
        return $this->execute(fn () => $this->client->resolveCompanyPaymentEvent($this->companyId, $this->connectionId, $eventId));
    }

    public function discard(string $eventId): mixed
    {
        return $this->execute(fn () => $this->client->discardCompanyPaymentEvent($this->companyId, $this->connectionId, $eventId));
    }

    public function restore(string $eventId): mixed
    {
        return $this->execute(fn () => $this->client->restoreCompanyPaymentEvent($this->companyId, $this->connectionId, $eventId));
    }
}
