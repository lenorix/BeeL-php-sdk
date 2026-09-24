<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Webhook;

/** Public webhook event names supported by BeeL subscriptions. */
enum WebhookEventType: string
{
    case VERIFACTU_STATUS_UPDATED = 'verifactu.status.updated';
    case INVOICE_ISSUED = 'invoice.issued';
    case INVOICE_EMAIL_SENT = 'invoice.email.sent';
    case INVOICE_VOIDED = 'invoice.voided';
    case RECURRING_INVOICE_PAUSED = 'recurring_invoice.paused';
    case ACCOUNT_CLAIMED = 'account.claimed';
    case COMPANY_CREATED = 'company.created';
    case REPRESENTATION_SIGNED = 'representation.signed';
}
