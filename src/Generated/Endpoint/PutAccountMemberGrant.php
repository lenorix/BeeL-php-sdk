<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class PutAccountMemberGrant extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
{
    protected $account_id;
    protected $member_id;
    protected $company_id;
    /**
     * Grants a `MEMBER` access to one company, or changes the `access_level` of an existing
     * grant. Only the company in the path is touched.
     *
     * - **Scope:** the member's other grants are left exactly as they were.
     * - **`access_level`:** `VIEW` or `OPERATE`. `NONE` is not accepted here — remove access by
     *   deleting the grant.
     * - **Eligible members:** grants apply only to `MEMBER`. `OWNER` and `ADMIN` reach every
     *   company implicitly and cannot receive grants.
     *
     * @param string $accountId Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param string $memberId Membership unique UUID.
     * @param string $companyId Unique identifier (UUID) of the company within the account.
     * @param \Lenorix\BeelSdk\Generated\Model\PutMemberGrantRequest $requestBody
     */
    public function __construct(string $accountId, string $memberId, string $companyId, \Lenorix\BeelSdk\Generated\Model\PutMemberGrantRequest $requestBody)
    {
        $this->account_id = $accountId;
        $this->member_id = $memberId;
        $this->company_id = $companyId;
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PUT';
    }
    public function getUri(): string
    {
        return str_replace(['{account_id}', '{member_id}', '{company_id}'], [rawurlencode($this->account_id), rawurlencode($this->member_id), rawurlencode($this->company_id)], '/v1/accounts/{account_id}/members/{member_id}/grants/{company_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\PutMemberGrantRequest) {
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantTooManyRequestsException
     * @throws \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsCompanyIdPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsCompanyIdPutResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (429 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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