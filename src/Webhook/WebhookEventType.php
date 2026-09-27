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
     * Whether BeeL delivers this event only to the provisioner that created the account.
     *
     * BeeL documents that `account.*` events reach only the provisioner; a subscription on
     * any other account never receives them. Other events are not documented as restricted.
     */
    public function isProvisionerOnly(): bool
    {
        return str_starts_with($this->value, 'account.');
    }
}
