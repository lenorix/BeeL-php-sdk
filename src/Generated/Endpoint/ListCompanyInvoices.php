<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoicesBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoicesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoicesInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoicesTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoicesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoicesUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ListCompanyInvoices extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Returns a paginated list of the invoices of this company, filterable by status, type,
     * series, customer, date range and free text. Only the documents of the company in the path
     * are returned.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "search"?: string, //Global search across invoice number, recipient name, recipient NIF, and series code (partial, case-insensitive)
     *    "status"?: array, //Filter by invoice status. Accepts a comma-separated list to match any of several
    statuses, for example `status=DRAFT,ISSUED`. A single value is also valid.
     *    "type"?: string, //Filter by invoice type
     *    "fiscal_only"?: bool, //When `true`, returns only fiscal documents (STANDARD, CORRECTIVE, SIMPLIFIED),
    excluding proformas and any other non-fiscal document. Defaults to `false`
    (the list returns every document type). Ignored when an explicit `type` is given.
     *    "customer_id"?: string, //Filter by customer UUID
     *    "date_from"?: string, //Issue date from (YYYY-MM-DD)
     *    "date_to"?: string, //Issue date to (YYYY-MM-DD)
     *    "invoice_number"?: string, //Search by invoice number (e.g., 2025/0001)
     *    "recipient_name"?: string, //Filter by recipient's fiscal name (partial, case-insensitive search)
     *    "recipient_nif"?: string, //Filter by recipient's NIF (partial search)
     *    "series_code"?: string, //Filter by series code (exact match, case-insensitive). Use `search` for partial matching across the invoice number, recipient and series code.
     *    "external_ref"?: string, //Filter by exact external reference (client-supplied order/cart/contract id).
     *    "rectified_invoice_id"?: string, //Return the corrective invoices that correct this invoice. Accepts the id of an
    issued invoice; a single invoice can have several partial correctives.
     *    "taxable_base_min"?: float, //Minimum taxable base
     *    "taxable_base_max"?: float, //Maximum taxable base
     *    "total_min"?: float, //Minimum invoice total
     *    "total_max"?: float, //Maximum invoice total
     *    "verifactu_status"?: string, //Filter by the VeriFactu submission status of the invoice, using the very same
    vocabulary that `verifactu.submission_status` publishes on each invoice.
    `NOT_SUBMITTED` selects issued invoices with VeriFactu enabled whose
    registration never happened (no live record).
     *    "verifactu_enabled"?: bool, //Filter by whether VeriFactu is enabled for the invoice — the same flag published as
    `verifactu.enabled`. `false` returns the invoices that never reach AEAT.
     *    "metadata"?: array, //Filter by metadata key/value pairs (exact match, AND between keys).
    Repeat the bracket-style param to filter on multiple keys.
    Max 50 pairs per request. Keys must match `^[A-Za-z0-9_\-.]{1,64}$`.
    Example: `?metadata[external_order_id]=ORD-42&metadata[tenant]=acme`
     *    "sort_by"?: string, //Field to sort by (e.g., issue_date, invoice_number, invoice_total)
     *    "sort_order"?: string, //Sort direction
     * } $queryParameters
     */
    public function __construct(string $companyId, array $queryParameters = [])
    {
        $this->company_id = $companyId;
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/invoices');
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
        $optionsResolver->setDefined(['page', 'limit', 'search', 'status', 'type', 'fiscal_only', 'customer_id', 'date_from', 'date_to', 'invoice_number', 'recipient_name', 'recipient_nif', 'series_code', 'external_ref', 'rectified_invoice_id', 'taxable_base_min', 'taxable_base_max', 'total_min', 'total_max', 'verifactu_status', 'verifactu_enabled', 'metadata', 'sort_by', 'sort_order']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['page' => 1, 'limit' => 20, 'fiscal_only' => false, 'sort_order' => 'desc']);
        $optionsResolver->addAllowedTypes('page', ['int']);
        $optionsResolver->addAllowedTypes('limit', ['int']);
        $optionsResolver->addAllowedTypes('search', ['string']);
        $optionsResolver->addAllowedTypes('status', ['array']);
        $optionsResolver->addAllowedTypes('type', ['string']);
        $optionsResolver->addAllowedTypes('fiscal_only', ['bool']);
        $optionsResolver->addAllowedTypes('customer_id', ['string']);
        $optionsResolver->addAllowedTypes('date_from', ['string']);
        $optionsResolver->addAllowedTypes('date_to', ['string']);
        $optionsResolver->addAllowedTypes('invoice_number', ['string']);
        $optionsResolver->addAllowedTypes('recipient_name', ['string']);
        $optionsResolver->addAllowedTypes('recipient_nif', ['string']);
        $optionsResolver->addAllowedTypes('series_code', ['string']);
        $optionsResolver->addAllowedTypes('external_ref', ['string']);
        $optionsResolver->addAllowedTypes('rectified_invoice_id', ['string']);
        $optionsResolver->addAllowedTypes('taxable_base_min', ['float']);
        $optionsResolver->addAllowedTypes('taxable_base_max', ['float']);
        $optionsResolver->addAllowedTypes('total_min', ['float']);
        $optionsResolver->addAllowedTypes('total_max', ['float']);
        $optionsResolver->addAllowedTypes('verifactu_status', ['string']);
        $optionsResolver->addAllowedTypes('verifactu_enabled', ['bool']);
        $optionsResolver->addAllowedTypes('metadata', ['array']);
        $optionsResolver->addAllowedTypes('sort_by', ['string']);
        $optionsResolver->addAllowedTypes('sort_order', ['string']);

        return $optionsResolver;
    }

    protected function getQueryStyles(): array
    {
        return ['status' => ['style' => 'form', 'explode' => false], 'metadata' => ['style' => 'deepObject', 'explode' => true]];
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1CompaniesCompanyIdInvoicesGetResponse200|ErrorResponse
     *
     * @throws ListCompanyInvoicesBadRequestException
     * @throws ListCompanyInvoicesUnauthorizedException
     * @throws ListCompanyInvoicesForbiddenException
     * @throws ListCompanyInvoicesUnprocessableEntityException
     * @throws ListCompanyInvoicesTooManyRequestsException
     * @throws ListCompanyInvoicesInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyInvoicesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyInvoicesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyInvoicesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyInvoicesUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyInvoicesTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyInvoicesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
