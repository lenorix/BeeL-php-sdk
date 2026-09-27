<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateCompanyRecurringInvoiceDerivationUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceDerivationRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesDerivationsPostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCompanyRecurringInvoiceDerivation extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Creates a recurring invoice template of this company taking its lines, recipient, series
     * and payment data from an existing invoice, so only the recurrence has to be described.
     *
     * - **`from_invoice_id`:** the source invoice. It must belong to the company in the path,
     *   and one you cannot reach is reported the same way as one that does not exist. It is
     *   not modified by this call.
     * - **Recurrence:** `name`, `day_of_month` and `start_date` are required; `end_date` and
     *   `frequency` are optional. The cadence is not taken from the source invoice — a one-off
     *   invoice has none to copy — so it is described here like any other recurrence field:
     *   every 1 (`MONTHLY`), 3 (`QUARTERLY`) or 12 (`YEARLY`) months, `MONTHLY` when omitted.
     *   It governs the step from the first invoice onwards, not where that first one lands.
     * - **VeriFactu:** not inherited from the source invoice. Each generated invoice is
     *   registered with AEAT, or not, according to the company's regime when it is issued.
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
    public function __construct(string $companyId, CreateRecurringInvoiceDerivationRequest $requestBody, array $headerParameters = [])
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
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/recurring-invoices/derivations');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof CreateRecurringInvoiceDerivationRequest) {
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
     * @return null|V1CompaniesCompanyIdRecurringInvoicesDerivationsPostResponse201|ErrorResponse
     *
     * @throws CreateCompanyRecurringInvoiceDerivationBadRequestException
     * @throws CreateCompanyRecurringInvoiceDerivationUnauthorizedException
     * @throws CreateCompanyRecurringInvoiceDerivationForbiddenException
     * @throws CreateCompanyRecurringInvoiceDerivationNotFoundException
     * @throws CreateCompanyRecurringInvoiceDerivationUnprocessableEntityException
     * @throws CreateCompanyRecurringInvoiceDerivationTooManyRequestsException
     * @throws CreateCompanyRecurringInvoiceDerivationInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdRecurringInvoicesDerivationsPostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceDerivationBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceDerivationUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceDerivationForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceDerivationNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceDerivationUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceDerivationTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateCompanyRecurringInvoiceDerivationInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
