<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;

/**
 * @deprecated Session-focus customer operations. Prefer company-scoped resources.
 *
 * @method mixed list(array $query = [])
 * @method mixed create(\Lenorix\BeelSdk\Generated\Model\CreateCustomerRequest $request)
 * @method mixed get(string $customerId)
 * @method mixed update(string $customerId, \Lenorix\BeelSdk\Generated\Model\UpdateCustomerRequest $request)
 * @method void deactivate(string $customerId)
 */
final readonly class CustomersResource extends GeneratedResource
{
    public function __construct(Client $client)
    {
        parent::__construct($client, [
            'list' => 'listCustomers',
            'create' => 'createCustomer',
            'get' => 'getCustomer',
            'update' => 'updateCustomer',
            'deactivate' => 'deleteCustomer',
        ]);
    }
}
