<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;

class ProductBulkCreateStatistics implements AdditionalPropertiesInterface
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
     * Products submitted.
     *
     * @var int
     */
    protected $totalProcessed;

    /**
     * Products created.
     *
     * @var int
     */
    protected $created;

    /**
     * Rows whose code already existed.
     *
     * @var int
     */
    protected $duplicates;

    /**
     * Rows some field of which did not pass validation.
     *
     * @var int
     */
    protected $invalid;

    /**
     * Products submitted.
     */
    public function getTotalProcessed(): int
    {
        return $this->totalProcessed;
    }

    /**
     * Products submitted.
     */
    public function setTotalProcessed(int $totalProcessed): self
    {
        $this->initialized['totalProcessed'] = true;
        $this->totalProcessed = $totalProcessed;

        return $this;
    }

    /**
     * Products created.
     */
    public function getCreated(): int
    {
        return $this->created;
    }

    /**
     * Products created.
     */
    public function setCreated(int $created): self
    {
        $this->initialized['created'] = true;
        $this->created = $created;

        return $this;
    }

    /**
     * Rows whose code already existed.
     */
    public function getDuplicates(): int
    {
        return $this->duplicates;
    }

    /**
     * Rows whose code already existed.
     */
    public function setDuplicates(int $duplicates): self
    {
        $this->initialized['duplicates'] = true;
        $this->duplicates = $duplicates;

        return $this;
    }

    /**
     * Rows some field of which did not pass validation.
     */
    public function getInvalid(): int
    {
        return $this->invalid;
    }

    /**
     * Rows some field of which did not pass validation.
     */
    public function setInvalid(int $invalid): self
    {
        $this->initialized['invalid'] = true;
        $this->invalid = $invalid;

        return $this;
    }

    public function definedProperties(): array
    {
        return ['totalProcessed' => ['total_processed', 'getTotalProcessed', 'setTotalProcessed'], 'created' => ['created', 'getCreated', 'setCreated'], 'duplicates' => ['duplicates', 'getDuplicates', 'setDuplicates'], 'invalid' => ['invalid', 'getInvalid', 'setInvalid']];
    }
}
