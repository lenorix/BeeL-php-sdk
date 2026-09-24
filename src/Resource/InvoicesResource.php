<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Resource;

use Lenorix\BeelSdk\Generated\Client;

/**
 * @deprecated Session-focus invoice operations. Prefer company-scoped resources.
 *
 * @method mixed list(array $query = [])
 * @method mixed create(\Lenorix\BeelSdk\Generated\Model\CreateInvoiceRequest $request)
 * @method mixed get(string $invoiceId)
 * @method mixed update(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\UpdateInvoiceRequest $request)
 * @method void delete(string $invoiceId)
 * @method mixed duplicate(string $invoiceId, ?\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdDuplicatePostBody $request = null)
 * @method mixed issue(string $invoiceId, array $query = [], array $headers = [])
 * @method mixed markPaid(string $invoiceId, ?\Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdMarkPaidPostBody $request = null)
 * @method mixed markSent(string $invoiceId)
 * @method mixed revertToIssued(string $invoiceId)
 * @method mixed void(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\VoidInvoiceRequest $request)
 * @method mixed createCorrective(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\CreateCorrectiveInvoiceRequest $request)
 * @method mixed schedule(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdSchedulePostBody $request)
 * @method mixed unschedule(string $invoiceId)
 * @method mixed reschedule(string $invoiceId, \Lenorix\BeelSdk\Generated\Model\V1InvoicesInvoiceIdReschedulePatchBody $request)
 * @method mixed getPdf(string $invoiceId)
 * @method mixed sendEmail(string $invoiceId, ?\Lenorix\BeelSdk\Generated\Model\SendEmailRequest $request = null)
 */
final readonly class InvoicesResource extends GeneratedResource
{
    public function __construct(Client $client)
    {
        parent::__construct($client, [
            'list' => 'listInvoices',
            'create' => 'createInvoice',
            'get' => 'getInvoice',
            'update' => 'updateInvoice',
            'delete' => 'deleteInvoice',
            'duplicate' => 'duplicateInvoice',
            'issue' => 'issueInvoice',
            'markPaid' => 'markInvoicePaid',
            'markSent' => 'markInvoiceSent',
            'revertToIssued' => 'revertInvoiceToIssued',
            'void' => 'voidInvoice',
            'createCorrective' => 'createCorrectiveInvoice',
            'schedule' => 'scheduleInvoice',
            'unschedule' => 'unscheduleInvoice',
            'reschedule' => 'rescheduleInvoice',
            'getPdf' => 'generateInvoicePdf',
            'sendEmail' => 'sendInvoiceEmail',
        ]);
    }
}
