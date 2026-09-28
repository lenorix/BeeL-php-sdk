<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class GetCompanyRecurringInvoiceHistory extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $company_id;
    protected $recurring_invoice_id;
    /**
     * Returns **every entry** in this schedule's history, newest first: the invoices it generated
     * and, just as important, the periods it did **not** — a failed unattended run, a slot a user
     * skipped, or the schedule being paused. Each entry carries its `type`, the `origin` of who
     * asked for it, a translated `reason` when there is one, and `requested_by` for a skip. That is
     * what lets you answer "why is there no invoice for March?" without reading logs.
     *
     * Only `GENERATED` entries have an `invoice_id`; for the rest it is `null`.
     *
     * **Paginated** with the usual `page`/`limit`, and the usual defaults: without them you get
     * the 20 most recent entries, not the whole history — which grows with every cycle the
     * template runs. Read `data.pagination` to walk the rest.
     *
     * The deprecated flat alias `GET /v1/recurring-invoices/{recurring_invoice_id}/history` does
     * **not** paginate and returns **only generated invoices**: it is frozen as it shipped until
     * its `Sunset` date. Only this route returns every entry type.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $recurringInvoiceId Unique identifier (UUID) of the recurring invoice template, as returned when it is created or listed. A template of another company answers `404` with `RECURRING_NOT_FOUND`, exactly like one that does not exist.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     * } $queryParameters
     */
    public function __construct(string $companyId, string $recurringInvoiceId, array $queryParameters = [])
    {
        $this->company_id = $companyId;
        $this->recurring_invoice_id = $recurringInvoiceId;
        $this->queryParameters = $queryParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{company_id}', '{recurring_invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->recurring_invoice_id)], '/v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}/history');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['page', 'limit']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['page' => 1, 'limit' => 20]);
        $optionsResolver->addAllowedTypes('page', ['int']);
        $optionsResolver->addAllowedTypes('limit', ['int']);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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