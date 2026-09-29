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

        if ($body === null) {
            $stream = $response->getBody();
            if (! $stream->isSeekable()) {
                return null;
            }
            $position = $stream->tell();
            $body = (string) $stream;
            $stream->seek($position);
        }
        $data = json_decode($body, true);
        if (! is_array($data)) {
            return null;
        }
        $error = is_array($data['error'] ?? null) ? $data['error'] : [];
        $seconds = $error['retry_after'] ?? $data['retry_after'] ?? (is_array($error['details'] ?? null) ? ($error['details']['retry_after'] ?? null) : null);

        return is_numeric($seconds) && is_finite((float) $seconds) && (float) $seconds >= 0 ? self::bounded((float) $seconds) : null;
    }

    private static function bounded(float $seconds): int
    {
        return (int) ceil(min($seconds, self::MAX_SECONDS));
    }
}
