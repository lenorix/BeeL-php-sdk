<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Enum;

/** Submission status of an invoice's VeriFactu record to AEAT. */
enum VeriFactuSubmissionStatus: string
{
    case PENDING = 'PENDING';
    case ACCEPTED = 'ACCEPTED';
    case VOIDED = 'VOIDED';
    case REJECTED = 'REJECTED';
    case NOT_SUBMITTED = 'NOT_SUBMITTED';
}
