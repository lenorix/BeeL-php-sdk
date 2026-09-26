<?php

declare(strict_types=1);

namespace Lenorix\BeelSdk\Tests\Support;

use LogicException;
use Psr\Http\Message\StreamInterface;

/** A response body that fails the test if anything reads it whole. */
final class TripwireStream implements StreamInterface
{
    public int $reads = 0;

    private int $position = 0;

    public function __construct(private readonly string $contents, private readonly bool $seekable = true) {}

    public function __toString(): string
    {
        throw new LogicException('The download body was read into a string.');
    }

    public function getContents(): string
    {
        throw new LogicException('The download body was read whole.');
    }

    public function read(int $length): string
    {
        $this->reads++;
        $chunk = substr($this->contents, $this->position, $length);
        $this->position += strlen($chunk);

        return $chunk;
    }

    public function close(): void {}

    public function detach()
    {
        return null;
    }

    public function getSize(): ?int
    {
        return strlen($this->contents);
    }

    public function tell(): int
    {
        return $this->position;
    }

    public function eof(): bool
    {
        return $this->position >= strlen($this->contents);
    }

    public function isSeekable(): bool
    {
        return $this->seekable;
    }

    public function seek(int $offset, int $whence = SEEK_SET): void
    {
        if (! $this->seekable) {
            throw new LogicException('Stream is not seekable.');
        }
        $this->position = $offset;
    }

    public function rewind(): void
    {
        $this->seek(0);
    }

    public function isWritable(): bool
    {
        return false;
    }

    public function write(string $string): int
    {
        throw new LogicException('Stream is not writable.');
    }

    public function isReadable(): bool
    {
        return true;
    }

    public function getMetadata(?string $key = null)
    {
        return $key === null ? [] : null;
    }
}
