<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyByIdBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyByIdConflictException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyByIdForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyByIdInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyByIdTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyByIdUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteCompanyById extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Removes a company from the account: it stops appearing and stops being billed.
     *
     * - **Existing invoices:** those already issued are retained, but the company-scoped API
     *   can no longer resolve them once the NIF is removed.
     * - **What blocks removal:** a NIF activated in Live
     *   (`409 COMPANY_ACTIVE_IN_PRODUCTION`), one holding any invoice in Live — issued, draft
     *   or proforma (`409 COMPANY_HAS_INVOICES`) — and the account's primary NIF
     *   (`400 CANNOT_DELETE_PRIMARY`).
     * - **Deactivating first:** switching off in Live is scheduled to the end of the paid
     *   cycle, so the removal only becomes possible once that takes effect.
     * - **Test:** NIFs never activated, or activated only in Test, are removed right away, and
     *   invoices in Test never block.
     * - **`Idempotency-Key`:** without one, a retry after a timeout answers `403` instead of
     *   the original `204`.
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
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}');
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
     * @throws DeleteCompanyByIdBadRequestException
     * @throws DeleteCompanyByIdUnauthorizedException
     * @throws DeleteCompanyByIdForbiddenException
     * @throws DeleteCompanyByIdConflictException
     * @throws DeleteCompanyByIdTooManyRequestsException
     * @throws DeleteCompanyByIdInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if ($status === 204) {
            return null;
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyByIdBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyByIdUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyByIdForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyByIdConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyByIdTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyByIdInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
