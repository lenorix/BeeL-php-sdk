<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\EndAccountManagementForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\EndAccountManagementInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\EndAccountManagementTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\EndAccountManagementUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class EndAccountManagement extends BaseEndpoint implements Endpoint
{
    protected $account_id;

    /**
     * Ends the management relationship over an account you provisioned: you lose access to it,
     * and its NIFs stop counting towards your billable usage from the next billing cycle.
     *
     * - **The holder:** keeps the account, its NIFs and its invoices, and becomes responsible
     *   for their own subscription. Nothing is deleted or anonymised.
     * - **Reversible:** only while the account stays unclaimed. Provisioning the same email
     *   again reactivates it (see `POST /v1/accounts`), and only the manager who ended the
     *   relationship can do so. Once the holder claims the account it is theirs, and getting the
     *   management back needs their consent, not just their email address.
     * - **Entitlement:** requires `manage_accounts`.
     */
    public function __construct(string $accountId)
    {
        $this->account_id = $accountId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{account_id}'], [rawurlencode($this->account_id)], '/v1/accounts/{account_id}/management');
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
     * @throws EndAccountManagementUnauthorizedException
     * @throws EndAccountManagementForbiddenException
     * @throws EndAccountManagementTooManyRequestsException
     * @throws EndAccountManagementInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new EndAccountManagementUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new EndAccountManagementForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new EndAccountManagementTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new EndAccountManagementInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
