<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListRecurringInvoicesForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListRecurringInvoicesUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ListRecurringInvoices extends BaseEndpoint implements Endpoint
{
    /**
     * **Deprecated.** Use `GET /v1/companies/{company_id}/recurring-invoices`, which returns the
     * same list with the same filters.
     *
     * Lists the recurring invoice templates of the authenticated user, with filters and
     * pagination.
     *
     * - **Filters:** `status` and `customer_id`, plus `page` and `limit` for pagination.
     * - **Sorting:** `sort_by` and `sort_order`. The legacy aliases `sortBy`/`sortOrder` are
     *   still honoured here but are not carried over to the canonical route.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "status"?: string,
     *    "customer_id"?: string,
     *    "page"?: int, //Page number, starting at 1. The response echoes it back as `pagination.current_page`.
     *    "limit"?: int, //How many items to return per page. The response echoes it back as `pagination.items_per_page`.
     *    "sort_by"?: string, //Field to sort by. Defaults to `created_at` when omitted.

    This parameter was previously named `sortBy`. The old name is still accepted for
    backwards compatibility (see `sortBy` below) and will be withdrawn in a future major
    version — send `sort_by`.
     *    "sortBy"?: string, //**Deprecated** — former name of `sort_by`, still honoured so existing integrations keep
    working. Ignored when `sort_by` is also present. Use `sort_by`.
     *    "sort_order"?: string, //Sort direction. Defaults to `desc` when omitted.

    This parameter was previously named `sortOrder`. The old name is still accepted for
    backwards compatibility (see `sortOrder` below) and will be withdrawn in a future major
    version — send `sort_order`.
     *    "sortOrder"?: string, //**Deprecated** — former name of `sort_order`, still honoured so existing integrations
    keep working. Ignored when `sort_order` is also present. Use `sort_order`.
     * } $queryParameters
     */
    public function __construct(array $queryParameters = [])
    {
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return '/v1/recurring-invoices';
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
        $optionsResolver->setDefined(['status', 'customer_id', 'page', 'limit', 'sort_by', 'sortBy', 'sort_order', 'sortOrder']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['page' => 1, 'limit' => 20]);
        $optionsResolver->addAllowedTypes('status', ['string']);
        $optionsResolver->addAllowedTypes('customer_id', ['string']);
        $optionsResolver->addAllowedTypes('page', ['int']);
        $optionsResolver->addAllowedTypes('limit', ['int']);
        $optionsResolver->addAllowedTypes('sort_by', ['string']);
        $optionsResolver->addAllowedTypes('sortBy', ['string']);
        $optionsResolver->addAllowedTypes('sort_order', ['string']);
        $optionsResolver->addAllowedTypes('sortOrder', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1RecurringInvoicesGetResponse200|ErrorResponse
     *
     * @throws ListRecurringInvoicesUnauthorizedException
     * @throws ListRecurringInvoicesForbiddenException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListRecurringInvoicesUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListRecurringInvoicesForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
