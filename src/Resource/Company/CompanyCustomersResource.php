<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\Customer;
use Lenorix\BeelSdk\Generated\Model\CustomerBulkDeleteResult;
use Lenorix\BeelSdk\Generated\Model\CustomerValidationUnifiedResult;
use Lenorix\BeelSdk\Generated\Model\PatchCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersBulkPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersGetResponse200Data;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPostBody;
use Lenorix\BeelSdk\Generated\Model\V1CompaniesCompanyIdCustomersImportsPreviewPostBody;
use Lenorix\BeelSdk\Http\QueryParameters;
use Lenorix\BeelSdk\Http\RequestModels;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** Manage the customer records used by invoices for one company. */
final readonly class CompanyCustomersResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /** @param array<string, mixed> $query Search and pagination filters accepted by BeeL. */
    public function list(array $query = []): V1CompaniesCompanyIdCustomersGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listCompanyCustomers($this->companyId, $query));
    }

    /**
     * Iterate over all of this company's customers, across every page.
     *
     * Pages are fetched lazily while you iterate. Filters and `limit` apply to every
     * page; `page` sets the first page to read.
     *
     * @param  array<string, mixed>  $query  The same filters as `list()`.
     * @return \Generator<int, Customer>
     */
    public function all(array $query = []): \Generator
    {
        return $this->paginate(
            fn (array $query): V1CompaniesCompanyIdCustomersGetResponse200Data => $this->list($query),
            static fn (V1CompaniesCompanyIdCustomersGetResponse200Data $page): array => $page->getCustomers(),
            $query,
        );
    }

    /**
     * Create a customer under this company.
     *
     * @param  CreateCustomerRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Optional request headers.
     */
    public function create(CreateCustomerRequest|array $request, array $headers = []): Customer
    {
        $request = RequestModels::from($request, CreateCustomerRequest::class);

        return $this->execute(fn () => $this->client->createCompanyCustomer($this->companyId, $request, $headers));
    }

    /** Retrieve a customer belonging to this company. */
    public function get(string $customerId): Customer
    {
        return $this->execute(fn () => $this->client->getCompanyCustomer($this->companyId, $customerId));
    }

    /** Partially update a customer; omitted fields remain unchan     *
     * @param  PatchCustomerRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function update(string $customerId, PatchCustomerRequest|array $request): Customer
    {
        $request = RequestModels::from($request, PatchCustomerRequest::class);

        return $this->execute(fn () => $this->client->patchCompanyCustomer($this->companyId, $customerId, $request));
    }

    /** Delete a customer from this company's catalog. */
    public function delete(string $customerId): void
    {
        $this->executeVoid(fn () => $this->client->deleteCompanyCustomer($this->companyId, $customerId));
    }

    /**
     * Create several customers in one request.
     *
     * @param  V1CompaniesCompanyIdCustomersBulkPostBody|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $query  Query options.
     * @param  array<string, mixed>  $headers  Optional request headers.
     */
    public function createBulk(V1CompaniesCompanyIdCustomersBulkPostBody|array $request, array $query = [], array $headers = []): CustomerValidationUnifiedResult
    {
        $request = RequestModels::from($request, V1CompaniesCompanyIdCustomersBulkPostBody::class);

        return $this->execute(fn () => $this->client->createCompanyCustomersBulk($this->companyId, $request, $query, $headers));
    }

    /**
     * Delete several customers by ID.
     *
     * @param  array<string, mixed>  $query  Deletion filters and IDs accepted by BeeL; `ids` may be a list or a comma-separated string.
     */
    public function deleteBulk(array $query = []): CustomerBulkDeleteResult
    {
        return $this->execute(fn () => $this->client->deleteCompanyCustomersBulk($this->companyId, QueryParameters::commaSeparated($query, 'ids')));
    }

    /**
     * Start a customer import for this company.
     *
     * @param  V1CompaniesCompanyIdCustomersImportsPostBody|array<string, mixed>  $request  The request as a model or as an array in API format.
     * @param  array<string, mixed>  $headers  Request headers. BeeL requires an `Idempotency-Key`: without one here or in `withOptions()`, a new one is sent.
     */
    public function import(V1CompaniesCompanyIdCustomersImportsPostBody|array $request, array $headers = []): CustomerValidationUnifiedResult
    {
        $request = RequestModels::from($request, V1CompaniesCompanyIdCustomersImportsPostBody::class);

        return $this->execute(fn () => $this->client->createCompanyCustomerImport($this->companyId, $request, $this->withIdempotencyKey($headers)));
    }

    /** Validate an import payload and preview its results without importing custom     *
     * @param  V1CompaniesCompanyIdCustomersImportsPreviewPostBody|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function previewImport(V1CompaniesCompanyIdCustomersImportsPreviewPostBody|array $request): CustomerValidationUnifiedResult
    {
        $request = RequestModels::from($request, V1CompaniesCompanyIdCustomersImportsPreviewPostBody::class);

        return $this->execute(fn () => $this->client->previewCompanyCustomerImport($this->companyId, $request));
    }
}
