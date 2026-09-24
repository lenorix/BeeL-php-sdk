<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;

/**
 * @deprecated Use a company-scoped products resource.
 *
 * @method mixed list(array $query = [])
 * @method mixed create(\Lenorix\BeelSdk\Generated\Model\CreateProductRequest $request)
 * @method mixed get(string $productId)
 * @method mixed update(string $productId, \Lenorix\BeelSdk\Generated\Model\UpdateProductRequest $request)
 * @method void delete(string $productId)
 * @method mixed createBulk(\Lenorix\BeelSdk\Generated\Model\V1ProductsBulkPostBody $request)
 * @method mixed deleteBulk(array $query = [])
 */
final readonly class ProductsResource extends GeneratedResource
{
    public function __construct(Client $client)
    {
        parent::__construct($client, ['list' => 'listProducts', 'create' => 'createProduct', 'get' => 'getProduct', 'update' => 'updateProduct', 'delete' => 'deleteProduct', 'search' => 'searchProducts', 'createBulk' => 'createProductsBulk', 'deleteBulk' => 'deleteProductsBulk']);
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
}
