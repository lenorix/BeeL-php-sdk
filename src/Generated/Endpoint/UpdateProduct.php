<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\UpdateProductBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\UpdateProductConflictException;
use Lenorix\BeelSdk\Generated\Exception\UpdateProductForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\UpdateProductInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\UpdateProductNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\UpdateProductUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\UpdateProductUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\UpdateProductRequest;
use Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdPutResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateProduct extends BaseEndpoint implements Endpoint
{
    protected $product_id;

    /**
     * Replaces an existing product with the body you send.
     *
     * - **Not a partial update:** leaving out `main_tax`, `equivalence_surcharge_rate` or
     *   `irpf_rate` resets them to the creation defaults (IVA 21%, 0% and 0%), so send the product
     *   complete. To change only some fields, use
     *   `PATCH /v1/companies/{company_id}/products/{product_id}`.
     * - **Deprecated:** this route will be retired on the date announced in its `Sunset` response
     *   header. The canonical form has a single update verb,
     *   `PATCH /v1/companies/{company_id}/products/{product_id}`, which is not a drop-in
     *   replacement for this one: it changes only the fields present in the body and resets
     *   nothing on its own. To reproduce a total replacement, send every field and pass `null` in
     *   the ones you want cleared.
     *
     * **Retires on 9 December 2026.** See the [migration guide](https://docs.beel.es/changelog/resources-under-the-nif) for what moved where and what changes when you switch.
     *
     * @param  string  $productId  Product unique UUID
     */
    public function __construct(string $productId, UpdateProductRequest $requestBody)
    {
        $this->product_id = $productId;
        $this->body = $requestBody;
    }

    use EndpointTrait;

    public function getMethod(): string
    {
        return 'PUT';
    }

    public function getUri(): string
    {
        return str_replace(['{product_id}'], [rawurlencode($this->product_id)], '/v1/products/{product_id}');
    }

    public function getBody(SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof UpdateProductRequest) {
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
     * @return null|V1ProductsProductIdPutResponse200|ErrorResponse
     *
     * @throws UpdateProductBadRequestException
     * @throws UpdateProductUnauthorizedException
     * @throws UpdateProductForbiddenException
     * @throws UpdateProductNotFoundException
     * @throws UpdateProductConflictException
     * @throws UpdateProductUnprocessableEntityException
     * @throws UpdateProductInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdPutResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateProductBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateProductUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateProductForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateProductNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateProductConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateProductUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new UpdateProductInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
