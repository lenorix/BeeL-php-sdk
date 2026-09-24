<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceConflictException;
use Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\ConvertCompanyProformaToInvoiceUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ConvertProformaToInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdConvertToInvoicePostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ConvertCompanyProformaToInvoice extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $invoice_id;

    /**
     * Converts an accepted proforma of this company into a real invoice. The new invoice is
     * created as a `STANDARD` draft linked back through `source_proforma_id`.
     *
     * - **What converts:** only proformas in status `ACTIVE`. One shown as `EXPIRED` is still
     *   `ACTIVE` underneath and converts too.
     * - **The proforma:** preserved as the record of what the customer accepted — it keeps its
     *   `PRO-...` number and PDF and moves to the terminal status `CONVERTED`.
     * - **`issue`:** with `true` the new invoice is numbered and issued in the same atomic
     *   call. If issuing fails nothing is created and the proforma stays `ACTIVE`.
     * - **Errors:** `422 CONVERSION_REQUIRES_PROFORMA` when the document is not a proforma,
     *   `422 PROFORMA_NOT_CONVERTIBLE` when it is not `ACTIVE`, and
     *   `409 PROFORMA_ALREADY_CONVERTED` when it has already been converted — a second call
     *   never creates a second invoice.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $invoiceId  Invoice ID
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
    public function __construct(string $companyId, string $invoiceId, ?ConvertProformaToInvoiceRequest $requestBody = null, array $headerParameters = [])
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
        return str_replace(['{company_id}', '{invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->invoice_id)], '/v1/companies/{company_id}/invoices/{invoice_id}/convert-to-invoice');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof ConvertProformaToInvoiceRequest) {
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
     * @return null|V1CompaniesCompanyIdInvoicesInvoiceIdConvertToInvoicePostResponse201|ErrorResponse
     *
     * @throws ConvertCompanyProformaToInvoiceBadRequestException
     * @throws ConvertCompanyProformaToInvoiceUnauthorizedException
     * @throws ConvertCompanyProformaToInvoiceForbiddenException
     * @throws ConvertCompanyProformaToInvoiceNotFoundException
     * @throws ConvertCompanyProformaToInvoiceConflictException
     * @throws ConvertCompanyProformaToInvoiceUnprocessableEntityException
     * @throws ConvertCompanyProformaToInvoiceTooManyRequestsException
     * @throws ConvertCompanyProformaToInvoiceInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdConvertToInvoicePostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ConvertCompanyProformaToInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ConvertCompanyProformaToInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ConvertCompanyProformaToInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ConvertCompanyProformaToInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ConvertCompanyProformaToInvoiceConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ConvertCompanyProformaToInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ConvertCompanyProformaToInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ConvertCompanyProformaToInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
