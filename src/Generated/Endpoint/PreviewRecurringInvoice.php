<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\PreviewRecurringInvoiceConflictException;
use Lenorix\BeelSdk\Generated\Exception\PreviewRecurringInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PreviewRecurringInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\PreviewRecurringInvoiceUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\PreviewRecurringInvoiceUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPreviewGetResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PreviewRecurringInvoice extends BaseEndpoint implements Endpoint
{
    protected $recurring_invoice_id;

    /**
     * **Deprecated.** Use `GET /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}/next-occurrence`, which behaves identically.
     *
     * Returns the invoice that would be produced by the next generation of this recurring
     * template, computed from the current issuer, recipient and series data. Nothing is
     * persisted.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  string  $recurringInvoiceId  UUID of the recurring invoice template
     */
    public function __construct(string $recurringInvoiceId)
    {
        $this->recurring_invoice_id = $recurringInvoiceId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{recurring_invoice_id}'], [rawurlencode($this->recurring_invoice_id)], '/v1/recurring-invoices/{recurring_invoice_id}/preview');
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
     * @return null|V1RecurringInvoicesRecurringInvoiceIdPreviewGetResponse200|ErrorResponse
     *
     * @throws PreviewRecurringInvoiceUnauthorizedException
     * @throws PreviewRecurringInvoiceForbiddenException
     * @throws PreviewRecurringInvoiceNotFoundException
     * @throws PreviewRecurringInvoiceConflictException
     * @throws PreviewRecurringInvoiceUnprocessableEntityException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1RecurringInvoicesRecurringInvoiceIdPreviewGetResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewRecurringInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewRecurringInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewRecurringInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewRecurringInvoiceConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewRecurringInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
