<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentConnectionsBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentConnectionsForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentConnectionsInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentConnectionsTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\ListCompanyPaymentConnectionsUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\ListManagedPaymentConnectionsResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ListCompanyPaymentConnections extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Returns the payment provider connections of a company your account **owns or
     * manages**, with the provider-side account each one points at and its `status`. Use it to
     * check whether a NIF you provisioned has completed its connection.
     *
     * - **A NIF with no connections:** answers `200` with an empty list.
     * - **`environment`:** Test and Live connections are independent, so only the ones living in
     *   the mode of the key you ask with are returned; this field states which.
     *
     * **Closed catalogue.** A NIF is not limited to one connection per provider: within a single
     * environment it may hold several of the same provider, one per external account. What is
     * unique is the external account itself — one live connection per provider, environment and
     * external account. The set is still bounded and unpaginated: the collection carries no
     * `pagination` and takes no `page`/`limit`, and every response holds the whole set for the
     * environment of the key you ask with.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     */
    public function __construct(string $companyId)
    {
        $this->company_id = $companyId;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/payment-connections');
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
     * @return null|ListManagedPaymentConnectionsResponse|ErrorResponse
     *
     * @throws ListCompanyPaymentConnectionsBadRequestException
     * @throws ListCompanyPaymentConnectionsUnauthorizedException
     * @throws ListCompanyPaymentConnectionsForbiddenException
     * @throws ListCompanyPaymentConnectionsTooManyRequestsException
     * @throws ListCompanyPaymentConnectionsInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ListManagedPaymentConnectionsResponse', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyPaymentConnectionsBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyPaymentConnectionsUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyPaymentConnectionsForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyPaymentConnectionsTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new ListCompanyPaymentConnectionsInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
