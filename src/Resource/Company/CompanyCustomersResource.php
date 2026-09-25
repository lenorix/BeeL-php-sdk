<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\Customer;
use Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPreviewPostBody;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

final readonly class CompanyCustomersResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): V1CompaniesCompanyIdCustomersGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listCompanyCustomers($this->companyId, $query));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function create(CreateCustomerRequest $request, array $headers = []): Customer
    {
        return $this->execute(fn () => $this->client->createCompanyCustomer($this->companyId, $request, $headers));
    }

    public function get(string $customerId): Customer
    {
        return $this->execute(fn () => $this->client->getCompanyCustomer($this->companyId, $customerId));
    }

    public function update(string $customerId, PatchCustomerRequest $request): Customer
    {
        return $this->execute(fn () => $this->client->patchCompanyCustomer($this->companyId, $customerId, $request));
    }

    public function delete(string $customerId): mixed
    {
        return $this->execute(fn () => $this->client->deleteCompanyCustomer($this->companyId, $customerId));
    }

    /**
     * @param  array<string, mixed>  $query
     * @param  array<string, mixed>  $headers
     */
    public function createBulk(V1CompaniesCompanyIdCustomersBulkPostBody $request, array $query = [], array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyCustomersBulk($this->companyId, $request, $query, $headers));
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function deleteBulk(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->deleteCompanyCustomersBulk($this->companyId, $query));
    }

    /**
     * @param  array<string, mixed>  $headers
     */
    public function import(V1CompaniesCompanyIdCustomersImportsPostBody $request, array $headers = []): mixed
    {
        return $this->execute(fn () => $this->client->createCompanyCustomerImport($this->companyId, $request, $headers));
    }

    public function previewImport(V1CompaniesCompanyIdCustomersImportsPreviewPostBody $request): mixed
    {
        return $this->execute(fn () => $this->client->previewCompanyCustomerImport($this->companyId, $request));
    }
}
