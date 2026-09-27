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
    /**
     * Seconds BeeL asks to wait, from the `Retry-After` header (seconds or an HTTP date) or the
     * `retry_after` field of the error body; null when BeeL gives no delay.
     *
     * @param  string|null  $body  The response body, when already read; otherwise it is read and rewound if seekable.
     */
    public static function seconds(ResponseInterface $response, ?string $body = null, ?int $now = null): ?int
    {
        $header = trim($response->getHeaderLine('Retry-After'));
        if ($header !== '' && ctype_digit($header)) {
            return (int) $header;
        }
        if ($header !== '' && ($retryAt = strtotime($header)) !== false) {
            return max(0, $retryAt - ($now ?? time()));
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

        return is_numeric($seconds) ? max(0, (int) ceil((float) $seconds)) : null;
    }
}
