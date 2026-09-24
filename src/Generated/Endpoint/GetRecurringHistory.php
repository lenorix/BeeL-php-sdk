<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class GetRecurringHistory extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $recurring_invoice_id;
    /**
     * **Deprecated.** Use `GET /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}/history`.
     *
     * Returns the invoices previously generated from this recurring template, including their
     * status and generation dates.
     *
     * - **Response shape:** it differs from the successor's, and that is why this notice exists.
     *   This route is frozen as it shipped until its `Sunset` date: it returns the **whole**
     *   history in `data.history` and carries no `pagination`. The successor pages with
     *   `page`/`limit` and answers the first 20 generations by default. Send `limit` and read
     *   `data.pagination` when you migrate.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param string $recurringInvoiceId
     */
    public function __construct(string $recurringInvoiceId)
    {
        $this->recurring_invoice_id = $recurringInvoiceId;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{recurring_invoice_id}'], [rawurlencode($this->recurring_invoice_id)], '/v1/recurring-invoices/{recurring_invoice_id}/history');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetRecurringHistoryForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\GetRecurringHistoryNotFoundException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdHistoryGetResponse200', 'json');
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetRecurringHistoryForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\GetRecurringHistoryNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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