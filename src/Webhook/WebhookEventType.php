<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Webhook;

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
}
