<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class ListCompanyInvoiceVerifactuRecords extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $company_id;
    protected $invoice_id;
    /**
     * Returns the VeriFactu records of this invoice, each with its own status, ordered by
     * `registered_at` ascending: the registration first and, if the invoice was voided, its
     * cancellation after it. A record rejected before reaching the AEAT is listed too, as
     * `REJECTED`, until the invoice is submitted again: the new record then replaces it.
     *
     * - **No records:** an invoice that was never submitted (a draft, or one outside VeriFactu)
     *   answers `200` with an empty list.
     *
     * **Closed catalogue.** This collection is fixed and bounded: it carries no `pagination`, it
     * takes no `page`/`limit`, and every response holds the whole set.
     *
     * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param string $invoiceId Invoice ID
     */
    public function __construct(string $companyId, string $invoiceId)
    {
        $this->company_id = $companyId;
        $this->invoice_id = $invoiceId;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return str_replace(['{company_id}', '{invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->invoice_id)], '/v1/companies/{company_id}/invoices/{invoice_id}/verifactu-records');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoiceVerifactuRecordsBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoiceVerifactuRecordsUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoiceVerifactuRecordsForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoiceVerifactuRecordsNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoiceVerifactuRecordsTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoiceVerifactuRecordsInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdVerifactuRecordsGetResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdVerifactuRecordsGetResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoiceVerifactuRecordsBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoiceVerifactuRecordsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoiceVerifactuRecordsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoiceVerifactuRecordsNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoiceVerifactuRecordsTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\ListCompanyInvoiceVerifactuRecordsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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