<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteAccountInvitationForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteAccountInvitationInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeleteAccountInvitationNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\DeleteAccountInvitationTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DeleteAccountInvitationUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteAccountInvitation extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    protected $invitation_id;

    /**
     * Revokes a `PENDING` invitation, so its acceptance link stops working.
     *
     * - **Already resolved:** an `ACCEPTED`, `REVOKED` or `EXPIRED` invitation cannot be
     *   revoked, and answers `404` without disclosing which of the three it is.
     * - **History:** revoking does not remove the invitation from the list.
     *
     * @param  string  $accountId  Your own account, or an account you provisioned. It — not the credential — decides which account the operation acts on; a `403` is returned when you do not reach it, the same response an account that does not exist gets.
     */
    public function __construct(string $accountId, string $invitationId)
    {
        $this->account_id = $accountId;
        $this->invitation_id = $invitationId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}', '{invitation_id}'], [rawurlencode($this->account_id), rawurlencode($this->invitation_id)], '/v1/accounts/{account_id}/invitations/{invitation_id}');
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
     * @throws DeleteAccountInvitationUnauthorizedException
     * @throws DeleteAccountInvitationForbiddenException
     * @throws DeleteAccountInvitationNotFoundException
     * @throws DeleteAccountInvitationTooManyRequestsException
     * @throws DeleteAccountInvitationInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountInvitationUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountInvitationForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountInvitationNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountInvitationTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteAccountInvitationInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
