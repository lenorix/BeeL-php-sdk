<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

/**
 * Holds the request options of one resource instance.
 *
 * @internal Resources renew their slot when cloned, so options set on a copy never reach the original.
 */
final class RequestOptionsSlot
{
    public ?RequestOptions $options = null;
}
