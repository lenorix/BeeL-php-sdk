<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenConflictException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountClaimTokenUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\CreateClaimTokenRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdClaimTokensPostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateAccountClaimToken extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    /**
     * Issues a single-use `claim_token`, and the `claim_url` built from it, so the account's
     * holder can set a password and take ownership.
     *
     * - **`email`:** send it when the account has no holder yet — the person is created by this
     *   call. Omit the body to re-issue the token for the holder the account already has. An
     *   `email` that differs from the existing holder's is rejected rather than replacing them.
     * - **Lifetime:** tokens last 30 days, and only the last one issued is live. Issuing again
     *   invalidates the previous token, so the old link stops working the moment you ask for a
     *   new one.
     * - **Not an invitation:** this hands the account itself over to its holder. To add a
     *   further person to an account that already has one, invite them with
     *   `POST /v1/accounts/{account_id}/invitations`.
     * - **Entitlement:** requires `manage_accounts`.
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
    public function __construct(string $accountId, ?CreateClaimTokenRequest $requestBody = null, array $headerParameters = [])
    {
        $this->account_id = $accountId;
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
        return str_replace(['{account_id}'], [rawurlencode($this->account_id)], '/v1/accounts/{account_id}/claim-tokens');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof CreateClaimTokenRequest) {
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
     * @return null|V1AccountsAccountIdClaimTokensPostResponse201|ErrorResponse
     *
     * @throws CreateAccountClaimTokenUnauthorizedException
     * @throws CreateAccountClaimTokenForbiddenException
     * @throws CreateAccountClaimTokenNotFoundException
     * @throws CreateAccountClaimTokenConflictException
     * @throws CreateAccountClaimTokenUnprocessableEntityException
     * @throws CreateAccountClaimTokenTooManyRequestsException
     * @throws CreateAccountClaimTokenInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdClaimTokensPostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountClaimTokenUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountClaimTokenForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountClaimTokenNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountClaimTokenConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountClaimTokenUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountClaimTokenTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountClaimTokenInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
