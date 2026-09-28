<?php

namespace Lenorix\BeelSdk\Generated\Runtime;

interface AdditionalPropertiesInterface extends \ArrayAccess, \Countable, \IteratorAggregate, \JsonSerializable
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;

    /**
     * @return iterable<string, mixed>
     */
    public function additionalPropertyEntries(): iterable;
}
