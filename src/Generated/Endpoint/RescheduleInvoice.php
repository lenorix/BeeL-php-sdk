<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\RescheduleInvoiceUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchBody;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class RescheduleInvoice extends BaseEndpoint implements Endpoint
{
    protected $invoice_id;

    /**
     * Changes the date of a scheduled invoice, which stays `SCHEDULED`. The new date must be
     * today or later.
     *
     * - **Deprecated:** use `PUT /v1/companies/{company_id}/invoices/{invoice_id}/schedule`, the
     *   single verb that schedules and reschedules.
     * - **Difference:** the new date travels there in `scheduled_for`, alongside the required
     *   `generation_mode`.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  string  $invoiceId  Invoice ID
     */
    public function __construct(string $invoiceId, V1InvoicesInvoiceIdReschedulePatchBody $requestBody)
    {
        $this->invoice_id = $invoiceId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        return str_replace(['{invoice_id}'], [rawurlencode($this->invoice_id)], '/v1/invoices/{invoice_id}/reschedule');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof V1InvoicesInvoiceIdReschedulePatchBody) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
        }

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
     * @return null|V1InvoicesInvoiceIdReschedulePatchResponse200|ErrorResponse
     *
     * @throws RescheduleInvoiceBadRequestException
     * @throws RescheduleInvoiceUnauthorizedException
     * @throws RescheduleInvoiceForbiddenException
     * @throws RescheduleInvoiceNotFoundException
     * @throws RescheduleInvoiceUnprocessableEntityException
     * @throws RescheduleInvoiceTooManyRequestsException
     * @throws RescheduleInvoiceInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RescheduleInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RescheduleInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RescheduleInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RescheduleInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RescheduleInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RescheduleInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new RescheduleInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
