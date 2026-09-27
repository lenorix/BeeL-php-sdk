<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class CreateCompanyInvoiceExport extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $company_id;
    protected $accept;
    /**
     * Produces a spreadsheet with the invoices of this company and returns the file in the
     * response.
     *
     * - **Selection:** the invoices named in `invoice_ids`, or, when that is absent, the ones
     *   matching `filters`. A request with neither is rejected with
     *   `400 EXPORT_SELECTION_REQUIRED`.
     * - **Format:** `SUMMARY` writes one row per invoice with aggregated totals, `ITEMS` one
     *   row per invoice line.
     * - **Limit:** up to 50000 invoices per export. Going over it is rejected with
     *   `422 EXPORT_LIMIT_EXCEEDED` — narrow the date range or split the selection. The
     *   export is never silently truncated.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param \Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest $requestBody
     * @param array $accept Accept content header application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|application/json
     */
    public function __construct(string $companyId, \Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest $requestBody, array $accept = [])
    {
        $this->company_id = $companyId;
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
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/invoices/exports');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest) {
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportInternalServerErrorException
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
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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