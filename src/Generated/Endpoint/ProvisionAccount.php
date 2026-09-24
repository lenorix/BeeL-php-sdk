<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ProvisionAccountBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ProvisionAccountConflictException;
use Lenorix\BeelSdk\Generated\Exception\ProvisionAccountForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ProvisionAccountInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ProvisionAccountTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ProvisionAccountUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\ProvisionAccountUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\ProvisionAccountRequest;
use Lenorix\BeelSdk\Generated\Model\V1AccountsPostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class ProvisionAccount extends BaseEndpoint implements Endpoint
{
    /**
     * Provisions a new account on BeeL and, when it is born with a holder, returns a single-use
     * `claim_token` to deliver so they can set a password and take ownership.
     *
     * - **`email`:** send it to create the account with a holder. Omit it and the account is
     *   created with no person at all, no `person_id` and no `claim_token`; a holder can be
     *   added later with `POST /v1/accounts/{account_id}/claim-tokens`.
     * - **`tax_profile`:** send it and the account comes back ready to invoice, with its NIF,
     *   default invoice series and VeriFactu configuration set up and its `company_id` in the
     *   response. Omit it and the account stays empty until its holder registers a NIF.
     * - **`access_level`:** the access you retain over the account. Defaults to `NONE`;
     *   `OPERATE` requires a `tax_profile`.
     * - **`external_ref`:** the idempotency key. Resending the same one returns the existing
     *   account rather than creating a second.
     * - **Entitlement:** requires `manage_accounts`.
     *
     * ## Reactivation
     *
     * If you previously ended your management of this account
     * (`DELETE /v1/accounts/{account_id}/management`) and its holder has not claimed it yet,
     * provisioning the same email reactivates that account instead of creating a new one. The
     * same account, holder, NIFs and invoices come back under your management, with the
     * `external_ref` and `access_level` of this request, and it counts towards your billable
     * usage again. Once the holder has claimed the account it is theirs, and only they can
     * grant you access again.
     *
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
    public function __construct(ProvisionAccountRequest $requestBody, array $headerParameters = [])
    {
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
        return '/v1/accounts';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof ProvisionAccountRequest) {
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
     * @return null|V1AccountsPostResponse201|ErrorResponse
     *
     * @throws ProvisionAccountBadRequestException
     * @throws ProvisionAccountUnauthorizedException
     * @throws ProvisionAccountForbiddenException
     * @throws ProvisionAccountConflictException
     * @throws ProvisionAccountUnprocessableEntityException
     * @throws ProvisionAccountTooManyRequestsException
     * @throws ProvisionAccountInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsPostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ProvisionAccountBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ProvisionAccountUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ProvisionAccountForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ProvisionAccountConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ProvisionAccountUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ProvisionAccountTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ProvisionAccountInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
