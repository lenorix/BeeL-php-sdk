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
     * - **`rectification_type`:** `TOTAL` leaves the original `VOIDED` and rectifies what is
     *   still invoiced on it: every line of the original and of its live correctives (voided ones
     *   do not count), negated. It takes no `lines` — sending them fails with
     *   `422 RECTIFICATIVA_TOTAL_CON_LINEAS`. `PARTIAL` leaves the original `RECTIFIED` and
     *   requires the adjustment `lines`.
     * - **Never more than was invoiced:** a `PARTIAL` may raise any amount, but may not take the
     *   taxable base of any rate (tax, rate and equivalence surcharge; `SUPLIDO` lines by their
     *   amount) below zero once the previous correctives are counted. That fails with
     *   `422 CORRECTIVE_EXCEEDS_INVOICED_AMOUNT`, and `error.details` (`CorrectiveInvoiceErrorDetails`)
     *   carries `tax_group` (for example `IVA 21%`) and `max_reduction`, how much of that rate is
     *   left to rectify. A
     *   `TOTAL` on an invoice that previous correctives already brought to zero fails with
     *   `422 CORRECTIVE_NOTHING_LEFT_TO_RECTIFY`.
     * - **Not for the withholding alone:** a `PARTIAL` whose lines leave the taxable base of
     *   every rate unchanged and only change the withholding fails with
     *   `422 CORRECTIVE_WITHHOLDING_ONLY`. A withholding is not a cause for a corrective: void
     *   the invoice and issue a new one without it.
     * - **The original's PDF:** unchanged by either type. The corrective has its own PDF; the
     *   original keeps the one that was delivered, and its new status is in `status`.
     * - **Total of 0:** a corrective whose `total_to_pay` is 0 has nothing to refund or
     *   collect, so it is issued as `PAID`, with `payment_date` equal to `issue_date`.
     * - **What can be rectified:** an ordinary or simplified invoice in `ISSUED`, `SENT`,
     *   `PAID`, `OVERDUE` or `RECTIFIED`. Rectifying a corrective fails with
     *   `422 CORRECTIVE_NOT_RECTIFIABLE` — to fix an erroneous corrective, issue another one
     *   against the original invoice.
     * - **Repeat rectifications:** several `PARTIAL` correctives are allowed, but a `VOIDED`
     *   invoice is no longer rectifiable, so a second `TOTAL` against the same invoice fails
     *   with `422 INVOICE_NOT_CORRECTIBLE_IN_CURRENT_STATUS`.
     * - **Correcting the recipient's data:** when the invoice recorded its recipient with a wrong
     *   name, tax ID or address, send the corrected `recipient` with `rectification_type`
     *   `PARTIAL`, `rectification_code` `R4` and no `lines`. The corrective carries the corrected
     *   recipient and does not change the amounts: its lines negate what is still invoiced and
     *   repeat it, so every rate nets to zero. A different person is not a data correction
     *   (`422 CORRECTIVE_RECIPIENT_IS_ANOTHER_PERSON`): correct the invoice in full and issue a new
     *   one to the right customer.
     * - **Original rejected by the AEAT:** when VeriFactu rejected the original's record and it
     *   has not been resubmitted, the original is not in the AEAT's books: fix and resubmit it
     *   first. Until then the request fails with `422 CORRECTIVE_ORIGINAL_RECORD_REJECTED`.
     * - **Exchange invoice recorded as F3:** correcting a full invoice issued in exchange for
     *   simplified invoices is not available yet: `422 EXCHANGE_INVOICE_NOT_CORRECTABLE`.
     *   Contact support.
     * - **Deadline:** four years from when the tax accrued (the original's operation date) or,
     *   for a cause of article 80 of the VAT Act, from the `circumstance_date` you declare. Past
     *   it the request fails with `422 CORRECTIVE_OUT_OF_TIME`, with `deadline` and
     *   `counted_from` in `error.details` (`CorrectiveInvoiceErrorDetails`).
     * - **What the reason code requires** (Ley 37/1992, art. 80): `R2` (insolvency) and `R3` (bad
     *   debt) need a recipient established in Spain, the Canary Islands, Ceuta or Melilla —an
     *   `R2` also accepts a recipient in another EU member state, for insolvency proceedings
     *   there— and fail otherwise with `422 CORRECTIVE_RECIPIENT_NOT_ESTABLISHED`. An `R3` needs
     *   at least six months since the original's operation date
     *   (`422 CORRECTIVE_BAD_DEBT_TOO_EARLY`, with `earliest_date`; one year when the previous
     *   year's turnover exceeded 6,010,121.04 €, which is the issuer's to apply), and on an operation
     *   with a base of 50 € or less it needs `recipient_is_business`
     *   (`422 CORRECTIVE_BAD_DEBT_BASE_TOO_LOW`). The other conditions of each code (claims,
     *   guarantees, related parties, filing with the AEAT) are the issuer's to meet.
     * - **Fiscal inheritance on a `PARTIAL`:** a line that omits `irpf_rate` or
     *   `equivalence_surcharge_rate` takes it from the **original invoice** — the document
     *   being amended — and never from the company's current tax profile, so a profile that
     *   changed after the original was issued does not leak into the credit note. An explicit
     *   value always wins, `0` included. The surcharge inherits the *regime* (on/off), not the
     *   rate: the rate is re-derived from each corrective line's own VAT (21→5.2, 10→1.4,
     *   5→0.62, 4→0.5), and an original outside the regime pins the line to `0`. `SUPLIDO`
     *   lines are out of it on both sides. When the original is not unambiguous BeeL does not
     *   pick for you: different IRPF rates per line fail with
     *   `422 CORRECTIVE_ORIGINAL_MIXED_IRPF`, and a surcharge applied on some lines but not
     *   others fails with `422 CORRECTIVE_ORIGINAL_MIXED_SURCHARGE`. Declare the figure on every
     *   line to get past either — both only fire when some line actually needs to inherit.
     * - **`series_id`:** when omitted, the document is numbered in the company's default
     *   corrective series, never in the series of the original: corrective invoices go in a
     *   series of their own (RD 1619/2012, art. 6.1.a). If the company has none, it is created
     *   on first use (code `R`, or the next free one that cannot repeat another series'
     *   numbers). An explicit `series_id` must be a corrective series.
     * - **Numbering conflict:** if the number the series would assign is already used by another
     *   invoice of the same company, in this series or in another one, the request fails with
     *   `400 SERIES_NUMBER_COLLISION` without issuing anything or consuming a number. The series
     *   needs review, so contact support.
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
