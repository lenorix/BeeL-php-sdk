<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceStatsBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceStatsForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceStatsInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceStatsTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\GetCompanyRecurringInvoiceStatsUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesStatsGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class GetCompanyRecurringInvoiceStats extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * How many recurring schedules this company has alive, what they add up to per month, and
     * how much invoicing is stopped because the unattended generation broke.
     *
     * **It is the whole company, and it takes no filters.** It is an anchor, not a summary of
     * whatever the list is showing: narrowing the list by customer or by status does not move
     * these figures. Pagination does not apply either — the numbers cover every schedule of the
     * company, not a page of them.
     *
     * **The two amounts are never added together.** `active.monthly_amount` is a forecast of
     * what is going to be invoiced; `stopped.monthly_amount` is invoicing that should be
     * happening and is not. There is deliberately no grand total in the response.
     *
     * The per-schedule figures behind them are the same ones
     * `GET /v1/companies/{company_id}/recurring-invoices` publishes as `amount`, so the rows
     * and this header cannot drift: adding the `amount` of every active row by hand gives
     * `active.monthly_amount` exactly, to the cent.
     *
     * Filters of the list are **rejected**, not ignored: sending `status`, `customer_id` or any
     * other unknown parameter answers `400` naming it. Asking for a filtered header and getting
     * whole-company figures back with a `200` would be worse than being told no.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     */
    public function __construct(string $companyId)
    {
        $this->company_id = $companyId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/recurring-invoices/stats');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1CompaniesCompanyIdRecurringInvoicesStatsGetResponse200|ErrorResponse
     *
     * @throws GetCompanyRecurringInvoiceStatsBadRequestException
     * @throws GetCompanyRecurringInvoiceStatsUnauthorizedException
     * @throws GetCompanyRecurringInvoiceStatsForbiddenException
     * @throws GetCompanyRecurringInvoiceStatsTooManyRequestsException
     * @throws GetCompanyRecurringInvoiceStatsInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesStatsGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceStatsBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceStatsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceStatsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceStatsTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new GetCompanyRecurringInvoiceStatsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
