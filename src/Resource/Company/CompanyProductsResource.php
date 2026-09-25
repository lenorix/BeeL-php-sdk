<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateProductRequest;
use Lenorix\BeelSdk\Generated\Model\PatchProductRequest;
use Lenorix\BeelSdk\Generated\Model\Product;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsBulkPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsGetResponse200Data;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanyProductsResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): V1CompaniesCompanyIdProductsGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listCompanyProducts($this->companyId, $query));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function create(CreateProductRequest $request, array $headers = []): Product
    {
        return $this->execute(fn () => $this->client->createCompanyProduct($this->companyId, $request, $headers));
    }

    public function get(string $productId): Product
    {
        return $this->execute(fn () => $this->client->getCompanyProduct($this->companyId, $productId));
    }

    public function update(string $productId, PatchProductRequest $request): Product
    {
        return $this->execute(fn () => $this->client->patchCompanyProduct($this->companyId, $productId, $request));
    }

    public function delete(string $productId): mixed
    {
        return $this->execute(fn () => $this->client->deleteCompanyProduct($this->companyId, $productId));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function createBulk(V1CompaniesCompanyIdProductsBulkPostBody $request, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyProductsBulk($this->companyId, $request, $headers));
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function deleteBulk(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->deleteCompanyProductsBulk($this->companyId, $query));
    }
}
