<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateProductRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateProductRequest;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteBody;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkDeleteResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1ProductsBulkPostBody;
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

    /** Search the deprecated product-search route (the company list route is preferred). */
    public function search(string $query, ?int $limit = null): mixed
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
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listProducts($query));
    }

    public function create(CreateProductRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createProduct($request));
    }

    public function get(string $productId): mixed
    {
        return $this->execute(fn () => $this->client->getProduct($productId));
    }

    public function update(string $productId, UpdateProductRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->updateProduct($productId, $request));
    }

    public function delete(string $productId): void
    {
        $this->execute(fn () => $this->client->deleteProduct($productId));
    }

    public function createBulk(V1ProductsBulkPostBody $request): mixed
    {
        return $this->execute(fn () => $this->client->createProductsBulk($request));
    }

    public function deleteBulk(V1ProductsBulkDeleteBody $request): V1ProductsBulkDeleteResponse200Data
    {
        return $this->execute(fn () => $this->client->deleteProductsBulk($request));
    }
}
