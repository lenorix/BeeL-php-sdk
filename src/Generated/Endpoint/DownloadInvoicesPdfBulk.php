<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DownloadInvoicesPdfBulkBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\DownloadInvoicesPdfBulkForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DownloadInvoicesPdfBulkInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DownloadInvoicesPdfBulkTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DownloadInvoicesPdfBulkUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\DownloadInvoicesPdfBulkUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesBulkPdfPostBody;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DownloadInvoicesPdfBulk extends BaseEndpoint implements Endpoint
{
    protected $accept;

    /**
     * Returns a single ZIP with the PDFs of the requested invoices.
     *
     * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/pdf-archive`, which
     *   behaves identically.
     * - **Limits:** up to 500 invoices per call, and the ZIP is capped at 50MB.
     * - **Missing PDFs:** invoices whose PDF is not available are left out; if none is
     *   available the call fails.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  array  $accept  Accept content header application/zip|application/json
     */
    public function __construct(V1InvoicesBulkPdfPostBody $requestBody, array $accept = [])
    {
        $this->body = $requestBody;
        $this->accept = $accept;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/v1/invoices/bulk/pdf';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof V1InvoicesBulkPdfPostBody) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
        }

        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        if (empty($this->accept)) {
            return ['Accept' => ['application/zip', 'application/json']];
        }

        return $this->accept;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|ErrorResponse
     *
     * @throws DownloadInvoicesPdfBulkBadRequestException
     * @throws DownloadInvoicesPdfBulkUnauthorizedException
     * @throws DownloadInvoicesPdfBulkForbiddenException
     * @throws DownloadInvoicesPdfBulkUnprocessableEntityException
     * @throws DownloadInvoicesPdfBulkTooManyRequestsException
     * @throws DownloadInvoicesPdfBulkInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 200) {
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadInvoicesPdfBulkBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadInvoicesPdfBulkUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadInvoicesPdfBulkForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadInvoicesPdfBulkUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadInvoicesPdfBulkTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DownloadInvoicesPdfBulkInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
