<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceConflictException;
use Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\VoidCompanyInvoiceUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdVoidPostResponse200;
use Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class VoidCompanyInvoice extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $invoice_id;

    /**
     * Voids an issued invoice of this company. The document is kept and its number is never
     * reused.
     *
     * - **When to use it:** the invoice was issued by mistake — the operation never took place,
     *   it was a test, or it is an accidental duplicate. If the operation did take place but
     *   the invoice is wrong, issue a corrective invoice instead
     *   (`POST …/{invoice_id}/corrective`). The exception is a withholding that should not
     *   have been applied: it is not a cause for a corrective, so void the invoice and issue a
     *   new one without it.
     * - **Sent or paid:** voiding an invoice that was already sent or paid requires
     *   `issued_in_error: true`, confirming it was issued by mistake; without it the request
     *   fails with `422 VOID_REQUIRES_ISSUED_IN_ERROR`.
     * - **Corrected invoices:** an invoice with live corrective invoices cannot be voided — it
     *   was corrected, so the operation took place; issue another corrective
     *   (`422 INVOICE_HAS_LIVE_CORRECTIVES`). A `TOTAL` corrective cannot be voided either: the
     *   invoice it rectifies would stay voided with nothing to offset it
     *   (`422 TOTAL_CORRECTIVE_NOT_VOIDABLE`).
     * - **`reason`:** required, at least 10 characters — it is fiscal data.
     * - **`void_date`:** deprecated. A date earlier than the invoice's issue date is rejected
     *   with `422 VOID_DATE_BEFORE_ISSUE_DATE`.
     * - **VeriFactu:** when it is enabled for the invoice, a cancellation record is submitted
     *   to the AEAT.
     * - **PDF:** unchanged. The PDF of the invoice stays the one that was delivered; the void is
     *   reported by the invoice's `status` and the `invoice.voided` webhook.
     * - **Proformas:** voiding an `ACTIVE` proforma is a plain status change with no fiscal
     *   effect — no corrective invoice, nothing submitted to the AEAT. The voided proforma is
     *   kept as the record of a rejected or withdrawn offer and stays listed.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $invoiceId  Invoice ID
     * @param array{
     *    "Idempotency-Key"?: string, //Idempotency key to prevent duplicates in sensitive operations.

    - Any unique client-generated string (e.g. an order id). A UUID also works but is not required
    - Allowed characters: letters, digits, `_` and `-` (max 255 chars)
    - Retrying with the same key replays the first response when it was a success (2xx) or a
     server error (5xx): same status and body, plus the header `Idempotency-Replay: true`.
     After a 5xx, check whether the operation took effect before retrying with a **new** key
    - A 4xx is not stored: the key is released, so the corrected request can reuse it
    - Stored responses expire 24 hours after processing

    The key is scoped per user and environment, and bound to the request body, so retrying after
    a network timeout replays the stored response instead of repeating the operation.

    | Status | Code | When |
    |---|---|---|
    | `400` | `INVALID_IDEMPOTENCY_KEY` | The key breaks the format rules above. |
    | `409` | `IDEMPOTENCY_KEY_PROCESSING` | The first request is still in flight. Wait for the `Retry-After` seconds (2) and retry with the same key. |
    | `409` | `IDEMPOTENCY_KEY_MISMATCH` | The key was already used with a **different** body. Use a new key. |
     * } $headerParameters
     */
    public function __construct(string $companyId, string $invoiceId, VoidInvoiceRequest $requestBody, array $headerParameters = [])
    {
        $this->company_id = $companyId;
        $this->invoice_id = $invoiceId;
        $this->body = $requestBody;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->invoice_id)], '/v1/companies/{company_id}/invoices/{invoice_id}/void');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof VoidInvoiceRequest) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
        }

        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
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
     * @return null|V1CompaniesCompanyIdInvoicesInvoiceIdVoidPostResponse200
     *
     * @throws VoidCompanyInvoiceBadRequestException
     * @throws VoidCompanyInvoiceUnauthorizedException
     * @throws VoidCompanyInvoiceForbiddenException
     * @throws VoidCompanyInvoiceNotFoundException
     * @throws VoidCompanyInvoiceConflictException
     * @throws VoidCompanyInvoiceUnprocessableEntityException
     * @throws VoidCompanyInvoiceTooManyRequestsException
     * @throws VoidCompanyInvoiceInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdVoidPostResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new VoidCompanyInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new VoidCompanyInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new VoidCompanyInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new VoidCompanyInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new VoidCompanyInvoiceConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new VoidCompanyInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new VoidCompanyInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new VoidCompanyInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
    }

    public function getAuthenticationScopes(): array
    {
        return ['ApiKeyAuth'];
    }
}
