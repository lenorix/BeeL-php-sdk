<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\DeleteProductsBulkBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\DeleteProductsBulkForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\DeleteProductsBulkInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\DeleteProductsBulkRequestEntityTooLargeException;
use Lenorix\BeelSdk\Generated\Exception\DeleteProductsBulkUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\DeleteProductsBulkUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteBody;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DeleteProductsBulk extends BaseEndpoint implements Endpoint
{
    /**
     * Deletes up to 100 products of the catalog, listed in `product_ids`.
     *
     * - **Partial operation:** the response reports which products were deleted
     *   (`deleted_products`) and which failed (`errors`, one entry per product with its
     *   `product_id`), with the counts in `summary`. That is why it answers `200` with a body
     *   instead of `204`.
     * - **Deprecated:** use `DELETE /v1/companies/{company_id}/products/bulk`, which deletes the
     *   same way but takes the IDs in the `ids` query parameter instead of in the request body: a
     *   `DELETE` body has no defined semantics and intermediaries may drop it.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     */
    public function __construct(V1ProductsBulkDeleteBody $requestBody)
    {
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return '/v1/products/bulk';
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof V1ProductsBulkDeleteBody) {
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
     * @return null|V1ProductsBulkDeleteResponse200|ErrorResponse
     *
     * @throws DeleteProductsBulkBadRequestException
     * @throws DeleteProductsBulkUnauthorizedException
     * @throws DeleteProductsBulkForbiddenException
     * @throws DeleteProductsBulkRequestEntityTooLargeException
     * @throws DeleteProductsBulkUnprocessableEntityException
     * @throws DeleteProductsBulkInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteProductsBulkBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteProductsBulkUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteProductsBulkForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 413 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteProductsBulkRequestEntityTooLargeException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteProductsBulkUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new DeleteProductsBulkInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
