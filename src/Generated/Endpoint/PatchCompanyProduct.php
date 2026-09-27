<?php

namespace Lenorix\BeelSdk\Generated\Endpoint;

use Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductBadRequestException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductConflictException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductForbiddenException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductInternalServerErrorException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductNotFoundException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductTooManyRequestsException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductUnauthorizedException;
use Lenorix\BeelSdk\Generated\Exception\PatchCompanyProductUnprocessableEntityException;
use Lenorix\BeelSdk\Generated\Model\ErrorResponse;
use Lenorix\BeelSdk\Generated\Model\PatchProductRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsProductIdPatchResponse200;
use Lenorix\BeelSdk\Generated\Runtime\Client\BaseEndpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\Endpoint;
use Lenorix\BeelSdk\Generated\Runtime\Client\EndpointTrait;
use Lenorix\BeelSdk\Generated\Runtime\Client\JsonPayload;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PatchCompanyProduct extends BaseEndpoint implements Endpoint
{
    protected $company_id;

    protected $product_id;

    /**
     * Updates only the fields present in the body, leaving every other field of the product as it
     * is — in particular `main_tax`, `irpf_rate` and `equivalence_surcharge_rate`.
     *
     * - **Null vs omitted:** a field sent as `null` is cleared, which is different from omitting
     *   it (see `PatchProductRequest`).
     * - **Only update verb:** the total replacement `PUT /v1/products/{product_id}`, which reset
     *   the omitted fields to their creation defaults, is not carried over to the canonical
     *   form.
     *
     * @param  string  $companyId  Unique identifier (UUID) of the company the operation acts on — its identifier, not its NIF. It is the only source of context: the account that owns it is derived from it, and the `BeeL-Active-Company` header plays no part. A company you do not reach answers `403`, and so does a company that does not exist, so the existence of a company in another account is never disclosed.
     * @param  string  $productId  Product unique UUID
     */
    public function __construct(string $companyId, string $productId, PatchProductRequest $requestBody)
    {
        $this->company_id = $companyId;
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
        return str_replace(['{company_id}', '{product_id}'], [rawurlencode($this->company_id), rawurlencode($this->product_id)], '/v1/companies/{company_id}/products/{product_id}');
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
     * @return null|V1CompaniesCompanyIdProductsProductIdPatchResponse200|ErrorResponse
     *
     * @throws PatchCompanyProductBadRequestException
     * @throws PatchCompanyProductUnauthorizedException
     * @throws PatchCompanyProductForbiddenException
     * @throws PatchCompanyProductNotFoundException
     * @throws PatchCompanyProductConflictException
     * @throws PatchCompanyProductUnprocessableEntityException
     * @throws PatchCompanyProductTooManyRequestsException
     * @throws PatchCompanyProductInternalServerErrorException
     */
    protected function transformResponseBody(ResponseInterface $response, SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && ($status === 200 && stripos(strtolower($contentType), 'application/json') !== false)) {
            return $serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsProductIdPatchResponse200', 'json');
        }
        if (is_null($contentType) === false && ($status === 400 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyProductBadRequestException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 401 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyProductUnauthorizedException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 403 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyProductForbiddenException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 404 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyProductNotFoundException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 409 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyProductConflictException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 422 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyProductUnprocessableEntityException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 429 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyProductTooManyRequestsException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
        }
        if (is_null($contentType) === false && ($status === 500 && stripos(strtolower($contentType), 'application/json') !== false)) {
            throw new PatchCompanyProductInternalServerErrorException($serializer->deserialize($body, 'Lenorix\BeelSdk\Generated\Model\ErrorResponse', 'json'), $response);
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
