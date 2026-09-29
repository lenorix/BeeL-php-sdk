<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateProductRequest;
use Lenorix\BeelSdk\Generated\Model\Product;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateResult;
use Lenorix\BeelSdk\Generated\Model\UpdateProductRequest;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteBody;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkPostBody;
use Lenorix\BeelSdk\Generated\Model\V1ProductsGetResponse200Data;
use Lenorix\BeelSdk\Http\RequestModels;
use Lenorix\BeelSdk\Http\ResponseContext;

/**
 * @deprecated Use a company-scoped products resource.
 */
final readonly class ProductsResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * Search the deprecated product-search route (the company list route is preferred).
     *
     * @return list<Product>
     */
    public function search(string $query, ?int $limit = null): array
    {
        $parameters = ['q' => $query];
        if ($limit !== null) {
            $parameters['limit'] = $limit;
        }

        return $this->execute(fn () => $this->client->searchProducts($parameters));
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): V1ProductsGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listProducts($query));
    }

    /**
     * @param  CreateProductRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function create(CreateProductRequest|array $request): Product
    {
        $request = RequestModels::from($request, CreateProductRequest::class);

        return $this->execute(fn () => $this->client->createProduct($request));
    }

    public function get(string $productId): Product
    {
        return $this->execute(fn () => $this->client->getProduct($productId));
    }

    /**
     * @param  UpdateProductRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function update(string $productId, UpdateProductRequest|array $request): Product
    {
        $request = RequestModels::from($request, UpdateProductRequest::class);

        return $this->execute(fn () => $this->client->updateProduct($productId, $request));
    }

    public function delete(string $productId): void
    {
        $this->executeVoid(fn () => $this->client->deleteProduct($productId));
    }

    /**
     * @param  V1ProductsBulkPostBody|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function createBulk(V1ProductsBulkPostBody|array $request): ProductBulkCreateResult
    {
        $request = RequestModels::from($request, V1ProductsBulkPostBody::class);

        return $this->execute(fn () => $this->client->createProductsBulk($request));
    }

    /**
     * @param  V1ProductsBulkDeleteBody|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function deleteBulk(V1ProductsBulkDeleteBody|array $request): V1ProductsBulkDeleteResponse200Data
    {
        $request = RequestModels::from($request, V1ProductsBulkDeleteBody::class);

        return $this->execute(fn () => $this->client->deleteProductsBulk($request));
    }
}
