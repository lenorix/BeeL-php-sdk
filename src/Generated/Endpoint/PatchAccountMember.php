<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class PatchAccountMember extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $account_id;
    protected $member_id;
    /**
     * Changes a member's `account_role` between `ADMIN` and `MEMBER`.
     *
     * - **`OWNER`:** not an assignable value here. An account has exactly one owner, and
     *   ownership is handed over only through `PUT /v1/accounts/{account_id}/owner`, which
     *   promotes the new owner and steps the current one down in the same operation.
     * - **Last owner:** the account's last `OWNER` cannot be demoted.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param string $memberId Membership unique UUID.
     * @param \Lenorix\BeelSdk\Generated\Model\ChangeMemberRoleRequest $requestBody
     */
    public function __construct(string $accountId, string $memberId, \Lenorix\BeelSdk\Generated\Model\ChangeMemberRoleRequest $requestBody)
    {
        $this->account_id = $accountId;
        $this->member_id = $memberId;
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PATCH';
    }
    public function getUri(): string
    {
        return str_replace(['{account_id}', '{member_id}'], [rawurlencode($this->account_id), rawurlencode($this->member_id)], '/v1/accounts/{account_id}/members/{member_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\ChangeMemberRoleRequest) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdPatchResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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