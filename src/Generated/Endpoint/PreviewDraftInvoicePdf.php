<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\PreviewDraftInvoicePdfBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\PreviewDraftInvoicePdfForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PreviewDraftInvoicePdfInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\PreviewDraftInvoicePdfNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\PreviewDraftInvoicePdfTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\PreviewDraftInvoicePdfUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PreviewDraftInvoicePdf extends BaseEndpoint implements Endpoint
{
    protected $invoice_id;

    protected $accept;

    /**
     * Renders the PDF of a draft invoice on the fly, without storing it, and returns it as
     * `application/pdf`.
     *
     * - **Deprecated:** use `GET /v1/companies/{company_id}/invoices/{invoice_id}/pdf/preview`,
     *   which behaves identically.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  string  $invoiceId  Invoice ID (must be a draft)
     * @param  array  $accept  Accept content header application/pdf|application/json
     */
    public function __construct(string $invoiceId, array $accept = [])
    {
        $this->invoice_id = $invoiceId;
        $this->accept = $accept;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{invoice_id}'], [rawurlencode($this->invoice_id)], '/v1/invoices/{invoice_id}/pdf/preview');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        if (empty($this->accept)) {
            return ['Accept' => ['application/pdf', 'application/json']];
        }

        return $this->accept;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|ErrorResponse
     *
     * @throws PreviewDraftInvoicePdfBadRequestException
     * @throws PreviewDraftInvoicePdfUnauthorizedException
     * @throws PreviewDraftInvoicePdfForbiddenException
     * @throws PreviewDraftInvoicePdfNotFoundException
     * @throws PreviewDraftInvoicePdfTooManyRequestsException
     * @throws PreviewDraftInvoicePdfInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 200) {
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewDraftInvoicePdfBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewDraftInvoicePdfUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewDraftInvoicePdfForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewDraftInvoicePdfNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewDraftInvoicePdfTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PreviewDraftInvoicePdfInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
