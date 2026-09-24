<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class IssueCompanyInvoice extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $company_id;
    protected $invoice_id;
    /**
    * Finalizes a draft invoice of this company: assigns its definitive number from the
    * configured series and makes it immutable.
    *
    * - **Irreversible:** an issued invoice is corrected with a corrective invoice
    *   (`POST …/{invoice_id}/corrective`) or voided (`POST …/{invoice_id}/void`), never edited.
    * - **Asynchronous:** PDF generation and submission to the AEAT happen after the response,
    *   so a `200` means the invoice was accepted for submission, not that the AEAT has
    *   registered it. Use `wait_for_pdf` to wait for the PDF.
    *
    * @param string $companyId Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
    * @param string $invoiceId Invoice ID
    * @param array{
    *    "wait_for_pdf"?: bool, //If `true`, waits for PDF generation and returns the URL in the response. Adds ~1-2s of
    latency but guarantees the PDF is immediately available.
    *    "attach_source_invoices"?: bool, //Only applies when the invoice has automatic email sending enabled. If `true`, the
    email sent after issuing also attaches a ZIP (`suplidos_<invoice-number>.zip`) with
    the PDFs of the source invoices referenced by the invoice's SUPLIDO consolidation
    lines. Access to sources owned by managed accounts is re-checked with the same rules
    as issuing, and the request fails synchronously with an actionable error — never a
    partial ZIP — if the invoice has no consolidation sources
    (`ATTACH_SOURCE_INVOICES_NO_SOURCES`), a source is not reachable
    (`ATTACH_SOURCE_INVOICE_UNAVAILABLE`) or a source has no generated PDF
    (`ATTACH_SOURCE_PDF_MISSING`).
    * } $queryParameters
    * @param array{
    *    "Idempotency-Key"?: string, //Idempotency key to prevent duplicates in sensitive operations.
    
    - Any unique client-generated string (e.g. an order id). A UUID also works but is not required
    - Allowed characters: letters, digits, `_` and `-` (max 255 chars)
    - If the same key is sent twice, the result of the first operation is returned
    - Keys expire 24 hours after processing
    
    The key is scoped per user and environment, and bound to the request body, so retrying after
    a network timeout replays the stored response instead of repeating the operation.
    
    | Status | Code | When |
    |---|---|---|
    | `400` | `INVALID_IDEMPOTENCY_KEY` | The key breaks the format rules above. |
    | `409` | `IDEMPOTENCY_KEY_PROCESSING` | The first request is still in flight. Wait and retry with the same key. |
    | `409` | `IDEMPOTENCY_KEY_MISMATCH` | The key was already used with a **different** body. Use a new key. |
    * } $headerParameters
    */
    public function __construct(string $companyId, string $invoiceId, array $queryParameters = [], array $headerParameters = [])
    {
        $this->company_id = $companyId;
        $this->invoice_id = $invoiceId;
        $this->queryParameters = $queryParameters;
        $this->headerParameters = $headerParameters;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return str_replace(['{company_id}', '{invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->invoice_id)], '/v1/companies/{company_id}/invoices/{invoice_id}/issue');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['wait_for_pdf', 'attach_source_invoices']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['wait_for_pdf' => false, 'attach_source_invoices' => false]);
        $optionsResolver->addAllowedTypes('wait_for_pdf', ['bool']);
        $optionsResolver->addAllowedTypes('attach_source_invoices', ['bool']);
        return $optionsResolver;
    }
    protected function getHeadersOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getHeadersOptionsResolver();
        $optionsResolver->setDefined(['Idempotency-Key']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('Idempotency-Key', ['string']);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdIssuePostResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdIssuePostResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (409 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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