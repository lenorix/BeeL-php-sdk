<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\DeactivateCustomersBulkUnauthorizedException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1CustomersBulkDeleteResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Serializer\SerializerInterface;

class DeactivateCustomersBulk extends BaseEndpoint implements Endpoint
{
    /**
     * Deletes the customers listed in `ids`.
     *
     * - **Deprecated:** use `DELETE /v1/companies/{company_id}/customers/bulk`, which behaves
     *   identically.
     *
     * ## Partial results
     *
     * - **Partial:** the customers that can be deleted are deleted, and the rest keep their
     *   place in `customers_deletion` with the status that explains why.
     * - **`HAS_INVOICES`:** a customer that has invoices cannot be deleted and comes back with
     *   that row status.
     *
     * ## What deleting means
     *
     * - **Semantics:** each deletion behaves as `DELETE /v1/customers/{customer_id}`. The
     *   customer is retained for tax record-keeping purposes but is no longer exposed by the
     *   API, its identifier is released for reuse, and invoices already issued to it keep their
     *   own copy of the recipient's details.
     * - **Not deactivating:** deleting frees the identifier, so the same NIF can be registered
     *   again, while `PATCH` with `active: false` leaves the customer where it is with its NIF
     *   still taken.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param array{
     *    "ids": string, //Comma-separated customer IDs
     * } $queryParameters
     */
    public function __construct(array $queryParameters = [])
    {
        $this->queryParameters = $queryParameters;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return '/v1/customers/bulk';
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
     * @return null|V1CustomersBulkDeleteResponse200|ErrorResponse
     *
     * @throws DeactivateCustomersBulkBadRequestException
     * @throws DeactivateCustomersBulkUnauthorizedException
     * @throws DeactivateCustomersBulkForbiddenException
     * @throws DeactivateCustomersBulkTooManyRequestsException
     * @throws DeactivateCustomersBulkInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CustomersBulkDeleteResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeactivateCustomersBulkBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeactivateCustomersBulkUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeactivateCustomersBulkForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeactivateCustomersBulkTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeactivateCustomersBulkInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
