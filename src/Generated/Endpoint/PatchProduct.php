<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\PatchProductBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\PatchProductConflictException;
use Lenorix\BeelSdk\Generated\Exception\PatchProductForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PatchProductInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\PatchProductNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\PatchProductUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\PatchProductUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\PatchProductRequest;
use Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PatchProduct extends BaseEndpoint implements Endpoint
{
    protected $product_id;

    /**
     * Updates only the fields present in the body, leaving every other field of the product as it
     * is — in particular `main_tax`, `irpf_rate` and `equivalence_surcharge_rate`, which `PUT`
     * resets.
     *
     * - **Null vs omitted:** a field sent as `null` is cleared, which is different from omitting
     *   it (see `PatchProductRequest`). The result goes through the same validation as `PUT`.
     * - **Deprecated:** use `PATCH /v1/companies/{company_id}/products/{product_id}`, which
     *   behaves identically.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  string  $productId  Product unique UUID
     */
    public function __construct(string $productId, PatchProductRequest $requestBody)
    {
        $this->product_id = $productId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        return str_replace(['{product_id}'], [rawurlencode($this->product_id)], '/v1/products/{product_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof PatchProductRequest) {
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
     * @return null|V1ProductsProductIdPatchResponse200|ErrorResponse
     *
     * @throws PatchProductBadRequestException
     * @throws PatchProductUnauthorizedException
     * @throws PatchProductForbiddenException
     * @throws PatchProductNotFoundException
     * @throws PatchProductConflictException
     * @throws PatchProductUnprocessableEntityException
     * @throws PatchProductInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchProductBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchProductUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchProductForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchProductNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchProductConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchProductUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchProductInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
