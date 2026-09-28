<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Exception;

/**
 * BeeL answered with a success status this SDK version does not recognise for the operation.
 *
 * The request may well have succeeded: BeeL sometimes adds a success status (such as `202`)
 * before this SDK is updated. It does not extend {@see BeelApiError}, so a generic error handler
 * does not treat a possible success as a failure. Inspect `Beel::getLastResponse()` before
 * retrying, since repeating a write that succeeded could duplicate it.
 */
final class BeelUnexpectedResponseError extends \RuntimeException
{
    /**
     * @param  int  $statusCode  The success status BeeL answered with.
     * @param  string|null  $requestId  BeeL request ID to include when contacting support.
     */
    public function __construct(
        public readonly int $statusCode,
        public readonly ?string $requestId = null,
    ) {
        parent::__construct(sprintf(
            'BeeL answered HTTP %d, a success status this SDK version does not recognise for this operation. The request may have succeeded: check $beel->getLastResponse() before retrying, and update the SDK.',
            $statusCode,
        ));
    }
}
