<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class RequestLogCursorPagination implements AdditionalPropertiesInterface
{
    use AdditionalAndPatternProperties;

    /**
     * @var array
     */
    protected $initialized = [];

    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }

    /**
     * Opaque cursor for the next (older) page. Null if there are no more.
     *
     * @var string|null
     */
    protected $nextCursor;

    /**
     * Opaque cursor for the previous (newer) page. Null if this is the first.
     *
     * @var string|null
     */
    protected $prevCursor;

    /**
     * @var bool
     */
    protected $hasNext;

    /**
     * @var bool
     */
    protected $hasPrevious;

    /**
     * Opaque cursor for the next (older) page. Null if there are no more.
     */
    public function getNextCursor(): ?string
    {
        return $this->nextCursor;
    }

    /**
     * Opaque cursor for the next (older) page. Null if there are no more.
     */
    public function setNextCursor(?string $nextCursor): self
    {
        $this->initialized['nextCursor'] = true;
        $this->nextCursor = $nextCursor;

        return $this;
    }

    /**
     * Opaque cursor for the previous (newer) page. Null if this is the first.
     */
    public function getPrevCursor(): ?string
    {
        return $this->prevCursor;
    }

    /**
     * Opaque cursor for the previous (newer) page. Null if this is the first.
     */
    public function setPrevCursor(?string $prevCursor): self
    {
        $this->initialized['prevCursor'] = true;
        $this->prevCursor = $prevCursor;

        return $this;
    }

    public function getHasNext(): bool
    {
        return $this->hasNext;
    }

    public function setHasNext(bool $hasNext): self
    {
        $this->initialized['hasNext'] = true;
        $this->hasNext = $hasNext;

        return $this;
    }

    public function getHasPrevious(): bool
    {
        return $this->hasPrevious;
    }

    public function setHasPrevious(bool $hasPrevious): self
    {
        $this->initialized['hasPrevious'] = true;
        $this->hasPrevious = $hasPrevious;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['nextCursor' => ['next_cursor', 'getNextCursor', 'setNextCursor'], 'prevCursor' => ['prev_cursor', 'getPrevCursor', 'setPrevCursor'], 'hasNext' => ['has_next', 'getHasNext', 'setHasNext'], 'hasPrevious' => ['has_previous', 'getHasPrevious', 'setHasPrevious']];
    }
}
