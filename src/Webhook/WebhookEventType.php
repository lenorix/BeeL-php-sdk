<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Webhook;

use Lenorix\BeelSdk\Generated\Model\WebhookEventDataAccountClaimed;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataCompanyCreated;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceEmailSent;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceIssued;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoicePdfGenerated;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceScheduleFailed;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataInvoiceVoided;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataRecurringInvoicePaused;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataRepresentationSigned;
use Lenorix\BeelSdk\Generated\Model\WebhookEventDataVeriFactuStatusUpdated;

/** Public webhook event names supported by BeeL subscriptions. */
enum WebhookEventType: string
{
    case VERIFACTU_STATUS_UPDATED = 'verifactu.status.updated';
    case INVOICE_ISSUED = 'invoice.issued';
    case INVOICE_EMAIL_SENT = 'invoice.email.sent';
    case INVOICE_PDF_GENERATED = 'invoice.pdf.generated';
    case INVOICE_VOIDED = 'invoice.voided';
    case RECURRING_INVOICE_PAUSED = 'recurring_invoice.paused';
    case INVOICE_SCHEDULE_FAILED = 'invoice.schedule_failed';
    case ACCOUNT_CLAIMED = 'account.claimed';
    case COMPANY_CREATED = 'company.created';
    case REPRESENTATION_SIGNED = 'representation.signed';

    /**
     * Whether BeeL delivers this event only to the platform that provisioned the account.
     *
     * BeeL documents `account.claimed`, `company.created` and `representation.signed` as
     * provisioner-only: they never reach a subscription on any other account.
     *
     * @see https://docs.beel.es/webhooks/events
     */
    public function isProvisionerOnly(): bool
    {
        return match ($this) {
            self::ACCOUNT_CLAIMED, self::COMPANY_CREATED, self::REPRESENTATION_SIGNED => true,
            default => false,
        };
    }

    /**
     * The generated model of this event's `data`.
     *
     * @return class-string
     */
    public function dataModel(): string
    {
        return match ($this) {
            self::INVOICE_ISSUED => WebhookEventDataInvoiceIssued::class,
            self::INVOICE_EMAIL_SENT => WebhookEventDataInvoiceEmailSent::class,
            self::INVOICE_PDF_GENERATED => WebhookEventDataInvoicePdfGenerated::class,
            self::INVOICE_VOIDED => WebhookEventDataInvoiceVoided::class,
            self::RECURRING_INVOICE_PAUSED => WebhookEventDataRecurringInvoicePaused::class,
            self::INVOICE_SCHEDULE_FAILED => WebhookEventDataInvoiceScheduleFailed::class,
            self::VERIFACTU_STATUS_UPDATED => WebhookEventDataVeriFactuStatusUpdated::class,
            self::ACCOUNT_CLAIMED => WebhookEventDataAccountClaimed::class,
            self::COMPANY_CREATED => WebhookEventDataCompanyCreated::class,
            self::REPRESENTATION_SIGNED => WebhookEventDataRepresentationSigned::class,
        };
    }

    /**
     * The fields BeeL's contract requires in this event's `data`; a test keeps them in sync with it.
     *
     * @return list<string>
     */
    public function requiredDataFields(): array
    {
        return match ($this) {
            self::INVOICE_ISSUED, self::INVOICE_VOIDED => ['invoice_id', 'invoice_number'],
            self::INVOICE_EMAIL_SENT => ['invoice_id', 'all_recipients', 'sent_at'],
            self::INVOICE_PDF_GENERATED, self::INVOICE_SCHEDULE_FAILED => ['invoice_id'],
            self::RECURRING_INVOICE_PAUSED => ['recurring_invoice_id', 'reason', 'since'],
            self::VERIFACTU_STATUS_UPDATED => ['invoice_id', 'verifactu_registration_id', 'operation', 'new_status'],
            self::ACCOUNT_CLAIMED => ['account_id', 'external_ref'],
            self::COMPANY_CREATED => ['account_id', 'external_ref', 'nif'],
            self::REPRESENTATION_SIGNED => ['account_id', 'external_ref', 'company_id', 'nif', 'signed_at'],
        };
    }
}
