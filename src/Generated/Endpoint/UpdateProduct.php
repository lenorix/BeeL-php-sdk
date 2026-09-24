<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

class UpdateProduct extends \Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint implements \Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint
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
     * @param string $productId Product unique UUID
     * @param \Lenorix\BeelSdk\Generated\Model\UpdateProductRequest $requestBody
     */
    public function __construct(string $productId, \Lenorix\BeelSdk\Generated\Model\UpdateProductRequest $requestBody)
    {
        $this->product_id = $productId;
        $this->body = $requestBody;
    }
    use \Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PUT';
    }
    public function getUri(): string
    {
        return str_replace(['{product_id}'], [rawurlencode($this->product_id)], '/v1/products/{product_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \Lenorix\BeelSdk\Generated\Model\UpdateProductRequest) {
            return [['Content-Type' => ['application/json']], \Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload::encode($serializer, $this->body)];
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
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductBadRequestException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductUnauthorizedException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductForbiddenException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductNotFoundException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductConflictException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductUnprocessableEntityException
     * @throws \Lenorix\BeelSdk\Generated\Exception\UpdateProductInternalServerErrorException
     *
     * @return null|\Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdPutResponse200|\Lenorix\BeelSdk\Generated\Model\ErrorResponse
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1ProductsProductIdPutResponse200', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateProductBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (401 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateProductUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (403 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateProductForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateProductNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (409 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateProductConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (422 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateProductUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new \Lenorix\BeelSdk\Generated\Exception\UpdateProductInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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