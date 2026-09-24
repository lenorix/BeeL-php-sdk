<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteRecurringInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteRecurringInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteRecurringInvoice extends BaseEndpoint implements Endpoint
{
    protected $recurring_invoice_id;

    /**
     * **Deprecated.** Use `DELETE /v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}`, which behaves identically.
     *
     * Permanently deletes a recurring invoice template and cancels any pending scheduled
     * generations. Invoices already generated from it are not affected.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     */
    public function __construct(string $recurringInvoiceId)
    {
        $this->recurring_invoice_id = $recurringInvoiceId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{recurring_invoice_id}'], [rawurlencode($this->recurring_invoice_id)], '/v1/recurring-invoices/{recurring_invoice_id}');
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
     * @return null|ErrorResponse
     *
     * @throws DeleteRecurringInvoiceForbiddenException
     * @throws DeleteRecurringInvoiceNotFoundException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteRecurringInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteRecurringInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
