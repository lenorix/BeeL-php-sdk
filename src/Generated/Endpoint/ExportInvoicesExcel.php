<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1InvoicesExportExcelPostBody;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ExportInvoicesExcel extends BaseEndpoint implements Endpoint
{
    protected $accept;

    /**
     * Exports invoices to an XLSX file.
     *
     * - **Deprecated:** use `POST /v1/companies/{company_id}/invoices/exports`, which produces
     *   the same file.
     * - **Difference:** the selection criteria are grouped there under `filters` instead of
     *   being top-level fields.
     * - **Selection:** the invoices named in `invoice_ids`, or, when that list is absent, the
     *   ones matching the filters.
     * - **Format:** `SUMMARY` gives one row per invoice with aggregated totals, `ITEMS` one row
     *   per invoice line.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  array  $accept  Accept content header application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|application/json
     */
    public function __construct(V1InvoicesExportExcelPostBody $requestBody, array $accept = [])
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
        return '/v1/invoices/export/excel';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof V1InvoicesExportExcelPostBody) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
        }

        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        if (empty($this->accept)) {
            return ['Accept' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/json']];
        }

        return $this->accept;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|ErrorResponse
     *
     * @throws ExportInvoicesExcelBadRequestException
     * @throws ExportInvoicesExcelUnauthorizedException
     * @throws ExportInvoicesExcelForbiddenException
     * @throws ExportInvoicesExcelUnprocessableEntityException
     * @throws ExportInvoicesExcelTooManyRequestsException
     * @throws ExportInvoicesExcelInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 200) {
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ExportInvoicesExcelBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ExportInvoicesExcelUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ExportInvoicesExcelForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ExportInvoicesExcelUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ExportInvoicesExcelTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ExportInvoicesExcelInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
