<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdConflictException;
use Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdPaymentRequiredException;
use Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ActivateCompanyByIdUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ActivateCompanyRequest;
use Lenorix\BeelSdk\Generated\Model\CompanyActivationResponse;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ActivateCompanyById extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Switches an existing company on in the mode carried in the body. The mode is always
     * explicit and never taken from the credential's environment, so a Test key can switch a NIF
     * on in Live.
     *
     * ## Modes and billing
     *
     * - **`TEST`:** immediate and free.
     * - **`PROD`:** immediate when the account already has a card on file or an enterprise
     *   contract, and the NIF is added to the existing subscription. With no card on file it
     *   answers `402 CHECKOUT_REQUIRED`, returning a `checkout_url` when `success_url` and
     *   `cancel_url` are supplied. It also requires being the billing subject of the account
     *   (`403 NOT_BILLING_OWNER` otherwise).
     *
     * ## Idempotency and pending switch-offs
     *
     * - **Repeating the call:** opens no second checkout and adds no second subscription item; it
     *   returns the existing activation with `already_active: true`. The same `Idempotency-Key`
     *   sent to this route and to the nested one it replaces is the same operation, so it is
     *   replayed and never charged twice.
     * - **A pending switch-off is cancelled:** while it is pending the NIF is still on — it just
     *   carries an effective date — so switching it on again only removes that date, answers
     *   `scheduled_deactivation_cancelled: true`, and charges or credits nothing.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company being switched on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
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
    public function __construct(string $companyId, ActivateCompanyRequest $requestBody, array $headerParameters = [])
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
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/activations');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof ActivateCompanyRequest) {
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
     * @return null|CompanyActivationResponse|ErrorResponse
     *
     * @throws ActivateCompanyByIdBadRequestException
     * @throws ActivateCompanyByIdUnauthorizedException
     * @throws ActivateCompanyByIdPaymentRequiredException
     * @throws ActivateCompanyByIdForbiddenException
     * @throws ActivateCompanyByIdConflictException
     * @throws ActivateCompanyByIdTooManyRequestsException
     * @throws ActivateCompanyByIdInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\CompanyActivationResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ActivateCompanyByIdBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ActivateCompanyByIdUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 402 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ActivateCompanyByIdPaymentRequiredException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ActivateCompanyByIdForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ActivateCompanyByIdConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ActivateCompanyByIdTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ActivateCompanyByIdInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
