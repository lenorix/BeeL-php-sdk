<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationConflictException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\CreateAccountInvitationUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\CreateInvitationRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsPostResponse201;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class CreateAccountInvitation extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    /**
     * Creates a single-use invitation for a person to join the account with the given
     * `account_role`.
     *
     * - **`token`:** the acceptance secret, returned once and never readable again, so deliver
     *   it to the invitee. `invitation_url` is the ready-to-use link built from that same token.
     * - **`grants`:** required. Send the companies a `MEMBER` starts with, or `[]` to invite
     *   them with no company access yet. Grants are only valid for `MEMBER`, since `OWNER` and
     *   `ADMIN` reach every company implicitly.
     * - **`account_role`:** `OWNER` cannot be invited. An account has exactly one owner, handed
     *   over only through `PUT /v1/accounts/{account_id}/owner`.
     * - **`send_email`:** defaults to `false`, so BeeL sends no email and you deliver the token
     *   or `invitation_url` yourself. Set it to `true` to have the invitation emailed to
     *   `invited_email` as well.
     *
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
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
    public function __construct(string $accountId, CreateInvitationRequest $requestBody, array $headerParameters = [])
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
        return str_replace(['{account_id}'], [rawurlencode($this->account_id)], '/v1/accounts/{account_id}/invitations');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof CreateInvitationRequest) {
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
     * @return null|V1AccountsAccountIdInvitationsPostResponse201|ErrorResponse
     *
     * @throws CreateAccountInvitationBadRequestException
     * @throws CreateAccountInvitationUnauthorizedException
     * @throws CreateAccountInvitationForbiddenException
     * @throws CreateAccountInvitationConflictException
     * @throws CreateAccountInvitationUnprocessableEntityException
     * @throws CreateAccountInvitationTooManyRequestsException
     * @throws CreateAccountInvitationInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 201 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdInvitationsPostResponse201', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountInvitationBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountInvitationUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountInvitationForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountInvitationConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountInvitationUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountInvitationTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new CreateAccountInvitationInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
