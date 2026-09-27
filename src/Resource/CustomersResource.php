<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\Customer;
use Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\V1CustomersGetResponse200Data;
use Lenorix\BeelSdk\Http\RequestModels;
use Lenorix\BeelSdk\Http\ResponseContext;

/**
 * @deprecated Session-focus customer operations. Prefer company-scoped resources.
 */
final readonly class CustomersResource extends GeneratedResource
{
    public function __construct(Client $client, ?ResponseContext $responseContext = null)
    {
        parent::__construct($client, $responseContext);
    }

    /**
     * @param  array<string, mixed>  $query
     */
    public function list(array $query = []): V1CustomersGetResponse200Data
    {
        return $this->execute(fn () => $this->client->listCustomers($query));
    }

    /**
     * @param  CreateCustomerRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function create(CreateCustomerRequest|array $request): Customer
    {
        $request = RequestModels::from($request, CreateCustomerRequest::class);

        return $this->execute(fn () => $this->client->createCustomer($request));
    }

    public function get(string $customerId): Customer
    {
        return $this->execute(fn () => $this->client->getCustomer($customerId));
    }

    /**
     * @param  UpdateCustomerRequest|array<string, mixed>  $request  The request as a model or as an array in API format.
     */
    public function update(string $customerId, UpdateCustomerRequest|array $request): Customer
    {
        $request = RequestModels::from($request, UpdateCustomerRequest::class);

        return $this->execute(fn () => $this->client->updateCustomer($customerId, $request));
    }

    public function deactivate(string $customerId): void
    {
        $this->execute(fn () => $this->client->deleteCustomer($customerId));
    }
}
