<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateProductRequest;
use Lenorix\BeelSdk\Generated\Model\PatchProductRequest;
use Lenorix\BeelSdk\Generated\Model\Product;
use Lenorix\BeelSdk\Generated\Model\ProductBulkCreateResult;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkDeleteResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsGetResponse200Data;
use Lenorix\BeelSdk\Http\QueryParameters;
use Lenorix\BeelSdk\Http\RequestModels;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** Manage this company's product catalog and default line details. */
final readonly class CompanyProductsResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * List products for this company with optional filters and pagination.
     *
     * @param  array<string, mixed>  $query  Product filters and pagination options accepted by BeeL.
     */
    public function list(array $query = []): V1CompaniesCompanyIdProductsGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listCompanyProducts($this->companyId, $query));
    }

    /**
     * Iterate over all of this company's products, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, Product>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): V1CompaniesCompanyIdProductsGetResponse200Data => $this->list($query),
            static fn (V1CompaniesCompanyIdProductsGetResponse200Data $page): array => $page->getProducts(),
            $query,
        );
    }

    /**
     * Create a product in this company's catalog.
     *
     * @param  CreateProductRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Optional request headers.
     */
    public function create(CreateProductRequest|array $request, array $headers = []): Product
    {
        $request = RequestModels::from($request, CreateProductRequest::class);

        return $this->execute(fn () => $this->client->createCompanyProduct($this->companyId, $request, $headers));
    }

    /** Retrieve one product from this company's catalog. */
    public function get(string $productId): Product
    {
        return $this->execute(fn () => $this->client->getCompanyProduct($this->companyId, $productId));
    }

    /** Partially update a product; omitted fields remain unchan     *
     * @param  PatchProductRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function update(string $productId, PatchProductRequest|array $request): Product
    {
        $request = RequestModels::from($request, PatchProductRequest::class);

        return $this->execute(fn () => $this->client->patchCompanyProduct($this->companyId, $productId, $request));
    }

    /** Delete a product from this company's catalog. */
    public function delete(string $productId): void
    {
        $this->execute(fn () => $this->client->deleteCompanyProduct($this->companyId, $productId));
    }

    /**
     * Create several products in one request.
     *
     * @param  V1CompaniesCompanyIdProductsBulkPostBody|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Optional request headers.
     */
    public function createBulk(V1CompaniesCompanyIdProductsBulkPostBody|array $request, array $headers = []): ProductBulkCreateResult
    {
        $request = RequestModels::from($request, V1CompaniesCompanyIdProductsBulkPostBody::class);

        return $this->execute(fn () => $this->client->createCompanyProductsBulk($this->companyId, $request, $headers));
    }

    /**
     * Delete several products by ID.
     *
     * @param  array<string, mixed>  $query  Product IDs accepted by BeeL; `ids` may be a list or a comma-separated string (at most 100).
     */
    public function deleteBulk(array $query = []): V1CompaniesCompanyIdProductsBulkDeleteResponse200Data
    {
        return $this->execute(fn () => $this->client->deleteCompanyProductsBulk($this->companyId, QueryParameters::commaSeparated($query, 'ids')));
    }
}
