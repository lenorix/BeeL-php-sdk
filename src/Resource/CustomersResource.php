<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest;
use Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequest;
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
    public function list(array $query = []): mixed
    {
        return $this->execute(fn () => $this->client->listCustomers($query));
    }

    public function create(CreateCustomerRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->createCustomer($request));
    }

    public function get(string $customerId): mixed
    {
        return $this->execute(fn () => $this->client->getCustomer($customerId));
    }

    public function update(string $customerId, UpdateCustomerRequest $request): mixed
    {
        return $this->execute(fn () => $this->client->updateCustomer($customerId, $request));
    }

    public function deactivate(string $customerId): void
    {
        $this->execute(fn () => $this->client->deleteCustomer($customerId));
    }
}
