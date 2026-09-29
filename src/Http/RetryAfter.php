<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * Reads how long BeeL asks to wait before retrying, so the transport and the exceptions agree.
 *
 * @internal
 */
final class RetryAfter
{
    /** Longest delay read from BeeL: a year, well beyond any retry, which keeps the arithmetic in range. */
    private const MAX_SECONDS = 31_536_000;

    /**
     * Seconds BeeL asks to wait, from the `Retry-After` header (seconds or an HTTP date) or the
     * `retry_after` field of the error body; null when BeeL gives no valid delay.
     *
     * Anything else, such as a negative number or text, is ignored, so the caller backs off instead
     * of retrying at once.
     *
     * @param  string|null  $body  The response body, when already read; otherwise it is read and rewound if seekable.
     */
    public static function seconds(ResponseInterface $response, ?string $body = null, ?int $now = null): ?int
    {
        $header = trim($response->getHeaderLine('Retry-After'));
        if (preg_match('/^\d+(\.\d+)?$/', $header) === 1) {
            return self::bounded((float) $header);
        }
        // Only an IMF-fixdate (RFC 9110), such as "Sun, 06 Nov 1994 08:49:37 GMT".
        $retryAt = $header === '' ? false : \DateTimeImmutable::createFromFormat('!D, d M Y H:i:s \G\M\T', $header, new \DateTimeZone('UTC'));
        if ($retryAt !== false && $retryAt->format('D, d M Y H:i:s \G\M\T') === $header) {
            return max(0, $retryAt->getTimestamp() - ($now ?? time()));
        }

        return ErrorBody::fromJson($body ?? Responses::peekBody($response))->retryAfter();
    }

    /**
     * Seconds from a `retry_after` value: a finite, non-negative number, rounded up; null for anything else.
     */
    public static function fromValue(mixed $seconds): ?int
    {
        return is_numeric($seconds) && is_finite((float) $seconds) && (float) $seconds >= 0 ? self::bounded((float) $seconds) : null;
    }

    private static function bounded(float $seconds): int
    {
        return (int) ceil(min($seconds, self::MAX_SECONDS));
    }
}
