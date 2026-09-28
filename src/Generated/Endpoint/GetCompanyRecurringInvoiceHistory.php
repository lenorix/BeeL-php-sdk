<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceHistoryUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class GetCompanyRecurringInvoiceHistory extends BaseEndpoint implements Endpoint
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
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $recurringInvoiceId  Unique identifier (UUID) of the recurring invoice template, as returned when it is created or listed. A template of another company answers `404` with `RECURRING_NOT_FOUND`, exactly like one that does not exist.
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

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{recurring_invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->recurring_invoice_id)], '/v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}/history');
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
     *
     * @return null|V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200|ErrorResponse
     *
     * @throws GetCompanyRecurringInvoiceHistoryBadRequestException
     * @throws GetCompanyRecurringInvoiceHistoryUnauthorizedException
     * @throws GetCompanyRecurringInvoiceHistoryForbiddenException
     * @throws GetCompanyRecurringInvoiceHistoryNotFoundException
     * @throws GetCompanyRecurringInvoiceHistoryUnprocessableEntityException
     * @throws GetCompanyRecurringInvoiceHistoryTooManyRequestsException
     * @throws GetCompanyRecurringInvoiceHistoryInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdHistoryGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceHistoryBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceHistoryUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceHistoryForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceHistoryNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceHistoryUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceHistoryTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceHistoryInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
