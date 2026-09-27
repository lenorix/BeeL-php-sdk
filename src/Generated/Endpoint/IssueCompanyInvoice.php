<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceConflictException;
use Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\IssueCompanyInvoiceUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdIssuePostResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class IssueCompanyInvoice extends BaseEndpoint implements Endpoint
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
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $invoiceId  Invoice ID
     * @param array{
     *    "wait_for_pdf"?: bool, //If `true`, waits for PDF generation and returns the URL in the response. Adds ~1-2s of
    latency but guarantees the PDF is immediately available.
     *    "attach_source_invoices"?: bool, //Only applies when the invoice has automatic email sending enabled. If `true`, the
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

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->invoice_id)], '/v1/companies/{company_id}/invoices/{invoice_id}/issue');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['wait_for_pdf', 'attach_source_invoices']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['wait_for_pdf' => false, 'attach_source_invoices' => false]);
        $optionsResolver->addAllowedTypes('wait_for_pdf', ['bool']);
        $optionsResolver->addAllowedTypes('attach_source_invoices', ['bool']);

        return $optionsResolver;
    }

    protected function getHeadersOptionsResolver(): OptionsResolver
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
     *
     * @return null|V1CompaniesCompanyIdInvoicesInvoiceIdIssuePostResponse200|ErrorResponse
     *
     * @throws IssueCompanyInvoiceBadRequestException
     * @throws IssueCompanyInvoiceUnauthorizedException
     * @throws IssueCompanyInvoiceForbiddenException
     * @throws IssueCompanyInvoiceNotFoundException
     * @throws IssueCompanyInvoiceConflictException
     * @throws IssueCompanyInvoiceUnprocessableEntityException
     * @throws IssueCompanyInvoiceTooManyRequestsException
     * @throws IssueCompanyInvoiceInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdIssuePostResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new IssueCompanyInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new IssueCompanyInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new IssueCompanyInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new IssueCompanyInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new IssueCompanyInvoiceConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new IssueCompanyInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new IssueCompanyInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new IssueCompanyInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
