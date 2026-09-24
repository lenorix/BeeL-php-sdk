<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateProductRequest;
use Lenorix\BeelSdk\Generated\Model\PatchProductRequest;
use Lenorix\BeelSdk\Generated\Model\Product;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsGetResponse200Data;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/**
 * @method \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdProductsGetResponse200Data list(array $query = [])
 * @method \Lenorix\BeelSdk\Generated\Model\Product create(\Lenorix\BeelSdk\Generated\Model\CreateProductRequest $request, array $headers = [])
 * @method \Lenorix\BeelSdk\Generated\Model\Product get(string $productId)
 * @method \Lenorix\BeelSdk\Generated\Model\Product update(string $productId, \Lenorix\BeelSdk\Generated\Model\PatchProductRequest $request)
 */
final readonly class CompanyProductsResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId)
    {
        parent::__construct($client, ['list' => 'listCompanyProducts', 'create' => 'createCompanyProduct', 'delete' => 'deleteCompanyProduct', 'get' => 'getCompanyProduct', 'update' => 'patchCompanyProduct', 'createBulk' => 'createCompanyProductsBulk', 'deleteBulk' => 'deleteCompanyProductsBulk'], [$companyId]);
    }

    public function list(array $query = []): V1CompaniesCompanyIdProductsGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listCompanyProducts($this->companyId, $query));
    }

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
}
