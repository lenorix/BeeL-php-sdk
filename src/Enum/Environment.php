<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Enum;

/** Mode a record lives in: Test or Live. For a company it also decides which AEAT its NIF is registered against. */
enum Environment: string
{
    case TEST = 'TEST';
    case PROD = 'PROD';
}
