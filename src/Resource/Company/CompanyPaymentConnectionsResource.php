<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/**
 * @method mixed list()
 * @method mixed authorize(\Lenorix\BeelSdk\Generated\Model\InitiatePaymentConnectionRequest $request)
 * @method mixed update(string $connectionId, \Lenorix\BeelSdk\Generated\Model\UpdateCompanyPaymentConnectionRequest $request)
 * @method void disconnect(string $connectionId)
 */
final readonly class CompanyPaymentConnectionsResource extends GeneratedResource
{
    public function __construct(Client $client, private string $companyId)
    {
        parent::__construct($client, [
            'list' => 'listCompanyPaymentConnections', 'authorize' => 'initiatePaymentConnection',
            'disconnect' => 'disconnectCompanyPaymentConnection', 'update' => 'updateCompanyPaymentConnection',
        ], [$companyId]);
    }

    public function events(string $connectionId): CompanyPaymentEventsResource
    {
        return new CompanyPaymentEventsResource($this->client, $this->companyId, $connectionId);
    }
}
