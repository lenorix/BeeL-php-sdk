<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ChangeManagedAccountAccessLevelBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ChangeManagedAccountAccessLevelForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ChangeManagedAccountAccessLevelInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ChangeManagedAccountAccessLevelTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ChangeManagedAccountAccessLevelUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ChangeAccessLevelRequest;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ChangeManagedAccountAccessLevel extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    /**
     * Updates the `access_level` you keep over an account you provisioned.
     *
     * - **Raising it:** only possible while the account is unclaimed. Once its holder has taken
     *   ownership you may keep or lower your access, but only they can raise it.
     * - **Billing:** the level never affects it — you pay for the account's subscription at any
     *   level.
     * - **`OPERATE`:** issuing invoices on the holder's behalf additionally requires a signed
     *   fiscal representation from them.
     * - **Entitlement:** requires `manage_accounts`.
     */
    public function __construct(string $accountId, ChangeAccessLevelRequest $requestBody)
    {
        $this->account_id = $accountId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}'], [rawurlencode($this->account_id)], '/v1/accounts/{account_id}/access-level');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof ChangeAccessLevelRequest) {
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
     * @return null|ErrorResponse
     *
     * @throws ChangeManagedAccountAccessLevelBadRequestException
     * @throws ChangeManagedAccountAccessLevelUnauthorizedException
     * @throws ChangeManagedAccountAccessLevelForbiddenException
     * @throws ChangeManagedAccountAccessLevelTooManyRequestsException
     * @throws ChangeManagedAccountAccessLevelInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ChangeManagedAccountAccessLevelBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ChangeManagedAccountAccessLevelUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ChangeManagedAccountAccessLevelForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ChangeManagedAccountAccessLevelTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ChangeManagedAccountAccessLevelInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
