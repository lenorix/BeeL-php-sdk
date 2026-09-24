<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\Customer;
use Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersGetResponse200Data;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/**
 * @method \Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersGetResponse200Data list(array $query = [])
 * @method \Lenorix\BeelSdk\Generated\Model\Customer create(\Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest $request, array $headers = [])
 * @method \Lenorix\BeelSdk\Generated\Model\Customer get(string $customerId)
 * @method \Lenorix\BeelSdk\Generated\Model\Customer update(string $customerId, \Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest $request)
 */
final readonly class CompanyCustomersResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId)
    {
        parent::__construct($client, ['list' => 'listCompanyCustomers', 'create' => 'createCompanyCustomer', 'delete' => 'deleteCompanyCustomer', 'get' => 'getCompanyCustomer', 'update' => 'patchCompanyCustomer', 'createBulk' => 'createCompanyCustomersBulk', 'deleteBulk' => 'deleteCompanyCustomersBulk', 'import' => 'createCompanyCustomerImport', 'previewImport' => 'previewCompanyCustomerImport'], [$companyId]);
    }

    public function list(array $query = []): V1CompaniesCompanyIdCustomersGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listCompanyCustomers($this->companyId, $query));
    }

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
}
