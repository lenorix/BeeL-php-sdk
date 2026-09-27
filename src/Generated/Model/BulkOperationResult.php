<?php

namespace Lenorix\BeelSdk\Generated\Model;

use Lenorix\BeelSdk\Generated\Runtime\AdditionalAndPatternProperties;
use Lenorix\BeelSdk\Generated\Runtime\AdditionalPropertiesInterface;
class BulkOperationResult implements AdditionalPropertiesInterface
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
     * Total number of invoices processed
     *
     * @var int
     */
    protected $total;
    /**
     * Number of invoices processed successfully
     *
     * @var int
     */
    protected $successful;
    /**
     * Number of invoices that failed
     *
     * @var int
     */
    protected $failed;
    /**
     * Details of the invoices that failed
     *
     * @var list<BulkOperationResultFailuresItem>
     */
    protected $failures;
    /**
     * Total number of invoices processed
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
    /**
     * Total number of invoices processed
     *
     * @param int $total
     *
     * @return self
     */
    public function setTotal(int $total): self
    {
        $this->initialized['total'] = true;
        $this->total = $total;
        return $this;
    }
    /**
     * Number of invoices processed successfully
     *
     * @return int
     */
    public function getSuccessful(): int
    {
        return $this->successful;
    }
    /**
     * Number of invoices processed successfully
     *
     * @param int $successful
     *
     * @return self
     */
    public function setSuccessful(int $successful): self
    {
        $this->initialized['successful'] = true;
        $this->successful = $successful;
        return $this;
    }
    /**
     * Number of invoices that failed
     *
     * @return int
     */
    public function getFailed(): int
    {
        return $this->failed;
    }
    /**
     * Number of invoices that failed
     *
     * @param int $failed
     *
     * @return self
     */
    public function setFailed(int $failed): self
    {
        $this->initialized['failed'] = true;
        $this->failed = $failed;
        return $this;
    }
    /**
     * Details of the invoices that failed
     *
     * @return list<BulkOperationResultFailuresItem>
     */
    public function getFailures(): array
    {
        return $this->failures;
    }
    /**
     * Details of the invoices that failed
     *
     * @param list<BulkOperationResultFailuresItem> $failures
     *
     * @return self
     */
    public function setFailures(array $failures): self
    {
        $this->initialized['failures'] = true;
        $this->failures = $failures;
        return $this;
    }
    public function definedProperties(): array
    {
        return ['total' => ['total', 'getTotal', 'setTotal'], 'successful' => ['successful', 'getSuccessful', 'setSuccessful'], 'failed' => ['failed', 'getFailed', 'setFailed'], 'failures' => ['failures', 'getFailures', 'setFailures']];
    }
}