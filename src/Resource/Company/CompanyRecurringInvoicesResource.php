<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource\Company;

use Lenorix\BeelSdk\Generated\Client;
use Lenorix\BeelSdk\Resource\GeneratedResource;

/**
 * @method mixed list(array $query = [])
 * @method mixed create(\Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceRequest $request)
 * @method mixed stats(array $query = [])
 * @method void delete(string $recurringInvoiceId)
 * @method mixed get(string $recurringInvoiceId)
 * @method mixed update(string $recurringInvoiceId, \Lenorix\BeelSdk\Generated\Model\PatchRecurringInvoiceRequest $request)
 * @method mixed derive(\Lenorix\BeelSdk\Generated\Model\CreateRecurringInvoiceDerivationRequest $request)
 * @method mixed setStatus(string $recurringInvoiceId, \Lenorix\BeelSdk\Generated\Model\SetRecurringInvoiceStatusRequest $request)
 * @method mixed skip(string $recurringInvoiceId)
 * @method mixed generateNow(string $recurringInvoiceId)
 * @method mixed nextOccurrence(string $recurringInvoiceId)
 * @method mixed history(string $recurringInvoiceId, array $query = [])
 */
final readonly class CompanyRecurringInvoicesResource extends GeneratedResource
{
    public function __construct(Client $client, string $companyId)
    {
        parent::__construct($client, ['list' => 'listCompanyRecurringInvoices', 'create' => 'createCompanyRecurringInvoice', 'stats' => 'getCompanyRecurringInvoiceStats', 'delete' => 'deleteCompanyRecurringInvoice', 'get' => 'getCompanyRecurringInvoice', 'update' => 'patchCompanyRecurringInvoice', 'setStatus' => 'setCompanyRecurringInvoiceStatus', 'nextOccurrence' => 'getCompanyRecurringInvoiceNextOccurrence', 'history' => 'getCompanyRecurringInvoiceHistory', 'derive' => 'createCompanyRecurringInvoiceDerivation', 'generateNow' => 'generateCompanyRecurringInvoiceNow', 'generate' => 'generateCompanyRecurringInvoiceNow', 'skip' => 'skipCompanyRecurringInvoice'], [$companyId]);
    }
}
