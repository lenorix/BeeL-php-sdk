<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/**
 * Any exception about a BeeL API response: an error ({@see BeelApiError}), a result still being
 * generated ({@see BeelNotReadyError}) or a success the SDK cannot read ({@see BeelUnexpectedResponseError}).
 *
 * Catch it to handle all of them at once, for example to log BeeL's request ID.
 */
interface BeelException extends \Throwable
{
    /**
     * Structured data for logging, such as a PSR-3 context array, including the request ID BeeL support needs.
     *
     * @return array<string, mixed>
     */
    public function context(): array;
}
