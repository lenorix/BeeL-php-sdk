<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class ExportInvoicesExcel extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
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
     * @param \Lenorix\BeelSdk\Generated\Model\V1InvoicesExportExcelPostBody $requestBody
     * @param array $accept Accept content header application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|application/json
     */
    public function __construct(\Lenorix\BeelSdk\Generated\Model\V1InvoicesExportExcelPostBody $requestBody, array $accept = [])
    {
        $this->body = $requestBody;
        $this->accept = $accept;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return '/v1/invoices/export/excel';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\V1InvoicesExportExcelPostBody) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ExportInvoicesExcelInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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