<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentEventsForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentEventsInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentEventsNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentEventsTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentEventsUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentEventsUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\ListManagedPaymentEventsResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ListCompanyPaymentEvents extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $connection_id;

    /**
     * Lists the payment events received through the payment provider connection of a NIF
     * (company), most recent first. Use it to audit the charges that produced an invoice and to
     * find the ones that did not.
     *
     * - **By default, every event is listed.** Nothing is hidden: events the connection
     *   skipped, duplicates and disputes are all returned. Narrow the list with the filters
     *   below; what you do not filter, you get. Set `charges_only=true` to read the same events
     *   as one row per money movement instead.
     * - **Scope:** events belong to the connection, not to the NIF directly. The
     *   `{connection_id}` segment picks one connection of the NIF in the path, and only the
     *   events of that connection are returned; an event of another NIF of the same account is
     *   never reachable from here.
     * - **Unknown connection:** a `{connection_id}` that belongs to no connection of this NIF
     *   returns `404`.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the events belong to — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $connectionId  Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "status"?: array, //Keep only the events in these processing states. Repeat the parameter to combine
    states; omit it for all of them.
     *    "failure_reason"?: array, //Keep only the events that did not complete for these reasons. Repeat the parameter to
    combine reasons.
     *    "failure_category"?: array, //Keep only the events that did not complete for a cause in these categories. Repeat the
    parameter to combine categories. Events that completed carry no category and are
    therefore never kept by this filter.
     *    "event_kind"?: array, //Keep only the events of these kinds. Matches `event_kind`, never `event_type`: the
    kind is what the event is about, while `event_type` is the raw name the provider
    emitted (`payment_intent.succeeded`) and is not filterable. `UNKNOWN` keeps every
    event whose provider name we do not classify. Repeat the parameter to combine kinds.
     *    "min_amount"?: int, //Keep only the events whose `amount` is at or above this value.
     *    "max_amount"?: int, //Keep only the events whose `amount` is at or below this value.
     *    "needs_action"?: bool, //`true` keeps only the events still worth acting on; `false`, only the ones that are
    not. Omit it for both.
     *    "from"?: string, //Keep only the events received at or after this instant.
     *    "to"?: string, //Keep only the events received at or before this instant.
     *    "q"?: string, //Free-text search over the payer name and the provider identifiers of the charge
    (`pi_`, `ch_`, `cs_`, `evt_`). Case-insensitive, partial matches allowed. The payer
    email is deliberately not searchable.
     *    "include_discarded"?: bool, //Include the events you discarded. They are excluded by default; discarding is a
    decision about the list, not a state of the event.
     *    "charges_only"?: bool, //Return one row per money movement instead of one row per event. Today, when this
    parameter is omitted or `false`, every event is listed.

     **The default changes on 11 December 2026.** From that day, omitting this parameter
    reads the listing as `charges_only=true` — one row per money movement. Until then a
    request that omits it answers with `Deprecation`, `Sunset` and `Link` headers. Send
    the value you want explicitly, whichever it is, so the change of default cannot
    surprise you. See the [migration guide](https://docs.beel.es/changelog/payments-cleanup).

    A money movement is a sale, a failed payment, each refund and each dispute. The
    provider usually reports a single movement through several events. When this
    parameter is `true`, each movement is returned in at most two rows: its outcome and,
    when any of its events requires action, its incident. The outcome row stands for the
    events of the movement that require no action; the incident row stands for the events
    of the movement that require action, so an invoiced movement that still has something
    to resolve always shows it. Within each row, the event that produced an invoice comes
    first, then an event of a classified kind before an unclassified one, and then the
    most recent one. A sale and a failed payment of the same charge are two movements, and
    every refund and every dispute of a charge is a movement of its own; the opening and
    the closing of a dispute are the same movement.

    An event of an unclassified kind that requires action joins the incident row of the
    movement its identifier names: a charge joins its sale, a dispute joins that dispute,
    and a refund or a credit note joins that refund. An event whose identifier names no
    movement, or that carries no identifier at all, stays a row of its own and is never
    merged with another. Events that moved no money, such as a customer, a price or a
    product being created, are left out, except those that require action, which are
    always listed.

    Discarded events of a movement that is still listed through a live event are ignored: they are
    neither returned nor counted. A movement whose events are all discarded is returned as
    a single row, only when `include_discarded` is `true`, and counts once in `discarded`.
    Without other filters, the number of rows returned with `include_discarded=true` is
    therefore `total` plus `discarded`.

    The other filters narrow the rows returned and `pagination.total_items`, and nothing
    else. `counts` describes the whole connection in the view you asked for and disregards
    every other filter: with `charges_only=true`, its `total`, `discarded`, `needs_action`
    and `by_status` values count money movements rather than individual events, while its
    `ignored` and `failure_reasons` values keep counting events. A request that filters by
    `q` may therefore return a single row while `counts.total` still reports every movement
    of the connection.
     * } $queryParameters
     */
    public function __construct(string $companyId, string $connectionId, array $queryParameters = [])
    {
        $this->company_id = $companyId;
        $this->connection_id = $connectionId;
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{connection_id}'], [rawurlencode($this->company_id), rawurlencode($this->connection_id)], '/v1/companies/{company_id}/payment-connections/{connection_id}/events');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['page', 'limit', 'status', 'failure_reason', 'failure_category', 'event_kind', 'min_amount', 'max_amount', 'needs_action', 'from', 'to', 'q', 'include_discarded', 'charges_only']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['page' => 1, 'limit' => 20, 'include_discarded' => false, 'charges_only' => false]);
        $optionsResolver->addAllowedTypes('page', ['int']);
        $optionsResolver->addAllowedTypes('limit', ['int']);
        $optionsResolver->addAllowedTypes('status', ['array']);
        $optionsResolver->addAllowedTypes('failure_reason', ['array']);
        $optionsResolver->addAllowedTypes('failure_category', ['array']);
        $optionsResolver->addAllowedTypes('event_kind', ['array']);
        $optionsResolver->addAllowedTypes('min_amount', ['int']);
        $optionsResolver->addAllowedTypes('max_amount', ['int']);
        $optionsResolver->addAllowedTypes('needs_action', ['bool']);
        $optionsResolver->addAllowedTypes('from', ['string']);
        $optionsResolver->addAllowedTypes('to', ['string']);
        $optionsResolver->addAllowedTypes('q', ['string']);
        $optionsResolver->addAllowedTypes('include_discarded', ['bool']);
        $optionsResolver->addAllowedTypes('charges_only', ['bool']);

        return $optionsResolver;
    }

    protected function getQueryStyles(): array
    {
        return ['status' => ['style' => 'form', 'explode' => true], 'failure_reason' => ['style' => 'form', 'explode' => true], 'failure_category' => ['style' => 'form', 'explode' => true], 'event_kind' => ['style' => 'form', 'explode' => true]];
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|ListManagedPaymentEventsResponse|ErrorResponse
     *
     * @throws ListCompanyPaymentEventsUnauthorizedException
     * @throws ListCompanyPaymentEventsForbiddenException
     * @throws ListCompanyPaymentEventsNotFoundException
     * @throws ListCompanyPaymentEventsUnprocessableEntityException
     * @throws ListCompanyPaymentEventsTooManyRequestsException
     * @throws ListCompanyPaymentEventsInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ListManagedPaymentEventsResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyPaymentEventsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyPaymentEventsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyPaymentEventsNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyPaymentEventsUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyPaymentEventsTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyPaymentEventsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (stripos(strtolower($contentType), 'application/json') !== false) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json');
        }
    }

    public function getAuthenticationScopes(): array
    {
        return ['ApiKeyAuth'];
    }
}
