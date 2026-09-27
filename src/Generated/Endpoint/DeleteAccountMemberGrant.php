<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberGrantForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberGrantInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberGrantNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberGrantTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DeleteAccountMemberGrantUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteAccountMemberGrant extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    protected $member_id;

    protected $company_id;

    /**
     * Revokes a `MEMBER`'s access to one company. Their grants over the account's other companies are left as they were.
     *
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     * @param  string  $memberId  Membership unique UUID.
     * @param  string  $companyId  Unique identifier (UUID) of the company within the account.
     */
    public function __construct(string $accountId, string $memberId, string $companyId)
    {
        $this->account_id = $accountId;
        $this->member_id = $memberId;
        $this->company_id = $companyId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}', '{member_id}', '{company_id}'], [rawurlencode($this->account_id), rawurlencode($this->member_id), rawurlencode($this->company_id)], '/v1/accounts/{account_id}/members/{member_id}/grants/{company_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
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
     * @return null|ErrorResponse
     *
     * @throws DeleteAccountMemberGrantUnauthorizedException
     * @throws DeleteAccountMemberGrantForbiddenException
     * @throws DeleteAccountMemberGrantNotFoundException
     * @throws DeleteAccountMemberGrantTooManyRequestsException
     * @throws DeleteAccountMemberGrantInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountMemberGrantUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountMemberGrantForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountMemberGrantNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountMemberGrantTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountMemberGrantInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
