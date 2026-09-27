<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceConflictException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyCorrectiveInvoiceUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdCorrectivePostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCompanyCorrectiveInvoice extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $invoice_id;

    /**
     * Issues a corrective invoice that amends the invoice in the path. It is a new fiscal
     * document with its own number, not an edit of the original.
     *
     * - **`rectification_type`:** `TOTAL` leaves the original `VOIDED` and copies its lines
     *   negated when `lines` is omitted. `PARTIAL` leaves the original `RECTIFIED` and requires
     *   the adjustment `lines`.
     * - **What can be rectified:** an ordinary or simplified invoice in `ISSUED`, `SENT`,
     *   `PAID`, `OVERDUE` or `RECTIFIED`. Rectifying a corrective fails with
     *   `422 CORRECTIVE_NOT_RECTIFIABLE` — to fix an erroneous corrective, issue another one
     *   against the original invoice.
     * - **Repeat rectifications:** several `PARTIAL` correctives are allowed, but a `VOIDED`
     *   invoice is no longer rectifiable, so a second `TOTAL` against the same invoice fails
     *   with `422 INVOICE_NOT_CORRECTIBLE_IN_CURRENT_STATUS`.
     * - **Fiscal inheritance on a `PARTIAL`:** a line that omits `irpf_rate` or
     *   `equivalence_surcharge_rate` takes it from the **original invoice** — the document
     *   being amended — and never from the company's current tax profile, so a profile that
     *   changed after the original was issued does not leak into the credit note. An explicit
     *   value always wins, `0` included. The surcharge inherits the *regime* (on/off), not the
     *   rate: the rate is re-derived from each corrective line's own VAT (21→5.2, 10→1.4,
     *   5→0.625, 4→0.5), and an original outside the regime pins the line to `0`. `SUPLIDO`
     *   lines are out of it on both sides. When the original is not unambiguous BeeL does not
     *   pick for you: different IRPF rates per line fail with
     *   `422 CORRECTIVE_ORIGINAL_MIXED_IRPF`, and a surcharge applied on some lines but not
     *   others fails with `422 CORRECTIVE_ORIGINAL_MIXED_SURCHARGE`. Declare the figure on every
     *   line to get past either — both only fire when some line actually needs to inherit.
     * - **`series_id`:** when omitted, the document is numbered in the company's default
     *   corrective series, never in the series of the original. That default is never created
     *   for you: if the company has none the request fails with
     *   `422 SERIES_DEFAULT_NOT_FOUND`, and
     *   `GET /v1/configuration/series/defaults-status` reports which default is missing.
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
    public function __construct(string $companyId, string $invoiceId, CreateCorrectiveInvoiceRequest $requestBody, array $headerParameters = [])
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
        return str_replace(['{company_id}', '{invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->invoice_id)], '/v1/companies/{company_id}/invoices/{invoice_id}/corrective');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof CreateCorrectiveInvoiceRequest) {
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
     * @return null|V1CompaniesCompanyIdInvoicesInvoiceIdCorrectivePostResponse201|ErrorResponse
     *
     * @throws CreateCompanyCorrectiveInvoiceBadRequestException
     * @throws CreateCompanyCorrectiveInvoiceUnauthorizedException
     * @throws CreateCompanyCorrectiveInvoiceForbiddenException
     * @throws CreateCompanyCorrectiveInvoiceNotFoundException
     * @throws CreateCompanyCorrectiveInvoiceConflictException
     * @throws CreateCompanyCorrectiveInvoiceUnprocessableEntityException
     * @throws CreateCompanyCorrectiveInvoiceTooManyRequestsException
     * @throws CreateCompanyCorrectiveInvoiceInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdInvoicesInvoiceIdCorrectivePostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCorrectiveInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ResponseInvalidJsonFormat', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCorrectiveInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCorrectiveInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCorrectiveInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCorrectiveInvoiceConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCorrectiveInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCorrectiveInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyCorrectiveInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
