<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\PatchAccountMemberUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ChangeMemberRoleRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PatchAccountMember extends BaseEndpoint implements Endpoint
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
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param  string  $memberId  Membership unique UUID.
     */
    public function __construct(string $accountId, string $memberId, ChangeMemberRoleRequest $requestBody)
    {
        $this->account_id = $accountId;
        $this->member_id = $memberId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}', '{member_id}'], [rawurlencode($this->account_id), rawurlencode($this->member_id)], '/v1/accounts/{account_id}/members/{member_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof ChangeMemberRoleRequest) {
            return [['Content-Type' => ['application/json']], JsonPayload::encode($serializer, $this->body)];
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
     *
     * @return null|V1AccountsAccountIdMembersMemberIdPatchResponse200|ErrorResponse
     *
     * @throws PatchAccountMemberBadRequestException
     * @throws PatchAccountMemberUnauthorizedException
     * @throws PatchAccountMemberForbiddenException
     * @throws PatchAccountMemberNotFoundException
     * @throws PatchAccountMemberUnprocessableEntityException
     * @throws PatchAccountMemberTooManyRequestsException
     * @throws PatchAccountMemberInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountMemberBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountMemberUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountMemberForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountMemberNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountMemberUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountMemberTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchAccountMemberInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
