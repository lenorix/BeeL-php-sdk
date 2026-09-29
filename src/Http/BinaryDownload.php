<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * A file returned in a BeeL response body, such as a ZIP of invoice PDFs or a spreadsheet export.
 *
 * The body is the response stream as the transport returned it: the SDK never reads
 * it into memory. With a streaming transport (for example Guzzle with `'stream' => true`)
 * it is read from the network as you consume it, and it can then be read only once.
 */
final readonly class BinaryDownload
{
    /**
     * @param  StreamInterface  $body  File contents, positioned at the start when the stream is seekable.
     * @param  string|null  $fileName  Suggested file name from `Content-Disposition`, reduced to a base name.
     * @param  string|null  $contentType  Media type without parameters, such as `application/zip` or `text/csv`.
     * @param  int|null  $contentLength  Size in bytes, when known.
     * @param  array<string, int>  $counts  Invoice counts reported by BeeL; each operation documents its keys.
     * @param  string|null  $charset  The `charset` parameter of `Content-Type`, such as `utf-8`, as BeeL sent it; null when absent.
     */
    public function __construct(
        public StreamInterface $body,
        public ?string $fileName,
        public ?string $contentType,
        public ?int $contentLength,
        public array $counts = [],
        public ?string $charset = null,
    ) {}

    /**
     * Wrap a successful response without reading its body.
     *
     * @param  array<string, string>  $countHeaders  Map of count key to the response header that carries it.
     *
     * @internal
     */
    public static function fromResponse(ResponseInterface $response, array $countHeaders = []): self
    {
        $body = $response->getBody();
        if ($body->isSeekable()) {
            $body->rewind();
        }

        $length = $response->getHeaderLine('Content-Length');
        $counts = [];
        foreach ($countHeaders as $key => $header) {
            $value = trim($response->getHeaderLine($header));
            if (ctype_digit($value)) {
                $counts[$key] = (int) $value;
            }
        }

        return new self(
            $body,
            self::fileName($response->getHeaderLine('Content-Disposition')),
            trim(explode(';', $response->getHeaderLine('Content-Type'))[0]) ?: null,
            ctype_digit($length) ? (int) $length : $body->getSize(),
            $counts,
            self::charset($response->getHeaderLine('Content-Type')),
        );
    }

    /**
     * Read the `charset` parameter of a `Content-Type` value (RFC 9110): the name is
     * case-insensitive and the value may be a quoted string.
     */
    private static function charset(string $contentType): ?string
    {
        if (preg_match('/;\s*charset\s*=\s*(?:"((?:[^"\\\\]|\\\\.)*)"|([^;\s]+))/i', $contentType, $matches) !== 1) {
            return null;
        }
        $value = ($matches[2] ?? '') !== '' ? $matches[2] : (string) preg_replace('/\\\\(.)/s', '$1', $matches[1]);

        return $value === '' ? null : $value;
    }

    /**
     * Read the file name from `Content-Disposition` (RFC 6266), preferring the UTF-8 `filename*` form.
     *
     * The result is reduced to a base name, so a value such as `../../x` can never point outside
     * the directory it is saved to, and made safe to save on Windows too.
     */
    private static function fileName(string $disposition): ?string
    {
        if ($disposition === '') {
            return null;
        }

        $name = null;
        if (preg_match("/filename\\*\\s*=\\s*UTF-8''([^;]+)/i", $disposition, $matches) === 1) {
            $name = rawurldecode(trim($matches[1]));
        } elseif (preg_match('/filename\s*=\s*"((?:[^"\\\\]|\\\\.)*)"/i', $disposition, $matches) === 1) {
            $name = (string) preg_replace('/\\\\(.)/s', '$1', $matches[1]);
        } elseif (preg_match('/filename\s*=\s*([^;\s]+)/i', $disposition, $matches) === 1) {
            $name = $matches[1];
        }
        if ($name === null) {
            return null;
        }

        $name = basename(str_replace('\\', '/', (string) preg_replace('/[\x00-\x1F\x7F]/', '', $name)));
        // Also safe on Windows: no characters it forbids (":" would name an alternate data stream),
        // no trailing dots or spaces, which it drops, and no reserved device name such as CON.
        $name = rtrim((string) preg_replace('/[<>:"|?*]/', '_', $name), '. ');
        if (preg_match('/^(CON|PRN|AUX|NUL|COM[1-9]|LPT[1-9])(\.|$)/i', $name) === 1) {
            $name = '_'.$name;
        }

        return $name === '' ? null : $name;
    }
}
