<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\PutAccountMemberGrantUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\PutMemberGrantRequest;
use Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsCompanyIdPutResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PutAccountMemberGrant extends BaseEndpoint implements Endpoint
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
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param  string  $memberId  Membership unique UUID.
     * @param  string  $companyId  Unique identifier (UUID) of the company within the account.
     */
    public function __construct(string $accountId, string $memberId, string $companyId, PutMemberGrantRequest $requestBody)
    {
        $this->account_id = $accountId;
        $this->member_id = $memberId;
        $this->company_id = $companyId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}', '{member_id}', '{company_id}'], [rawurlencode($this->account_id), rawurlencode($this->member_id), rawurlencode($this->company_id)], '/v1/accounts/{account_id}/members/{member_id}/grants/{company_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof PutMemberGrantRequest) {
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
     * @return null|V1AccountsAccountIdMembersMemberIdGrantsCompanyIdPutResponse200|ErrorResponse
     *
     * @throws PutAccountMemberGrantBadRequestException
     * @throws PutAccountMemberGrantUnauthorizedException
     * @throws PutAccountMemberGrantForbiddenException
     * @throws PutAccountMemberGrantNotFoundException
     * @throws PutAccountMemberGrantUnprocessableEntityException
     * @throws PutAccountMemberGrantTooManyRequestsException
     * @throws PutAccountMemberGrantInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1AccountsAccountIdMembersMemberIdGrantsCompanyIdPutResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PutAccountMemberGrantBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PutAccountMemberGrantUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PutAccountMemberGrantForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PutAccountMemberGrantNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PutAccountMemberGrantUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PutAccountMemberGrantTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PutAccountMemberGrantInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
