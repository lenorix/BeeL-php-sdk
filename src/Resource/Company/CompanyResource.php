<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Beel;
use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Http\ResponseContext;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/** A resource scoped to one company (NIF). */
abstract readonly class CompanyResource extends GeneratedResource
{
    /** @internal Resources are created by {@see Beel::company()}. */
    public function __construct(Client $client, protected string $companyId, ResponseContext $responseContext)
    {
        parent::__construct($client, $responseContext);
    }
}
