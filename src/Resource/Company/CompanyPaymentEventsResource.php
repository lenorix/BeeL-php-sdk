<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\ListManagedPaymentEventsResponseData;
use Lenorix\BeelSdk\Generated\Model\ManagedPaymentEvent;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** Inspect and recover payment events for one company payment connection. */
final readonly class CompanyPaymentEventsResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, private string $connectionId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * List events for this connection, including events that need attention.
     *
     * @param  array<string, mixed>  $query  Event filters and pagination options accepted by BeeL.
     */
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listCompanyPaymentEvents($this->companyId, $this->connectionId, $query));
    }

    /**
     * Iterate over all of this connection's payment events, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, ManagedPaymentEvent>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): ListManagedPaymentEventsResponseData => $this->list($query),
            static fn (ListManagedPaymentEventsResponseData $page): array => $page->getEvents(),
            $query,
        );
    }

    /** Retrieve one payment event and its processing details. */
    public function get(string $eventId): mixed
    {
        return $this->execute(fn () => $this->client->getCompanyPaymentEvent($this->companyId, $this->connectionId, $eventId));
    }

    /** Retry processing this payment event. */
    public function retry(string $eventId): mixed
    {
        return $this->execute(fn () => $this->client->retryCompanyPaymentEvent($this->companyId, $this->connectionId, $eventId));
    }

    /** Create a draft invoice from the payment event for review before issuing. */
    public function draft(string $eventId): mixed
    {
        return $this->execute(fn () => $this->client->generateCompanyPaymentEventDraft($this->companyId, $this->connectionId, $eventId));
    }

    /** Mark this payment event as resolved after handling it. */
    public function resolve(string $eventId): mixed
    {
        return $this->execute(fn () => $this->client->resolveCompanyPaymentEvent($this->companyId, $this->connectionId, $eventId));
    }

    /** Discard an event that should not create an invoice. */
    public function discard(string $eventId): mixed
    {
        return $this->execute(fn () => $this->client->discardCompanyPaymentEvent($this->companyId, $this->connectionId, $eventId));
    }

    /** Restore a discarded event to the actionable event list. */
    public function restore(string $eventId): mixed
    {
        return $this->execute(fn () => $this->client->restoreCompanyPaymentEvent($this->companyId, $this->connectionId, $eventId));
    }
}
