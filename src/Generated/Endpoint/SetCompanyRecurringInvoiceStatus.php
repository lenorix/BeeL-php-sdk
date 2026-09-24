<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\SetCompanyRecurringInvoiceStatusUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\SetRecurringInvoiceStatusRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdStatusPutResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class SetCompanyRecurringInvoiceStatus extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $recurring_invoice_id;

    /**
     * Sets the lifecycle status of a recurring invoice template. This is how generation is
     * paused and resumed.
     *
     * - **`PAUSED`:** stops automatic generation, keeping the schedule configuration intact.
     * - **`ACTIVE`:** resumes generation. It keeps the scheduled next generation date whenever
     *   that date has not fallen due yet (including today), so resuming never re-issues a period
     *   you already invoiced and never undoes a skipped one. Only a date left in the past is
     *   rescheduled, to the first occurrence after today; the periods missed while the template
     *   was paused are not backfilled. If nothing is left to generate — the next generation date
     *   falls beyond `end_date`, or `max_invoices` has already been reached — the template
     *   becomes `COMPLETED`; for `end_date` that holds whether the date was kept or rescheduled.
     * - **`COMPLETED`:** reached on its own when the schedule runs out. It cannot be set here;
     *   the body only accepts `ACTIVE` and `PAUSED`.
     * - **Rejected transitions:** resuming a template that is already active, or one whose
     *   `pause.blocker` is still in effect.
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
    public function __construct(string $companyId, string $recurringInvoiceId, SetRecurringInvoiceStatusRequest $requestBody, array $headerParameters = [])
    {
        $this->company_id = $companyId;
        $this->recurring_invoice_id = $recurringInvoiceId;
        $this->body = $requestBody;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{recurring_invoice_id}'], [rawurlencode($this->company_id), rawurlencode($this->recurring_invoice_id)], '/v1/companies/{company_id}/recurring-invoices/{recurring_invoice_id}/status');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof SetRecurringInvoiceStatusRequest) {
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
     * @return null|V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdStatusPutResponse200|ErrorResponse
     *
     * @throws SetCompanyRecurringInvoiceStatusBadRequestException
     * @throws SetCompanyRecurringInvoiceStatusUnauthorizedException
     * @throws SetCompanyRecurringInvoiceStatusForbiddenException
     * @throws SetCompanyRecurringInvoiceStatusNotFoundException
     * @throws SetCompanyRecurringInvoiceStatusUnprocessableEntityException
     * @throws SetCompanyRecurringInvoiceStatusTooManyRequestsException
     * @throws SetCompanyRecurringInvoiceStatusInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesRecurringInvoiceIdStatusPutResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SetCompanyRecurringInvoiceStatusBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SetCompanyRecurringInvoiceStatusUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SetCompanyRecurringInvoiceStatusForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SetCompanyRecurringInvoiceStatusNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SetCompanyRecurringInvoiceStatusUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SetCompanyRecurringInvoiceStatusTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new SetCompanyRecurringInvoiceStatusInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
