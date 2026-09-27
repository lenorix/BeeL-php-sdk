<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class CustomerBulkDeleteMetadata implements AdditionalPropertiesInterface
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
     * Number of identifiers submitted.
     *
     * @var int
     */
    protected $totalCustomers;
    /**
     * The batch operation this report belongs to.
     *
     * @var string
     */
    protected $operation;
    /**
     * Always `false`. Deleting has no rehearsal mode; the field is here so every batch report
     * of this API has the same shape.
     * 
     *
     * @var bool
     */
    protected $isDryRun;
    /**
     * Number of identifiers submitted.
     *
     * @return int
     */
    public function getTotalCustomers(): int
    {
        return $this->totalCustomers;
    }
    /**
     * Number of identifiers submitted.
     *
     * @param int $totalCustomers
     *
     * @return self
     */
    public function setTotalCustomers(int $totalCustomers): self
    {
        $this->initialized['totalCustomers'] = true;
        $this->totalCustomers = $totalCustomers;
        return $this;
    }
    /**
     * The batch operation this report belongs to.
     *
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }
    /**
     * The batch operation this report belongs to.
     *
     * @param string $operation
     *
     * @return self
     */
    public function setOperation(string $operation): self
    {
        $this->initialized['operation'] = true;
        $this->operation = $operation;
        return $this;
    }
    /**
     * Always `false`. Deleting has no rehearsal mode; the field is here so every batch report
     * of this API has the same shape.
     * 
     *
     * @return bool
     */
    public function getIsDryRun(): bool
    {
        return $this->isDryRun;
    }
    /**
    * Always `false`. Deleting has no rehearsal mode; the field is here so every batch report
    of this API has the same shape.
    
    *
    * @param bool $isDryRun
    *
    * @return self
    */
    public function setIsDryRun(bool $isDryRun): self
    {
        $this->initialized['isDryRun'] = true;
        $this->isDryRun = $isDryRun;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['totalCustomers' => ['total_customers', 'getTotalCustomers', 'setTotalCustomers'], 'operation' => ['operation', 'getOperation', 'setOperation'], 'isDryRun' => ['is_dry_run', 'getIsDryRun', 'setIsDryRun']];
    }
}