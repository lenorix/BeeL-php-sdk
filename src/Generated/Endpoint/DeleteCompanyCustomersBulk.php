<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomersBulkBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomersBulkForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomersBulkInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomersBulkTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DeleteCompanyCustomersBulkUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkDeleteResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteCompanyCustomersBulk extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    /**
     * Deletes the customers listed in `ids` from this company.
     *
     * ## Partial results
     *
     * - **Partial operation:** the customers that can be deleted are deleted, and the rest keep
     *   their place in `customers_deletion` with the status that explains why. That is why it
     *   answers `200` with a body instead of `204`, and why it answers `200` even when no row
     *   could be deleted.
     * - **`HAS_INVOICES`:** a customer that has invoices cannot be deleted and comes back with
     *   that row status.
     *
     * ## What deleting means
     *
     * - **Semantics:** the same semantics as
     *   `DELETE /v1/companies/{company_id}/customers/{customer_id}` — the customer is retained
     *   internally for tax record-keeping purposes but is no longer exposed by the API, its
     *   identifier is released for reuse, and invoices already issued to it keep their own copy of
     *   the recipient's details.
     * - **Deleting is not deactivating:** deleting frees the identifier, so the same NIF can be
     *   registered again, while `PATCH` with `active: false` leaves the customer where it is with
     *   its NIF still taken.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param array{
     *    "ids": string, //Comma-separated customer IDs
     * } $queryParameters
     */
    public function __construct(string $companyId, array $queryParameters = [])
    {
        $this->company_id = $companyId;
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return str_replace(['{company_id}'], [rawurlencode($this->company_id)], '/v1/companies/{company_id}/customers/bulk');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['ids']);
        $optionsResolver->setRequired(['ids']);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('ids', ['string']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     *
     * @return null|V1CompaniesCompanyIdCustomersBulkDeleteResponse200|ErrorResponse
     *
     * @throws DeleteCompanyCustomersBulkBadRequestException
     * @throws DeleteCompanyCustomersBulkUnauthorizedException
     * @throws DeleteCompanyCustomersBulkForbiddenException
     * @throws DeleteCompanyCustomersBulkTooManyRequestsException
     * @throws DeleteCompanyCustomersBulkInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkDeleteResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyCustomersBulkBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyCustomersBulkUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyCustomersBulkForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyCustomersBulkTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteCompanyCustomersBulkInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
