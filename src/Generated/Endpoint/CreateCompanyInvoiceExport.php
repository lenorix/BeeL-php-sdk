<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoiceExportUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\CreateInvoiceExportRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCompanyInvoiceExport extends BaseEndpoint implements Endpoint
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
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  array  $accept  Accept content header application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|application/json
     */
    public function __construct(string $companyId, CreateInvoiceExportRequest $requestBody, array $accept = [])
    {
        $this->company_id = $companyId;
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
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/invoices/exports');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof CreateInvoiceExportRequest) {
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
     * @throws CreateCompanyInvoiceExportBadRequestException
     * @throws CreateCompanyInvoiceExportUnauthorizedException
     * @throws CreateCompanyInvoiceExportForbiddenException
     * @throws CreateCompanyInvoiceExportUnprocessableEntityException
     * @throws CreateCompanyInvoiceExportTooManyRequestsException
     * @throws CreateCompanyInvoiceExportInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 200) {
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoiceExportBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoiceExportUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoiceExportForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoiceExportUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoiceExportTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoiceExportInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
