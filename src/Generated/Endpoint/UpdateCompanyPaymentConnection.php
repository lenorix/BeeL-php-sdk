<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\UpdateCompanyPaymentConnectionForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCompanyPaymentConnectionInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCompanyPaymentConnectionNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCompanyPaymentConnectionTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCompanyPaymentConnectionUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\UpdateCompanyPaymentConnectionUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionResponse;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequest;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateCompanyPaymentConnection extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $connection_id;

    /**
     * Updates the auto-invoicing settings of the payment connection named by `{connection_id}` of a
     * company your account **owns or manages**.
     *
     * - **Partial by field:** a field you omit keeps its current value. The series fields also
     *   accept an explicit `null`, which clears the series and falls back to the company default
     *   for that document type. `filter_config` is the exception: when sent, it **replaces the
     *   whole object**, not just the sub-fields you included — a partial `filter_config` clears
     *   every filter axis you left out.
     * - **Read-only fields:** `id`, `provider`, `status`, `environment`, `external_account_id`,
     *   `connected_at`, `last_event_at` and `active_filters` are not part of this request and are
     *   ignored if sent. `status` moves through the disconnect operation, never here.
     * - **Series:** each one must exist, be active, belong to this NIF and carry a compatible
     *   document type, or the request answers `422`.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $connectionId  Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
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
    public function __construct(string $companyId, string $connectionId, UpdateCompanyPaymentConnectionRequest $requestBody, array $headerParameters = [])
    {
        $this->company_id = $companyId;
        $this->connection_id = $connectionId;
        $this->body = $requestBody;
        $this->headerParameters = $headerParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{connection_id}'], [rawurlencode($this->company_id), rawurlencode($this->connection_id)], '/v1/companies/{company_id}/payment-connections/{connection_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof UpdateCompanyPaymentConnectionRequest) {
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
     * @return null|CompanyPaymentConnectionResponse|ErrorResponse
     *
     * @throws UpdateCompanyPaymentConnectionUnauthorizedException
     * @throws UpdateCompanyPaymentConnectionForbiddenException
     * @throws UpdateCompanyPaymentConnectionNotFoundException
     * @throws UpdateCompanyPaymentConnectionUnprocessableEntityException
     * @throws UpdateCompanyPaymentConnectionTooManyRequestsException
     * @throws UpdateCompanyPaymentConnectionInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\CompanyPaymentConnectionResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCompanyPaymentConnectionUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCompanyPaymentConnectionForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCompanyPaymentConnectionNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCompanyPaymentConnectionUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCompanyPaymentConnectionTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateCompanyPaymentConnectionInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
