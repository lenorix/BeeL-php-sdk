<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListInvoicesBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ListInvoicesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListInvoicesInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ListInvoicesTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ListInvoicesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\ListInvoicesUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ListInvoices extends BaseEndpoint implements Endpoint
{
    /**
     * Returns a paginated list of invoices, with filters, sorting and pagination.
     *
     * - **Deprecated:** use `GET /v1/companies/{company_id}/invoices`, which returns the same
     *   list with the same filters.
     * - **Difference:** the legacy alias `external_reference` is not carried over there. Use
     *   `external_ref`, which this route also accepts.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "search"?: string, //Global search across invoice number, recipient name, recipient NIF, and series code (partial, case-insensitive)
     *    "status"?: array, //Filter by invoice status. Accepts a comma-separated list to match any of several
    statuses, for example `status=DRAFT,ISSUED`. A single value is also valid.
     *    "type"?: string, //Filter by invoice type
     *    "fiscal_only"?: bool, //When `true`, returns only fiscal documents (STANDARD, CORRECTIVE, SIMPLIFIED),
     * @param array{
     *    "BeeL-Active-Company"?: string, //Which company (tax ID) the request operates on.

    An API key belongs to an account, and an account may hold several companies. Endpoints that
    read or write company-owned data — invoices, customers, products, series, tax and VeriFactu
    settings — resolve their target company from this header **when the path does not already
    name one**.

    On a path that names the company, such as `/v1/companies/{company_id}/invoices`, the path
    is the target and this header is not read at all: it neither switches the target nor makes
    the request fail, so sending one that disagrees with the path is silently ignored rather
    than rejected. Prefer those paths whenever you need to be explicit about which tax ID you
    are operating on.

    On an account holding a single company the header may be omitted — that company is used.
    On an account holding several it is required: the request fails with
    `403 ACTIVE_COMPANY_REQUIRED` otherwise. A company-owned record always belongs to one tax
    ID, so operating on it without saying which one has no meaning.

    The company does **not** have to belong to the API key's own account: one you manage works
    too, which is what makes the `company_id` returned by `POST /v1/accounts` usable here to
    invoice on a provisioned account's behalf. What you may do with it is then decided by your
    access level over that account, and issuing also requires a signed fiscal representation.

    This header is how you **operate** on a company, never how you find one: a value you do not
    reach answers `403`, the same as one that does not exist, so guessing reveals nothing. Get
    the `company_id` from the response that created the company.

    Requires the `companies:read` scope. Returns `403` if the company is neither yours nor one
    you manage.
     * } $headerParameters
     */
    public function __construct(array $queryParameters = [], array $headerParameters = [])
    {
        $this->queryParameters = $queryParameters;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return '/v1/invoices';
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
        $optionsResolver->setDefined(['page', 'limit', 'search', 'status', 'type', 'fiscal_only', 'customer_id', 'date_from', 'date_to', 'invoice_number', 'recipient_name', 'recipient_nif', 'series_code', 'external_ref', 'external_reference', 'taxable_base_min', 'taxable_base_max', 'total_min', 'total_max', 'verifactu_status', 'verifactu_enabled', 'metadata', 'sort_by', 'sort_order']);
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
        $optionsResolver->addAllowedTypes('external_reference', ['string']);
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

    protected function getHeadersOptionsResolver(): OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(['BeeL-Active-Company']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('BeeL-Active-Company', ['string']);

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
     * @return null|V1InvoicesGetResponse200|ErrorResponse
     *
     * @throws ListInvoicesBadRequestException
     * @throws ListInvoicesUnauthorizedException
     * @throws ListInvoicesForbiddenException
     * @throws ListInvoicesUnprocessableEntityException
     * @throws ListInvoicesTooManyRequestsException
     * @throws ListInvoicesInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1InvoicesGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListInvoicesBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListInvoicesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListInvoicesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListInvoicesUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListInvoicesTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListInvoicesInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
