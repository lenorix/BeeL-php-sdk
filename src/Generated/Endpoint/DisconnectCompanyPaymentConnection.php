<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DisconnectCompanyPaymentConnectionForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DisconnectCompanyPaymentConnectionInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DisconnectCompanyPaymentConnectionNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\DisconnectCompanyPaymentConnectionTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DisconnectCompanyPaymentConnectionUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DisconnectCompanyPaymentConnection extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $connection_id;

    /**
     * Disconnects the payment connection named by `{connection_id}` of a company that your account
     * **owns or manages**.
     *
     * - **Effect:** BeeL deletes the stored credentials and auto-invoicing stops at once; charges
     *   arriving afterwards are ignored and produce no invoice. Already-issued invoices are not
     *   affected.
     * - **The provider-side authorization is not revoked:** to withdraw it, the holder must
     *   remove BeeL's access from the provider's own dashboard (in Stripe, *Settings → Connected
     *   applications*).
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $connectionId  Unique identifier (UUID) of the payment connection the operation acts on, as returned by `GET /v1/companies/{company_id}/payment-connections`. A NIF can hold several connections of the same provider, so the provider slug alone does not name one. A connection of another NIF answers `404`, exactly like one that does not exist.
     */
    public function __construct(string $companyId, string $connectionId)
    {
        $this->company_id = $companyId;
        $this->connection_id = $connectionId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}', '{connection_id}'], [rawurlencode($this->company_id), rawurlencode($this->connection_id)], '/v1/companies/{company_id}/payment-connections/{connection_id}');
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
     * @throws DisconnectCompanyPaymentConnectionUnauthorizedException
     * @throws DisconnectCompanyPaymentConnectionForbiddenException
     * @throws DisconnectCompanyPaymentConnectionNotFoundException
     * @throws DisconnectCompanyPaymentConnectionTooManyRequestsException
     * @throws DisconnectCompanyPaymentConnectionInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DisconnectCompanyPaymentConnectionUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DisconnectCompanyPaymentConnectionForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DisconnectCompanyPaymentConnectionNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DisconnectCompanyPaymentConnectionTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DisconnectCompanyPaymentConnectionInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
