<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/**
 * @method mixed list(array $query = [])
 * @method mixed get(string $eventId)
 * @method mixed retry(string $eventId)
 * @method mixed draft(string $eventId)
 * @method mixed resolve(string $eventId)
 * @method mixed discard(string $eventId)
 * @method mixed restore(string $eventId)
 */
final readonly class CompanyPaymentEventsResource extends GeneratedResource
{
    public function __construct(Client $client, string $companyId, string $connectionId)
    {
        parent::__construct($client, ['list' => 'listCompanyPaymentEvents', 'get' => 'getCompanyPaymentEvent', 'retry' => 'retryCompanyPaymentEvent', 'draft' => 'generateCompanyPaymentEventDraft', 'resolve' => 'resolveCompanyPaymentEvent', 'discard' => 'discardCompanyPaymentEvent', 'restore' => 'restoreCompanyPaymentEvent'], [$companyId, $connectionId]);
    }
}
