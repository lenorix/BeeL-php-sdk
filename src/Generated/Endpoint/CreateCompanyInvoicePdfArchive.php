<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoicePdfArchiveBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoicePdfArchiveForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoicePdfArchiveInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoicePdfArchiveTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoicePdfArchiveUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyInvoicePdfArchiveUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\CreateInvoicePdfArchiveRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCompanyInvoicePdfArchive extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $accept;

    /**
     * Returns a single ZIP with the PDFs of the invoices of this company named in
     * `invoice_ids`.
     *
     * - **Limit:** up to 500 invoices per request.
     * - **Missing PDFs:** invoices whose PDF is not available are left out of the archive. If
     *   no PDF at all is available the call fails with `400`.
     * - **Counts:** `X-Bulk-Total`, `X-Bulk-Successful` and `X-Bulk-Failed` response headers
     *   report how many PDFs were requested and how many made it into the ZIP.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  array  $accept  Accept content header application/zip|application/json
     */
    public function __construct(string $companyId, CreateInvoicePdfArchiveRequest $requestBody, array $accept = [])
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
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/invoices/pdf-archive');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof CreateInvoicePdfArchiveRequest) {
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
     * @throws CreateCompanyInvoicePdfArchiveBadRequestException
     * @throws CreateCompanyInvoicePdfArchiveUnauthorizedException
     * @throws CreateCompanyInvoicePdfArchiveForbiddenException
     * @throws CreateCompanyInvoicePdfArchiveUnprocessableEntityException
     * @throws CreateCompanyInvoicePdfArchiveTooManyRequestsException
     * @throws CreateCompanyInvoicePdfArchiveInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 200) {
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoicePdfArchiveBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoicePdfArchiveUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoicePdfArchiveForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoicePdfArchiveUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoicePdfArchiveTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyInvoicePdfArchiveInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
