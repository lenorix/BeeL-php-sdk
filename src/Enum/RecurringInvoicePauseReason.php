<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Enum;

/** Who stopped a recurring invoice schedule. */
enum RecurringInvoicePauseReason: string
{
    /** A person paused it, from the API or the dashboard. */
    case USER = 'USER';

    /** The account lost the recurring-invoices feature. */
    case DOWNGRADE = 'DOWNGRADE';

    /** An unattended run failed with an error that retrying will not fix. */
    case GENERATION_FAILURE = 'GENERATION_FAILURE';
}
