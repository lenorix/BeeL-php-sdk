<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesPostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCompanyRecurringInvoice extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Creates a recurring invoice template under this company: the invoice data it repeats
     * (lines, recipient, series, payment) plus the recurrence that drives it.
     *
     * - **Cadence:** `frequency` is how often it generates — every 1 (`MONTHLY`), 3
     *   (`QUARTERLY`) or 12 (`YEARLY`) months — on `day_of_month`, from `start_date` until
     *   `end_date` if one is given. Omitted, `MONTHLY` applies.
     * - **The cadence governs the step, not the first invoice:** the first occurrence is the
     *   first `day_of_month` on or after `start_date`, found one month at a time whatever the
     *   cadence; the cadence takes over from there. A `YEARLY` template starting 15 February
     *   with `day_of_month` 10 first invoices on 10 March, then every 10 March after that — it
     *   does not wait a year.
     * - **`start_date` in the past:** accepted and stored as sent, but it never anchors
     *   generation backwards. `next_generation` becomes the next date of the template's own
     *   calendar that is still ahead — the grid of `day_of_month` dates anchored at
     *   `start_date`, one every `frequency` — so on a quarterly or yearly template it can land
     *   months from now, not this month. The missed periods are not generated.
     * - **`draft_in_advance`:** whether the invoice is created as a draft for review before it
     *   is emitted. The window is fixed at 5 days, and both options emit on the scheduled day.
     *   Omitted, no review draft is prepared. It supersedes the deprecated `preview_days`.
     * - **VeriFactu:** the template does not carry it. Whether each generated invoice is
     *   registered with AEAT is decided when that invoice is issued, against the company's
     *   regime at that moment.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
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
    public function __construct(string $companyId, CreateRecurringInvoiceRequest $requestBody, array $headerParameters = [])
    {
        $this->company_id = $companyId;
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
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/recurring-invoices');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof CreateRecurringInvoiceRequest) {
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
     * @return null|V1CompaniesCompanyIdRecurringInvoicesPostResponse201|ErrorResponse
     *
     * @throws CreateCompanyRecurringInvoiceBadRequestException
     * @throws CreateCompanyRecurringInvoiceUnauthorizedException
     * @throws CreateCompanyRecurringInvoiceForbiddenException
     * @throws CreateCompanyRecurringInvoiceNotFoundException
     * @throws CreateCompanyRecurringInvoiceUnprocessableEntityException
     * @throws CreateCompanyRecurringInvoiceTooManyRequestsException
     * @throws CreateCompanyRecurringInvoiceInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesPostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
