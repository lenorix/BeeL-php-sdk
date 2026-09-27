<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Enum;

/**
 * How an account relates to you in webhook subscriptions and event envelopes.
 *
 * Delivered events use `OWN` or `MANAGED`; subscriptions may also ask for `ALL`.
 */
enum WebhookAccountRelationship: string
{
    /** Your own account. */
    case OWN = 'own';

    /** An account you manage. */
    case MANAGED = 'managed';

    /** Both; valid only when creating or updating a subscription. */
    case ALL = 'all';
}
